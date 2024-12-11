<?php
// Database credentials
$host = 'localhost';  // or your database host
$dbname = 'portfolio';
$username = 'root';    // your MySQL username
$password = '';        // your MySQL password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if form data is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Prepare SQL query to insert the data
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Execute the query
        if ($stmt->execute()) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message.";
        }
    }
} catch (PDOException $e) {
    // Handle error
    echo "Error: " . $e->getMessage();
}
?>
