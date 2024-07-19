<?php

namespace App\Models;

class API
{   
    private static $host_address = "192.168.0.136:3000";

    public function testConnection()
    {
        //$data = ["table" => "Requests"];
        //$data = 'table=Requests&filter={"ID": 3}';
        $data = 'table=Requests';
        $result = $this->CallAPI("POST", self::$host_address . "/list-table", $data);
        return json_decode($result);
    }

    public function GetTable($tableName, $filter=null)
    {
        $url = self::$host_address . "/list-table";
        $data = 'table=' . $tableName;
        if($filter)
        {
            $data .= "&filter=" . $filter;
        }

        $result = $this->CallAPI("POST", $url, $data);
        return json_decode($result);
    }

    public function SaveRecord($tableName, $data)
    {
        $url = self::$host_address . "/add-record";
        $data = 'table=' . $tableName . '&data=' . $data;

        $result = $this->CallAPI("POST", $url, $data);
        return json_decode($result);
    }

    public function GetProjectListAsArray()
    {
        $projects = $this->GetTable("Projects");
        $projectList = [];
        foreach($projects->body->data as $proj)
        {
            $projectList[$proj->ID] = $proj->Name;
        }
        
        return $projectList;
    }

    private function CallAPI($method, $url, $data = false)
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
        //curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        //var_dump($url);

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