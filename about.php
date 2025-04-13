<?php
session_start();
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }
        .custom-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0c1f4e;
    padding: 15px 20px;
    flex-wrap: wrap;
}

.header-left, .header-right {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-img img, .logo-img2 img {
    height: 70px;
    width: auto;
    border-radius: 50px;
    background-color: white;
    padding: 5px;
}

.header-center {
    flex: 2;
    text-align: center;
}

.header-center h1 {
    margin: 0;
    font-size: 26px;
    color: white;
    font-family: "Times New Roman", Times, serif;
    font-weight: bold;
}

.header-center h1 span {
    font-size: 28px;
    display: inline-block;
}

.header-center h6 {
    margin: 4px 0 0;
    font-size: 13px;
    color: rgb(255, 189, 67);
    font-weight: 500;
    font-family: Arial, sans-serif;
}

.navbar {
    background-color: #0c1f4e;
    display: flex;
    justify-content: center;
    gap: 30px;
    padding: 10px 0;
    border-top: 1px solid #1f2c5c;
    flex-wrap: wrap;
}

.navbar a {
    color: #d9d9d9;
    text-decoration: none;
    font-weight: 500;
    position: relative;
    padding: 6px 0;
    transition: color 0.3s ease;
}

.navbar a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0%;
    height: 2px;
    background-color: rgb(253, 253, 253);
    transition: width 0.3s ease;
}

.navbar a:hover,
.navbar a.active {
    color: #ffffff;
}

.navbar a.active::after {
    width: 100%;
}


        /* Main container styling */
        .about-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .about-container h2 {
            font-size: 2.5em;
            color: #2a2a72;
            margin-bottom: 20px;
            text-align: center;
        }

        .about-content {
            display: flex;
            flex-direction: column;
            gap: 30px;
            line-height: 1.6em;
        }

        /* About Section */
        .about-section {
            padding: 20px;
        }

        .about-section h3 {
            font-size: 1.8em;
            color: #4ecdc4;
            margin-bottom: 10px;
        }

        .about-section p {
            font-size: 1.1em;
            color: #666;
        }

        /* Team section */
        .team-section {
            text-align: center;
            padding: 20px;
        }

        .team-section h3 {
            font-size: 1.8em;
            color: #4ecdc4;
            margin-bottom: 20px;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .team-member {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .team-member img {
            width: 100%;
            height: auto;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .team-member h4 {
            font-size: 1.5em;
            color: #2a2a72;
            margin-bottom: 5px;
        }

        .team-member p {
            font-size: 1em;
            color: #666;
        }

        /* Back to Home Button */
        .back-btn {
            display: block;
            margin: 30px auto 0;
            background-color: #4ecdc4;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-align:center;
            text-decoration: none;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            font-size: 1em;
        }

        .back-btn:hover {
            background-color: #39b4a7;
        }

        .footer {
  background-color: #0a1b4c;
  color: white;
  padding: 40px 20px 0;
  font-family: 'Segoe UI', sans-serif;
}

.footer-content {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding-bottom: 30px;
  border-bottom: 1px solid #444;
}

.footer-column {
  flex: 1 1 200px;
  margin: 10px 20px;
}

.footer-column h4 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #fff;
  border-bottom: 2px solid #f7a106;
  display: inline-block;
  padding-bottom: 5px;
}

.footer-column p {
  margin: 6px 0;
  color: #ddd;
  font-size: 14px;
}

.footer-bottom {
  background-color: #081737;
  color: #f7a106;
  padding: 15px 20px;
  text-align: center;
  font-size: 13px;
  position: relative;
}

.footer-bottom a {
  color: #f7a106;
  text-decoration: none;
  font-weight: bold;
}

.footer-bottom .scroll-top {
  position: absolute;
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 20px;
}

.footer-bottom .scroll-top a {
  color: #f7a106;
  text-decoration: none;
}

    </style>
</head>
<body>
    <div class="about-container">
        <h2>About Us</h2>


        <div class="about-content">
            <!-- Website Overview -->
            <section class="about-section">
                <h3>Our Mission</h3>
                <p>Welcome to our question paper management platform, designed to streamline access to academic resources. Our goal is to provide an easy-to-use portal for students and educators alike to upload, download, and share past question papers.</p>
            </section>

            <section class="about-section">
                <h3>Who We Are</h3>
                <p>We are a passionate team dedicated to making academic resources more accessible to everyone. Whether you're a student preparing for exams or an educator looking to share valuable resources, our platform is here to support you. We believe in the power of knowledge and strive to ensure it’s within reach for all.</p>
            </section>

            <!-- Team Section (optional, can be customized or removed if irrelevant) -->
            <section class="team-section">
                <h3>Meet Our Team</h3>
                <div class="team-grid">
                    <!-- Team Member 1 -->
                    <div class="team-member">
                        
                        <h4>RAJESH R</h4>
                        <p>Founder & Full stack Developer</p>
                    </div>
                    
                    <!-- Add more team members as needed -->
                </div>
            </section>
        </div>

        <!-- Back to Home Button -->
        <a href="index.php" class="back-btn">Back to Home</a>
    </div>

    <footer class="footer">
  <div class="footer-content">
    <div class="footer-column">
      <h4>Locate Us</h4>
      <p>GCEE in Google Map</p>
      <p>How to Reach GCEE</p>
    </div>
    <div class="footer-column">
      <h4>Downloads</h4>
      <p>Academic Schedule</p>
      <p>Staff Forms</p>
    </div>
    <div class="footer-column">
      <h4>Quick Links</h4>
      <!-- Add your links or keep empty -->
    </div>
    <div class="footer-column">
      <h4>Contact Us</h4>
      <p>Government College of Engineering (Autonomous), IRTT,</p>
      <p>Erode – 638 316, Tamilnadu, India</p>
      <p>Phone: (0424) 253 9799</p>
      <p>Email: gceerodeprincipal@gmail.com</p>
    </div>
  </div>

  <div class="footer-bottom">
    <p>
      Designed & Maintained by <a href="#" target="_blank">GCEE Website Administrators, Department of IT, GCE, Erode</a>
    </p>
    <p>© GCEE – All Rights Reserved | Best viewed in Full HD</p>
    <p class="scroll-top"><a href="#">^</a></p>
  </div>
</footer>

</body>
</html>
