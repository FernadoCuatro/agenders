<?php
session_start();
if(isset($_SESSION['verificado']) && (isset($_GET['idus'])))
{
if(isset($_GET['idno'])) {$idno = base64_decode($_GET['idno']); }
if(isset($_GET['idus'])) { $idus = base64_decode($_GET['idus']);}
try
{
require_once('conn/conn.php');
$sql ="CALL `del_no`('$idno');";

$resultado = $conn->query($sql);
} 
catch (Exception $e)
{
$error = $e->getMessage();
}
$em = 'notas.php?idus='.base64_encode($idus);''; 
header("Location: $em");
} else {
header ("Location: ../index.php?out=si");
}
?>