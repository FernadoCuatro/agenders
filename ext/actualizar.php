<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus'])))
{
include 'variables2.php';
if(isset($_GET['id'])) {$id = base64_decode($_GET['id']); }
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']);}
try
{
require_once('conn/conn.php');
$sql = "CALL `act_con`('$nombre', '$apellido', '$numero', '$email', '$foto', '$notas', '$id');";
$resultado = $conn->query($sql);
}
catch (Exception $e)
{ $error = $e->getMessage(); }
$em = 'ver.php?id='.base64_encode($id).'&idus='.base64_encode($idus);'';
header("Location: $em");
$conn->close();
} else { header ("Location: ../index.php?out=si"); }
?>
