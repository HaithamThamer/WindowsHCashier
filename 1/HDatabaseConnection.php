<?php


class HDatabaseConnection{
    private $dbHost,$dbUsername,$dbPassword,$dbName,$connection;
    public $isConnected;
    function __construct($dbHost,$dbUsername,$dbPassword,$dbName) {
        $this->dbHost = $dbHost;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
        $this->isConnected = FALSE;
    }//Construct
    private function openConnection(){
        if (!$this->isConnected && $this->connection == null) {
            $this->connection = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            $this->isConnected = TRUE;
        }else{
           $this->isConnected = FALSE; 
        }
        return $this->isConnected;
    }//openConnection
    private function closeConnection(){
        if ($this->isConnected && $this->connection != null) {
            $this->connection->close();
            $this->connection = null;
            $this->isConnected = FALSE;
            return !$this->isConnected;
        }else{
            $this->isConnected = TRUE;
            return !$this->isConnected;
        }
    }//closeConnection
    public function query($sql){
        if (!$this->isConnected){$this->openConnection();}
        $result = $this->connection->query($sql);
        if ($this->isConnected){$this->closeConnection();}
        return $result;
    }
    public function queryNonReader($sql){
        if (!$this->isConnected){$this->openConnection();}
        $this->connection->query($sql);
        if ($this->isConnected){$this->closeConnection();}
    }
    public function queryCompanyInfo($name){
        if (!$this->isConnected){$this->openConnection();}
        $result = $this->connection->query("SELECT value FROM tbl_company_info WHERE name = '$name'")->fetch_array()[0];
        if ($this->isConnected){$this->closeConnection();}
        return $result;
    }
}//Class
