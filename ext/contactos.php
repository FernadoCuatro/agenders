<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus']))){
include 'variables.php';
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']); }
try
{require_once('conn/conn.php');
$sql = "CALL `mos_con_idus`('$idus')";
$resultado = $conn->query($sql); 
$conn ->next_result();
$sql2 = "CALL `mos_us_idus`('$idus');";
$resultado2 = $conn->query($sql2);
}
catch (Exception $e) { $error = $e->getMessage(); }

?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
<meta charset="utf-8">
<title>AGENDERS | CONTACTOS (<?php echo $resultado->num_rows; ?>)</title>
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
<div class="contenedor">
<div class="conex"><a href="xs.php"><button class="connoex"><i class="far fa-times-circle"></i>Cerrar sesión</button></a></div>
<div class="con"><img src="../img/hero/hero1.png" alt=""></div>
<div class="conen"><a href="notas.php?idus=<?php echo base64_encode($idus) ;?>"><button class="conno"><i class="far fa-sticky-note"></i>Notas</button></a></div>
<?php while($registro2 = $resultado2->fetch_assoc() ) {  ?>
<h2 class="conpri">¡Hola <span class="conpri1"><?php echo $registro2['nombre'];?></span><i class="fas fa-thumbs-up"></i>,estas en tu mejor biblioteca de datos, Tus contactos guardados son: <span class="conpri2"><?php echo $resultado->num_rows; ?></span>!</h2>
<?php } ?>
<h2 class="conseg">Agregar nuevo contacto:</h2>
<div class="contenido2">
<form action="crear.php?idus=<?php echo $idus; ?>" method="post" enctype="multipart/form-data">
<div class="campo1">
<label for="nombre">Nombre:</label>
<input type="text" name="nombre" id="nombre" placeholder="Eje. Melissa" required  autocomplete="off">
</div>
<div class="campo1">
<label for="apellido">apellido:</label>
<input type="text" name="apellido" id="apellido" placeholder="Eje. Cuatro" autocomplete="off">
</div>
<div class="campo1">
<label for="numero">Telefono:</label>
<input type="number" name="numero" id="numero" placeholder="Eje. (+1)2235 1894" required>
</div>
<div class="campo1">
<label for="email">Correo:</label>
<input type="email" name="email" id="email" placeholder="ejemplo@agenders.com" autocomplete="off">
</div>
<div class="campo1">
<div id="stpho">
<label for="foto">foto:<br><i class="fas fa-save"></i></label>
<input type="file" name="foto" id="fotosub" >
</div>
</div>
<div class="campo1">
<label for="Notas">Apuntes:</label>
<input type="text" name="Notas" id="Notas" placeholder="Conocida en Clases" autocomplete="off">
</div>
</div>
<div class="enga"><input type="submit" value="Agregar" name="enviado" class="conag"></div>
</form>
<?php if($resultado->num_rows > 0 )
{?>
<div class="contenidocon existentescon">
<h2 class="conmu">Contactos existentes</h2>
<table>
<thead>
<tr>
<th><i class="fas fa-file-image"></i></i><span class="condes">Foto</span></th>
<th><i class="fas fa-users"></i><span class="condes">Nombres</span></th>
<th><i class="fas fa-expand-arrows-alt"></i><span class="condes">Ver</span></th>
</tr>
</thead>
<tbody>
<?php while($registro = $resultado->fetch_assoc() ) { ?>
<tr>
<td>
<?php
if($registro['foto']>'')
{ ?>
<div class="confo">
<img src="data:image/jpg;base64,<?php echo base64_encode($registro['foto']); ?>" title="foto de <?php echo $registro["nombre"]; ?>" id="foto">
<?php } else { ?>
</div>
<div class="confo">
<img src="../img/userspa.png" alt="">
<?php  } ?>
</div>
</td>
<td><?php echo $registro['nombre']." "; $id=$registro['id']; if($registro['apellido'] > '') {?>
<span class="condes">
<?php 
echo $registro['apellido'];
?>
</span><?php } ?></td>
<td>
<a href="ver.php?id=<?php echo base64_encode($id); ?>&idus=<?php echo base64_encode($idus) ;?>"><button class="conbot"><i class="fas fa-expand"></i></i><span class="condes">Ver</span></button></a> 
</td>
</tr>
<?php }?>
</tbody>
</table>
</div>
</div>
<?php } ?>
<?php
$conn->close();
} else {
header ("Location: ../index.php?out=si");
}
?>
</body>
</html>