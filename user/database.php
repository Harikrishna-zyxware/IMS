<?php

//namespace database;

/*
*database class to execute query
*/
class database {

    public $lastId, $t, $db_link;

    //PDO result object
    public $result;
    public function open_database_connection()
    {
        //TODO: connect to the database and return the link object
        $server = 'blog';
        $dbname = 'blog';
        $username = 'root';
        $password = 'root';

        $link = new \PDO("mysql:host=$server;dbname=$dbname", $username, $password);

        return $link;
    }


    public function close_database_connection($link)
    {
        //TODO: close database connection
        $link = null;
    }

    /* query execute public function
    *  A single public function that handles query preparation, parameter binding and query excution
    *  returns the fetched data 
    */
    public function query_execute($query, $values) {
        $link = $this->open_database_connection();
        
        //check if the values is null
        //means it is an select query with no values
        if(empty($values)) {
            $result = $link->query($query);
        }
        else {

            //TODO: validation for insert
            $result = $link->prepare($query);
            foreach($values as $key => $val) {
                $result->bindParam($key, $values[$key]);
            }
           
            $this->t = $result->execute();
        }

        //fetch row(s) if the query is select
        $select = substr($query, 0, 6);
        if($select === "SELECT" || $select === "select") {
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
        }
        else {
            $data = NULL;
        }

        //save last insert id
        $this->lastId = $link->lastInsertId();

        $this->close_database_connection($link);
        return $data;
    }

    /*  query execute public functions
    *   Different public functions for handling query preparation, parameter binding and query excution
    * 
    */

    public function query() {

    }

    /*
    *   query prepare ()
    *   @params
    */
    public function prepare($type, $coloumns, $table, $values) {

        $link = $this->open_database_connection();
        $this->db_link = $link;
        
        switch($type) {
            case "SELECT":  //select every row operation
                if($coloumns === '*' && $values == NULL) {
                    $this->result = $link->query("SELECT * FROM $table");
                }

                //select a row from table
                else if($coloumns == '*') {

                    $query = "SELECT * FROM `$table`"
                    . " WHERE ";
                    //$i = 0;
                    foreach ($values as $key => $value) {
                        $query .= $key . " = :" . $key . " AND ";
                    }

                    //trim the last , and blank space using rtrim()
                    $query = rtrim($query," AND ");
                    $this->result = $link->prepare($query);
                }

                //select certain fields from a row in the table
                else {
                    $n = $coloumns.count();
                    $query = "SELECT ";
                    for ($i =0; $i < $n - 1; $i++) {
                        $query .= $coloumns[$i] . ", ";
                    } 
                    $query .=  $coloumns[$n - 1] . " FROM `$table`"
                    . " WHERE ";
                    
                    // AND condition
                    foreach ($values as $key => $value) {
                        $query .= $key . " = :" . $key . " AND ";
                    }

                    //trim the last , and blank space using rtrim()
                    $query = rtrim($query," AND ");
                    $this->result = $link->prepare($query);
                }
                return $this;
            case "INSERT": $query = "INSERT INTO `$table`(";
                foreach ($values as $key => $value) {
                    $query .= "`$key`" . ", ";
                }

                //trim the last , and blank space using rtrim()
                $query = rtrim($query,', ');
                 $query .= ") VALUES (";
                foreach ($values as $key => $value) {
                    $query .= "'$value'" . ", ";
                }

                //trim the last , and blank space using rtrim()
                $query = rtrim($query,', ');
                $query .= ")";
                $this->result = $link->prepare($query);
                return $this;
            //case "UPDATE":
            //case "DELETE":
        }

    }

    /*
    *   bind ()
    */
    public function bind($values) {
        if(isset($values)) {
            $i = 0;
            foreach ($values as $key => &$value) {
                $placeholder = ":" . $key;
                $this->result->bindParam($placeholder, $values[$key]);
            }
        }
        return $this;
    }

    /*
    *   execute()
    */
    public function execute() {
        $this->t = $this->result->execute();
        return $this;
    }

    /*
    *   fetch()
    */
    public function fetch() {
        while($row = $this->result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    /*
    *   lastinsert Id
    */
    public function last_insert_id() {
        $this->lastId = $this->db_link->lastInsertId();
        return $this->lastId;
    }
}

?>