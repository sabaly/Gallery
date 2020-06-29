<?php
require "../Models/autoload.php";
$db = DBFactory::getMysqlConnexionWithPDO();

//managers
$categorieManager = new categorieManager_PDO($db);

$categories = $categorieManager->listCategories();

echo json_encode($categories);

?>