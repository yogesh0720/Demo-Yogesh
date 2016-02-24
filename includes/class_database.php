<?php

class class_database {

    private $serverName;
    private $userName;
    private $password;
    private $databaseName;
    private $type;
    public $mysqli;

    public function __construct() {
        $dbcredentials = class_common::getSettings('database');

        $this->serverName = $dbcredentials['server'];
        $this->userName = $dbcredentials['username'];
        $this->password = $dbcredentials['password'];
        $this->type = $dbcredentials['type'];
        $this->databaseName = $dbcredentials['databasename'];

        $this->connect();
    }

    private function connect() {
        switch($this->type)
        {
            case 'mysql' :
                //return mysql_connect($this->serverName, $this->userName, $this->password);
                $this->mysqli = new class_custommysqli( $this->serverName, $this->userName, $this->password, $this->databaseName );
                if ( mysqli_connect_errno() ) {
                	die( printf( 'MySQL Server connection failed: %s', mysqli_connect_error() ) );
                }
                break;
            case 'sqlserver' :

                break;
            default :
                throw new Exception('Database type invalid.');
        }
    }

    public function closeConnection() {
        switch($this->type)
        {
            case 'mysql' :
                $this->mysqli->close();
                break;
            case 'sqlserver' :

                break;
            default :
                throw new Exception('Database type invalid.');
        }
    }

    public function query($sql) {

        switch($this->type)
        {
            case 'mysql' :

                $resultSet = $this->mysqli->query($sql);
                return $resultSet;

                break;
            case 'sqlserver' :

                break;
            default :
                throw new Exception('Database type invalid.');
        }
    }

    public function get_row($sql) {

        switch($this->type)
        {
            case 'mysql' :
                $resultSet = $this->mysqli->query($sql);
                return $resultSet->fetch_array( MYSQLI_ASSOC );
                break;
            case 'sqlserver' :

                break;
            default :
                throw new Exception('Database type invalid.');
        }
    }

    public function getSPString($spName, $params = '') {
        switch($this->type)
        {
            case 'mysql' :
                $sql = "CALL $spName(";

                for($i = 0; $i < count($params); $i++)
                {
                    $sql .= "'" . $params[$i] . "', ";
                }

                $sql = substr($sql, 0, strlen($sql) - 2);
                $sql .= ")";

                //@file_put_contents( APPLICATION_UPLOAD . 'dblog.log', "\r\n" . date('d/m/Y H:i:s') . ' : ' . $sql . "\r\n", FILE_APPEND );

                return $sql;

                break;
            case 'sqlserver' :

                break;
            default :
                throw new Exception('Database type invalid.');
        }
    }

    
    public function getSPQueryResult($spname, $params, $return_obj_asso = 0) {
    	// CREATE THE DATABASE CONNECTION
    	// $this->connect();
    	$query = $this->getSPString ( $spname, $params );
    	$result = $this->mysqli->multi_query ( $query );
    
    	$result_arr = array ();
    	if ($result) {
    		while ( $res_use = $this->mysqli->store_result () ) {
    			if ($res_use->num_rows > 0) {
    				$result_sub_array = array ();
    				if ($arr_obj_asso) {
    					while ( $row = $res_use->fetch_object () )
    						array_push ( $result_sub_array, $row );
    				} else {
    					while ( $row = $res_use->fetch_assoc () )
    						array_push ( $result_sub_array, $row );
    				}
    				array_push ( $result_arr, $result_sub_array );
    			}
    			$res_use->free ();
    			$this->mysqli->next_result ();
    		}
    		while ( $this->mysqli->next_result () ) {
    		}
    		;
    	}
    	
    	return $result_arr;
    }
    
    
    public function getQueryResult($sqlquery, $return_obj_asso = 0) {    	
    	$query_exc = $this->mysqli->query ( $sqlquery );
    
    	$result_arr = array ();
    	if ($query_exc) {
    		if ($query_exc->num_rows > 0) {
    			if ($arr_obj_asso) {
    				while ( $rows = $query_exc->fetch_object () )
    					array_push ( $result_arr, $rows );
    			} else {
    				while ( $rows = $query_exc->fetch_assoc () )
    					array_push ( $result_arr, $rows );
    			}
    		}
    	}
    	return $result_arr;
    }
}

?>