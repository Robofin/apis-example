<!DOCTYPE html>
<html>
<head>
    <title>Item Management</title>
</head>
<body>
    <?php
    $base_url = 'http://127.0.0.1:8000/api/items/';

    function fetchItems() {
        global $base_url;
        $response = file_get_contents($base_url);
        return json_decode($response, true);
    }

    function addItem($data) {
        global $base_url;
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data),
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($base_url, false, $context);
        return json_decode($response, true);
    }

    // Similar functions for update, delete, and viewItem

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submissions
        if (isset($_POST['add'])) {
            $newItemData = [
                'category' => $_POST['category'],
                'subcategory' => $_POST['subcategory'],
                'name' => $_POST['name'],
                'amount' => (int)$_POST['amount'],
                'description' => $_POST['description'],
                'is_published' => isset($_POST['is_published']),
            ];
            $addedItem = addItem($newItemData);
            if ($addedItem) {
                echo "Item added successfully!";
            } else {
                echo "Failed to add item.";
            }
        }
        // Similar handling for update, delete
    }

    // Fetch and display items
    $items = fetchItems();
    foreach ($items as $item) {
        echo '<h3>' . $item['name'] . '</h3>';
        echo '<p>Category: ' . $item['category'] . '</p>';
        echo '<p>Subcategory: ' . $item['subcategory'] . '</p>';
        echo '<p>Amount: ' . $item['amount'] . '</p>';
        echo '<p>Description: ' . $item['description'] . '</p>';
        echo '<p>Published: ' . ($item['is_published'] ? 'Yes' : 'No') . '</p>';
        // Add update and delete buttons with appropriate forms
    }
    ?>
    
    <h2>Add New Item</h2>
    <form method="post">
        <label>Category:</label>
        <input type="text" name="category" required><br>
        <label>Subcategory:</label>
        <input type="text" name="subcategory" required><br>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Amount:</label>
        <input type="number" name="amount" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Published:</label>
        <input type="checkbox" name="is_published"><br>
        <input type="submit" name="add" value="Add Item">
    </form>
</body>
</html>
