<?php
include 'mainClass.php';
class DataClass extends mainClass
{
    function getData($idUser)
    {
        $this->connectionDataBase();
        $sql = "SELECT 	* FROM users WHERE 	id='" . $idUser . "'";
        $stmt = $this->conn->prepare($sql);
        $result = $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
?>
