<?php
include('database.php');

// Check if supplier_id is set
if(isset($_REQUEST['supplier_id'])) {
    $supplier_id = $_REQUEST['supplier_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM supplier WHERE supplier_id=?");
    $stmt->bind_param("i", $supplier_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "supplier_id is not set.";
}

$connection->close();
?>
