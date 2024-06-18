<?php
include('database.php');

// Check if stockout_id is set
if(isset($_REQUEST['stockout_id'])) {
    $stockout_id = $_REQUEST['stockout_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM stockout WHERE stockout_id=?");
    $stmt->bind_param("i", $stockout_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "stockout_id is not set.";
}

$connection->close();
?>
