<?php
require "funciones.php";
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a BD
$db = conectarDB();

use Model\ActiveRecord;
use Model\Admin;
use Model\Propiedad;
use Model\Vendedor;

ActiveRecord::setDB($db );
$query = "select COLUMN_NAME 
  from INFORMATION_SCHEMA.COLUMNS
 where TABLE_SCHEMA = 'bienes_raices'
   and TABLE_NAME = 'propiedades'
 order by ORDINAL_POSITION";

$stmt = $db->prepare($query);
$stmt->execute();
$stmt->bind_result($columna);
$columnas = [];
while ($stmt->fetch()){
    $columnas[] = $columna;
}

Propiedad::setColumnas($columnas);


$query = "select COLUMN_NAME 
  from INFORMATION_SCHEMA.COLUMNS
 where TABLE_SCHEMA = 'bienes_raices'
   and TABLE_NAME = 'vendedores'
 order by ORDINAL_POSITION";

$stmt = $db->prepare($query);
$stmt->execute();
$stmt->bind_result($columna);
$columnas = [];
while ($stmt->fetch()){
    $columnas[] = $columna;
}
Vendedor::setColumnas($columnas);


$query = "select COLUMN_NAME 
  from INFORMATION_SCHEMA.COLUMNS
 where TABLE_SCHEMA = 'bienes_raices'
   and TABLE_NAME = 'usuarios'
 order by ORDINAL_POSITION";

$stmt = $db->prepare($query);
$stmt->execute();
$stmt->bind_result($columna);
$columnas = [];
while ($stmt->fetch()){
    $columnas[] = $columna;
}
Admin::setColumnas($columnas);