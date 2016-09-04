<?php
require_once 'App.php';
require_once 'functions.php';
$oApp = App::getInstance();
$oApp->init();

$oProduto = new \App\Model\ModelProduto();
$oProduto->setCodigo(2);
$oPersis = new \App\Persistence\Persistence();
$oPersis->setModel($oProduto);
if($oPersis->read()){
    var_dump($oProduto);
}
