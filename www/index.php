<?php
require_once('../backend/controllers/shortController.php');
require_once('../backend/models/shortModel.php');
$shortController = new shortController();
$shortModel = new shortModel();

$uri = $shortModel->escape($shortModel->base($shortModel->parse($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

if($uri == basename(__DIR__))
{
    $shortController->index();
}
else if(preg_match_all('/^\A([a-z0-9]{8})$/', $uri, $matches, PREG_OFFSET_CAPTURE, 0))
{
    $shortController->redirect($uri);
}
else
{
    $shortController->index();
}