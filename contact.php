<?php
include './db_connect.php';

// Initialize variables for form feedback
$message_sent = false;
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepare SQL statement
        $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            $message_sent = true;
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        $error_message = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?> <!-- Ensure header is included -->

<div class="container">
    <h1>Contact Me</h1>

    <?php if ($message_sent): ?>
        <p style="color: green;">Message sent successfully!</p>
    <?php elseif (!empty($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form action="contact.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

</body>
</html>

</html>
