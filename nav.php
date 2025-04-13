<?php
// navbar.php
?>
<style>
/* navbar.css */
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
</style>

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
