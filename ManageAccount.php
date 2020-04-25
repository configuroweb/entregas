<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register an Accout</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
		require 'Connection.php';
		$Username = null;
		if(!empty($_SESSION["Username"]))
		{
			$Username = $_SESSION["Username"];
		}
		$sql = "select * from tbl_customers where Username = '".$Username."' and Password = '".$_SESSION['Password']."'";
		$Res = mysqli_query($Conn,$sql);
		while($Rows = mysqli_fetch_array($Res))
		{
			$C_ID = $Rows[0];
			$C_Username = $Rows[1];
			$C_Password = $Rows[2];
			$C_Firstname = $Rows[4];
			$C_Middlename = $Rows[5];
			$C_Lastname = $Rows[6];
			$C_Address = $Rows[7];
			$C_Email = $Rows[8];
		}
	?>
</head>

<body>

    <div class="brand">Sole Mates Shoe Store</div>
    <div class="address-bar"><strong>Cheap</strong> Shoes for Everyone</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Sole Mates Shoe Store</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
					<li><a href="bestseller.php">Best Sellers</a></li>
					<li><a href="shop.php">Shop</a></li>
                    <li><a href="about.php">About</a></li>
					<?php if($Username == null){echo '<li><a href="register.php?ActionType=Register">Register</a></li>';} ?>
					<?php if($Username == null){echo '<li><a href="Login.php?Role=User">Login</a></li>';} else {echo '<li><a href="Logout.php">Logout</a></li>';} ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
						<hr>
						<h2 class="intro-text text-center">Manage Account</h2>
						<hr>
					<div class="col-md-6">	
							<form role="form" action="Register.php?ActionType=Edit&Loc=MA&ID=<?php echo $C_ID; ?>" method="POST">
							<h4 style="text-align: center">Account Information</h4>
							<div class="form-group">
							  <label for="username">Username:</label>
							  <input type="text" name="Username" class="form-control" id="Username" value="<?php echo $C_Username; ?>" disabled>
							</div>
							
							<div class="form-group">
							  <label for="Password">Password:</label>
							  <input type="Password" name="Password" class="form-control" id="Password" value="<?php echo $C_Password; ?>" disabled>
							</div>

							<div class="form-group">
							  <label for="Firstname">Firstname:</label>
							  <input type="text" name="Firstname" class="form-control" id="Firstname" value="<?php echo $C_Firstname; ?>" disabled>
							</div>
							
							<div class="form-group">
							  <label for="Middlename">Middlename:</label>
							  <input type="text" name="Middlename" class="form-control" id="Middlename" value="<?php echo $C_Middlename; ?>" disabled>
							</div>
							
							<div class="form-group">
							  <label for="Lastname">Lastname:</label>
							  <input type="text" name="Lastname" class="form-control" id="Lastname" value="<?php echo $C_Lastname; ?>" disabled>
							</div>
							
							<div class="form-group">
							  <label for="Address">Address:</label>
							  <input type="text" name="Address" class="form-control" id="Address" value="<?php echo $C_Address; ?>" disabled>
							</div>
							
							<div class="form-group">
							  <label for="EmailAddress">Email Address:</label>
							  <input type="email" name="EmailAddress" class="form-control" id="EmailAddress" value="<?php echo $C_Email; ?>" disabled>
							</div>
							
							<button type="submit" class="btn btn-default">Edit Info</button>
						</form>
					</div>
					
					<div class="col-md-6">	
						<h4 style="text-align: center">My Orders</h4>
						<div class="table-responsive">
							<table border="5px" class="table">
								<tr style="text-align: center; color: Black; font-weight: bold;">
									<td>Order ID</td>
									<td>Product Name</td>
									<td>Product Brand</td>
									<td>Product Size</td>
									<td>Product Color</td>
									<td>Product Price</td>
									<td>Date Ordered</td>
									<td>Action</td>
								</tr>
								
								<?php 
								$sqlI = "SELECT tbl_orders.OrderID, tbl_products.Productname, tbl_products.ProductBrand, tbl_orders.Size, " .
								" tbl_orders.Color, tbl_products.ProductPrice, tbl_orders.DateOrdered FROM tbl_products RIGHT JOIN " .
								" tbl_orders on tbl_orders.ProductID = tbl_products.ProductID WHERE tbl_orders.CustomerID = $C_ID ORDER BY tbl_orders.OrderID";
								$Resulta = mysqli_query($Conn,$sqlI);
								while($Rows = mysqli_fetch_array($Resulta)):; 
								?>
								<tr style="color: black">
								<td><?php echo $Rows[0]; ?></td>
								<td><?php echo $Rows[1]; ?></td>
								<td><?php echo $Rows[2]; ?></td>
								<td><?php echo $Rows[3]; ?></td>
								<td><?php echo $Rows[4]; ?></td>
								<td><?php echo $Rows[5]; ?></td>
								<td><?php echo $Rows[6]; ?></td>
								<td>
								<a href="#" onclick="OrderOnclick(<?php echo $Rows[0]; ?>);">Cancel</a>
								</td>
								<?php endwhile; ?>
								</tr>
							</table>
						</div>
					</div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Sole Mates Shoe Store 2017</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
		function OrderOnclick(OrderID)
		{
			if(confirm("Are you sure you want to cancel this order?") == true)
			{
				window.open("ManageAccountAction.php?oID="+OrderID,"_self",null,true);
			}
		}
	</script>

</body>

</html>














