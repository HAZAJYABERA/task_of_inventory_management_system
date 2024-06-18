<?php
include('database.php');

// Initialize variables
$stockin_id = $stock_transaction_id = $product_id = $transaction_date = $quantity = '';

// Check if stockin_id is set and handle potential array from $_REQUEST
if (isset($_REQUEST['stockin_id'])) {
    if (is_array($_REQUEST['stockin_id'])) {
        // Take the first element of the array, assuming it should be a single value
        $stockin_id = reset($_REQUEST['stockin_id']);
    } else {
        $stockin_id = $_REQUEST['stockin_id'];
    }

    // Prepare and execute SELECT statement to retrieve stockin details
    $stmt = $connection->prepare("SELECT * FROM stockin WHERE stockin_id = ?");
    $stmt->bind_param("i", $stockin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock_transaction_id = $row['stock_transaction_id'];
        $product_id = $row['product_id'];
        $transaction_date = $row['transaction_date'];
        $quantity = $row['quantity'];
    } else {
        echo "Stockin record not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="stockin_id">Stockin ID:</label>
        <input type="number" name="stockin_id" value="<?php echo htmlspecialchars($stockin_id); ?>" readonly>
        <br><br>

        <label for="stock_transaction_id">Stock Transaction ID:</label>
        <input type="number" name="stock_transaction_id" value="<?php echo htmlspecialchars($stock_transaction_id); ?>">
        <br><br>

        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
        <br><br>

        <label for="transaction_date">Transaction Date:</label>
        <input type="date" name="transaction_date" value="<?php echo htmlspecialchars($transaction_date); ?>">
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
        <br><br>
       
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $stockin_id = $_POST['stockin_id'];
    $stock_transaction_id = $_POST['stock_transaction_id'];
    $product_id = $_POST['product_id'];
    $transaction_date = $_POST['transaction_date'];
    $quantity = $_POST['quantity'];

    // Update the stockin in the database
    $stmt = $connection->prepare("UPDATE stockin SET stock_transaction_id=?, product_id=?, transaction_date=?, quantity=? WHERE stockin_id=?");
    $stmt->bind_param("iisii", $stock_transaction_id, $product_id, $transaction_date, $quantity, $stockin_id);

    if ($stmt->execute()) {
        // Redirect to stockins.php after successful update
        header('Location: stockins.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating stockin record: " . $stmt->error;
    }
    $stmt->close();
}

$connection->close();
?>
