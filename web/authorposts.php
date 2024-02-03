<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Front page</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="menu">
                            <ul style="float:left">
                                <li class=""><a href="index.php">Home</a></li>
                                <?php 

                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";

                                try {
                                        $conn = new PDO("mysql:host=$servername;dbname=makaseb", $username, $password);
                                        // set the PDO error mode to exception
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                        
                                        
                                        $sql = "SELECT * FROM categorie";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
                                ?>
                                    <li class=""><a href="categorie.php?idcategorie=<?php echo $v['id']; ?>&categoriename=<?php echo $v['name']; ?>"><?php echo $v['name']; ?></a></li>     
                                <?php        }
                                    }catch(PDOException $e) {
                                    echo "Connection failed: " . $e->getMessage();
                                    }
                                ?>
                                
                                
                            </ul>
                            
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="logo" style="float:right">
                            <h2><a href="#">Classic</a></h2>
                        </div>
                    </div>
                </div>
                <hr style="height:5px; background-color:rgb(241,241,241);">
            </div>
            
        </header>
        <section class="blog-post-area">
            <div class="container">
                <div class="row">
                    
                    <div class="blog-post-area-style">
                        <h3>All the posts by <?php echo $_GET['nomusers']; ?></h1>
                <?php 
                     function get_words($sentence, $count) {
                                    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
                                    return $matches[0];
                                }                 
                    $nomusers=$_GET['nomusers'];                   
                    $servername = "localhost";
                    $username = "root";
                    $password = "";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=makaseb", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        
                        $sql = "SELECT 	* FROM users WHERE name='".$nomusers."'";
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        $idautheur="";
                        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$pp) {
                            $idautheur=$pp['id'];
                            
                        }
                        $sql2 = "SELECT * FROM article WHERE idUser='".$idautheur."'";
                        $stmt = $conn->prepare($sql2);
                        $stmt->execute();
                        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                ?>
                <?php
                        foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
                ?>
                            <div class='col-md-3'>
                                <div class='single-post' >
                                    <?php echo "<a href='posts.php?idarticle=".$v['id']."&nomusers=".$nomusers."'>"; ?>
                                        <img  style="width:100%; background-image:url('../images/<?php echo $v['image']; ?>'); height:150px; background-position:center; background-size:cover;" alt=''/>
                                    </a>
                                    <h3><a href="<?php echo "posts.php?idarticle=".$v['id']."&nomusers=".$nomusers."";?>" ><?php echo $v['title']; ?></a></h3>
                                    <h4><span>Posted By: <span class='author-name'><?php echo $nomusers; ?></span></span></h4>
                                    <p style="text-align: justify;"><?php echo get_words($v['text'],10); ?> ...</p>
                                </div>
                            </div>  

                <?php   }
                    }catch(PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }

                ?>
                        

                    </div>
                </div>
            </div>
        </section>
        <footer class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="footer-bg">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="footer-menu">
                                                <ul>
                                                    <li class="active"><a href="index.php">Home</a></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="footer-icon">
                                                <p><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></p>
                                            </div>
                                        </div>
                                    </div> .
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <script src="js/jquery-3.1.1.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/active.js"></script>
</body>

</html>