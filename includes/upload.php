<?php
require_once 'database.php';

class CertificateUpload {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function processUpload($file, $user_id) {
        // Check for errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'File upload error.'];
        }
        
        // Check file size
        if ($file['size'] > MAX_FILE_SIZE) {
            return ['success' => false, 'message' => 'File is too large.'];
        }
        
        // Check file type
        $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($file_ext, ALLOWED_FILE_TYPES)) {
            return ['success' => false, 'message' => 'Invalid file type.'];
        }
        
        // Generate unique filename
        $new_filename = uniqid() . '_' . time() . '.' . $file_ext;
        $destination = UPLOAD_DIR . $new_filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Save to database
            $query = "INSERT INTO certificates (user_id, original_filename, stored_filename, status) 
                      VALUES (:user_id, :original_filename, :stored_filename, 'pending')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":original_filename", $file['name']);
            $stmt->bindParam(":stored_filename", $new_filename);
            
            if ($stmt->execute()) {
                $certificate_id = $this->conn->lastInsertId();
                
                // Process verification (in a real system, this might be a queue job)
                $verification_result = $this->verifyCertificate($destination);
                
                // Update database with results
                $this->updateVerificationResult($certificate_id, $verification_result);
                
                return [
                    'success' => true, 
                    'certificate_id' => $certificate_id,
                    'result' => $verification_result
                ];
            }
        }
        
        return ['success' => false, 'message' => 'Failed to process upload.'];
    }
    
    private function verifyCertificate($file_path) {
        // This is a simplified version - in a real system, you would use:
        // 1. Image processing libraries (like OpenCV via PHP extension)
        // 2. OCR (Tesseract OCR)
        // 3. Machine learning models (via API calls to Python services)
        
        // For demonstration, we'll return a mock result
        $authenticity_score = rand(70, 100); // Random score for demo
        
        // Generate a grade based on score
        if ($authenticity_score >= 90) $grade = 'A';
        elseif ($authenticity_score >= 80) $grade = 'B';
        elseif ($authenticity_score >= 70) $grade = 'C';
        elseif ($authenticity_score >= 60) $grade = 'D';
        else $grade = 'F';
        
        // Check for common issues (mock data)
        $issues = [];
        if ($authenticity_score < 85) {
            $possible_issues = [
                'Font inconsistency detected',
                'Signature mismatch',
                'Logo appears altered',
                'Security features missing',
                'Formatting irregularities'
            ];
            
            $num_issues = rand(1, 3);
            for ($i = 0; $i < $num_issues; $i++) {
                $random_issue = $possible_issues[array_rand($possible_issues)];
                if (!in_array($random_issue, $issues)) {
                    $issues[] = $random_issue;
                }
            }
        }
        
        return [
            'authenticity_score' => $authenticity_score,
            'grade' => $grade,
            'issues' => $issues,
            'verification_date' => date('Y-m-d H:i:s')
        ];
    }
    
    private function updateVerificationResult($certificate_id, $result) {
        $query = "UPDATE certificates 
                  SET verification_result = :result, grade = :grade, status = 'completed' 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":result", json_encode($result));
        $stmt->bindParam(":grade", $result['grade']);
        $stmt->bindParam(":id", $certificate_id);
        $stmt->execute();
    }
    
    public function getCertificate($certificate_id, $user_id) {
        $query = "SELECT * FROM certificates WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $certificate_id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1) {
            $certificate = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($certificate['verification_result']) {
                $certificate['verification_result'] = json_decode($certificate['verification_result'], true);
            }
            return $certificate;
        }
        return false;
    }
    
    public function getUserCertificates($user_id) {
        $query = "SELECT * FROM certificates WHERE user_id = :user_id ORDER BY upload_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        
        $certificates = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['verification_result']) {
                $row['verification_result'] = json_decode($row['verification_result'], true);
            }
            $certificates[] = $row;
        }
        return $certificates;
    }
}
?>