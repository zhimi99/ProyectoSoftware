<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Latihan MySQLi</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
    
        <style>

               .menuCSS3 ul {
                    display: flex;
                    padding: 0px;
                    margin: 0;
                    list-style: none;
                    width: auto;
                    float: left;
                  
                }
                .menuCSS3 a {
                    display: block;
                    padding: 2em;
                    background-color: darkseagreen;
                    text-decoration: none;
                    color: #191C26;
                    font-family: monospace;
                    font-size: 18px;
                    padding-bottom: 20px;
                    padding-top: 20px;
                    width: 480px;
                    
                }
                .menuCSS3 a:hover {
                    background-color: forestgreen;
                    
                    
                }
                .menuCSS3 ul li ul {
                    display: none;
                    
                }
                .menuCSS3 ul li a:hover + ul, .menuCSS3 ul li ul:hover {
                    display: block;
                    
                }

         </style> 
    
    
    <nav class="menuCSS3">
		<ul>
			<li><a href="librosAdmin.html">MANTENIMIENTO</a></li>
           <li><a href="indexLibros.php">Listar Libros</a></li>
			<li><a href="agregarLibro.php">Agregar Nuevo Libro</a></li>
		</ul>
	</nav>
    
</head>
<body>
	
	<div class="container">
		<div class="content">
			<h2>Registrar Nuevo Libro&raquo; Agregar datos</h2>
			<hr />

			<?php
			if(isset($_POST['add'])){
				$ISBN		     = mysqli_real_escape_string($con,(strip_tags($_POST["ISBN"],ENT_QUOTES)));//Escanpando caracteres 
				$BookTitle	     = mysqli_real_escape_string($con,(strip_tags($_POST["Book-Title"],ENT_QUOTES)));//Escanpando caracteres 
				$BookAuthor	 = mysqli_real_escape_string($con,(strip_tags($_POST["Book-Author"],ENT_QUOTES)));//Escanpando caracteres 
				$YearOfPublication	 = mysqli_real_escape_string($con,(strip_tags($_POST["Year-Of-Publication"],ENT_QUOTES)));//Escanpando caracteres 
				$Publisher    = mysqli_real_escape_string($con,(strip_tags($_POST["Publisher"],ENT_QUOTES)));//Escanpando caracteres 
				$ImageURLS		 = mysqli_real_escape_string($con,
                (strip_tags($_POST["Image-URL-S"],ENT_QUOTES)));//Escanpando caracteres 
				$categoria	 = mysqli_real_escape_string($con,
                (strip_tags($_POST["categoria"],ENT_QUOTES)));//Escanpando caracteres 
				$stock	 = mysqli_real_escape_string($con,
                (strip_tags($_POST["stock"],ENT_QUOTES)));//Escanpando caracteres 
				
			

				$cek = mysqli_query($con, "SELECT * FROM BXBooks WHERE ISBN='$ISBN'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($con, "INSERT INTO BXBooks(ISBN, Book-Title	, Book-Author, Year-Of-Publication,Publisher, Image-URL-S, categoria, stock	)
															VALUES('$ISBN','$BookTitle', '$BookAuthor', '$YearOfPublication', '$Publisher', '$ImageURLS', '$categoria','$stock')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho! Los datos han sido guardados con éxito.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar los datos !</div>';
						}
					 
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. código exite!</div>';
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">ISBN</label>
					<div class="col-sm-2">
						<input type="text" name="cedula" class="form-control" placeholder="ISBN" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Book-Title</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" class="form-control" placeholder="Book-Title" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Book-Author</label>
					<div class="col-sm-4">
						<input type="text" name="direccion" class="form-control" placeholder="Book-Author" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Year-Of-Publication</label>
					<div class="col-sm-4">
						<input type="text" name="telefono" class="input-group date form-control"  placeholder="Year-Of-Publication" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Publisher</label>
					<div class="col-sm-3">
						<textarea name="correo" class="form-control" placeholder="Publisher"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">$Image-URL-S</label>
					<div class="col-sm-3">
						<input type="text" name="clave" class="form-control" placeholder="URL-IMAGEN" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Categoria</label>
					<div class="col-sm-3">
						<select name="estado" class="form-control">
							<option value=""> ----- </option>
                            <option value="1">Comedia</option>
							<option value="2">Romance</option>
                            <option value="1">Aventura</option>
							<option value="2">Ficción</option>
                            
						</select>
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-3 control-label">stock</label>
					<div class="col-sm-3">
						<input type="text" name="clave" class="form-control" placeholder="stock" required>
					</div>
				</div>
                
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	
</body>
</html>
