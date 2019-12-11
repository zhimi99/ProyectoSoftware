<?php
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Datos de los Usuarios</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
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
			<h2>Lista de  Libros</h2>
			<hr />

			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM BXBooks WHERE ISBN='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM BXBooks WHERE ISBN='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="get">
				<div class="form-group">
					<select name="filter" class="form-control" onchange="form.submit()">
						<option value="0">Categoria</option>
						<?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
						<option value="1" <?php if($filter == 'Tetap'){ echo 'selected'; } ?>>Comedia</option>
						<option value="2" <?php if($filter == 'Kontrak'){ echo 'selected';}?>>Romance</option>
                        <option value="3" <?php if($filter == 'Kontrak'){ echo 'selected';}?>>Aventura</option>
                        <option value="4" <?php if($filter == 'Kontrak'){ echo 'selected';}?>>Ficcion</option>
                        
					</select>
				</div>
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<tr>
                    <th>No</th>
					<th>ISBN</th>
					<th>Book-Title</th>
                    <th>Book-Author</th>
                    <th>Year-Of-Publication</th>
					<th>Publisher</th>
					<th>Image-URL-S</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Acciones</th>
				</tr>
				<?php
				if($filter){
					$sql = mysqli_query($con, "SELECT * FROM BXBooks WHERE categoria='$filter' ORDER BY ISBN ASC");
				}else{
					$sql = mysqli_query($con, "SELECT * FROM BXBooks");
				}
                
				//$rows -> mysqli_num_rows($ql);
                if(mysqli_num_rows($sql)==0){
					echo '<tr><td colspan="11">No hay datos.</td></tr>';
				}else{
					$no = 1;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['ISBN'].'</td>
							<td><a href="detalleLibro.php?nik='.$row['ISBN'].'"> <img src="../proyecto/iconos/reporte.jpg" alt="Avatar" width="25px"> '.$row['Book-Title'].'</a></td>
                            <td>'.$row['Book-Author'].'</td>
                            <td>'.$row['Year-Of-Publication'].'</td>
							<td>'.$row['Publisher'].'</td>
                            <td>'.$row['Image-URL-S'].'</td>
                            
							<td>';
							if($row['categoria'] == '1'){
								echo '<span class="label label-success">Comedia</span>';
							}
                            else if ($row['categoria'] == '2' ){
								echo '<span class="label label-info">Romance</span>';
							}
                            else if ($row['categoria'] == '3' ){
								echo '<span class="label label-info">Aventura</span>';
							}
                            else if ($row['categoria'] == '4' ){
								echo '<span class="label label-info">Ficcion</span>';
							}
                            
                            
						echo '
							</td>
                             <td>'.$row['stock'].'</td>
							<td>

								<a href="editarLibro.php?nik='.$row['ISBN'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="index.php?aksi=delete&nik='.$row['ISBN'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['Book-Title'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
			</table>
			</div>
		</div>
	</div><center>
    
    </center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
