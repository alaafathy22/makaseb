<?php
include 'classes/mainClass.php';
class loginPage extends mainClass
{
    function actionLoginPage($email, $password)
    {
        if (isset($_POST['submit'])) {
            $sql = "SELECT 	* FROM users WHERE 	email='" . $email . "'";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            if ($result) {
                if ($this->checkPasswordBeforeSetSession($result, $password)) {
                    $this->setSession($result);
                }
            } else {
                $messageErrorLogin = 'Error . Please review the information';
                header('Location: index.php?messageErrorLogin=' . $messageErrorLogin);
            }
        }
    }
    public function checkPasswordBeforeSetSession($result, $password): bool
    {
        foreach ($result as $key => $value) {
            $verify = password_verify($password, $value['password']);
            if ($verify) {
                return true;
            } else {
                $messageErrorLogin = 'Error . Please review the information';
                header('Location: index.php?messageErrorLogin=' . $messageErrorLogin);
            }
        }
    }
}
?>
