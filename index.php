<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set("America/Sao_Paulo");

$method = $_SERVER['REQUEST_METHOD'];

#AUTOLOAD
include_once "classes/autoload.class.php";
new Autoload();

#ROTAS
$rota = new Rotas();

$rota->add('POST', '/cidadao', 'Cidadao::adicionaCidadaos');
$rota->add('GET', '/cidadao', 'Cidadao::listarCidadaos');
$rota->add('GET', '/cidadao/[NIS]', 'Cidadao::listarCidadaoPorNis');
$rota->ir($_GET['path']);
