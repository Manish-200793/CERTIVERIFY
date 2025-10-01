<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Certificate - CertiVerify</title>
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

        /* Verification Section */
        .verification {
            padding: 80px 0;
        }

        .verification-container {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .upload-section {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .upload-section h2 {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .upload-area {
            border: 2px dashed var(--primary);
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            margin-bottom: 20px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .upload-area:hover {
            background: rgba(67, 97, 238, 0.05);
        }

        .upload-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .upload-text {
            margin-bottom: 15px;
        }

        .file-input {
            display: none;
        }

        .btn-upload {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-upload:hover {
            background: var(--secondary);
        }

        .or-divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .or-divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--light-gray);
            z-index: 1;
        }

        .or-text {
            display: inline-block;
            background: white;
            padding: 0 15px;
            position: relative;
            z-index: 2;
            color: var(--gray);
        }

        .certificate-id-form {
            margin-top: 20px;
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

        /* How It Works Sidebar */
        .how-it-works-sidebar {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .how-it-works-sidebar h2 {
            color: var(--secondary);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .process-steps {
            list-style: none;
        }

        .process-step {
            display: flex;
            margin-bottom: 25px;
            position: relative;
        }

        .process-step:not(:last-child)::after {
            content: "";
            position: absolute;
            left: 20px;
            top: 40px;
            bottom: -25px;
            width: 2px;
            background: var(--light-gray);
        }

        .step-number {
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

        .step-content h3 {
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        /* Features Section */
        .features {
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

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: var(--light);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
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

        .feature-card h3 {
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

            .verification-container {
                flex-direction: column;
            }

            .page-header h1 {
                font-size: 2.2rem;
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
                    <li><a href="verify.html" class="active">Verify Certificate</a></li>
                    <li><a href="career.html">Career Roadmap</a></li>
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
            <h1>Certificate Verification</h1>
            <ul class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="verify.html">Verify Certificate</a></li>
            </ul>
        </div>
    </section>

    <!-- Verification Section -->
    <section class="verification">
        <div class="container">
            <div class="verification-container">
                <div class="upload-section">
                    <h2>Verify Your Certificate</h2>
                    <p>Upload your certificate or enter the certificate ID to verify its authenticity and get a detailed report.</p>
                    
                    <div class="upload-area" id="dropZone">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <p class="upload-text">Drag & drop your certificate file here</p>
                        <p class="upload-text">OR</p>
                        <input type="file" id="fileInput" class="file-input" accept=".jpg,.jpeg,.png,.pdf">
                        <button class="btn-upload" onclick="document.getElementById('fileInput').click()">Browse Files</button>
                    </div>

                    <div class="or-divider">
                        <span class="or-text">OR</span>
                    </div>

                    <div class="certificate-id-form">
                        <div class="form-group">
                            <label for="certificateId">Enter Certificate ID</label>
                            <input type="text" id="certificateId" class="form-control" placeholder="e.g., CERT-1234-5678-90AB">
                        </div>
                        <button class="btn" style="width: 100%;">Verify Certificate</button>
                    </div>
                </div>

                <div class="how-it-works-sidebar">
                    <h2>How Verification Works</h2>
                    <ul class="process-steps">
                        <li class="process-step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h3>Upload Your Certificate</h3>
                                <p>Upload a clear image or PDF of your certificate</p>
                            </div>
                        </li>
                        <li class="process-step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h3>AI Analysis</h3>
                                <p>Our system analyzes security features and compares against databases</p>
                            </div>
                        </li>
                        <li class="process-step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h3>Get Detailed Report</h3>
                                <p>Receive a comprehensive report with authenticity score</p>
                            </div>
                        </li>
                        <li class="process-step">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h3>Certificate Grading</h3>
                                <p>Get a grade based on authenticity and recognition</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Verify Certificates?</h2>
                <p>Protect yourself from fraud and make informed decisions with our verification system</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Prevent Fraud</h3>
                    <p>Detect fake certificates and protect your organization from fraudulent claims.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Make Informed Decisions</h3>
                    <p>Get detailed insights about certificates to make better hiring or admission decisions.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3>Ensure Credibility</h3>
                    <p>Maintain the credibility and reputation of your institution or organization.</p>
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
                        <li><a href="#">Certificate Verification</a></li>
                        <li><a href="#">Certificate Grading</a></li>
                        <li><a href="#">Career Roadmap</a></li>
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
        // Drag and drop functionality
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropZone.style.borderColor = '#4361ee';
            dropZone.style.backgroundColor = 'rgba(67, 97, 238, 0.1)';
        }

        function unhighlight() {
            dropZone.style.borderColor = '#4361ee';
            dropZone.style.backgroundColor = 'transparent';
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            // Here you would handle the file upload
            console.log('File dropped:', files[0].name);
            alert(`File "${files[0].name}" ready for verification!`);
        }

        // File input change handler
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                console.log('File selected:', this.files[0].name);
                alert(`File "${this.files[0].name}" ready for verification!`);
            }
        });
    </script>
</body>
</html>