<?php
require_once 'database.php';

class RoadmapGenerator {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getCareerRoles() {
        $query = "SELECT * FROM career_roles ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $roles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $roles[] = $row;
        }
        return $roles;
    }
    
    public function getUserCertifications($user_id) {
        $query = "SELECT c.* FROM user_certifications uc 
                  JOIN certifications c ON uc.cert_id = c.id 
                  WHERE uc.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        
        $certs = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $certs[] = $row;
        }
        return $certs;
    }
    
    public function generateRoadmap($user_id, $role_id, $experience_level) {
        // Get target role details
        $role_query = "SELECT * FROM career_roles WHERE id = :role_id";
        $role_stmt = $this->conn->prepare($role_query);
        $role_stmt->bindParam(":role_id", $role_id);
        $role_stmt->execute();
        $role = $role_stmt->fetch(PDO::FETCH_ASSOC);
        
        // Get user's current certifications
        $user_certs = $this->getUserCertifications($user_id);
        $user_cert_ids = array_column($user_certs, 'id');
        
        // Get recommended certifications for this role
        $certs_query = "SELECT c.*, rc.phase, rc.recommended_order 
                        FROM role_certifications rc 
                        JOIN certifications c ON rc.cert_id = c.id 
                        WHERE rc.role_id = :role_id 
                        ORDER BY rc.recommended_order";
        $certs_stmt = $this->conn->prepare($certs_query);
        $certs_stmt->bindParam(":role_id", $role_id);
        $certs_stmt->execute();
        
        $recommended_certs = [];
        while ($row = $certs_stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['completed'] = in_array($row['id'], $user_cert_ids);
            $recommended_certs[$row['phase']][] = $row;
        }
        
        // Adjust based on experience level
        $phases = $this->adjustForExperienceLevel($recommended_certs, $experience_level);
        
        // Generate roadmap data
        $roadmap_data = [
            'role' => $role,
            'experience_level' => $experience_level,
            'generated_date' => date('Y-m-d H:i:s'),
            'phases' => $phases
        ];
        
        // Save to database
        $query = "INSERT INTO roadmaps (user_id, role_id, roadmap_data) 
                  VALUES (:user_id, :role_id, :roadmap_data)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":role_id", $role_id);
        $stmt->bindParam(":roadmap_data", json_encode($roadmap_data));
        $stmt->execute();
        
        $roadmap_id = $this->conn->lastInsertId();
        
        return [
            'roadmap_id' => $roadmap_id,
            'roadmap_data' => $roadmap_data
        ];
    }
    
    private function adjustForExperienceLevel($certs, $experience_level) {
        // Adjust certification recommendations based on experience
        switch ($experience_level) {
            case 'beginner':
                // Include all phases
                return $certs;
                
            case 'intermediate':
                // Skip some foundation certs if already known
                if (isset($certs['foundation'])) {
                    $certs['foundation'] = array_slice($certs['foundation'], 0, 1);
                }
                return $certs;
                
            case 'advanced':
                // Focus on advanced certifications
                if (isset($certs['foundation'])) {
                    $certs['foundation'] = [];
                }
                if (isset($certs['intermediate'])) {
                    $certs['intermediate'] = array_slice($certs['intermediate'], 0, 1);
                }
                return $certs;
                
            default:
                return $certs;
        }
    }
    
    public function getRoadmap($roadmap_id, $user_id) {
        $query = "SELECT r.*, cr.name as role_name 
                  FROM roadmaps r 
                  JOIN career_roles cr ON r.role_id = cr.id 
                  WHERE r.id = :id AND r.user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $roadmap_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1) {
            $roadmap = $stmt->fetch(PDO::FETCH_ASSOC);
            $roadmap['roadmap_data'] = json_decode($roadmap['roadmap_data'], true);
            return $roadmap;
        }
        return false;
    }
    
    public function getUserRoadmaps($user_id) {
        $query = "SELECT r.*, cr.name as role_name 
                  FROM roadmaps r 
                  JOIN career_roles cr ON r.role_id = cr.id 
                  WHERE r.user_id = :user_id 
                  ORDER BY r.generated_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        
        $roadmaps = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['roadmap_data'] = json_decode($row['roadmap_data'], true);
            $roadmaps[] = $row;
        }
        return $roadmaps;
    }
}
?>