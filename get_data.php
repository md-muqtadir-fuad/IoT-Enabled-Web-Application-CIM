<?php
// sensor_data.php for data insertion and table display

// DB config
$host = 'localhost';
$db   = 'ipebuett_sensor_data';
$user = 'ipebuett_ipebuett';
$pass = '7-l7[BXR5xlDo4';

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    header('Content-Type: application/json');
    die(json_encode([
        "success" => false,
        "message" => "❌ Database connection failed: " . $mysqli->connect_error,
        "binary_feedback" => 0
    ]));
}

// Configuration
$group_passwords = [
    'groupA1' => 'passA1', 'groupA2' => 'passA2', 'groupA3' => 'passA3', 'groupA4' => 'passA4',
    'groupA5' => 'passA5', 'groupA6' => 'passA6', 'groupA7' => 'passA7', 'groupA8' => 'passA8',
    'groupA9' => 'passA9', 'groupA10' => 'passA10', 'groupA11' => 'passA11', 'groupA12' => 'passA12',
    'groupB1' => 'passB1', 'groupB2' => 'passB2', 'groupB3' => 'passB3', 'groupB4' => 'passB4',
    'groupB5' => 'passB5', 'groupB6' => 'passB6', 'groupB7' => 'passB7', 'groupB8' => 'passB8',
    'groupB9' => 'passB9', 'groupB10' => 'passB10', 'groupB11' => 'passB11', 'groupB12' => 'passB12'
];

$group_sensors = [
    'groupA1' => [
        'Temperature' => ['min' => null, 'max' => 40],
        'Smoke'       => ['min' => 0, 'max' => 1]
    ],
    'groupA2' => [
        'humidity'     => ['min' => null, 'max' => null],
        'temperature'  => ['min' => null, 'max' => null],
        'accX'     => ['min' => null, 'max' => null],
        'accY'  => ['min' => null, 'max' => null],
        'accZ'     => ['min' => null, 'max' => null],
        'gyroX'  => ['min' => null, 'max' => null],
        'gyroY'  => ['min' => null, 'max' => null],
        'gyroZ'     => ['min' => null, 'max' => null]
        
        
        
        
        ],
    'groupA3' => [],
    'groupA4' => [
        'CO2'          => ['min' => null, 'max' => null],
        'Humidity'     => ['min' => null, 'max' => null],
        'Temperature'  => ['min' => null, 'max' => null]
    ],
    'groupA5' => [
        'Ammonia'     => ['min' => null, 'max' => 30],
        'Temperature' => ['min' => null, 'max' => 30]
    ],
    'groupA6' => [
        'Distance'    => ['min' => 100, 'max' => null],
        'Ultrasonic'  => ['min' => 10, 'max' => null],
        'Vibration'   => ['min' => null, 'max' => null]
    ],
    'groupA7' => [],
    'groupA8' => [
        'Temperature' => ['min' => 25, 'max' => 30],
        'Flow'        => ['min' => 0, 'max' => 1]
    ],
    'groupA9' => [

        'clearance_sensor'        => ['min' => null, 'max' => null],
        'temperature_sensor'        => ['min' => null, 'max' => null],
        'humidity_sensor'        => ['min' => null, 'max' => null]
        
    ],
    'groupA10' => [
        
        'DS18B20'   => ['min' => null, 'max' => null]
        
        ],
    'groupA11' => [
        'Temperature' => ['min' => null, 'max' => 35],
        'Humidity'    => ['min' => null, 'max' => 70],
        'Distance'    => ['min' => 50, 'max' => null]
    ],
    'groupA12' => [
        'Distance'    => ['min' => 1, 'max' => 6],
        'OnOff'       => ['min' => 0, 'max' => 1]
    ],
    'groupB1' => [
        'Flow'        => ['min' => null, 'max' => 20],
        'Ultrasonic'  => ['min' => 10, 'max' => null],
        'water_level'  => ['min' => 10, 'max' => null]
    ],
    'groupB2' => [
        
        'ACS712'  => ['min' => null, 'max' => null]
        ],
    'groupB3' => [
        'weight'        => ['min' => null, 'max' => null],
        'bottle'=> ['min' => null, 'max' => 40],
        'IR Sensor'   => ['min' => null, 'max' => 30],
        'YZC-131A'    => ['min' => null, 'max' => 100],
        'LM393'       => ['min' => null, 'max' => 100]
    ],
    'groupB4' => [
        
        
        
        'soil_sensor'    => ['min' => null, 'max' => null]
        ],
    'groupB5' => [


        'Temperature' => ['min' => null, 'max' => null],
        'Liquid_Level' => ['min' => null, 'max' => null],
        'Flow_Rate' => ['min' => null, 'max' => null]
        
        
        
        
        ],
    'groupB6' => [
        'Distance'    => ['min' => null, 'max' => 100],
        'Time'        => ['min' => null, 'max' => null],
        'Velocity'    => ['min' => null, 'max' => 20],
        'Ultrasonic_sensor'    => ['min' => null, 'max' => null]
    ],
    'groupB7' => [
        
        

        'sonar_sensor'    => ['min' => null, 'max' => 20],
        'ir_sensor'    => ['min' => null, 'max' => null]        
        
        
        ],
    'groupB8' => [
        'Weight'        => ['min' => null, 'max' => null],
        'Distance'    => ['min' => null, 'max' => 20],
        'Speed'    => ['min' => null, 'max' => null]        
        
        
        ],
    'groupB9' => [
                'smoke'        => ['min' => null, 'max' => null],
        'flame'        => ['min' => null, 'max' => null]
        ],
    'groupB10'=> [
        'Temperature'        => ['min' => null, 'max' => null],
        'Smoke'    => ['min' => null, 'max' => 20],
        'Position'    => ['min' => null, 'max' => null]
        ],
    'groupB11'=> [],
    'groupB12'=> [
        'Light'       => ['min' => 5, 'max' => 40],
        'Ammonia'     => ['min' => null, 'max' => 10]
    ]
];

// Get parameters
$group = $_GET['g'] ?? '';
$sensor_name = $_GET['sn'] ?? '';
$sensor_data = $_GET['sd'] ?? '';
$group_password = $_GET['p'] ?? '';
$format = $_GET['format'] ?? '';
$mode = $_GET['mode'] ?? '';

// Validate group
if (!in_array($group, array_keys($group_passwords))) {
    header('Content-Type: application/json');
    die(json_encode([
        "success" => false,
        "message" => "❌ Invalid group/table name.",
        "binary_feedback" => 0
    ]));
}

// Handle deletion
if ($mode === 'delete') {
    $delete_id = $_GET['id'] ?? '';
    $delete_password = $_GET['p'] ?? '';

    if (!is_numeric($delete_id) || empty($delete_password) || $delete_password !== $group_passwords[$group]) {
        header('Content-Type: application/json');
        die(json_encode([
            "success" => false,
            "message" => "❌ Invalid ID or password.",
        ]));
    }

    $stmt = $mysqli->prepare("DELETE FROM `$group` WHERE id = ?");
    if (!$stmt) {
        header('Content-Type: application/json');
        die(json_encode([
            "success" => false,
            "message" => "❌ Prepare failed: " . $mysqli->error,
        ]));
    }
    $stmt->bind_param("i", $delete_id);
    $success = $stmt->execute();
    $stmt->close();

    header('Content-Type: application/json');
    die(json_encode([
        "success" => $success,
        "message" => $success ? "✅ Deleted row with ID $delete_id from $group." : "❌ Delete failed: " . $mysqli->error,
    ]));
}

// Handle data insertion
if (!empty($sensor_name) || is_numeric($sensor_data)) {


    // Validate sensor name
    if (!isset($group_sensors[$group]) || !array_key_exists($sensor_name, $group_sensors[$group])) {
        header('Content-Type: application/json');
        echo json_encode([
            "success" => false,
            "message" => "❌ Invalid sensor name for group $group. Valid sensors: " .
                         (isset($group_sensors[$group]) && count($group_sensors[$group]) > 0
                             ? implode(", ", array_keys($group_sensors[$group]))
                             : "No valid sensors defined."),
            "binary_feedback" => 0
        ]);
            // Validate password
    if (empty($group_password) || $group_password !== $group_passwords[$group]) {
        header('Content-Type: application/json');
        die(json_encode([
            "success" => false,
            "message" => "❌ Missing or incorrect password for data insertion.",
            "binary_feedback" => 0
        ]));
    }
    die();
    }
            // Validate password
    if (empty($group_password) || $group_password !== $group_passwords[$group]) {
        header('Content-Type: application/json');
        die(json_encode([
            "success" => false,
            "message" => "❌ Missing or incorrect password for data insertion.",
            "binary_feedback" => 0
        ]));
    }
    // Compute binary feedback
    $limits = $group_sensors[$group][$sensor_name];
    $binary_feedback = 0;
    if ($limits['min'] !== null && $sensor_data < $limits['min']) {
        $binary_feedback = 1;
    }
    if ($limits['max'] !== null && $sensor_data > $limits['max']) {
        $binary_feedback = 1;
    }

    // Insert data
    $stmt = $mysqli->prepare("INSERT INTO `$group` (sensor_name, sensor_data, timestamp) VALUES (?, ?, NOW())");
    if (!$stmt) {
        header('Content-Type: application/json');
        die(json_encode([
            "success" => false,
            "message" => "❌ Prepare failed: " . $mysqli->error,
            "binary_feedback" => 0
        ]));
    }
    $stmt->bind_param("sd", $sensor_name, $sensor_data);
    $success = $stmt->execute();
    $stmt->close();

    if (!$success) {
        header('Content-Type: application/json');
        die(json_encode([
            "success" => false,
            "message" => "❌ Insert failed: " . $mysqli->error,
            "binary_feedback" => 0
        ]));
    }

    // Return JSON for Arduino
    if ($format === 'json') {
        header('Content-Type: application/json');
        echo json_encode([
            "success" => true,
            "message" => "✅ Data inserted into $group successfully.",
            "binary_feedback" => $binary_feedback,
            "limits" => $limits
        ]);
        $mysqli->close();
        exit;
    }
}
    if ($format === 'json') {
        header('Content-Type: application/json');
        echo json_encode([
            "success" => true,
            "message" => "✅ Data inserted into $group successfully.",
            "binary_feedback" => $binary_feedback,
            "limits" => $limits
        ]);
        $mysqli->close();
        exit;
    }
// Fetch latest 50 records
$result = $mysqli->query("SELECT * FROM `$group` ORDER BY id DESC LIMIT 1000");
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Get unique sensor names for filter dropdown
$sensor_names = array_unique(array_column($rows, 'sensor_name'));

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Latest Data for <?php echo htmlspecialchars($group); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Poppins:wght@500;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 40px;
            background: #fff;
            color: #333;
            min-height: 100vh;
            position: relative;
        }
        h2, h3 {
            font-family: 'Poppins', sans-serif;
            color: #8B0000;
            text-shadow: 0 3px 6px rgba(0,0,0,0.4);
            text-align: center;
            margin: 25px 0;
        }
        h2 { font-size: 2.2rem; }
        h3 { font-size: 1.6rem; }
        .filter-container {
            max-width: 950px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255,255,255,0.98);
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
            border: 1px solid rgba(139,0,0,0.2);
        }
        .filter-container label {
            font-size: 1.2rem;
            color: #8B0000;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }
        .filter-container select, .filter-container input {
            padding: 10px;
            border-radius: 10px;
            border: none;
            background: #fff;
            color: #333;
            font-size: 1.1rem;
            outline: none;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
            transition: all 0.4s ease;
        }
        .filter-container select:focus, .filter-container input:focus {
            box-shadow: 0 0 12px rgba(139,0,0,0.8);
        }
        table {
            background: rgba(255,255,255,0.98);
            border-collapse: collapse;
            width: 90%;
            max-width: 950px;
            margin: 20px auto;
            border-radius: 20px;
            box-shadow: 0 12px 24px rgba(0,0,0,0.3);
            border: 1px solid rgba(139,0,0,0.2);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        table:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 32px rgba(0,0,0,0.4);
        }
        th, td {
            border: 1px solid rgba(139,0,0,0.2);
            padding: 12px 16px;
            text-align: center;
            color: #333;
        }
        th {
            background: linear-gradient(to right, #8B0000, #A52A2A);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            cursor: pointer;
            position: relative;
        }
        th:hover {
            background: linear-gradient(to right, #A52A2A, #8B0000);
        }
        th::after {
            content: '';
            position: absolute;
            right: 10px;
            font-size: 1rem;
        }
        th.asc::after { content: '↑'; }
        th.desc::after { content: '↓'; }
        tr:nth-child(even) { background: rgba(139,0,0,0.05); }
        tr:hover { background: rgba(139,0,0,0.1); }
        @media(max-width: 768px) {
            body { padding: 20px; }
            table { width: 100%; }
            .filter-container { flex-direction: column; align-items: center; }
        }
        .delete-btn {
            background: #8B0000;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .delete-btn:hover { background: #B22222; }
    </style>
</head>
<body>
    <h2><?php echo !empty($sensor_name) ? "✅ Data inserted into " : "Latest Data for "; ?><?php echo htmlspecialchars($group); ?></h2>
    <div class="filter-container">
        <label for="sensor_filter">Filter by Sensor Name:</label>
        <select id="sensor_filter">
            <option value="">All Sensors</option>
            <?php foreach ($sensor_names as $sensor): ?>
                <option value="<?php echo htmlspecialchars($sensor); ?>"><?php echo htmlspecialchars($sensor); ?></option>
            <?php endforeach; ?>
        </select>
        <label for="data_min">Min Sensor Data:</label>
        <input type="number" id="data_min" placeholder="Min value">
        <label for="data_max">Max Sensor Data:</label>
        <input type="number" id="data_max" placeholder="Max value">
    </div>
    <h3>Showing latest 1000 records</h3>
    <?php if (empty($rows)): ?>
        <p>No data available for group <?php echo htmlspecialchars($group); ?>.</p>
    <?php else: ?>
    <table id="dataTable">
        <thead>
            <tr>
                <th data-sort="id">ID</th>
                <th data-sort="sensor_name">Sensor Name</th>
                <th data-sort="sensor_data">Sensor Data</th>
                <th>Lower Threshold</th>
                <th>Upper Threshold</th>
                <th data-sort="timestamp">Timestamp</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row):
                $minThreshold = isset($group_sensors[$group][$row['sensor_name']]) && $group_sensors[$group][$row['sensor_name']]['min'] !== null ? $group_sensors[$group][$row['sensor_name']]['min'] : '-';
                $maxThreshold = isset($group_sensors[$group][$row['sensor_name']]) && $group_sensors[$group][$row['sensor_name']]['max'] !== null ? $group_sensors[$group][$row['sensor_name']]['max'] : '-';
                $val = floatval($row['sensor_data']);
                $outOfLower = $minThreshold !== '-' && $val < $minThreshold;
                $outOfUpper = $maxThreshold !== '-' && $val > $maxThreshold;
                $highlight = $outOfLower || $outOfUpper;
                $style = $highlight ? 'color: #FF0000; font-weight: bold;' : 'color: #8B0000;';
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['sensor_name']); ?></td>
                <td style="<?php echo $style; ?>"><?php echo htmlspecialchars($row['sensor_data']); ?></td>
                <td><?php echo htmlspecialchars($minThreshold); ?></td>
                <td><?php echo htmlspecialchars($maxThreshold); ?></td>
                <td><?php echo htmlspecialchars($row['timestamp']); ?></td>
                <td><button class="delete-btn" data-id="<?php echo htmlspecialchars($row['id']); ?>" data-group="<?php echo htmlspecialchars($group); ?>">Delete</button></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        console.log('DOM loaded, initializing table');
        const table = document.getElementById('dataTable');
        if (!table) {
            console.error('Table element not found');
            return;
        }
        const tbody = table.querySelector('tbody');
        const headers = table.querySelectorAll('th[data-sort]');
        const sensorFilter = document.getElementById('sensor_filter');
        const dataMin = document.getElementById('data_min');
        const dataMax = document.getElementById('data_max');

        let data = <?php echo json_encode($rows); ?>;
        let thresholds = <?php echo json_encode($group_sensors[$group] ?? []); ?>;
        let sortColumn = 'id';
        let sortDirection = 'desc';

        function renderTable(filteredData) {
            console.log('Rendering table with', filteredData.length, 'rows');
            tbody.innerHTML = '';
            filteredData.forEach(row => {
                const minT = thresholds[row.sensor_name] && thresholds[row.sensor_name].min !== null ? thresholds[row.sensor_name].min : '-';
                const maxT = thresholds[row.sensor_name] && thresholds[row.sensor_name].max !== null ? thresholds[row.sensor_name].max : '-';
                const val = parseFloat(row.sensor_data);
                const outOfLower = minT !== '-' && val < minT;
                const outOfUpper = maxT !== '-' && val > maxT;
                const style = (outOfLower || outOfUpper) ? 'color: #FF0000; font-weight: bold;' : 'color: #8B0000;';
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.id}</td>
                    <td>${row.sensor_name}</td>
                    <td style="${style}">${row.sensor_data}</td>
                    <td>${minT}</td>
                    <td>${maxT}</td>
                    <td>${row.timestamp}</td>
                    <td><button class="delete-btn" data-id="${row.id}" data-group="<?php echo htmlspecialchars($group); ?>">Delete</button></td>
                `;
                tbody.appendChild(tr);
            });
        }

        function sortData(column, direction) {
            console.log('Sorting by', column, 'in', direction, 'order');
            data.sort((a, b) => {
                let valA = a[column];
                let valB = b[column];
                if (column === 'id' || column === 'sensor_data') {
                    valA = parseFloat(valA) || 0;
                    valB = parseFloat(valB) || 0;
                } else if (column === 'timestamp') {
                    valA = new Date(valA).getTime() || 0;
                    valB = new Date(valB).getTime() || 0;
                } else {
                    valA = valA ? valA.toString().toLowerCase() : '';
                    valB = valB ? valB.toString().toLowerCase() : '';
                }
                if (valA < valB) return direction === 'asc' ? -1 : 1;
                if (valA > valB) return direction === 'asc' ? 1 : -1;
                return 0;
            });
            console.log('Sorted data:', data);
        }

        function applyFilters() {
            console.log('Applying filters');
            let filteredData = [...data];
            const sensorValue = sensorFilter.value;
            const minValue = dataMin.value ? parseFloat(dataMin.value) : null;
            const maxValue = dataMax.value ? parseFloat(dataMax.value) : null;

            if (sensorValue) {
                filteredData = filteredData.filter(row => row.sensor_name === sensorValue);
            }
            if (minValue !== null) {
                filteredData = filteredData.filter(row => parseFloat(row.sensor_data) >= minValue);
            }
            if (maxValue !== null) {
                filteredData = filteredData.filter(row => parseFloat(row.sensor_data) <= maxValue);
            }

            renderTable(filteredData);
        }

        headers.forEach(header => {
            header.addEventListener('click', () => {
                console.log('Header clicked:', header.getAttribute('data-sort'));
                const newColumn = header.getAttribute('data-sort');
                if (newColumn === sortColumn) {
                    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    sortColumn = newColumn;
                    sortDirection = 'asc';
                }
                headers.forEach(h => h.classList.remove('asc', 'desc'));
                header.classList.add(sortDirection);
                sortData(sortColumn, sortDirection);
                applyFilters();
            });
        });

        sensorFilter.addEventListener('change', applyFilters);
        dataMin.addEventListener('input', applyFilters);
        dataMax.addEventListener('input', applyFilters);

        // Handle delete button clicks
        table.addEventListener('click', (e) => {
            if (e.target.classList.contains('delete-btn')) {
                const id = e.target.getAttribute('data-id');
                const group = e.target.getAttribute('data-group');
                console.log('Delete clicked for ID:', id, 'Group:', group);
                const password = prompt(`Enter password for group ${group} to delete ID ${id}:`);
                if (password) {
                    fetch(`<?php echo basename($_SERVER['PHP_SELF']); ?>?mode=delete&id=${id}&g=${group}&p=${encodeURIComponent(password)}`)
                        .then(res => res.json())
                        .then(response => {
                            console.log('Delete response:', response);
                            if (response.success) {
                                alert(response.message);
                                data = data.filter(row => row.id !== String(id));
                                applyFilters();
                            } else {
                                alert(response.message);
                            }
                        })
                        .catch(err => {
                            console.error('Delete request failed:', err);
                            alert('Request failed: ' + err);
                        });
                }
            }
        });

        // Initial render
        if (data.length > 0) {
            console.log('Initial data:', data);
            sortData(sortColumn, sortDirection);
            applyFilters();
        } else {
            console.log('No data to render');
        }
    });
    </script>
</body>
</html>