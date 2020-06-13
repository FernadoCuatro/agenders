<?php
session_start();
if(isset($_SESSION['verificado'])  && (isset($_GET['idus'])))
{
include 'variables4.php';
if(isset($_GET['idno'])) { $idno = base64_decode($_GET['idno']); }
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']); }
try
{
require_once('conn/conn.php');
$sql = "CALL `ver_not`('$idno');";
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
<title>AGENDERS | EDITAR NOTAS</title>
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
<h2 class="conseg">Editar Nota</h2>
<form action="nactualizar.php?idno=<?php echo base64_encode($idno); ?>&idus=<?php echo base64_encode($idus);?>" method="post">
<?php while ($registro = $resultado->fetch_assoc()){?>
<div class="camponed">
<input type="text" name="nota" id="notas" value="<?php echo $registro['notas'] ?>">
</div>

<button type="submit" class="verbot"><i class="fas fa-pencil-alt"></i><span class="verqui">Modificar</span></button>
<a href="notas.php?idus=<?php echo base64_encode($idus); ?>"><button type="button" class="verbot"><i class="fas fa-home"></i><span class="verqui">Inicio</span></button></a>
<?php } ?>
</form>
</div>



<?php
$conn->close();
} else {
header ("Location: ../index.php?out=si");
}
?>
</body>
</html>