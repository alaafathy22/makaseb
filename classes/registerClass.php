<?php
include 'loginClass.php';
require_once 'hijri.class.php';
class registerPage extends loginPage
{
    public function insertInDataBase()
    {
        $dataHijriNow = new hijri\datetime();
        try {
            if (isset($_POST['submit'])) {
                $passwordAfterConvert = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $filepath = './images/' . $_FILES['imageUser']['name'];
                $filename = $_FILES['imageUser']['name'];
                move_uploaded_file($_FILES['imageUser']['tmp_name'], $filepath);
                $sql = "INSERT INTO users (name, password,email,profile_pic,created_at) VALUES ('" . $_POST['nameUser'] . "', '" . $passwordAfterConvert . "', '" . $_POST['emailUser'] . "', '" . $filename . "','" . $dataHijriNow . "' )";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $this->actionLoginPage($_POST['emailUser'], $_POST['password']);
            }
        } catch (PDOException $e) {
            $messageErrorLogin = $e->getMessage();
            header('Location: ' . $_SERVER['PHP_SELF'] . '?messageErrorLogin=' . $messageErrorLogin);
        }
    }
}
?>
