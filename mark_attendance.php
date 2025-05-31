<?php
$conn = new mysqli('localhost', 'root', '', 'attendance_system');
$data = json_decode(file_get_contents("php://input"), true);
$date = date('Y-m-d');

foreach ($data as $entry) {
    $rollNo = $entry['roll_no'];
    $status = $entry['status'];

    // Get student_id and name
    $stmt = $conn->prepare("SELECT id, name FROM students WHERE roll_no = ?");
    $stmt->bind_param("s", $rollNo);
    $stmt->execute();
    $stmt->bind_result($student_id, $student_name);
    $stmt->fetch();
    $stmt->close();

    // Insert or update attendance
    if ($student_id) {
        $insert = $conn->prepare("INSERT INTO attendance (student_id, student_name, date, status)
                                  VALUES (?, ?, ?, ?)
                                  ON DUPLICATE KEY UPDATE status = VALUES(status)");
        $insert->bind_param("isss", $student_id, $student_name, $date, $status);
        $insert->execute();
    }
}
echo "Attendance saved.";
?>
