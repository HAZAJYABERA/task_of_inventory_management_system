<?php
include('database.php');

// Check if stockin_id is set
if(isset($_REQUEST['stockin_id'])) {
    $stockin_id = $_REQUEST['stockin_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM stockin WHERE stockin_id=?");
    $stmt->bind_param("i", $stockin_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "stockin_id is not set.";
}

$connection->close();
?>
