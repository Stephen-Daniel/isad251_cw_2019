<?php


function getConnection()
{
    $dataSourceName = 'mysql:dbname='.DB_DATABASE.';host='.DB_SERVER;
    $dbConnection = null;
    try{
        $dbConnection = new PDO($dataSourceName,  DB_USER, DB_PASSWORD);
    } catch (PDOException $err)
    {
        echo 'Connection failed: ', $err->getMessage();
    }
    return $dbConnection;
}
/*
function getAll($tablename)
{
    $statement = getConnection()->prepare("SELECT * FROM ".$tablename);
    $statement->execute();
    $resultSet = $statement->fetchAll (PDO::FETCH_ASSOC);

    return $resultSet;
}
*/


?>