<?php

include "dbconn.php";
 /*
$sql ="SELECT cart.id , cart.prod_id, cart.qty, cart.order_id, products.name, products.price, products.description from cart INNER JOIN products on products.id=cart.prod_id where cart.status='1'";
//$sql1 = "SELECT DISTINCT order_id FROM cart WHERE status = 1";

$result = mysqli_query($conn,$sql);
//$result2 = mysqli_query($conn, $sql1);

    echo "<table>";

        echo '
            <thead>
                <td><b>Order ID</b></td>
                <td><b>Name</b></td>
                <td><b>Quantity</b></td>
                <td><b>Price</b></td>
            </thead>
        ';

        while($rs = mysqli_fetch_array($result)) { 
            $id = $rs["id"]; 
            $prod_id = $rs["prod_id"];
            $order_id = $rs["order_id"];
            $name = $rs["name"]; 
            $qty = $rs["qty"]; 
            $description = $rs["description"]; 
            $price = $rs["price"];

           
                echo "<tr>
                            <td><b>$order_id</b></td>
                            <td>$name</td>
                            <td>$qty</td> 
                            <td>P $price</td>
                      </tr>";
          
        } 
    echo "</table>";
*/

$sql = mysqli_query($conn, "SELECT * FROM cart_orders WHERE status = 1");
echo '<div>
        <h2>Orders</h2>
        <ul>';
    while($row = mysqli_fetch_array($sql))
    {
        $order_id = $row['order_id'];
        $status = $row['status'];
        echo '
            <li>
                <p><strong>Order ID: </strong>'.$row['order_id'].'<span style="display:inline-block; width:65%;"></span>
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
               <form method = "post" action="update-order.php">
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
                <span style="display:inline-block; width:90%;"></span><input type="submit" value="Delivered">
                </form>               
               
               <hr>
               <?php
    }

?>