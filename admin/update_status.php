<?php
session_start();
include("../connection/connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure that the script only processes POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    $update_query = "UPDATE users_orders SET status=? WHERE o_id=?";

    $stmt = mysqli_stmt_init($db);

    if (mysqli_stmt_prepare($stmt, $update_query)) {
        mysqli_stmt_bind_param($stmt, "si", $new_status, $order_id);

        // Execute the update query
        if (mysqli_stmt_execute($stmt)) {
            // Close the statement
            mysqli_stmt_close($stmt);

            // Send a JSON response indicating success
            $response = ['success' => true, 'newStatus' => getDisplayStatus($new_status)];
            echo json_encode($response);
            exit();
        } else {
            // Send a JSON response indicating the error
            echo json_encode(['success' => false, 'error' => "Error updating status: " . mysqli_stmt_error($stmt)]);
            exit();
        }
    } else {
        // Send a JSON response indicating the error
        echo json_encode(['success' => false, 'error' => "Error preparing update query: " . mysqli_error($db)]);
        exit();
    }
} else {
    // Send a JSON response indicating an invalid request method
    echo json_encode(['success' => false, 'error' => "Invalid request method"]);
    exit();
}

// Helper function to get display status
function getDisplayStatus($status) {
    switch ($status) {
        case "":
        case "NULL":
            return '<button type="button" class="btn btn-info" style="font-weight:bold;">Dispatch</button>';
        case "on_way":
            return '<button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span>On a Way!</button>';
        case "delivered":
            return '<button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Delivered</button>';
        case "rejected":
            return '<button type="button" class="btn btn-danger"><i class="fa fa-close"></i>Cancelled</button>';
        default:
            return ''; // Return a default value or an empty string
    }
}
?>
