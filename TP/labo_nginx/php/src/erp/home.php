<?php
    define("DB_HOST", "mysql");
    define("DB_USERNAME", "admin");
    define("DB_PASSWORD", "admin123");
    define("DB_NAME", "woodytoys");
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if ($conn->connect_error){
        echo "An Error occured with the database, please contact the system administrator.";
        
    }
            
    if(isset($_GET["uuid"])){
        $log_access = $conn->prepare("SELECT uuid FROM res_users where uuid = ?");
        $log_access->bind_param("s",  $_GET["uuid"]);
        $log_access->execute();
        $log_result = $log_access->get_result();
        if($log_result->num_rows != 1){
            header("Location: index.php");
            exit();
        }
        $log_result->close();
        $log_access->close();
    } else {
        header("Location: index.php");
        exit();
    }
    if(isset($_POST["submit"])){
        header("Location: index.php");
        exit();
    }
?>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Erp</title>
    </head>
    <body style="font-family: Calibri">
        <h1> WoodyToys Intranet</h1>
        <br/>
        <a style="margin-left:25px;" href="https://woodytoys.l1-9.ephec-ti.be">Site vitrine</a><a style="margin-left:25px;" href="https://b2b.l1-9.ephec-ti.be">Site vendeur</a>
        </br><br/><br/>
        <?php
            if(isset($_GET["uuid"])) {
                $info_access = $conn->prepare("SELECT * FROM res_users where uuid = ?");
                $info_access->bind_param("s",  $_GET["uuid"]);
                $info_access->execute();
                $info_result = $info_access->get_result();
                if($info_result->num_rows == 1){
                    $row = $info_result->fetch_assoc();
                    printf("<div><span> Hello <b>%s %s</b></span><hr/><span>email : <b>%s</b></span><br/><span>Accès Comptabilité : <b>%d</b></span><br/><span>Accès Contacts : <b>%d</b></div>", 
                        $row["firstname"], 
                        $row["lastname"], 
                        $row["login"], 
                        $row["access_accounting"],
                        $row["access_contact"]
                    );
                $info_result->close();
                $info_access->close();
                } else {
                    printf('No user found. Please contact your administrator<br />');
                }
            }

            $conn->close()
        ?>
        <div id="login_container">
            <form method="POST">
                <input type="hidden" name="is_disconnect" id="is_disconnect" value="1">
                <input type="submit" name="submit" value="Déconnexion">
            </form>
        </div>
    </body>
</html>
