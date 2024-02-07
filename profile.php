<?php
$pageName = 'Profile';
session_start();
require_once './headStyles.php';
if ($_SESSION['logged'] != 1) {
    header('Location: index.php');
} else {
    include './classes/dashboardClass.php';
    $MainClass = new dashboardClass();
    $data = $MainClass->getDataForDashBoard();
    $logOut = $MainClass->logOut();
}
?>
<!-- Page Wrapper -->
<div id="">
    <?php
    $secondDropDown = 'dashboard';
    $linkSecondDropDown = 'dashboard.php';
    include 'navBar.php';
    ?>
    <!-- End of nav -->
    <!-- End of Topbar -->
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">

                        <img width="200px" height="200px" class="img-account-profile rounded-circle mb-2"
                            src="./images/<?php echo $_SESSION['image']; ?>" alt>

                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>

                        <button disabled class="btn btn-primary" type="button">Upload new image</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">

                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form>
                            <?php foreach ($data as $key => $value) {?>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will
                                    appear to
                                    other users on the site)</label>
                                <input class="form-control" id="inputUsername" type="text"
                                    placeholder="Enter your username" value="<?php echo $value['name']; ?>">
                            </div>

                            <div class="row gx-3 mb-3">

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputOrgName">Email</label>
                                    <input class="form-control" id="inputOrgName" type="text"
                                        placeholder="Enter your organization name" value="<?php echo $value['email']; ?>">
                                </div>

                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLocation">Data When Created at</label>
                                    <input dir="auto" class="form-control" id="inputLocation" type="text"
                                        placeholder="Enter your location" value="<?php echo $value['created_at']; ?>">
                                </div>
                            </div>
                            <?php }?>
                            <button disabled class="btn btn-primary" type="button">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'modalLogout.php';
require_once './footerStyles.php';
?>
