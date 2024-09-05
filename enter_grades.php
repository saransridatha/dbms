<?php
// This page is only accessible if admin is logged in (you can add session control here for security)

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

// Check if grades are being submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uid = $_POST['uid'];
    $marks_subject1 = $_POST['marks_subject1'];
    $marks_subject2 = $_POST['marks_subject2'];
    $marks_subject3 = $_POST['marks_subject3'];
    $marks_subject4 = $_POST['marks_subject4'];

    // Insert or update the grades in the student_grades table
    $sql = "INSERT INTO student_grades (uid, marks_subject1, marks_subject2, marks_subject3, marks_subject4)
            VALUES ('$uid', '$marks_subject1', '$marks_subject2', '$marks_subject3', '$marks_subject4')
            ON DUPLICATE KEY UPDATE
            marks_subject1 = '$marks_subject1', 
            marks_subject2 = '$marks_subject2', 
            marks_subject3 = '$marks_subject3',
            marks_subject4 = '$marks_subject4'";

    if ($conn->query($sql) === TRUE) {
        echo "Grades successfully entered/updated for UID: $uid.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    // Show the form to input grades
    echo '<h2>Enter Grades for a Student</h2>';
    echo '<form action="" method="post">
            <label for="uid">Student UID:</label><br>
            <input type="number" id="uid" name="uid" required><br><br>

            <label for="marks_subject1">Marks for Subject 1:</label><br>
            <input type="number" id="marks_subject1" name="marks_subject1" required><br><br>

            <label for="marks_subject2">Marks for Subject 2:</label><br>
            <input type="number" id="marks_subject2" name="marks_subject2" required><br><br>

            <label for="marks_subject3">Marks for Subject 3:</label><br>
            <input type="number" id="marks_subject3" name="marks_subject3" required><br><br>

            <label for="marks_subject4">Marks for Subject 4:</label><br>
            <input type="number" id="marks_subject4" name="marks_subject4" required><br><br>

            <input type="submit" value="Submit Grades">
          </form>';
}

// Close the database connection
$conn->close();
?>
