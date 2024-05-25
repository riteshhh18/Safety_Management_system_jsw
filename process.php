<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "training_reports";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $training_id = $_POST['training_id'];
    $aadhar_no = $_POST['aadhar_no'];
    $employee_name = $_POST['employee_name'];
    $address = $_POST['address'];
    $vendor_name = $_POST['vendor_name'];
    $training_type = $_POST['training_type'];
    $po_no = $_POST['po_no'];
    $hod_name = $_POST['hod_name'];
    $location = $_POST['location'];
    $training_date_from = $_POST['training_date_from'];
    $training_date_to = $_POST['training_date_to'];

    // Insert data into database
    $sql = "INSERT INTO reports (training_id, aadhar_no, employee_name, address, vendor_name, training_type, po_no, hod_name, location, training_date_from, training_date_to)
            VALUES ('$training_id', '$aadhar_no', '$employee_name', '$address', '$vendor_name', '$training_type', '$po_no', '$hod_name', '$location', '$training_date_from', '$training_date_to')";

    if ($conn->query($sql) === TRUE) {
        // Fetch data from the database after insertion
        $data = array();
        $fetch_sql = "SELECT * FROM reports";
        $result = $conn->query($fetch_sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
