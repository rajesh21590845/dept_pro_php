<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.php");
//     exit();   
// }
include 'db.php';
// include 'nav.php'; // Including the navigation menu
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        /* General Styles */
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

        @media (max-width: 768px) {
            .custom-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-right-side {
                align-items: flex-start;
            }

            .navbar {
                align-items: flex-start;
            }
        }

        .main-img {
            position: relative;
            width: 100%;
            height: auto;
            overflow: hidden;
        }

        .main-img .bg-image {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .main-img .main-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(12, 31, 78, 0.8), rgba(255, 255, 255, 0));
            z-index: 1;
        }

        .main-img .main-img-text {
            position: absolute;
            top: 50%;
            left: 40px;
            transform: translateY(-50%);
            color: white;
            z-index: 2;
            max-width: 400px;
        }

        .main-img .main-img-text h2 {
            font-size: 32px;
            margin-bottom: 10px;
            font-family: "Cinzel", "google fonts";
        }

        .main-img .main-img-text p {
            font-size: 18px;
        }

        .main-img .corner-img {
            position: absolute;
            top: 0;
            left: 30px;
            height: 100px;
            z-index: 3;
        }

        .corner-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            height: 100px;
            z-index: 3;
        }

        .corner-img {
            height: 100%;
        }

        .corner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            font-weight: bold;
            font-family: Arial, sans-serif;
            pointer-events: none;
        }

        .news-bar {
            background-color: #ff6b6b;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            animation: slideIn 30s infinite;
        }

        .news-bar p {
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @keyframes slideIn {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }



        .hero {
            background: linear-gradient(to right, rgb(255, 255, 255), rgb(255, 255, 255));
            color: white;
            padding: 100px 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: zoomIn 1.5s ease-out;
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .hero h2 {
            font-size: 2.8em;
            margin-bottom: 20px;
            color: rgb(0, 0, 0);
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: rgb(255, 182, 12);
        }

        .btn {
            background-color: #ffe66d;
            color: #333;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
            animation: pulse 2s infinite;
        }

        .btn:hover {
            background-color: #ffd639;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .papers-section {
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
        }

        .papers-section h2 {
            font-size: 2.5em;
            margin-bottom: 40px;
            color: #333;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .papers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 0 20px;
        }

        .paper-card {
            background-color: #ff6b6b;
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1.5s ease;
        }

        .paper-card h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .paper-card p {
            margin: 10px 0;
        }

        .paper-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            animation: fadeInUp 1s ease;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <header class="custom-header">
        <div class="header-left">
            <div class="logo-img">
                <img src="assets/img83.jpg" alt="Left Logo" />
            </div>
        </div>
        <div class="header-center">
            <h1>Government College of <span>Engineering, Erode</span></h1>
            <h6>(Approved by AICTE, New Delhi and Affiliated to Anna University, Chennai)</h6>
        </div>
        <div class="header-right">
            <div class="logo-img2">
                <img src="assets/gold.png" alt="Right Logo" />
            </div>
        </div>
    </header>

    <nav class="navbar">
        <a href="index.php" class="active">Home</a>
        <a href="papers.php">Facilities</a>   
        <a href="papers.php">Committees</a>
        <a href="papers.php">ALUMNI</a>
        <a href="papers.php">Papers</a>
        <a href="about.php">Placement</a>
        <a href="about.php">About</a>
        <a href="about.php">Academic Schedule</a>
        <a href="contact.php">Achievements</a>
        <a href="contact.php">Contact</a>
        <a href="upload.php">Upload</a>
    </nav>

    <div class="main-img">
        <!-- Top-left corner image with text -->
        <div class="corner-wrapper">
            <img src="assets/subtract.png" class="corner-img" alt="Decor">

        </div>

        <!-- Background image -->
        <img src="assets/img59.jpg" alt="Main Image" class="bg-image">

        <!-- Gradient overlay -->
        <div class="main-overlay"></div>

        <!-- Text on the left-center -->
        <div class="main-img-text">
            <h2>WELCOME TO INFORMATION TECHNOLOGY</h2>
            <p>Explore question papers, tools & more!</p>
        </div>
    </div>
    
    <!-- News bar -->
    <div class="news-bar">
        <p>Latest News: New updates coming soon! Stay tuned for exciting features.</p>
    </div>

<!--
    <section class="hero">
        <div class="hero-content">
            <h2>COMPREHENSIVE PLATFORM FOR PAST QUESTION PAPERS</h2>
            <p>Find and download question papers from various subjects and grades.</p>
            <a href="papers.php" class="btn">Explore Now</a>
        </div>
    </section>

    <section class="hero">
        <div class="hero-content">
            <h2>CGPA CALCULATION</h2>
            <p>Allow students to simulate potential future grades</p>
            <a href="cgpa_calculator.php" class="btn">Calculate Now</a>
        </div>
    </section>
    -->

    <script>
        const links = document.querySelectorAll('.navbar a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                links.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            });
        });
    </script>

    <footer class="footer">
        <p>&copy; 2024 Question Paper Collection. All rights reserved.</p>
    </footer>

</body>
</html>