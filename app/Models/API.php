<?php

namespace App\Models;

class API
{
    public function testConnection()
    {
        //$data = ["table" => "Projects"];
        $data = "table=Projects";
        $result = $this->CallAPI("POST", "localhost:3000/list-table", $data);
        return $results;
    }

    function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();
    
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
    
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
    
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        var_dump($url);

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($curl);
    
        curl_close($curl);
    
        return $result;
    }
}