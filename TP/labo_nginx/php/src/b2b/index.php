<html>
    <head>
        <meta charset = "UTF-8">
        <title>WoodyToys revendeurs</title>
    </head>
    <body style="font-family: Calibri">
        <h1> WoodyToys b2b</h1>
        <br/>
        <a style="margin-left:25px;" href="https://woodytoys.l1-9.ephec-ti.be">Site vitrine</a><a style="margin-left:25px;" href="https://erp.l1-9.ephec-ti.be">Intranet</a>
        </br>
        <div>
            <h3>Mettre un article en vente</h3>
            <form method="POST">
                <label for="article">Article: </label>
                <input type="text" name="name" placeholder="nom de l'article">
                <label for="brand">Brand: </label>
                <input type="text" name="brand" placeholder="Nom de la marque">
                <label for="prix">Prix: </label>
                <input type="number" step="0.01" name="price" placeholder="en euro">
                <input type="submit" name="submit" value="Mettre en vente">
            </form>

        </div>
        <div>
            <h3>Articles en vente</h3>
            <table>
                <thead>
                    <th> ID </th>
                    <th> Nom </th>
                    <th> Marque </th>
                    <th> Prix </th>
                </thead>
                <?php
                define("DB_HOST", "mariadb");
                define("DB_USERNAME", "admin_woodytoys");
                define("DB_PASSWORD", "password123");
                define("DB_NAME", "woodytoys");
                $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
                
                if ($conn->connect_error){
                    echo "An Error occured with the database, please contact the system administrator.";
                    
                }
                        
                $id = 0;

                $stmt = "SELECT * FROM articles";
                $result = $conn->query($stmt);

                if ($result->num_rows > 0) {
                    printf('<tbody>');
                    while($row = $result->fetch_assoc()) {
                        $id++;  
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%.2f</td></tr>", 
                            $row["id"], 
                            $row["name"], 
                            $row["brand"],
                            $row["price"]);
                    }
                    printf('</tbody>');
                } else {
                    printf('No record found.<br />');
                }

                if (isset($_POST['submit'])){
                    $id++;  
                    $new_article_id = $id;
                    $article = $_POST["name"];
                    $prix = $_POST["price"];
                    $brand = $_POST["brand"];

                    $insert = $conn->prepare("INSERT INTO articles VALUES (?, ?, ?, ?)");
                    $insert->bind_param("issd", $new_article_id, $article, $prix, $brand);
                    $insert->execute();
                    $insert->close();
                    echo "<meta http-equiv='refresh' content='0'>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </body>
</html>
