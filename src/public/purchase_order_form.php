<?php
require_once "/var/www/Lib/General/Database/Connection.php";

$conn = Connection::open();

$purchaseOrder = '';

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['purchase_order_to_search'])) {
    $purchaseOrderToSearch = $_GET['purchase_order_to_search'];

    $sql = "SELECT * FROM purchase_orders WHERE id = {$purchaseOrderToSearch}";
    $result = $conn->query($sql);
    if ($result) {
        $r = $result->fetch();
        $purchaseOrder = $r['id'];
    } else {
        die("Falha ao recuperar a ordem de compras");
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_to_delete'])) {
    $itemToDelete = $_POST['item_to_delete'];
    $sql = "DELETE FROM purchase_order_items WHERE id = {$itemToDelete}";
    if ($conn->query($sql)) {
        echo "Item deletado com sucesso";
    } else {
        echo "Falha ao excluir item";
    };
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['item_to_delete'])) {
    // Insert purchase order
    $order_date = $_POST['order_date'];
    $supplier_name = $_POST['supplier_name'];

    $sql = "INSERT INTO purchase_orders (order_date, supplier_name) VALUES ('$order_date', '$supplier_name')";
    if ($conn->query($sql)) {
        $purchase_order_id = $conn->lastInsertId();

        // Insert purchase order items
        $product_names = $_POST['product_name'];
        $quantities = $_POST['quantity'];
        $prices = $_POST['price'];

        for ($i = 0; $i < count($product_names); $i++) {
            $product_name = $product_names[$i];
            $quantity = $quantities[$i];
            $price = $prices[$i];

            $sql = "INSERT INTO purchase_order_items (purchase_order_id, product_name, quantity, price) VALUES ($purchase_order_id, '$product_name', $quantity, $price)";
            $conn->query($sql);
        }

        echo "Purchase order and items inserted successfully!";
    } else {
        echo "Error: " . $sql . $conn->errorInfo() ."<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="PT-br">
<head>
    <title>Create Purchase Order</title>
</head>
<body>
<h2>Create Purchase Order</h2>
<form method="POST" action="">
    <label for="order_date">Order Date:</label>
    <input type="date" id="order_date" name="order_date" required><br><br>

    <label for="supplier_name">Supplier Name:</label>
    <input type="text" id="supplier_name" name="supplier_name" required><br><br>

    <h3>Items</h3>
    <div id="items">
        <div class="item">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name[]" required>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity[]" required>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price[]" step="0.01" required>
            <button type="button"  onclick="removeItem(this)">Excluir</button>
            <br><br>
        </div>
    </div>
    <button type="button" onclick="addItem()">Add Item</button><br><br>
    <input type="submit" value="Submit">
</form>


<h2>Pesquidar Compras</h2>
<form method="GET" action="">
    <input type="text" name="purchase_order_to_search">
    <input type="submit" value="Pesquisar">
</form>
<table>
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Excluir</th>
    </tr>

    <?php
        if (!empty($purchaseOrder)) {
            $supplierQuery = "SELECT * FROM purchase_orders WHERE id = 5";
            $result = $conn->query($supplierQuery);
            if (!$result->rowCount() > 0 ) {
                die('Falha ao recuperar purchase order');
            }
            $r = $result->fetch();
            $sql = "SELECT * FROM purchase_order_items WHERE purchase_order_id = {$purchaseOrder}";
            $result = $conn->query($sql);
            if ($result->rowCount() > 0 ) {
                while ($row = $result->fetch(2)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['product_name']}</td>";
                    echo "<td>{$row['price']}</td>";
                    echo "<td>{$row['quantity']}</td>";
                    echo "<td>
                            <form method='POST' action=''>
                                   <input type='hidden' name='item_to_delete' value={$row['id']}> 
                                   <input type='submit' value='Excluir'> 
                            </form> 
                        </td>";
                    echo "</tr>";

                }
            }
        }

     ?>
</table>

<script>

    function addItem() {
        let item = document.createElement('div');
        item.className = 'item';
        item.innerHTML = `
            <label for="product_name">Nome Produto:</label>
            <input type="text" id="product_name" name="product_name[]" required>
            <label for="quantity">Quantidade:</label>
            <input type="number" id="quantity" name="quantity[]" required>
            <label for="price">Preço:</label>
            <input type="number" name="price[]" required>
            <button type="button" onclick="removeItem(this)">Excluir</button><br><br>
           `;
        document.getElementById('items').appendChild(item);
    }

    function removeItem(button)
    {
        button.parentElement.remove();
    }
</script>
</body>
</html>
