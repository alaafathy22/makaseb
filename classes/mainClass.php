<?php
include 'interfaceMain.php';
abstract class mainClass implements mainRood
{
    protected $conn;
    final function connectionDataBase()
    {
        $serverName = 'localhost';
        $userName = 'root';
        $passwordDataBase = '';
        try {
            $this->conn = new PDO("mysql:host=$serverName;dbname=makaseb", $userName, $passwordDataBase);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            header('Location: pageError.php?messageErrorConnect=' . $e->getMessage());
        }
    }

    final function setSession($result)
    {
        session_start();
        if ($result) {
            foreach (new RecursiveArrayIterator($result) as $key => $value) {
                $_SESSION['login'] = $value['email'];
                $_SESSION['image'] = $value['profile_pic'];
                $_SESSION['idUser'] = $value['id'];
                $_SESSION['logged'] = 1;
            }
            header('Location: dashboard.php');
        } else {
            $messageErrorLogin = 'Error . Please review the information';
            header('Location: index.php?messageErrorLogin=' . $messageErrorLogin);
        }
    }

    final function logOut()
    {
        if (isset($_POST['logout'])) {
            // remove all session variables
            session_unset();
            // destroy the session
            session_destroy();
            header('Location: index.php');
        }
    }
}
?>
