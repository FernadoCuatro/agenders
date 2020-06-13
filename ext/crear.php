<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus']))){
include 'variables.php';
if(isset($_GET['idus'])) { $idus = $_GET['idus']; }
if($nombre > '' and $numero > '')
{ try{ require_once('conn/conn.php');
$sql = "CALL `ins_con`('$nombre','$apellido', '$numero', '$email', '$foto', '$Notas', '$idus');";
$resultado = $conn->query($sql);}
catch (Exception $e)
{$error = $e->getMessage();
}
$em = 'contactos.php?idus='.base64_encode($idus);''; 
header("Location: $em");
$conn->close();
} else {
$em = 'contactos.php?idus='.base64_encode($idus);''; 
header("Location: $em");
}} else { header ("Location: ../index.php?out=si"); }
?>
<a href=""></a>
</body>
</html>