<?php
// Database configuration
$host = '';
$dbName = 'ecotrack';
$username = '';
$password = '';

// Establish database connection using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Process form data if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement to insert user data into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");

    // Bind parameters to the prepared statement
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    // Attempt to execute the prepared statement
    try {
        $stmt->execute();
        echo "User registered successfully!";
        // Redirect to a success page or homepage after successful registration
        // header("Location: success.php");
        // exit();
    } catch (PDOException $e) {
        // Display an error message if unable to execute the query
        die("Error: " . $e->getMessage());
    }
}
?>
