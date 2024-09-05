<?php
// AWS RDS MySQL Database connection details
$host = "localhost";
$dbname = "college";
$username = "root";
$password = "12345678";

// Establish a connection to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$uid = $_POST['uid'];

// Fetch fee details for the given UID
$sql = "SELECT * FROM fees WHERE uid = '$uid'";
$result = $conn->query($sql);

// Check if data exists for the UID
if ($result->num_rows > 0) {
    // Fetch data from the result set
    $row = $result->fetch_assoc();
    $total_fees = $row['amount_paid'] + $row['amount_pending'];
    $amount_paid = $row['amount_paid'];
    $amount_pending = $row['amount_pending'];

    // Display fee details
    echo "<h2>Fee Details for UID: $uid</h2>";
    echo "Total Fees: $total_fees<br>";
    echo "Amount Paid: $amount_paid<br>";
    echo "Amount Pending: $amount_pending<br><br>";

    // Form to pay additional fees
    echo '<h3>Pay Fees</h3>';
    echo '<form action="pay_fees.php" method="post">
            <input type="hidden" name="uid" value="' . $uid . '">
            <label for="amount_to_pay">Amount to Pay:</label><br>
            <input type="number" id="amount_to_pay" name="amount_to_pay" required><br><br>
            <input type="submit" value="Pay Now">
          </form>';
} else {
    echo "No fee details found for UID: $uid";
}

// Close the database connection
$conn->close();
?>
