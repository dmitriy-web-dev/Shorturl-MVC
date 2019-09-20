<?php
require_once('connectionModel.php');
class url_functions extends connectionModel
{
    function isDomainAvailable($domain)
    {
        if(!filter_var($domain, FILTER_VALIDATE_URL))
        { return false; }
        $curlInit = curl_init($domain);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($curlInit);
        curl_close($curlInit);
        if ($response) { return true; } else { return false; }
    }

    function add($data)
    {
        if(!$this->fetch($data['long_url'], 'short_url', 'long_url'))
        {
            try
            {
                $stmt= $this->connection->prepare("INSERT INTO links (id, long_url, short_url) VALUES (:id, :long_url, :short_url)");
                $stmt->execute($data);
                return $data['short_url'];
            }
            catch (Exception $e)
            {
                return false;
            }
        }
        else
        {
            return $data['short_url'];
        }
    }
    function fetch($value, $in, $where)
    {
        try
        {
            $stmt = $this->connection->prepare("SELECT $in FROM links WHERE $where=:$where");
            $stmt->execute([$where => $value]);
            $result = $stmt->fetch();
            if($result)
            {
                return $result;
            }
            else
            {
                return false;
            }
        }
        catch (Exception $e)
        {
            return false;
        }
    }
}