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
$amount_to_pay = $_POST['amount_to_pay'];

// Fetch the current fee details for the given UID
$sql = "SELECT * FROM fees WHERE uid = '$uid'";
$result = $conn->query($sql);

// Check if data exists for the UID
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $amount_paid = $row['amount_paid'];
    $amount_pending = $row['amount_pending'];

    // Calculate new amounts
    if ($amount_to_pay > $amount_pending) {
        echo "Error: The amount to pay exceeds the pending amount!";
    } else {
        $new_amount_paid = $amount_paid + $amount_to_pay;
        $new_amount_pending = $amount_pending - $amount_to_pay;

        // Update the fees table
        $update_sql = "UPDATE fees SET amount_paid = '$new_amount_paid', amount_pending = '$new_amount_pending' WHERE uid = '$uid'";

        if ($conn->query($update_sql) === TRUE) {
            echo "Payment successful!<br>";
            echo "New Amount Paid: $new_amount_paid<br>";
            echo "New Amount Pending: $new_amount_pending<br>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "No fee details found for UID: $uid";
}

// Close the database connection
$conn->close();
?>
