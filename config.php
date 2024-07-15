
<?php
$host = '127.0.0.1:3307'; // Your database host
$dbname = 'registration'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>