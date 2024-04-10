<?php
include("../connection/connect.php");

// Fetch updated statuses from the database
$query = mysqli_query($db, "SELECT o_id, status FROM users_orders");

$statuses = array();
while ($row = mysqli_fetch_assoc($query)) {
    $statuses[$row['o_id']] = getDisplayStatus($row['status']);
}

// Return the updated statuses in JSON format
echo json_encode($statuses);

// Helper function to get display status
function getDisplayStatus($status) {
    switch ($status) {
        case "":
        case "NULL":
            return '<button type="button" class="btn btn-info" style="font-weight:bold;">Dispatch</button>';
        case "in process":
            return '<button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin"  aria-hidden="true" ></span>On a Way!</button>';
        case "closed":
            return '<button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Delivered</button>';
        case "rejected":
            return '<button type="button" class="btn btn-danger"><i class="fa fa-close"></i>Cancelled</button>';
        default:
            return ''; // Return a default value or an empty string
    }
}
?>
