<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus'])))
{
if(isset($_GET['id'])) {$id = base64_decode($_GET['id']); }
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']);}
try
{
require_once('conn/conn.php');
$sql ="CALL `del_cor`('$id');";
$resultado = $conn->query($sql);
}
catch (Exception $e)
{
$error = $e->getMessage();
}
$em = 'contactos.php?idus='.base64_encode($idus);''; 
header("Location: $em");
$conn->close();
} else {
header ("Location: ../index.php?out=si");
}
?>