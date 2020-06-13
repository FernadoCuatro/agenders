<?php
session_start();
if(isset($_SESSION['orde']))
{
try
{require_once('conn/conn.php');
$sql = "CALL `age_usu`();";
$resultado = $conn->query($sql);
$conn ->next_result();
$sql2 = "CALL `age_con`();";
$resultado2 = $conn->query($sql2);
$conn ->next_result();
$sql3 = "CALL `age_not`();";
$resultado3 = $conn->query($sql3);
}
catch (Exception $e) { $error = $e->getMessage(); }
?>
<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
<meta charset="utf-8">
<title>AGENDERS || GESTOR</title>
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
<h2>Bienvenido administrador.</h2>
<a href="xsage.php"><button>Cerrar sesión</button></a>
<a href="#usuarios"><button>Usuarios</button></a>
<a href="#contactos"><button>Contactos</button></a>
<a href="#notas"><button>notas</button></a>
<h4 id="usuarios">Usuarios</h4>
<table border="1">
<thead><tr>
<th>idus</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>pw</th></tr>
</thead>
<tbody>
<?php while($registro = $resultado->fetch_assoc() ) { ?>
<tr>
<td><?php echo $registro['idus'];?></td>
<td><?php echo $registro['nombre'];?></td>
<td><?php echo $registro['apellido'];?></td>
<td><?php echo $registro['email'];?></td>
<td><?php echo $registro['pw']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<h4 id="contactos">contactos</h4>
<table border="1">
<thead><tr>
<th>id</th><th>nombre</th><th>apellido</th><th>telefono</th><th>email</th><th>apuntes</th><th>idus</th></tr>
</thead>
<tbody>
<?php while($registro2 = $resultado2->fetch_assoc() ) { ?>
<tr>
<td><?php echo $registro2['id'];?></td>
<td><?php echo $registro2['nombre'];?></td>
<td><?php echo $registro2['apellido'];?></td>
<td><?php echo $registro2['telefono']; ?></td>
<td><?php echo $registro2['email']; ?></td>
<td><?php echo $registro2['apuntes']; ?></td>
<td><?php echo $registro2['idus']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
<h4 id="notas">Notas</h4>
<table border="1">
<thead><tr>
<th>idno</th><th>notas</th><th>idus</th></tr>
</thead>
<tbody>
<?php while($registro3 = $resultado3->fetch_assoc() ) { ?>
<tr>
<td><?php echo $registro3['idno'];?></td>
<td><?php echo $registro3['notas'];?></td>
<td><?php echo $registro3['idus'];?></td>
</tr>
<?php } ?>
</tbody>
</table>











</body>
</html>
<?php
} else {
header ("Location: ../index.php?out=si");
} ?>
