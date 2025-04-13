<?php
session_start();
include 'db.php';

// Check if the user is an admin
//if (!isset($_SESSION['role']) ) {
//    echo "You do not have permission to access this page.";
//    exit;
//}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $subject = $_POST['subject'];
    $year = $_POST['year'];
    $file_path = 'uploads/' . basename($_FILES['file']['name']);
    
    // Move uploaded file to the "uploads" directory
    if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
        // Insert paper information into the database
        $stmt = $conn->prepare("INSERT INTO paper (subject, year, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $subject, $year, $file_path);
        $stmt->execute();
        
        echo "<div class='success-message'>Paper uploaded successfully!</div>";
    } else {
        echo "<div class='error-message'>File upload failed!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Question Paper</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .upload-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 30px;
            color: #2a2a72;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-size: 1.1em;
            margin-bottom: 8px;
            color: #333;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        button {
            background-color: #4ecdc4;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            font-size: 1em;
        }

        button:hover {
            background-color: #39b4a7;
        }

        .success-message,
        .error-message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #4ecdc4;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="upload-container">
        <h2>Upload Question Paper</h2>

        <form method="POST" enctype="multipart/form-data">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required>
            <label for="file">Choose File:</label>
            <input type="file" id="file" name="file" required>

            <button type="submit">Upload</button>
        </form>

        <a href="papers.php">View Papers</a>
    </div>

</body>
</html>
