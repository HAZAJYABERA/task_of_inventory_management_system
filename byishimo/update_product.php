<?php
include('database.php');

// Check if product_id is set
if (isset($_REQUEST['product_id'])) {
    $product_id = $_REQUEST['product_id'];

    // Prepare and execute SELECT statement to retrieve product details
    $stmt = $connection->prepare("SELECT * FROM product WHERE product_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . $connection->error);
    }
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
    } else {
        echo "Product not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="product_id">Product ID:</label>
        <input type="number" name="product_id" value="<?php echo isset($product_id) ? $product_id : ''; ?>" readonly>
        <br><br>

        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?php echo isset($product_name) ? $product_name : ''; ?>">
        <br><br>

        <label for="product_description">Product Description:</label>
        <input type="text" name="product_description" value="<?php echo isset($product_description) ? $product_description : ''; ?>">
        <br><br>

        <label for="product_price">Product Price:</label>
        <input type="number" step="0.01" name="product_price" value="<?php echo isset($product_price) ? $product_price : ''; ?>">
        <br><br>
       
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Retrieve updated values from form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // Update the product in the database
    $stmt = $connection->prepare("UPDATE product SET product_name=?, product_description=?, product_price=? WHERE product_id=?");
    if ($stmt === false) {
        die('Prepare failed: ' . $connection->error);
    }
    $stmt->bind_param("ssdi", $product_name, $product_description, $product_price, $product_id);

    if ($stmt->execute()) {
        // Redirect to products.php after successful update
        header('Location: products.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating product: " . $stmt->error;
    }
    $stmt->close();
}

$connection->close();
?>
