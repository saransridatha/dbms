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

// Check if the form is submitted with a UID
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uid = $_POST['uid'];

    // Fetch student details for the given UID
    $sql = "SELECT * FROM student_details WHERE uid = '$uid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the student details
        $row = $result->fetch_assoc();
        echo "<h2>Student Details for UID: $uid</h2>";
        echo "Name: " . $row['student_name'] . "<br>";
        echo "Phone Number: " . $row['ph_no'] . "<br>";
        echo "Course Code: " . $row['course_code'] . "<br>";
        echo "Address: " . $row['address'] . "<br>";
        echo "Year: " . $row['year'] . "<br>";
        echo "Age: " . $row['age'] . "<br>";
        echo "Gender: " . ($row['gender'] === 'm' ? 'Male' : 'Female') . "<br>";
    } else {
        echo "No student details found for UID: $uid";
    }
} else {
    // Display the form to input UID
    echo '<h2>Enter Student UID to View Details</h2>';
    echo '<form action="" method="post">
            <label for="uid">Student UID:</label><br>
            <input type="number" id="uid" name="uid" required><br><br>
            <input type="submit" value="View Details">
          </form>';
}

// Close the database connection
$conn->close();
?>
