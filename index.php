<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reverse IP Address</title>
</head>
<body>
    <h1>Reverse IP Address</h1>
    <form method="post">
        <label for="ipAddress">Enter IP Address:</label>
        <input type="text" id="ipAddress" name="ipAddress">
        <button type="submit">Reverse IP</button>
    </form>

    <?php
    // Function to reverse IP address
    function reverseIP($ip) {
        return implode('.', array_reverse(explode('.', $ip)));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get user input IP address
        $userIP = $_POST['ipAddress'];

        // Reverse the user input IP address
        $reversedIP = reverseIP($userIP);

        // Print the reversed IP address
        echo "<p>Origin IP: $userIP</p>";
        echo "<p>Reversed IP: $reversedIP</p>";
    }
    ?>
</body>
</html>
