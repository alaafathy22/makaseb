<?php
 session_start();
 if($_SESSION["logged"]!=1){
     header('Location: ../index.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
    <?php
    
    $whattodelete=$_POST["idofarticle"];
    
    if( $_POST["sub"]=="Delete") {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=makaseb", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM article WHERE id='".$whattodelete."'";
            $result=$conn->exec($sql);
            echo "this is the result".$result;
        }catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
            $conn = null;
        header('Location: articles.php');
    }else{

        $idofarticle=$_POST["idofarticle"];
        $titleofarticle=$_POST["titleofarticle"];
        $imagepic=$_POST["imagepic"];
        $textofarticle=$_POST["textofarticle"];
        $categorieofarticle=$_POST["categorieofarticle"];
        $authorofarticle=$_POST["authorofarticle"];
        echo "
        <div class='d-flex'>
        <div style='width:50%'>
        <div style='text-align:center'>Old</div>
        <form class='mx-3' >
            <label for='' class='mb-2' >title</label>
            <input type='text'  class='form-control mb-2 ' value='".$titleofarticle."'   readonly/>
            
            <label for='' class='mb-2'>text</label>
            <textarea type='text'  class='form-control mb-2'style='height:150px;' value='' readonly>".$textofarticle."</textarea> 

            <label for='' class='mb-2' >categorie</label>
            <input type='text'  class='form-control mb-2 ' value='".$categorieofarticle."'   readonly/>

            <label for='' class='mb-2' >author</label>
            <input type='text'  class='form-control mb-2 ' value='".$authorofarticle."'   readonly/>

            <label for='' class='mb-2' >Image</label>
            <div>
            <img src='../images/".$imagepic."' style='width:150px; height:150px;' />
            </div>
            
        </form>
        </div>
        <div style='width:50%'>
                <div style='text-align:center'>New</div>
                <form class='mx-3' method='POST' enctype='multipart/form-data'>
                    <input type='text'  class='form-control mb-2 ' value='".$idofarticle."' name='thenewid'  hidden/>
                    <label for='' class='mb-2' >title</label>
                    <input type='text'  class='form-control mb-2 ' name='thenewtitle'/>
                    
                    <label for='' class='mb-2'>text</label>
                    <textarea type='text'  class='form-control mb-2'style='height:150px;' name='thenewtext'></textarea>

                    <label for='' class='mb-2' >categorie</label>

                    <select  class='form-control mb-2 ' name='thenewcategorie'/>";
                    
                    
                    try {
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $conn = new PDO("mysql:host=$servername;dbname=makaseb", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        echo "Connected successfully";
                        $sql = "SELECT 	id,name FROM categorie";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {

                            $id_categorie=$v;
                            echo "<option value='".$v["id"]."'>".$v["name"]."</option>";
                        }
                    }catch(PDOException $e) {
                        echo "2nd catch Connection failed: " . $e->getMessage();
                    }
        echo        "</select>
                    <label for='' class='mb-2' >author</label>
                    <select  class='form-control mb-2 ' name='thenewauthor'/>";
                    try {
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $conn = new PDO("mysql:host=$servername;dbname=makaseb", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        echo "Connected successfully";
                        $sql = "SELECT 	id,name FROM users";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {

                            $id_categorie=$v;
                        }
                        echo "<option value='".$_SESSION["idauthor"]."'>".$_SESSION["login"]."</option>";
                    }catch(PDOException $e) {
                        echo "2nd catch Connection failed: " . $e->getMessage();
                    }
        echo        "</select>
                    <label for='' class='mb-2 d-block' >Image</label>
                    <input type='file' name='thenewimage'class='mb-2 d-block' />
                    <input type='submit' name='submit' class='btn btn-primary mt-3' value='Submit'/>
                    
                    
                </form>
            </div>
        </div>";
    }
    if(isset($_POST["submit"])){
        try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $thenewid=$_POST["thenewid"];
            $thenewtitle=$_POST["thenewtitle"];
            $thenewtext=htmlentities($_POST["thenewtext"],ENT_QUOTES);
            $thenewcategorie=$_POST["thenewcategorie"];
            $thenewauthor=$_POST["thenewauthor"];
            $filepath="../images/".$_FILES["thenewimage"]["name"];
            $filename=$_FILES["thenewimage"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], $filepath);
            $conn = new PDO("mysql:host=$servername;dbname=makaseb", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            $sql = "UPDATE article SET title='".$thenewtitle."', text ='".$thenewtext."',image='".$filename."',id_categorie='".$thenewcategorie."',idUser='".$thenewauthor."' WHERE id='".$thenewid."'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {

                $id_categorie=$v;
                echo "<option value='".$v["id"]."'>".$v["name"]."</option>";
            }
        }catch(PDOException $e) {
            echo "2nd catch Connection failed: " . $e->getMessage();
        }
        header('Location: articles.php');
    }
    ?>
</body>
</html>