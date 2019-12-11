<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de los Usuario</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
	
</head>
<body>
	
    
    
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
    
    
    
    
	<div class="container">
		<div class="content">
			<h2>Datos de los Libros &raquo; Editar datos</h2>
			<hr/>
			<?php
			$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($con, "SELECT * FROM BXBooks WHERE ISBN='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: index.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
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
				
				
				$update = mysqli_query($con, "UPDATE BXBooks SET Book-Title='$BookTitle	', Book-Author='$BookAuthor', Year-Of-Publication='$YearOfPublication', Publisher='$Publisher', Image-URL-S='$ImageURLS	', categoria='$categoria', stock='$stock' WHERE ISBN='$nik', stock='$stock'") or die(mysqli_error());
				if($update){
					echo 'header("Location: editarLibro.php?nik=".$nik."&pesan=sukses")';
                  //  header("Location: index.php");
                    
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">ISBN</label>
					<div class="col-sm-2">
						<input type="text" name="cedula" value="<?php echo $row ['ISBN']; ?>" class="form-control" placeholder="ISBN" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">BookTitle</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" value="<?php echo $row ['Book-Title']; ?>" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Book-Author</label>
					<div class="col-sm-4">
						<input type="text" name="direccion" value="<?php echo $row ['Book-Author']; ?>" class="form-control" placeholder="Dirección" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Year-Of-Publication</label>
					<div class="col-sm-4">
						<input type="text" name="telefono" value="<?php echo $row ['Year-Of-Publication']; ?>" class="input-group date form-control" placeholder="Year-Of-Publication" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Publisher</label>
					<div class="col-sm-3">
						<textarea name="correo" class="form-control" placeholder="Publisher"><?php echo $row ['Publisher']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Image-URL-S</label>
					<div class="col-sm-3">
						<input type="text" name="clave" value="<?php echo $row ['Image-URL-S']; ?>" class="form-control" placeholder="URL IMAGEN" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Categoria</label>
					<div class="col-sm-3">
						<select name="estado" class="form-control">
							<option value="">- Selecciona estado -</option>
                            <option value="1" <?php if ($row ['categoria']==1){echo "selected";} ?>>Comedia</option>
							<option value="2" <?php if ($row ['categoria']==2){echo "selected";} ?>>Romance</option>
                            <option value="3" <?php if ($row ['categoria']==1){echo "selected";} ?>>Aventura</option>
                            <option value="4" <?php if ($row ['categoria']==1){echo "selected";} ?>>Ficcion</option>
							
						</select> 
					</div>
                   
                </div>
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
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