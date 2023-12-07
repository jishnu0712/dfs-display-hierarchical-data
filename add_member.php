<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Server-side validation
        $parent = isset($_POST['parent']) ? intval($_POST['parent']) : null;
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;

        // Validate
        if (empty($name)) {
            $response = array('status' => 'error', 'msg' => 'Name cannot be empty.');
        } else {
            // Insert into the database
            $query = "INSERT INTO members (ParentId, Name, CreatedDate) VALUES (?, ?, ?)";
            $statement = $pdo->prepare($query);
            $statement->execute([$parent, $name, date("Y-m-d H:i:s")]);

            // Get the ID of the newly inserted member
            $newMemberId = $pdo->lastInsertId();

            $response = array('status' => 'success', 'msg' => 'Member added successfully.', 'newMemberId' => $newMemberId, 'memberName' => $name,);
        }
    } catch (PDOException $e) {
        $response = array('status' => 'error', 'msg' => 'Error adding member: ' . $e->getMessage());
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    header('HTTP/1.1 400 Bad Request');
    echo "Bad Request";
}
