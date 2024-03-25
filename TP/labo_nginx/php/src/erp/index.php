<?php
    define("DB_HOST", "mariadb");
    define("DB_USERNAME", "admin");
    define("DB_PASSWORD", "admin123");
    define("DB_NAME", "woodytoys");
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $err = FALSE;
    if ($conn->connect_error){
        echo "An Error occured with the database, please contact the system administrator.";
        
    }
            
    if (isset($_POST['submit'])){
        $login = $_POST["login"];
        $password = $_POST["password"];

        $access = $conn->prepare("SELECT uuid, password FROM res_users WHERE login = ?");
        $access->bind_param("s",  $login);
        $access->execute();
        $result = $access->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row["password"])){
                header("Location: home.php?uuid=".$row["uuid"]);
                exit();
            } else {
                $err = TRUE;
            }
        } else {
            $err = TRUE;
        }
        $result->close();
        $access->close();

    }
    $conn->close();
?>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Erp</title>
    </head>
    <body style="font-family: Calibri">
        <h1> WoodyToys Intranet</h1>
        <br/>
        <a style="margin-left:25px;" href="http://woodytoys.l1-9.ephec-ti.be">Site vitrine</a><a style="margin-left:25px;" href="http://b2b.l1-9.ephec-ti.be">Site vendeur</a>
        </br><br/><br/>
        <div id="login_container">
            <form method="POST">
                <label for="login">Identifiants </label>
                <input type="text" name="login" placeholder="Email..">
                <label for="password">Mot de passe </label>
                <input type="password" name="password" placeholder="Mot de passe..">
                <input type="submit" name="submit" value="Connection">
            </form>
        </div>
        <br/>
        <div>
            <?php
                if($err==TRUE){
                    printf("Mot de passe ou login incorrect. <br/> Veuillez contacter l'administrateur système si vous avez perdu votre mot de passe.<br/>");
                }
            ?>
        </div>
    </body>
</html>
