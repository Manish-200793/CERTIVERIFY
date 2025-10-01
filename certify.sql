-- Create Database
CREATE DATABASE IF NOT EXISTS certiverify;
USE certiverify;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    role ENUM('student', 'employer', 'admin') DEFAULT 'student'
);

-- Certificates Table
CREATE TABLE certificates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    original_filename VARCHAR(255),
    stored_filename VARCHAR(255),
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    verification_result JSON,
    grade VARCHAR(5),
    status ENUM('pending', 'processing', 'completed', 'failed') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Career Roles Table
CREATE TABLE career_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    avg_salary VARCHAR(50),
    demand_level ENUM('low', 'medium', 'high', 'very_high')
);

-- Certifications Table
CREATE TABLE certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    provider VARCHAR(100),
    difficulty ENUM('beginner', 'intermediate', 'advanced'),
    estimated_duration VARCHAR(50),
    description TEXT,
    avg_cost DECIMAL(10, 2)
);

-- Roadmap Table
CREATE TABLE roadmaps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    role_id INT,
    generated_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    roadmap_data JSON,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES career_roles(id)
);

-- Role-Certification Mapping Table
CREATE TABLE role_certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT,
    cert_id INT,
    phase ENUM('foundation', 'intermediate', 'advanced'),
    recommended_order INT,
    FOREIGN KEY (role_id) REFERENCES career_roles(id),
    FOREIGN KEY (cert_id) REFERENCES certifications(id)
);

-- User Certifications Table (to track user's completed certs)
CREATE TABLE user_certifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    cert_id INT,
    completion_date DATE,
    verification_id INT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (cert_id) REFERENCES certifications(id),
    FOREIGN KEY (verification_id) REFERENCES certificates(id)
);

-- Insert sample career roles
INSERT INTO career_roles (name, description, avg_salary, demand_level) VALUES
('Cloud Architect', 'Design and manage cloud infrastructure solutions', '$120,000', 'high'),
('Data Scientist', 'Extract insights from complex data sets', '$115,000', 'very_high'),
('Cybersecurity Analyst', 'Protect systems and networks from cyber threats', '$100,000', 'high'),
('DevOps Engineer', 'Bridge development and operations for efficient delivery', '$110,000', 'high'),
('Software Developer', 'Design, develop, and test software applications', '$90,000', 'high'),
('AI Engineer', 'Develop artificial intelligence models and systems', '$130,000', 'very_high'),
('Network Engineer', 'Design and implement computer networks', '$85,000', 'medium');

-- Insert sample certifications
INSERT INTO certifications (name, provider, difficulty, estimated_duration, description, avg_cost) VALUES
('AWS Cloud Practitioner', 'Amazon', 'beginner', '1-2 months', 'Fundamental understanding of AWS Cloud concepts', 0),
('AWS Solutions Architect Associate', 'Amazon', 'intermediate', '3-4 months', 'Design distributed systems on AWS', 150),
('AWS Solutions Architect Professional', 'Amazon', 'advanced', '4-6 months', 'Advanced designing of distributed systems on AWS', 300),
('CompTIA Network+', 'CompTIA', 'beginner', '2-3 months', 'Networking concepts and infrastructure', 329),
('Microsoft Azure Administrator', 'Microsoft', 'intermediate', '3-4 months', 'Implement, manage and monitor Azure solutions', 165),
('Google Cloud Professional Architect', 'Google', 'advanced', '4-6 months', 'Design, develop, and manage cloud architecture', 200),
('Certified Data Professional', 'ICCP', 'intermediate', '3-5 months', 'Data management and analytics', 300),
('Certified Information Systems Security Professional', '(ISC)²', 'advanced', '5-6 months', 'Advanced cybersecurity skills', 699);

-- Map certifications to roles (Cloud Architect example)
INSERT INTO role_certifications (role_id, cert_id, phase, recommended_order) VALUES
(1, 1, 'foundation', 1),
(1, 4, 'foundation', 2),
(1, 2, 'intermediate', 1),
(1, 5, 'intermediate', 2),
(1, 3, 'advanced', 1),
(1, 6, 'advanced', 2);

-- Insert more mappings for other roles as needed...

-- Insert a sample admin user (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@certiverify.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Note: The password is hashed using password_hash('admin123', PASSWORD_DEFAULT)