<?php
// Database Connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "url_shortener";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate short code
function generateShortCode($length = 6) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

// Handle URL Shortening
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['long_url'])) {
    $long_url = $conn->real_escape_string($_POST['long_url']);
    
    // Check if URL exists
    $sql = "SELECT short_code FROM urls WHERE long_url = '$long_url'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $short_code = $row['short_code'];
    } else {
        $short_code = generateShortCode();
        $conn->query("INSERT INTO urls (long_url, short_code) VALUES ('$long_url', '$short_code')");
    }
    
    $short_url = "http://yourdomain.com/$short_code";
}

// Redirect logic
if (isset($_GET['code'])) {
    $code = $conn->real_escape_string($_GET['code']);
    $sql = "SELECT long_url FROM urls WHERE short_code = '$code'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        header("Location: " . $row['long_url']);
        exit();
    } else {
        echo "Short URL not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
</head>
<body>
    <h2>Shorten a URL</h2>
    <form method="POST">
        <input type="url" name="long_url" required placeholder="Enter long URL">
        <button type="submit">Shorten</button>
    </form>
    <?php if (isset($short_url)): ?>
        <p>Shortened URL: <a href="<?php echo $short_url; ?>" target="_blank"><?php echo $short_url; ?></a></p>
    <?php endif; ?>
</body>
</html>
