<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Roadmap - CertiVerify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --accent: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #ffb800;
            --danger: #f72585;
            --gray: #6c757d;
            --light-gray: #e9ecef;
        }

        body {
            background-color: #f8f9fa;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .logo i {
            margin-right: 10px;
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-left: 30px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--accent);
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            background: #ff0676;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid white;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary);
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .page-header h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
        }

        .breadcrumb {
            display: flex;
            justify-content: center;
            list-style: none;
        }

        .breadcrumb li {
            margin: 0 10px;
        }

        .breadcrumb a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb li:not(:last-child)::after {
            content: ">";
            margin-left: 20px;
            opacity: 0.7;
        }

        /* Roadmap Section */
        .roadmap {
            padding: 80px 0;
        }

        .roadmap-container {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .form-section {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .form-section h2 {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1em;
        }

        .checkbox-group {
            margin-top: 10px;
        }

        .checkbox-item {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .checkbox-item input {
            margin-right: 10px;
        }

        /* Roadmap Preview */
        .roadmap-preview {
            flex: 2;
            min-width: 300px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .roadmap-preview h2 {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .roadmap-placeholder {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray);
        }

        .roadmap-placeholder i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: var(--light-gray);
        }

        /* Roadmap Visualization */
        .roadmap-visualization {
            display: none;
            margin-top: 30px;
        }

        .roadmap-phase {
            margin-bottom: 40px;
            position: relative;
            padding-left: 30px;
            border-left: 3px solid var(--primary);
        }

        .phase-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .phase-number {
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .phase-title {
            font-size: 1.5rem;
            color: var(--secondary);
        }

        .phase-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-left: 55px;
        }

        .cert-card {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .cert-card:hover {
            transform: translateY(-5px);
        }

        .cert-card h4 {
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .cert-card p {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .cert-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: var(--gray);
        }

        /* Popular Roles Section */
        .popular-roles {
            padding: 80px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--secondary);
            margin-bottom: 15px;
        }

        .section-title p {
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
        }

        .roles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .role-card {
            background: var(--light);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            text-align: center;
            cursor: pointer;
        }

        .role-card:hover {
            transform: translateY(-10px);
        }

        .role-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
        }

        .role-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--secondary);
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            color: var(--accent);
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column a {
            color: var(--light-gray);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column a:hover {
            color: var(--accent);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: all 0.3s;
        }

        .social-links a:hover {
            background: var(--accent);
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--light-gray);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .roadmap-container {
                flex-direction: column;
            }

            .page-header h1 {
                font-size: 2.2rem;
            }

            .phase-cards {
                margin-left: 0;
                grid-template-columns: 1fr;
            }

            .roadmap-phase {
                padding-left: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <i class="fas fa-certificate"></i>
                    <span>CertiVerify</span>
                </div>
                <ul class="nav-links">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="verify.html">Verify Certificate</a></li>
                    <li><a href="career.html" class="active">Career Roadmap</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <a href="login.html" class="btn btn-outline">Login</a>
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Career Roadmap Generator</h1>
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="career.html">Career Roadmap</a></li>
            </ul>
        </div>
    </section>

    <!-- Roadmap Section -->
    <section class="roadmap">
        <div class="container">
            <div class="roadmap-container">
                <div class="form-section">
                    <h2>Create Your Career Path</h2>
                    <p>Select your desired role and current certifications to generate a personalized roadmap.</p>
                    
                    <div class="form-group">
                        <label for="careerRole">Desired Career Role</label>
                        <select id="careerRole" class="form-control">
                            <option value="">Select a role</option>
                            <option value="cloud-architect">Cloud Architect</option>
                            <option value="data-scientist">Data Scientist</option>
                            <option value="cybersecurity-analyst">Cybersecurity Analyst</option>
                            <option value="devops-engineer">DevOps Engineer</option>
                            <option value="software-developer">Software Developer</option>
                            <option value="ai-engineer">AI Engineer</option>
                            <option value="network-engineer">Network Engineer</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Current Certifications (Select all that apply)</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" id="aws-cloud" value="aws-cloud">
                                <label for="aws-cloud">AWS Cloud Practitioner</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="comptia-a" value="comptia-a">
                                <label for="comptia-a">CompTIA A+</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="comptia-security" value="comptia-security">
                                <label for="comptia-security">CompTIA Security+</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="google-it" value="google-it">
                                <label for="google-it">Google IT Support</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" id="azure-fundamentals" value="azure-fundamentals">
                                <label for="azure-fundamentals">Azure Fundamentals</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="experienceLevel">Experience Level</label>
                        <select id="experienceLevel" class="form-control">
                            <option value="beginner">Beginner (0-2 years)</option>
                            <option value="intermediate">Intermediate (2-5 years)</option>
                            <option value="advanced">Advanced (5+ years)</option>
                        </select>
                    </div>

                    <button class="btn" style="width: 100%;" onclick="generateRoadmap()">Generate Roadmap</button>
                </div>

                <div class="roadmap-preview">
                    <h2>Your Career Roadmap</h2>
                    <div class="roadmap-placeholder" id="roadmapPlaceholder">
                        <i class="fas fa-road"></i>
                        <p>Your personalized career roadmap will appear here after you select a role and generate your path.</p>
                    </div>

                    <div class="roadmap-visualization" id="roadmapVisualization">
                        <h3 id="roadmapTitle">Cloud Architect Career Path</h3>
                        <p id="roadmapDescription">Based on your selected role and current certifications, here's your personalized certification path:</p>
                        
                        <div class="roadmap-phase">
                            <div class="phase-header">
                                <div class="phase-number">1</div>
                                <h3 class="phase-title">Foundation Phase (0-6 months)</h3>
                            </div>
                            <div class="phase-cards">
                                <div class="cert-card">
                                    <h4>AWS Cloud Practitioner</h4>
                                    <p>Fundamental understanding of AWS Cloud concepts</p>
                                    <div class="cert-meta">
                                        <span>Difficulty: Beginner</span>
                                        <span>Duration: 1-2 months</span>
                                    </div>
                                </div>
                                <div class="cert-card">
                                    <h4>CompTIA Network+</h4>
                                    <p>Networking concepts and infrastructure</p>
                                    <div class="cert-meta">
                                        <span>Difficulty: Beginner</span>
                                        <span>Duration: 2-3 months</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="roadmap-phase">
                            <div class="phase-header">
                                <div class="phase-number">2</div>
                                <h3 class="phase-title">Intermediate Phase (6-18 months)</h3>
                            </div>
                            <div class="phase-cards">
                                <div class="cert-card">
                                    <h4>AWS Solutions Architect Associate</h4>
                                    <p>Design distributed systems on AWS</p>
                                    <div class="cert-meta">
                                        <span>Difficulty: Intermediate</span>
                                        <span>Duration: 3-4 months</span>
                                    </div>
                                </div>
                                <div class="cert-card">
                                    <h4>Microsoft Azure Administrator</h4>
                                    <p>Implement, manage and monitor Azure solutions</p>
                                    <div class="cert-meta">
                                        <span>Difficulty: Intermediate</span>
                                        <span>Duration: 3-4 months</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="roadmap-phase">
                            <div class="phase-header">
                                <div class="phase-number">3</div>
                                <h3 class="phase-title">Advanced Phase (18-36 months)</h3>
                            </div>
                            <div class="phase-cards">
                                <div class="cert-card">
                                    <h4>AWS Solutions Architect Professional</h4>
                                    <p>Advanced designing of distributed systems on AWS</p>
                                    <div class="cert-meta">
                                        <span>Difficulty: Advanced</span>
                                        <span>Duration: 4-6 months</span>
                                    </div>
                                </div>
                                <div class="cert-card">
                                    <h4>Google Cloud Professional Architect</h4>
                                    <p>Design, develop, and manage cloud architecture</p>
                                    <div class="cert-meta">
                                        <span>Difficulty: Advanced</span>
                                        <span>Duration: 4-6 months</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Roles Section -->
    <section class="popular-roles">
        <div class="container">
            <div class="section-title">
                <h2>Popular Career Paths</h2>
                <p>Explore certification roadmaps for these in-demand IT roles</p>
            </div>
            <div class="roles-grid">
                <div class="role-card" onclick="selectRole('cloud-architect')">
                    <div class="role-icon">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <h3>Cloud Architect</h3>
                    <p>Design and manage cloud infrastructure solutions</p>
                </div>
                <div class="role-card" onclick="selectRole('data-scientist')">
                    <div class="role-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Data Scientist</h3>
                    <p>Extract insights from complex data sets</p>
                </div>
                <div class="role-card" onclick="selectRole('cybersecurity-analyst')">
                    <div class="role-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Cybersecurity Analyst</h3>
                    <p>Protect systems and networks from cyber threats</p>
                </div>
                <div class="role-card" onclick="selectRole('devops-engineer')">
                    <div class="role-icon">
                        <i class="fas fa-code-branch"></i>
                    </div>
                    <h3>DevOps Engineer</h3>
                    <p>Bridge development and operations for efficient delivery</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>CertiVerify</h3>
                    <p>The leading platform for certificate verification and career roadmap planning.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="verify.html">Verify Certificate</a></li>
                        <li><a href="career.html">Career Roadmap</a></li>
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="verify.html">Certificate Verification</a></li>
                        <li><a href="verify.html">Certificate Grading</a></li>
                        <li><a href="career.html">Career Roadmap</a></li>
                        <li><a href="#">For Employers</a></li>
                        <li><a href="#">For Institutions</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> 123 Tech Street, Innovation City</li>
                        <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-envelope"></i> info@certiverify.com</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2023 CertiVerify. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Function to select a role from the popular roles section
        function selectRole(role) {
            document.getElementById('careerRole').value = role;
            generateRoadmap();
        }

        // Function to generate the roadmap
        function generateRoadmap() {
            const role = document.getElementById('careerRole').value;
            const experience = document.getElementById('experienceLevel').value;
            
            if (!role) {
                alert('Please select a career role first');
                return;
            }
            
            // Hide placeholder and show visualization
            document.getElementById('roadmapPlaceholder').style.display = 'none';
            document.getElementById('roadmapVisualization').style.display = 'block';
            
            // Update roadmap title based on selection
            const roleTitles = {
                'cloud-architect': 'Cloud Architect',
                'data-scientist': 'Data Scientist',
                'cybersecurity-analyst': 'Cybersecurity Analyst',
                'devops-engineer': 'DevOps Engineer',
                'software-developer': 'Software Developer',
                'ai-engineer': 'AI Engineer',
                'network-engineer': 'Network Engineer'
            };
            
            document.getElementById('roadmapTitle').textContent = `${roleTitles[role]} Career Path`;
            
            // Scroll to the roadmap section
            document.getElementById('roadmapVisualization').scrollIntoView({ behavior: 'smooth' });
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Add any initialization code here
        });
    </script>
</body>
</html>