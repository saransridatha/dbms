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

// Fetch student attendance for the given UID
$sql = "SELECT * FROM student_attendance WHERE uid = '$uid'";
$result = $conn->query($sql);

// Check if data exists for the UID
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Attendance for UID: $uid</h2>";
    echo "Total Classes: " . $row['total_classes'] . "<br>";
    echo "Classes Attended: " . $row['classes_attended'] . "<br>";
    echo "Attendance Percentage: " . ($row['classes_attended'] / $row['total_classes']) * 100 . "%<br>";
} else {
    echo "No attendance record found for UID: $uid";
}

// Close the database connection
$conn->close();
?>

