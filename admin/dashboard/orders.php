<?php

$page = $_SERVER['PHP_SELF'];
$sec = "5"; //interval in seconds for autorefreshing page content

session_start();
$admin = $_SESSION['admin'];
if(isset($admin)){} else { header('location:login'); }
?>
<!Doctype html>
<html>
	<head>
		<title>Artizan Cafe</title>
		<link rel="icon" href="img/logo.png">

		<!-- CUSTOM JS/CSS -->
		<link rel="stylesheet" type="text/css" href="../css/admin.css">
		<meta name="viewport" content="device-width=initial-scale 1.0;">

		<!-- AUTO REFRESH PAGE -->
		<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">


		<!-- FLAT UI JS/CSS -->
		<link rel="stylesheet" type="text/css" href="../Ui/dist/css/flat-ui.css">
		<link rel="stylesheet" type="text/css" href="../Ui/dist/css/flat-ui.min.css">
		<link rel="stylesheet" type="text/css" href="../Ui/dist/css/flat-ui.css.map">
		<link rel="stylesheet" type="text/css" href="../Ui/dist/css/vendor/bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="../Ui/dist/js/flat-ui.js"></script>

		<!-- Font awesome -->
		<link rel="stylesheet" type="text/css" href="../fonts/css/font-awesome.css">


		<!-- Animate -->
		<link rel="stylesheet" type="text/css" href="../css/animate.css">

		<!-- JQUERY -->
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/dashboard.js"></script>
		<script type="text/javascript" src="../js/drop.js"></script>

		<!-- Menu Ajax --> 
		<script type="text/javascript" src="../js/admin-ajax/form-ajax.js"></script>
		<script type="text/javascript" src="../js/form_jquery.js"></script>


	</head>

	<body>

		<!-- Start of Container -->
		<div class="container">
		<!-- Start of header-->
        <div class="header">
                        <div class="left">
                            <i class="fa fa-spoon"></i><i class="fa fa-spoon"></i> Artizan Cafe
                        </div>
                        <div class="left2">
                            <i id="burgermenu" class="fa fa-bars" alt="1"></i>
                        </div><!--
                        <div class="right">
                            <div class="box">
                                 <a href="out.php"><i class="fa fa-gear" style="color:white !important;"></i></a>
                            </div> 
                        </div>-->
                        <div class="right2">
                            <div class="box">
                                <i class="fa fa-gear"></i>
                            </div>
                        </div>
        </div>
    	<!-- End of header-->
    	<!-- Start of Content-->
    	<div class="content1">
			<?php

			include "../php/admin/crud/dbconn.php";

			$sql = mysqli_query($conn, "SELECT * FROM cart_orders WHERE status = 1");
			echo '<div>
					<br/>
					<br/>
					<h2>Pending Orders</h2>
					<ul>';
				while($row = mysqli_fetch_array($sql))
				{
					$order_id = $row['order_id'];
					$status = $row['status'];
					echo '
						<li>
							<p><strong>Order ID: </strong>'.$row['order_id'].'<span style="display:inline-block; width:45%;"></span>
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
						
						<?php
				}

			?>
    	</div>
        <!-- End of Content-->

        <!-- Start of footer-->
        <div class="footer">
            Developed by MIS Student &copy 2018
        </div>
        <!-- End of footer-->



    		<!-- Start of header-->
        <!-- End of header-->
		</div>
		<!-- End of Container -->
	</body>
</html>


<!-- Start of add product-->
<div class="add_products animated bounce">
		<div class="header-title">
			 <h4> <i class="fa fa-plus"></i> Add Product</h4>
			 <span><i class="fa fa-remove"></i></span>
		</div><br><br>
		<div class="animated shake" id="erorr">
		</div>
		<form id="addproduct" action="../php/admin/crud/add.php" method="post" enctype="multipart/form-data">
						<div class="img-cont">
								<img src="../img/images.jpg" alt="Upload Image" />

						</div>
						<div class="form-cont">
							  <input type="file" name="image" value="" id="add_image" required accept="image/png,image/jpg,image/jpeg,image/gif,image/	bitman" >
								<input type="text" name="name"  id="name" placeholder="Name" required="">
								<input type="number" name="price" id="price" placeholder="Price" required="">
								<select name="category" required="" id="category">
										<option value="Sisig">Sisig</option>
										<option value="Main-Meals">Main Meals</option>
										<option value="For Kids">For Kids</option>
										<option value="Desserts">Desserts</option>
										<option value="Drinks">Drinks</option>
										<option value="Extras">Extras</option>
								</select>
							 	<textarea name="description" id="description" rows="8" placeholder="Description" resizable></textarea>
								<button id="addprod-submit">Submit</button>
						</div>
			</form>
</div>
<!-- End of add product-->

<!-- Start of update product-->
<div class="add_products2 animated bounce" id="update-cont">
		<div class="header-title">
			 <h4> <i class="fa fa-plus"></i> Update Product</h4>
			 <span><i class="fa fa-remove"></i></span>
		</div><br><br>
		<div class="animated shake" id="erorr">
		</div>
		<div id="jafhioasbfaskldhasd"></div>
</div>
<!-- End of update product-->

					<!-- Start of PopUp-->
					<div class="popup animated bounceIn">
							<span>Delete ? </span>
							<hr>
							<button class="ok">Ok</button>
							<button class="cancel">Cancel</button>
					</div>
					<!-- End of PopUp-->




<!--

this might help

        <kbd style="background-color:red;">1</kbd>


-->
