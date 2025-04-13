<?php
session_start();
//if (!isset($_SESSION['user_id'])) {
    //header("Location: login.php");
  //  exit();
//}
include 'db.php';
include 'nav.php'; // Including the navigation menu
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Calculator</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }

        /* Header Styles */
        .header {
            background-color: #4ecdc4;
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header .logo h1 {
            margin: 0;
            text-align: center;
        }

        .navbar {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #39b4a7;
        }

        /* CGPA Section */
        .cgpa-section {
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            border-radius: 8px;
            max-width: 800px;
        }

        .cgpa-section h2 {
            font-size: 2.5em;
            margin-bottom: 40px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        label {
            font-weight: bold;
        }

        input, button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        button {
            background-color: #4ecdc4;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #39b4a7;
        }

        .result {
            margin-top: 20px;
            font-size: 1.2em;
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
            text-align: center;
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

    <!-- CGPA Calculator Section -->
    <section class="cgpa-section">
        <h2>CGPA Calculator</h2>
        <form method="post">
            <div>
                <label for="numSubjects">Number of Subjects:</label>
                <input type="number" id="numSubjects" name="numSubjects" min="1" required>
            </div>
            <div id="subjectInputs"></div>
            <button type="button" onclick="addSubjectInputs()">Add Subjects</button>
            <button type="submit" name="calculate">Calculate CGPA</button>
        </form>

        <?php
        if (isset($_POST['calculate'])) {
            $numSubjects = intval($_POST['numSubjects']);
            $totalCredits = 0;
            $totalPoints = 0;

            for ($i = 1; $i <= $numSubjects; $i++) {
                $credits = intval($_POST["credits_$i"]);
                $grade = floatval($_POST["grade_$i"]);
                $totalCredits += $credits;
                $totalPoints += $credits * $grade;
            }

            $cgpa = $totalCredits > 0 ? $totalPoints / $totalCredits : 0;
            echo "<div class='result'>Your CGPA is: " . number_format($cgpa, 2) . "</div>";
        }
        ?>
    </section>

    <!-- Back to Home Button at the Bottom -->
    <a href="index.php" class="back-btn">Back to Home</a>

    <script>
        function addSubjectInputs() {
            const numSubjects = document.getElementById('numSubjects').value;
            const container = document.getElementById('subjectInputs');
            container.innerHTML = '';

            for (let i = 1; i <= numSubjects; i++) {
                container.innerHTML += `
                    <div>
                        <label for="credits_${i}">Credits for Subject ${i}:</label>
                        <input type="number" id="credits_${i}" name="credits_${i}" min="1" required>
                    </div>
                    <div>
                        <label for="grade_${i}">Grade for Subject ${i}:</label>
                        <input type="number" id="grade_${i}" name="grade_${i}" step="0.01" min="0" max="4" required>
                    </div>
                `;
            }
        }
    </script>

</body>
</html>
