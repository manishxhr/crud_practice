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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $currentstudent = $student->studentById($id);
}

// handle form update request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $currentstudent['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($student->update($id, $name, $email, $password)) {
        header("Location: index.php?message=" . urlencode("Student updated successfully!"));
        exit;
    } else {
        $message = "Failed to update student.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card shadow-sm p-4" style="max-width: 500px; margin: auto;">
        <h3 class="text-center mb-4">Update Student</h3>

        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($currentstudent['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($currentstudent['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($currentstudent['password']) ?>" required>
            </div>
            <div class="d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
