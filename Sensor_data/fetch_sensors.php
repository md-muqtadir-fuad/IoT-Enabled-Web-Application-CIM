<?php
header('Content-Type: application/json');

$host = 'localhost';
$db   = 'ipebuett_sensor_data';
$user = 'ipebuett_ipebuett';
$pass = '7-l7[BXR5xlDo4';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    echo json_encode(["error" => "DB connection failed: " . $mysqli->connect_error]);
    exit;
}

$group = $_GET['group'] ?? '';

$allowed_groups = [
    'groupA1','groupA2','groupA3','groupA4','groupA5','groupA6',
    'groupA7','groupA8','groupA9','groupA10','groupA11','groupA12',
    'groupB1','groupB2','groupB3','groupB4','groupB5','groupB6',
    'groupB7','groupB8','groupB9','groupB10','groupB11','groupB12'
];

if (!in_array($group, $allowed_groups)) {
    echo json_encode(["error" => "Invalid group name"]);
    exit;
}

$result = $mysqli->query("SELECT DISTINCT sensor_name FROM `$group` ORDER BY sensor_name");
if (!$result) {
    echo json_encode(["error" => "Query failed: " . $mysqli->error]);
    exit;
}

$sensors = [];
while ($row = $result->fetch_assoc()) {
    $sensors[] = $row['sensor_name'];
}

echo json_encode($sensors);
$mysqli->close();
