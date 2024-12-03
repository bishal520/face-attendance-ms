<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = array();  

if (isset($_POST['courseID']) && isset($_POST['unitID']) && isset($_POST['venueID'])) {
    $courseID = $_POST['courseID'];
    $unitID = $_POST['unitID'];
    $venueID = $_POST['venueID'];

    // Create the database connection
    $host = 'localhost';
    $port = '3307';  // Custom port
    $database = 'attendance-db';
    $user = 'root';
    $password = '';

    $conn = new mysqli($host, $user, $password, $database, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query
    $sql = "SELECT registrationNumber FROM tblstudents WHERE courseCode = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $courseID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $registrationNumbers = array();
        while ($row = $result->fetch_assoc()) {
            $registrationNumbers[] = $row["registrationNumber"];
        }

        $response['status'] = 'success';
        $response['data'] = $registrationNumbers;
    } else {
        $response['status'] = 'error';
        $response['message'] = 'No records found';
    }

    // Capture the generated HTML for the table
    ob_start();  
    include 'studentTable.php';  
    $tableHTML = ob_get_clean();  

    $response['html'] = $tableHTML;
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid or missing parameters';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
