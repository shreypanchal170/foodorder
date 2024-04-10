<?php
session_start();
// Include your connection file
include("../connection/connect.php");



// Prepare SQL statement to fetch the details of delivered orders along with user details
$sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id = users_orders.u_id WHERE users_orders.status='rejected'";
$query = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/logo.png">
    <title>Cancelled Orders History</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Include DataTables Buttons CSS -->
    <link href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1><span style="color:red;">Cancelled Orders History</span></h1>
                  
                    <!-- PDF export button -->
                    <script>
                        $(document).ready(function() {
                            // Initialize DataTables with Buttons
                            $('#ordersTable').DataTable({
                                dom: 'Bfrtip',
                                buttons: [
                                    {
                                        extend: 'copy',
                                        text: 'Copy',
                                        
                                    },
                                    {
                                        extend: 'csv',
                                        text: 'CSV',
                                        
                                    }
                                    
                                ]
                            });

                            
                        });
                    </script>

                 
                    <table id="ordersTable" class="table" bgcolor="red">
                        <thead>
                            <tr>
                                <th><span style="color:white;">User ID</span></th>
                                <th><span style="color:white;">User Name</span></th>
                                <th><span style="color:white;">Email</span></th>
                                <th><span style="color:white;">Order ID</span></th>
                                <th><span style="color:white;">Dish</span></th>
                                <th><span style="color:white;">Price</span></th>
                                <!-- Add more columns as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr>
                                    <td><?php echo $row['u_id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['o_id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <!-- Add more columns as needed -->
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <a href="all_orders.php" class="btn btn-primary">Back to Admin Panel</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- Include DataTables Buttons JavaScript -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
<script>

    // Initialize DataTables with Buttons
    $(document).ready(function() {
    // Initialize DataTables
    $('#ordersTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv'
        ]
    });
});
    // Print button click handler
    $('#print-button').on('click', function() {
        window.print();
    });
</script>
</body>
</html>
