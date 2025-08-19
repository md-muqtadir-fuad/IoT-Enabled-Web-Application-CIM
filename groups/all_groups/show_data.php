<?php
header('Content-Type: application/json');

// ====== Database config ======
$host = 'localhost';
$db   = 'ipebuett_sensor_data';
$user = 'ipebuett_ipebuett';
$pass = '7-l7[BXR5xlDo4';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $mysqli->connect_error]));
}

// ====== Fetch parameters ======
$mode  = $_GET['mode'] ?? '';
$group = $_GET['group'] ?? '';

$allowed_groups = [
    'groupA1','groupA2','groupA3','groupA4','groupA5','groupA6',
    'groupA7','groupA8','groupA9','groupA10','groupA11','groupA12',
    'groupB1','groupB2','groupB3','groupB4','groupB5','groupB6',
    'groupB7','groupB8','groupB9','groupB10','groupB11','groupB12'
];
if ($group == "huda"){
    header('Content-Type: text/html; charset=utf-8');
    ?>
    <div>
        <h2>Hey fucking huda how are you</h2>
        <img src="huda.jpg" alt="My Image" />
    </div>
    <?php
    die();  // Stop further script execution here

}
if (!in_array($group, $allowed_groups)) {

    die(json_encode(["error" => "Invalid group/table name."]));
    


}

// --- Get unique sensor names ---
if ($mode === 'names') {
    $result = $mysqli->query("SELECT DISTINCT sensor_name FROM `$group` ORDER BY sensor_name");
    $names = [];
    while($row = $result->fetch_assoc()) {
        $names[] = $row['sensor_name'];
    }
    echo json_encode($names);
    exit;
}

// --- Get data for graph ---
if ($mode === 'data') {
    $sensor_name = $_GET['sensor_name'] ?? '';

    if (empty($sensor_name)) {
        die(json_encode(["error" => "Sensor name is required."]));
    }

    $stmt = $mysqli->prepare("SELECT timestamp, sensor_data FROM `$group` WHERE sensor_name = ? ORDER BY id DESC LIMIT 100");
    if (!$stmt) {
        die(json_encode(["error" => "Prepare failed: " . $mysqli->error]));
    }

    $stmt->bind_param("s", $sensor_name);
    $stmt->execute();
    $result = $stmt->get_result();

    $timestamps = [];
    $values = [];

    while($row = $result->fetch_assoc()) {
        $timestamps[] = $row['timestamp'];
        $values[] = (float)$row['sensor_data'];
    }

    // Reverse to get chronological order
    $timestamps = array_reverse($timestamps);
    $values = array_reverse($values);

    echo json_encode(["timestamps" => $timestamps, "values" => $values]);
    exit;
}

echo json_encode(["error" => "Invalid mode."]);
?>
