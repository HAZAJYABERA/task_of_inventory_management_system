<?php
include('database.php');

// Check if customer_id is set
if(isset($_REQUEST['customer_id'])) {
    $customer_id = $_REQUEST['customer_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM customer WHERE customer_id=?");
    $stmt->bind_param("i", $customer_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "customer_id is not set.";
}

$connection->close();
?>
