<?php
header('Content-Type: application/json');

// ====== Database config ======
$host = 'localhost';
$db   = 'ipebuett_sensor_data';
$user = 'ipebuett_ipebuett';
$pass = '7-l7[BXR5xlDo4';

// ====== Predefined threshold ======
$threshold = 100; // Adjust this value as needed

// ====== Database connection ======
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $mysqli->connect_error]));
}

// ====== Fetch parameters ======
$group = $_GET['group'] ?? '';
$sensor_name = $_GET['sensor_name'] ?? '';

$allowed_groups = [
    'groupA1','groupA2','groupA3','groupA4','groupA5','groupA6',
    'groupA7','groupA8','groupA9','groupA10','groupA11','groupA12',
    'groupB1','groupB2','groupB3','groupB4','groupB5','groupB6',
    'groupB7','groupB8','groupB9','groupB10','groupB11','groupB12'
];

if ($group == "huda") {
    die(json_encode(["error" => "Invalid group name."]));
}
if (!in_array($group, $allowed_groups)) {
    die(json_encode(["error" => "Invalid group/table name."]));
}
if (empty($sensor_name)) {
    die(json_encode(["error" => "Sensor name is required."]));
}

// ====== Get max sensor_data value for the specified sensor_name ======
$stmt = $mysqli->prepare("SELECT MAX(sensor_data) AS max_value FROM `$group` WHERE sensor_name = ?");
if (!$stmt) {
    die(json_encode(["error" => "Prepare failed: " . $mysqli->error]));
}

$stmt->bind_param("s", $sensor_name);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$max_value = (float)$row['max_value'];

if (is_null($max_value)) {
    die(json_encode(["error" => "No data found for sensor_name: $sensor_name."]));
}

// ====== Determine binary feedback ======
$feedback = ($max_value > $threshold) ? 1 : 0;

// ====== Output result ======
echo json_encode([
    "sensor_name" => $sensor_name,
    "max_value" => $max_value,
    "threshold" => $threshold,
    "feedback" => $feedback
]);

$stmt->close();
$mysqli->close();
?>