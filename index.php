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
$allstudents = $student->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div>
    <?php
  if (isset($_GET['message'])) {
    $message = urldecode($_GET['message']);
    echo "<div class='alert alert-success'>$message</div>";
}
?>
</div>


<div class="container mt-5">
    <h1 class="mb-4">All Students</h1>
    <a href="adduser.php" class="btn btn-primary mb-3">Add Student</a>
    
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($allstudents)): ?>
                <?php foreach($allstudents as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['password']) ?></td>
                        <td><a href="update.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-warning">Edit</a></td>
                        <td><a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
