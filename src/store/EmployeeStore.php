<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include DBConnection class
    include '../../src/common/DBConnection.php';

    // Create a new instance of DBConnection
    $conn = new DBConnection();

    // Retrieve form data and sanitize inputs
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $user_name = $_SESSION["admin_name"];
    $gender = htmlspecialchars($_POST['gender']);
    $department_id = intval($_POST['department_id']);
    $destination = htmlspecialchars($_POST['destination']);
    $times = htmlspecialchars($_POST['times']);
    $CIN = htmlspecialchars($_POST['CIN']);

    // Insert employee data into the database
    $result = $conn->execute("INSERT INTO employees (first_name, last_name, user_name, gender, department_id, destination, times, CIN, create_by, created_date) 
                              VALUES ('$first_name', '$last_name', '{$_SESSION["admin_name"]}', '$gender', $department_id, '$destination', '$times', '$CIN', '{$_SESSION["admin_name"]}', NOW())");

    // Redirect to appropriate page based on insertion result
    if($result) {
        header("Location: createEmployee.php?message=success");
        exit();
    } else {
        header("Location: createEmployee.php?message=failed");
        exit();
    }
} else {
    // Redirect to the form page if accessed directly without form submission
    header("Location: createEmployee.php");
    exit();
}
?>
