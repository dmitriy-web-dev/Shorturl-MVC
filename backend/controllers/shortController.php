<?php
class shortController
{
    public function index()
    {
        include_once('../backend/views/home.php');
    }
    public function redirect($uri)
    {
        include_once('../backend/views/redirect.php');
    }
}