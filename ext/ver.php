<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus']))){
if(isset($_GET['id'])) { $id = base64_decode($_GET['id']); }
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']); }
try
{
require_once('conn/conn.php');
$sql = "CALL `ver_cor`('$id');";
$resultado = $conn->query($sql);
}
catch (Exception $e)
{
$error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
<meta charset="utf-8">
<title>AGENDERS | VER </title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="manifest" href="site.webmanifest">
<link rel="apple-touch-icon" href="icon.png">
<link rel="icon" type="icon" href="../img/AgendersIcon.png">
<link rel="stylesheet" href="../css/normalize.css">
<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="../css/all.min.css">
<meta name="theme-color" content="#fafafa">
</head>
<body>
<div class="contenedorver">
<div class="verhe"><img src="../img/hero/hero1.png" alt=""></div>
<form action="" method="post">
<?php while ($registro = $resultado->fetch_assoc()){?>
<div class="verencl">
<table class="veren">
<tbody>
<tr>
<td>
<div class="veren">
<a href="editar.php?id=<?php echo base64_encode($id); ?>&idus=<?php echo base64_encode($idus); ?>"><button type="button" class="verbot"><i class="fas fa-edit"></i><span class="verqui">Editar</span></button></a>
</div>
</td>
<td> 
<a href="javascript:eliminar()"><button type="button" class="verbot2"><i class="far fa-trash-alt"></i><span class="verqui">Borrar</span></button></a>
</td>
<td>
<a href="contactos.php?idus=<?php echo base64_encode($idus); ?>"><button type="button" class="verbot"><i class="fas fa-home"></i><span class="verqui">Inicio</span></button></a>
</td>
</tr>
</tbody>
</table>
</div>
<h2 class="conseg">Ver contacto de <?php echo $registro['nombre'] ?></h2>
<div class="campo">
<label for="nombre">Nombre:</label>
<p><?php echo $registro['nombre'] ?></p>
</div>
<?php 
if($registro['apellido'] > '')
{?>
<div class="campo">
<label for="apellido">Apellido:</label>
<p><?php echo $registro['apellido'] ."<br>";?></p>
</div>
<?php } ?>
<div class="campo">
<label for="numero">Telefono:</label>
<p><?php echo $registro['telefono'] ?></p>
</div>
<?php
if($registro['email']>'')
{ ?>
<div class="campoverem">
<label for="email">Email:</label>
<p><?php echo $registro['email'] ."<br>";?></p>
</div>
<?php } ?>
<?php
if($registro['apuntes'] > '')
{?>
<div class="verfo">
<label for="notas">Apuntes:</label>
<p><?php echo $registro['apuntes'] ."<br>";?></p>
</div>
<?php } ?>
<?php 
if($registro['foto']>'')
{ ?>
<div class="verfo">
<label for="foto">foto:</label><br>
<img src="data:image/jpg;base64,<?php echo base64_encode($registro['foto']); ?>" title="foto de <?php echo $registro["nombre"]; ?>" id="foto">
</div>
<?php } ?>

<?php } ?>
</form>
</div>
<?php
$conn->close();
?>
<script language="JavaScript1.2" type="text/javascript"> 
function eliminar() 
{ var confirmacion =confirm("¿Realmente desea eliminar este contacto?"); 
if (confirmacion == true) 
{ document.location.href="borrar.php?id=<?php echo base64_encode($id); ?>&idus=<?php echo base64_encode($idus); ?>"; } 
else 
{ document.location.href="ver.php?id=<?php echo base64_encode($id); ?>&idus=<?php echo base64_encode($idus); ?>"; }  } 
</script> 
<?php } else { header ("Location: ../index.php?out=si"); } ?>
</body>
</html>