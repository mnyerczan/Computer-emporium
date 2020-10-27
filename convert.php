<?php

require_once "BaseHandler.php";
require_once "XMLHandler.php";
require_once "CSVHandler.php";




// Construct a new XMLHandler object.
$csvHandler = new CSVHandler("import.csv"); 


// Construct a new XMLHandler object.
$xmlHandler = new XMLHandler("import.xml");


// Construct a new PDO object. If do not success, PDO object throw an PDOException error.
$pdo = new PDO("mysql:host=localhost;dbname=test;charset=utf8;","ms", "1024");


// $xmlHandler->export($pdo);
// $csvHandler->export($pdo);

$xmlList = $xmlHandler->render();
$csvList = $csvHandler->render();


require_once "view.php";




