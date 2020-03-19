<?php
class Database{
  
    //specify your own database credentials
    private $serverName = "sibernetik.com\\sqldeveloper, 1433"; //serverName\instanceName, portNumber (default is 1433)
    private $connectionInfo = array( 
        "Database"=>"api_db", 
        "UID"=>"SA", 
        "PWD"=>"SiberCorshine123");

public function getConnection(){
  
    $this->conn = null;
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn ) {
        echo "Connection established.<br />";
   }else{
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
   }
 
    return $this->conn;
}

?>
