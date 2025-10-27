<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/classes/database.php");
require_once(__DIR__ . "/classes/student.php");

// database connection
$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

if(isset($_GET['id'])){
    $id=$_GET['id'];
    if($student->delete($id)){
        $message="student. delyed. successfully";
        header("Location: index.php?message=" . urlencode("Student deleted successfully"));
        exit;
    }
    }


?>