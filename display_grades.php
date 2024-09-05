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

// Fetch student grades for the given UID
$sql = "SELECT * FROM student_grades WHERE uid = '$uid'";
$result = $conn->query($sql);

// Check if data exists for the UID
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Grades for UID: $uid</h2>";
    echo "Subject 1: " . $row['marks_subject1'] . "<br>";
    echo "Subject 2: " . $row['marks_subject2'] . "<br>";
    echo "Subject 3: " . $row['marks_subject3'] . "<br>";
    echo "Subject 4: " . $row['marks_subject4'] . "<br>";
} else {
    echo "No grades found for UID: $uid";
}

// Close the database connection
$conn->close();
?>
