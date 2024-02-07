<?php
include 'classes/registerClass.php';
$pageName = 'Register';
$connectedClass = new registerPage();
$connectedClass->connectionDataBase();
$connectedClass->insertInDataBase();
require_once 'headStyles.php';
?>
<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('./filesForStyle/register_Page/images/bg_1.jpg')"></div>
    <div class="contents order-2 order-md-1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <div class="mb-4">
                        <h3>Register</h3>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group first">
                            <label for="email">Name</label>
                            <input required type="text" name="nameUser" class="form-control" id="name">
                        </div>
                        <div class="form-group first">
                            <label for="email">Email</label>
                            <input required type="email" name="emailUser" class="form-control" id="email">
                        </div>
                        <div class="form-group first">
                            <input required type="file" name="imageUser" class="form-control" id="imageUser">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input required type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="d-flex mb-5 align-items-center">
                            <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Agree our <a
                                        href="#">Terms and Conditions</a></span>
                                <input type="checkbox" checked="checked" />
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                        <input type="submit" name="submit" value="Register" class="btn btn-block btn-primary">
                        <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>
                        <a style="color: white;line-height: 40px;text-decoration: none;" href="index.php"
                            class="btn btn-block btn-info">Login</a>
                        <?php
                        if (isset($_GET['messageErrorLogin'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_GET['messageErrorLogin'] . '</div>';
                        } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once 'footerStyles.php';
?>
