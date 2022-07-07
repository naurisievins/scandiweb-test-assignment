<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/JS/card.js"></script>
    <title>Scandiweb test</title>
</head>

<body>
    <header>
        <table>
            <tr>
                <td><h1>Product List</h1></td>
                <td class="fright"><input name="massdelete" id="delete-product-btn" type="submit" form="container" value="MASS DELETE"></td>
                <td class="fright"><input name="add" id="add-product-btn" type="submit" value="ADD" onclick="location.href='/add-product'"></td>
            </tr>
        </table>
        <hr>
    </header>
    
    <main>
        <form id="container" method="post" action=""></form>
        <?php
            require 'config.php';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['massdelete'])){
                    if(!empty($_POST['checkbox'])){
                        foreach($_POST['checkbox'] as $pid){
                            $id = ltrim($pid,"p");
                            //echo "DELETE FROM products WHERE pID=$id" ."<br>";
                            $sql = "DELETE FROM products WHERE pID=$id";
                            if ($conn->query($sql) === TRUE) {
                                header('Location: /');
                                //exit();
                                //echo "deleted!!";
                            } else {
                                echo "Error deleting data: " . $conn->error;
                            }
                        }
                        $conn->close();
                    }
                }
            }
        ?>
    </main>
    <footer>
        <hr>
        <span>Scandiweb Test assignment</span>
    </footer>

    <noscript>JavaScript is not supported by your browser!</noscript>
</body>
</html>