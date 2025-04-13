<?php
session_start();
include 'db.php';
include 'nav.php';


// Initialize the search term
$searchTerm = '';

// Check if the search form was submitted
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM paper WHERE subject LIKE ? OR year LIKE ?");
    $likeSearchTerm = '%' . $searchTerm . '%';
    $stmt->bind_param("ss", $likeSearchTerm, $likeSearchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Default: Show all papers
    $result = $conn->query("SELECT * FROM paper");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Question Papers</title>
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


        /* Search Form Styling */
        .search-form {
            margin: 20px auto;
            text-align: center;
        }

        .search-form input {
            padding: 10px;
            font-size: 1.2em;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-form button {
            padding: 10px 20px;
            font-size: 1.2em;
            border: none;
            background-color: #4ecdc4;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .search-form button:hover {
            background-color: #39b4a7;
        }

        /* Papers Section Styling */
        .papers-section {
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            border-radius: 8px;
            max-width: 1200px;
        }

        .papers-section h2 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 40px;
        }

        /* Grid Layout for Paper Cards */
        .papers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 0 20px;
        }

        /* Styling for Paper Cards */
        .paper-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .paper-card h3 {
            font-size: 1.5em;
            color: #2a2a72;
            margin: 0 0 10px;
        }

        .paper-card p {
            font-size: 1.1em;
            color: #666;
            margin: 0 0 20px;
        }

        /* Button Styling */
        .btn {
            background-color: #4ecdc4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #39b4a7;
        }

        /* Hover Effects for Paper Cards */
        .paper-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Back Button Styling */
        .back-btn {
            display: block;
            margin: 50px auto;
            background-color: #f36f61;
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
        }

        .back-btn:hover {
            background-color: #e55a4d;
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

    <!-- Search Form -->
    <div class="search-form">
        <form action="papers.php" method="get">
            <input type="text" name="search" placeholder="Search by subject or year" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Papers Section -->
    <section class="papers-section">
        <h2>Available Question Papers</h2>
        <div class="papers-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="paper-card">
                        <h3><?php echo htmlspecialchars($row['subject']); ?></h3>
                        <p>Year: <?php echo htmlspecialchars($row['year']); ?></p>
                        <a href="<?php echo htmlspecialchars($row['file_path']); ?>" class="btn" download>Download</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No papers found for the search term "<?php echo htmlspecialchars($searchTerm); ?>"</p>
            <?php endif; ?>
        </div>
    </section>
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
