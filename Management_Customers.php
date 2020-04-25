<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Products</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/business-casual.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php
		$Username = null;
		if(!empty($_SESSION["Username"]))
		{$Username = $_SESSION["Username"];}
		if(empty($_SESSION['Admin'])){echo '<script>window.open("index.php","_self",null,true);</script>';}
	?>
</head>

<body>

    <div class="brand">Entregas ConfiguroWeb</div>
    <div class="address-bar"><strong>Directo</strong> y a la puerta de tu casa</div>

    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Entregas ConfiguroWeb</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				<li><a href="index.php">Inicio</a></li>
					<li><a href="Management_Orders.php">Órdenes</a></li>
					<li><a href="Management_Products.php?ProductAction=Add">Productos</a></li>
					<li><a href="Management_ProductsList.php">Lista de Productos</a></li>
                    <li><a href="Management_Customers.php">Clientes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
					<div class="table-responsive">
						<h4 style="text-align:center;">Clientes</h4>
						<table border="5px" class="table">
							<tr style="text-align: center; color: Black; font-weight: bold;">
								<td>ID Cliente</td>
								<td>Usuario</td>
								<td>Contraseña</td>
								<td>Primer Nombre</td>
								<td>Primer Apellido</td>
								<td>Segundo Apellido</td>
								<td>Dirección</td>
								<td>Correo Electrónico</td>
								<td>Acción</td>
							</tr>
								<?php 
								require 'Connection.php';
								$sql = "select CustomerID,Username,Password,Firstname,Middlename,Lastname,Address,EmailAddress from tbl_customers where Role = 'User'";
								$Resulta = mysqli_query($Conn,$sql);
								while($Rows = mysqli_fetch_array($Resulta)):; 
								?>
							<tr style="color: black">
								<td><?php $cid = $Rows[0]; echo $cid; ?></td>
								<td><?php echo $Rows[1]; ?></td>
								<td><?php echo $Rows[2]; ?></td>
								<td><?php echo $Rows[3]; ?></td>
								<td><?php echo $Rows[4]; ?></td>
								<td><?php echo $Rows[5]; ?></td>
								<td><?php echo $Rows[6]; ?></td>
								<td><?php echo $Rows[7]; ?></td>
								<td>
								<a href="#" onclick="actionOnclick('Edit',<?php echo $cid; ?>)">Editar</a> | 
								<a href="#" onclick="actionOnclick('Delete',<?php echo $cid; ?>)">Eliminar</a>
								</td>
								<?php endwhile; ?>
							</tr>
						</table>
					</div>
                </div>
            </div>
        </div>

    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; ConfiguroWeb</p>
                </div>
            </div>
        </div>
    </footer>
	

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script>
		function actionOnclick(Action,CustomerID){
			if(Action == "Edit")
			{
				if(confirm("Seguro deseas editar esta información?") == true)
				{
					window.open("Register.php?ActionType=Edit&Loc=MC&ID="+CustomerID,"_self",null,true);
				}
			}
			else if(Action == "Delete")
			{
				if(confirm("Seguro deseas eliminar esta información?") == true)
				{
					window.open("Management_Customers_Action.php?ID="+CustomerID,"_self",null,true);
				}
			}
		}
	</script>

</body>

</html>
