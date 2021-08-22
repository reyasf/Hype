<?php

/* 
 * Run HypeSetup to create the database if it's not available and the required tables
 */
require "model/Model.php";

Class HypeSetup {
    function __construct() {
        $model = new Model();
        $connection = $model->connection;
        $database = $model->database;
        $tablename = $model->tablename;
        if (!$connection) {
            die('Could not connect: ' . mysqli_connect_error());
        } else {
            $this->createSchema($connection,$database,$tablename);
        }
    }
    
    /* Check the configured DB is available if not create the DB*/
    function createSchema($connection,$database,$tablename) {
        $db_available = mysqli_select_db($connection, $database);

        if (!$db_available) {
            $sql = "CREATE DATABASE ".$database;
            if (mysqli_query($connection, $sql)) {
                mysqli_select_db($connection, $database);
                $this->createTables($connection,$tablename);
            } else {
                echo 'Error creating database: ' . mysqli_error() . "\n";
            }
        } else {
            echo 'Database and Tables already exist.';
        }
        mysqli_close($connection);
    }
    
    /* Create the configured Table */
    function createTables($connection,$tablename) {
        $query = "CREATE TABLE ".$tablename."(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            username VARCHAR(30) NOT NULL,
            password VARCHAR(64) NOT NULL,
            email VARCHAR(70) NOT NULL UNIQUE
        )";
        if(mysqli_query($connection, $query)) {
            echo "Database and Tables are succesfully created.";
        } else {
            echo "ERROR: While creating the table" . mysqli_error($connection);
        }
    }
}

$setup = new HypeSetup();

