<?php
include('database.php');

// Check if stock_transaction_id is set
if(isset($_REQUEST['stock_transaction_id'])) {
    $stock_transaction_id = $_REQUEST['stock_transaction_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM stock_transaction WHERE stock_transaction_id=?");
    $stmt->bind_param("i", $stock_transaction_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $connection->error;
    }

    $stmt->close();
} else {
    echo "stock_transaction_id is not set.";
}

$connection->close();
?>
