<?php
if(isset($_POST['nombre'])){ $nombre = $_POST['nombre'];}else{$nombre = '';}
if(isset($_POST['apellido'])){ $apellido = $_POST['apellido'];}else{$apellido = '';}
if(isset($_POST['numero'])){$numero = $_POST['numero'];}else{$numero = '';}
if(isset($_POST['email'])){$email = $_POST['email'];}else{$email = '';}

if(isset($_FILES['foto'])){$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));}

if(isset($_POST['Notas'])){$Notas = $_POST['Notas'];}else{$Notas = '';}
?>