<?php
include('database.php');

// Check if stock_transaction_id is set
if (isset($_REQUEST['stock_transaction_id'])) {
    $stock_transaction_id = $_REQUEST['stock_transaction_id'];

    // Prepare and execute SELECT statement to retrieve stock transaction details
    $stmt = $connection->prepare("SELECT * FROM stock_transaction WHERE stock_transaction_id = ?");
    $stmt->bind_param("i", $stock_transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock_transaction_id = $row['stock_transaction_id'];
        $product_id = $row['product_id'];
        $transaction_type = $row['transaction_type'];
        $quantity = $row['quantity'];
        $transaction_date = $row['transaction_date'];
    } else {
        echo "Stock transaction record not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="stock_transaction_id">Stock Transaction ID:</label>
        <input type="number" name="stock_transaction_id" value="<?php echo isset($stock_transaction_id) ? $stock_transaction_id : ''; ?>" readonly>
        <br><br>

        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>">
        <br><br>

        <label for="transaction_type">Transaction Type:</label>
        <input type="text" name="transaction_type" value="<?php echo isset($transaction_type) ? $transaction_type : ''; ?>">
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
        <br><br>

        <label for="transaction_date">Transaction Date:</label>
        <input type="date" name="transaction_date" value="<?php echo isset($transaction_date) ? $transaction_date : ''; ?>">
        <br><br>
       
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $stock_transaction_id = $_POST['stock_transaction_id'];
    $product_id = $_POST['product_id'];
    $transaction_type = $_POST['transaction_type'];
    $quantity = $_POST['quantity'];
    $transaction_date = $_POST['transaction_date'];

    // Update the stock transaction in the database
    $stmt = $connection->prepare("UPDATE stock_transaction SET product_id=?, transaction_type=?, quantity=?, transaction_date=? WHERE stock_transaction_id=?");
    $stmt->bind_param("isssi", $product_id, $transaction_type, $quantity, $transaction_date, $stock_transaction_id);

    if ($stmt->execute()) {
        // Redirect to stock_transactions.php after successful update
        header('Location: stock_transactions.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating stock transaction record: " . $stmt->error;
    }
}
?>
