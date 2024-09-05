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

// Check if attendance is being submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uid = $_POST['uid'];
    $total_classes = $_POST['total_classes'];
    $classes_attended = $_POST['classes_attended'];

    // Insert or update the attendance in the student_attendance table
    $sql = "INSERT INTO student_attendance (uid, total_classes, classes_attended)
            VALUES ('$uid', '$total_classes', '$classes_attended')
            ON DUPLICATE KEY UPDATE
            total_classes = '$total_classes', 
            classes_attended = '$classes_attended'";

    if ($conn->query($sql) === TRUE) {
        echo "Attendance successfully entered/updated for UID: $uid.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    // Show the form to input attendance
    echo '<h2>Enter Attendance for a Student</h2>';
    echo '<form action="" method="post">
            <label for="uid">Student UID:</label><br>
            <input type="number" id="uid" name="uid" required><br><br>

            <label for="total_classes">Total Classes:</label><br>
            <input type="number" id="total_classes" name="total_classes" required><br><br>

            <label for="classes_attended">Classes Attended:</label><br>
            <input type="number" id="classes_attended" name="classes_attended" required><br><br>

            <input type="submit" value="Submit Attendance">
          </form>';
}

// Close the database connection
$conn->close();
?>
