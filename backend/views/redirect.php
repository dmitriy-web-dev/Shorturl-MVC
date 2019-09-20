<?php
require_once('../backend/models/url_functions.php');
require_once('../backend/controllers/shorturlController.php');
$function = new url_functions();
$defaultController = new shorturlController();

$page = $function->fetch($uri, 'long_url', 'short_url');
if(!$page)
{
    $defaultController->index();
}
else
{
    header("Location: $page[0]");
}