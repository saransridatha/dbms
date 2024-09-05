<?php
// Hardcoded admin credentials
$admin_username = "admin";
$admin_password = "admin";

// Get credentials from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Verify credentials
if ($username === $admin_username && $password === $admin_password) {
    // Check if this is for grades, student details, or attendance
    if (isset($_POST['action']) && $_POST['action'] === "enter_grades") {
        header("Location: enter_grades.php");
    } elseif (isset($_POST['action']) && $_POST['action'] === "view_student_details") {
        header("Location: view_student_details.php");
    } elseif (isset($_POST['action']) && $_POST['action'] === "enter_attendance") {
        header("Location: enter_attendance.php");
    } elseif (isset($_POST['action']) && $_POST['action'] === "view_attendance") {
        header("Location: view_attendance.php");
    } else {
        echo "Invalid action.";
    }
} else {
    echo "Invalid Username or Password.";
}
?>
