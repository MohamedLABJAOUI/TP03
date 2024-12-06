<?php include('db.php'); ?>

<?php
$id = $_GET['id'];
$task = $conn->query("SELECT * FROM tasks WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE tasks SET title=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $description, $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form method="POST">
        <label>Title:</label>
        <input type="text" name="title" value="<?= $task['title'] ?>" required><br>
        <label>Description:</label>
        <textarea name="description"><?= $task['description'] ?></textarea><br>
        <button type="submit">Update Task</button>
    </form>
</body>
</html>
