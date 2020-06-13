<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus']))){
include 'variables3.php';
if(isset($_GET['idus'])) { $idus = $_GET['idus']; }
if($nota > '')
{
try{ require_once('conn/conn.php');
$sql ="CALL `agg_not`('$nota', '$idus');";
$resultado = $conn->query($sql);}
catch (Exception $e)
{$error = $e->getMessage();
}
$em = 'notas.php?idus='.base64_encode($idus);''; 
header("Location: $em");
$conn->close();
}
else
{
$em = 'notas.php?idus='.base64_encode($idus);''; 
header("Location: $em");
}
} else { header ("Location: ../index.php?out=si"); }
?>