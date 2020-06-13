<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus'])))
{ 
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']); }
include 'variables3.php';
try
{require_once('conn/conn.php');
$sql = "CALL `mos_not_idus`('$idus');";
$resultado = $conn->query($sql); 
$conn ->next_result();
$sql2 = "CALL `mos_us_idus`('$idus');";
$resultado2 = $conn->query($sql2); }
catch (Exception $e) { $error = $e->getMessage(); }
?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
<meta charset="utf-8">
<title>AGENDERS | NOTAS (<?php echo $resultado->num_rows; ?>)</title>
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
<div class="conen"><a href="contactos.php?idus=<?php echo base64_encode($idus) ;?>"><button class="conno"><i class="fas fa-address-book"></i>Contactos</button></a></div>
<?php while($registro2 = $resultado2->fetch_assoc() ) { ?>
<h2 class="conpri">¡Hola <span class="conpri1"><?php echo $registro2['nombre'];?></span><i class="fas fa-thumbs-up"></i>, estas en tu mejor biblioteca de datos, tus notas guardadas son <span class="conpri2"><?php echo $resultado->num_rows; ?></span>!</h2>
<?php }?>
<form action="ncrear.php?idus=<?php echo $idus; ?>" method="post">
<div class="notaqw">
<div class="campo2">
<input type="text" name="nota" id="nota" class="notain" placeholder="Eje. Hay Homework parar mañana y tengo examen de biologia." autocomplete="off" required>
</div>
</div>
<div class="enga">
<input type="submit" value="agregar nota" class="conag">
</div>
</form>
<?php if($resultado->num_rows > 0) { ?>
<div class="contenidono existentesno">
<h2  class="conmu">Notas existentes</h2>
<table>
<thead>
<tr>
<th><i class="far fa-clipboard"></i><span class="condes">Notas</span></th>
<th><i class="fas fa-edit"></i><span class="condes">Editar</span></th>
<th><i class="fas fa-trash"></i><span class="condes">Borrar</span></th>
</tr>
</thead>
<tbody>
<?php while($registro = $resultado->fetch_assoc() ) { ?>
<tr>
<td><span class="notamo"><?php echo $registro['notas']; $idno=$registro['idno']; ?></span></td>
<td>
<a href="neditar.php?idno=<?php echo base64_encode($idno); ?>&idus=<?php echo base64_encode($idus) ;?>"><button class="conbot"><i class="fas fa-edit"></i><span class="condes">Editar</span></button></a> 
</td>
<td>
<a href="nborrar.php?idno=<?php echo base64_encode($idno); ?>&idus=<?php echo base64_encode($idus); ?>";"><button class="notael"><i class="fas fa-trash"></i><span class="condes">Borrar</span></button></a> 
</td>
</tr>
<?php }?>
</tbody>
</table>
<?php } ?>
</div>
</div>
<?php
} else {
header ("Location: ../index.php?out=si");
}
?>
</body>
</html>