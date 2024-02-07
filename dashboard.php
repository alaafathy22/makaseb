<?php
$pageName = 'DashBoard';
require_once './headStyles.php';
session_start();
if ($_SESSION['logged'] != 1) {
    header('Location: ./index.php');
} else {
    include './classes/dashboardClass.php';
    $MainClass = new dashboardClass();
    $data = $MainClass->getDataForDashBoard();
    $logOut = $MainClass->logOut();
}
?>
<div id="">
    <?php
    $secondDropDown = 'profile';
    $linkSecondDropDown = 'profile.php';
    include 'navBar.php';
    ?>
    <!-- End of nav -->
    <!-- Modal For LogOut -->
    <?php
    include 'modalLogout.php';
    ?>
</div>


<?php
require_once './footerStyles.php';
?>
