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

$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// if(isset($_POST['submit'])){
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        if ($student->create($name, $email, $password)) {
            $message = "Student created successfully!";
            header("location:index.php?message=".urlencode($message));
            exit;
        } else {
            $message = "Failed to create student.";
        }
    } else {
        $message = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Create Student</h1>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <form action="" method="post" class="row g-3">
        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="col-md-4">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="col-md-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
