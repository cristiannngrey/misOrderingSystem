<?php

include "dbconn.php";

$sql = mysqli_query($conn, "SELECT * FROM cart_orders ORDER BY id DESC");
echo '<div>
        <h2>Orders</h2>
        <span style="display:inline-block; width:100%;"><b>Status:</b> 1 = Yet to be Delivered <br/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 4 = Delivered
        <ul>';
    while($row = mysqli_fetch_array($sql))
    {
        $order_id = $row['order_id'];
        $status = $row['status'];
        echo '
            <li>
                <p><strong>Status: </strong>'.$row['status'].'&nbsp&nbsp&nbsp&nbsp<strong>Order ID: </strong>'.$row['order_id'].'<span style="display:inline-block; width:30%;"></span>
                <strong>Date: </strong>'.$row['date'].'</p>
                <table>
                    <thead>
                        <td><b>Product ID</b></td>
                        <td><b>Name</b></td>
                        <td><b>Quantity</b></td>
                    </thead>
        ';

        $sql1 = mysqli_query($conn, "SELECT * FROM cart WHERE order_id = '$order_id';");
        while($row1 = mysqli_fetch_array($sql1))
        {
            $product_id = $row1['prod_id'];
            $sql2 = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
            while($row2 = mysqli_fetch_array($sql2))
            {  
                $item_name = $row2['name'];
                echo'
                        <tr>
                            <td>'.$row1['prod_id'].'</td> 
                            <td>'.$item_name.'</td>
                            <td>'.$row1['qty'] .'</td>
                        </tr>
                    </li>
                ';
                
            }
        }echo '</table>
                <br/>';
    ?>
               <!-- <form method = "post" action="update-order.php">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
                <span style="display:inline-block; width:90%;"></span><input type="submit" value="Delivered">
                </form>                 -->
               
               <hr> 
               <?php
    }

?>