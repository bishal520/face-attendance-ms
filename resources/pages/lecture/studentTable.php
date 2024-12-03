

<div class="table">
    <table>
        <thead>
            <tr>
                <th>Registration No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Unit</th>
                <th>Venue</th>
                <th>Attendance</th>
                <th>Settings</th>
            </tr>
        </thead>
        <tbody id="studentTableContainer">
        <?php
if (isset($_POST['courseID']) && isset($_POST['unitID']) && isset($_POST['venueID'])) {

    $courseID = $_POST['courseID'];
    $unitID = $_POST['unitID'];
    $venueID = $_POST['venueID'];

    // Ensure that the connection $conn is established before this point

    $sql = "SELECT * FROM tblstudents WHERE courseCode = '$courseID'"; // You might want to use prepared statements for security
    $result = $conn->query($sql); // Execute query using $conn->query() for mysqli

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { // Use fetch_assoc() with mysqli
            echo "<tr>";
            $registrationNumber = $row["registrationNumber"];
            echo "<td>" . $registrationNumber . "</td>";
            echo "<td>" . $row["firstName"] . " " . $row["lastName"] . "</td>"; // Add space between first and last name
            echo "<td>" . $courseID . "</td>";
            echo "<td>" . $unitID . "</td>";
            echo "<td>" . $venueID . "</td>";
            echo "<td>Absent</td>"; 
            echo "<td><span><i class='ri-edit-line edit'></i><i class='ri-delete-bin-line delete'></i></span></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
    }
}
?>

        </tbody>
    </table>
</div>
