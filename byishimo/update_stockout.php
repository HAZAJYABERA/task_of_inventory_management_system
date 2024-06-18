<?php
include('database.php');

// Check if stockout_id is set
if (isset($_REQUEST['stockout_id'])) {
    $stockout_id = $_REQUEST['stockout_id'];

    // Prepare and execute SELECT statement to retrieve stockout details
    $stmt = $connection->prepare("SELECT * FROM stockout WHERE stockout_id = ?");
    $stmt->bind_param("i", $stockout_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stockout_id = $row['stockout_id'];
        $stock_transaction_id = $row['stock_transaction_id'];
        $product_id = $row['product_id'];
        $customer_id = $row['customer_id'];
        $transaction_date = $row['transaction_date'];
        $quantity = $row['quantity'];
    } else {
        echo "Stockout record not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="stockout_id">Stockout ID:</label>
        <input type="number" name="stockout_id" value="<?php echo isset($stockout_id) ? $stockout_id : ''; ?>" readonly>
        <br><br>

        <label for="stock_transaction_id">Stock Transaction ID:</label>
        <input type="number" name="stock_transaction_id" value="<?php echo isset($stock_transaction_id) ? $stock_transaction_id : ''; ?>">
        <br><br>

        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>">
        <br><br>

        <label for="customer_id">Customer ID:</label>
        <input type="number" name="customer_id" value="<?php echo isset($customer_id) ? $customer_id : ''; ?>">
        <br><br>

        <label for="transaction_date">Transaction Date:</label>
        <input type="date" name="transaction_date" value="<?php echo isset($transaction_date) ? $transaction_date : ''; ?>">
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
        <br><br>
       
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $stockout_id = $_POST['stockout_id'];
    $stock_transaction_id = $_POST['stock_transaction_id'];
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];
    $transaction_date = $_POST['transaction_date'];
    $quantity = $_POST['quantity'];

    // Update the stockout in the database
    $stmt = $connection->prepare("UPDATE stockout SET stock_transaction_id=?, product_id=?, customer_id=?, transaction_date=?, quantity=? WHERE stockout_id=?");
    $stmt->bind_param("iiisii", $stock_transaction_id, $product_id, $customer_id, $transaction_date, $quantity, $stockout_id);

    if ($stmt->execute()) {
        // Redirect to stockouts.php after successful update
        header('Location: stockouts.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating stockout record: " . $stmt->error;
    }
}
?>
