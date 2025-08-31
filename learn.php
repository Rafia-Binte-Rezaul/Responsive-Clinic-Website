<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appointment_data";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['doctor_id'])) {
    $doctor_id = intval($_GET['doctor_id']);
    $sql = "SELECT schedule_id, date_time FROM schedule WHERE doctor_id = $doctor_id";
    $result = $conn->query($sql);

    $slots = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $slots[] = $row;
        }
    }
    echo json_encode($slots);
    exit;
}
?>
