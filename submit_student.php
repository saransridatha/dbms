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
$student_name = $_POST['student_name'];
$uid = $_POST['uid'];
$ph_no = $_POST['ph_no'];
$course_code = $_POST['course_code'];
$address = $_POST['address'];
$year = $_POST['year'];
$age = $_POST['age'];
$gender = $_POST['gender'];

// SQL query to insert data into student_details table
$sql = "INSERT INTO student_details (uid, student_name, ph_no, course_code, address, year, age, gender)
        VALUES ('$uid', '$student_name', '$ph_no', '$course_code', '$address', '$year', '$age', '$gender')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
