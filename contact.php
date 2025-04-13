<?php
session_start();
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f4f8;
            color: #333;
        }

        /* Main container styling */
        .contact-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .contact-container h2 {
            font-size: 2.5em;
            color: #2a2a72;
            margin-bottom: 20px;
            text-align: center;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }

        .contact-form label {
            font-size: 1.2em;
            color: #666;
        }

        .contact-form input, 
        .contact-form textarea {
            width: 100%;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        .contact-form textarea {
            height: 150px;
        }

        .contact-form button {
            background-color: #4ecdc4;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            font-size: 1em;
        }

        .contact-form button:hover {
            background-color: #39b4a7;
        }

        /* Contact Information Section */
        .contact-info {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #666;
        }

        .contact-info p {
            font-size: 1.2em;
            margin: 5px 0;
        }

        .contact-info a {
            color: #4ecdc4;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
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
            text-decoration: none;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
            font-size: 1em;
            text-align: center;
        }

        .back-btn:hover {
            background-color: #39b4a7;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us</h2>

        <!-- Contact Form Section -->
        <form class="contact-form" method="POST" action="send_message.php">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <!-- Contact Information Section -->
        <div class="contact-info">
            <p>Email: <a href="mailto:rajeshrajendran1102@gmail.com">rajeshrajendran1102@gmail.com</a></p>
            <p>Phone: <a href="tel:+1234567890">+91 94433 09859</a></p>
            <p>Address: GCE,dubai mainroad,dubai-10 </p>
        </div>

        <!-- Back to Home Button -->
        <a href="index.php" class="back-btn">Back to Home</a>
    </div>
</body>
</html>
