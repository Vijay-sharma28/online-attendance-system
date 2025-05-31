<?php
$conn = new mysqli('localhost', 'root', '', 'attendance_system');
$date = date('Y-m-d');

$result = $conn->query("
    SELECT s.name, s.branch, s.roll_no, a.status
    FROM students_mpmc s
    LEFT JOIN attendance_mpmc a ON s.id = a.student_id AND a.date = '$date'
    ORDER BY s.id DESC
");

$students = [];

while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}

echo json_encode($students);
?>
