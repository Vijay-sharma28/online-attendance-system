<?php
$conn = new mysqli('localhost', 'root', '', 'attendance_system');

$name = $_POST['name'];
$branch = $_POST['branch'];
$rollNo = $_POST['roll_no'];

$stmt = $conn->prepare("INSERT INTO students_spm (name, branch, roll_no) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $branch, $rollNo);

if ($stmt->execute()) {
    echo "Student added.";
} else {
    echo "Error: " . $stmt->error;
}
?>
