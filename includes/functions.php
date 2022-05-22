<?php

    define('DBINFO', 'mysql:host=localhost;dbname=liamro_dont_waste_it');
    define('DBUSER','liamro_user');
    define('DBPASS','12345');
    

    function fetchAll($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->query('SET NAMES utf8');
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }
    
    

?>