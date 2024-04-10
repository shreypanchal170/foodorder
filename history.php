<?php
session_start();
error_reporting(0);

include("connection/connect.php");
include_once 'product-action.php';

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {
    $user_id = $_SESSION["user_id"];

    // Fetch orders with status 'delivered' for the logged-in user
    $query = "SELECT * FROM users_orders WHERE u_id = '$user_id' AND status = 'delivered'";
    $result = mysqli_query($db, $query);

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Order History</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
            .button {
                background-color: #ff3300;
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
            }
        </style>
        <link rel="icon" href="/images/logo.png">
    </head>
    <body>
        <h2><span style="color:green;">Order History</span></h2>
        <?php
        // Check if there are any orders
        if (mysqli_num_rows($result) > 0) {
            ?>
            <table>
                <tr>
                    <th><span style="color:green;">Order ID</span></th>
                    <th><span style="color:green;">Title</span></th>
                    <th><span style="color:green;">Quantity</span></th>
                    <th><span style="color:green;">Price</span></th>
                    <th><span style="color:green;">Instruction</span></th>
                </tr>
                <?php
                // Loop through each row to display order details
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['o_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['instruction']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <button class="button" onclick="copyAndPrint()">Print</button>
            <a href="your_orders.php" class="button"><span style="color:white">Back to Admin Panel</a></span>
            <?php
        } else {
            echo "<p>No delivered orders found.</p>";
        }
        ?>
        <script>
            function copyAndPrint() {
                // Copy the content of the table to the clipboard
                var table = document.getElementsByTagName("table")[0];
                var range = document.createRange();
                range.selectNode(table);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.execCommand("copy");
                window.getSelection().removeAllRanges();

                // Print the page
                window.print();
            }
        </script>
    </body>
    </html>

<?php
}
?>
