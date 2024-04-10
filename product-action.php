<?php
session_start();
include("connection/connect.php"); // connection to db
error_reporting(0);
function addToCart($item_id, $quantity, $rs_id, $d_id, $db) {
    // Check if cart is not empty
    if(!empty($_SESSION["cart_item"])) {
        // Check if item is already in cart
        if(array_key_exists($item_id, $_SESSION["cart_item"])) {
            // Update quantity of existing item in cart
            $_SESSION["cart_item"][$item_id]["quantity"] += $quantity;
        } else {
            // Add new item to cart
            $SQL = "SELECT * FROM dishes WHERE id='$item_id' AND rs_id='$rs_id' AND d_id='$d_id'";
            $resultset = mysqli_query($db, $SQL);
            $row = mysqli_fetch_assoc($resultset);
            if ($row) {
                $_SESSION["cart_item"][$item_id] = [
                    "quantity" => $quantity,
                    "price" => $row["price"],
                    "title" => $row["title"],
                    "d_id" => $d_id,
                    "rs_id" => $rs_id
                ];
            }
        }
    } else {
        // Cart is empty, add new item
        $SQL = "SELECT * FROM dishes WHERE id='$item_id' AND rs_id='$rs_id' AND d_id='$d_id'";
        $resultset = mysqli_query($db, $SQL);
        $row = mysqli_fetch_assoc($resultset);
        if ($row) {
            $_SESSION["cart_item"][$item_id] = [
                "quantity" => $quantity,
                "price" => $row["price"],
                "title" => $row["title"],
                "d_id" => $d_id,
                "rs_id" => $rs_id
            ];
        }
    }
}
// Check if action is set and not empty
if (!empty($_GET["action"])) {
    // Get the product ID from the URL parameter
    $productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

    // Switch statement to handle different actions
    switch ($_GET["action"]) {
        case "add":
            // Check if quantity is set in POST
            if (isset($_POST['quantity'])) {
                $quantity = htmlspecialchars($_POST['quantity']);

                // Fetch product details from the database
                $stmt = $db->prepare("SELECT * FROM dishes WHERE d_id = ?");
                $stmt->bind_param('i', $productId);
                $stmt->execute();
                $productDetails = $stmt->get_result()->fetch_object();

                // Create an array to store item details
                $itemArray = array(
                    'title' => $productDetails->title,
                    'd_id' => $productDetails->d_id,
                    'quantity' => $quantity,
                    'price' => $productDetails->price,
                    'rs_id' => $_SESSION['rs_id'] // Add rs_id from session
                );

                // Check if cart item session is empty
                if (!empty($_SESSION["cart_item"])) {
                    // Check if the product is already in the cart
                    if (array_key_exists($productDetails->d_id, $_SESSION["cart_item"])) {
                        // Increment the quantity if the product is already in the cart
                        $_SESSION["cart_item"][$productDetails->d_id]["quantity"] += $quantity;
                    } else {
                        // Add the product to the cart if it's not already in the cart
                        $_SESSION["cart_item"][$productDetails->d_id] = $itemArray;
                    }
                } else {
                    // Add the product to the cart if the cart item session is empty
                    $_SESSION["cart_item"][$productDetails->d_id] = $itemArray;
                }
            }
            break;

        case "remove":
            // Check if cart item session is not empty
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $key => $value) {
                    // Remove the item from the cart if the product ID matches
                    if ($productId == $value['d_id']) {
                        unset($_SESSION["cart_item"][$key]);
                    }
                }
            }
            break;

        case "empty":
            // Empty the cart by unsetting the cart item session
            unset($_SESSION["cart_item"]);
            break;

        case "check":
            // Redirect to the checkout page
            header("location: checkout.php");
            break;
    }
}
