<?php
include 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Find the token in the password_resets table
    $stmt = $conn->prepare("SELECT user_id, created_at FROM password_resets WHERE token=?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $created_at);
        $stmt->fetch();

        // Check if the token is less than 1 hour old
        $expiry_time = strtotime($created_at) + 3600; // 1 hour
        if (time() < $expiry_time) {
            // Process the form submission to reset the password
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                // Update the user's password in the users table
                $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
                $stmt->bind_param("si", $new_password, $user_id);
                if ($stmt->execute()) {
                    // Delete the token to prevent reuse
                    $stmt = $conn->prepare("DELETE FROM password_resets WHERE user_id=?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();

                    echo "Password has been reset. <a href='login.php'>Login</a>";
                } else {
                    echo "Error updating password.";
                }
            }
        } else {
            echo "The password reset link has expired.";
        }
    } else {
        echo "Invalid token.";
    }
} else {
    echo "No token provided.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>

                     
 body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #4ecdc4, #65c3ba);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 2.5em;
            margin: 0;
        }

        .form-section {
            background: #fff;
            color: #333;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        input:focus {
            border-color: #4ecdc4;
            outline: none;
        }

        .btn {
            background-color: #4ecdc4;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #39b4a7;
        }

        .error-message {
            color: #ff6b6b;
            margin-top: 20px;
        }

        /* Similar styling as your register page */
    </style>
</head>
<body>
    <header class="header">
        <h1>Reset Password</h1>
    </header>
    <section class="form-section">
        <form method="POST">
            <label>New Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </section>
</body>
</html>
