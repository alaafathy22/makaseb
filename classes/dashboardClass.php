<?php
include 'getDataClass.php';
class dashboardClass extends DataClass
{
    function getDataForDashBoard()
    {
        return $this->getData($_SESSION['idUser']);
    }
}
?>
