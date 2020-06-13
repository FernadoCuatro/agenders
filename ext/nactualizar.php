<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus'])))
{
include 'variables4.php';
if(isset($_GET['idno'])) {$idno = base64_decode($_GET['idno']); }
if(isset($_GET['idus'])) {$idus = base64_decode($_GET['idus']);}
try
{
require_once('conn/conn.php');
$sql = "CALL `act_no`('$nota', '$idno');";
$resultado = $conn->query($sql);
}
catch (Exception $e)
{
$error = $e->getMessage();
}
$em = 'notas.php?idno='.base64_encode($id).'&idus='.base64_encode($idus);'';
header("Location: $em");
$conn->close();
} else { header ("Location: ../index.php?out=si"); }
?>