<?php
class shortModel
{
    function escape($string)
    {
        return preg_replace("/[^A-Za-z0-9]/","",$string);
    }
    function base($string)
    {
        return basename($string);
    }
    function parse($string, $component)
    {
        return parse_url($string, $component);
    }
}