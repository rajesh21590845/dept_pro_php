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

    <!-- Back to Home Button at the Bottom -->
    <a href="index.php" class="back-btn">Back to Home</a>

</body>
</html>
