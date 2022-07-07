<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="JS/validate.js"></script>
    <title>Scandiweb test</title>
</head>

<body>

<?php
require 'config.php';

function validate($data) {
    $data = trim($data);
    if ($data != "") {
        $data = htmlspecialchars($data);
        return $data;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['save'])){
        $sku = $_POST['sku'];
        $name = $_POST['name'];
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);
        $productType = $_POST['productType'];
        $size = filter_input(INPUT_POST, "size", FILTER_VALIDATE_FLOAT);
        $weight = filter_input(INPUT_POST, "weight", FILTER_VALIDATE_FLOAT);
        $height = filter_input(INPUT_POST, "height", FILTER_VALIDATE_FLOAT);
        $width = filter_input(INPUT_POST, "width", FILTER_VALIDATE_FLOAT);
        $length = filter_input(INPUT_POST, "length", FILTER_VALIDATE_FLOAT);
        $skuerror = "";

        //$skuErr = $nameErr = $priceErr = $sizeErr = $weightErr = $dimErr = "";
      
        $sql = "SELECT pSKU FROM products WHERE pSKU = '$sku'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $skuerror = "Given SKU already exists!";
        } else {
            if ($sku == "" or strlen($sku)>50){
                //$skuErr = "SKU Error!";
                $sku = null;
            } else {
                $sku = validate($_POST['sku']);
            }
            if ($name == "" or strlen($name)>50){
                //$nameErr = "Name Error!";
                $name = null;
            } else {
                $name = validate($_POST['name']);
            }
            if (empty($price) or strlen($price)>10 or $price<=0){
                //$priceErr = "Price Error!";
                $price = null;
            } else {
                $price = validate($_POST['price']);
            }
            if ($productType === "dvd") {
                if (empty($size) or strlen($size)>10 or $size<=0){
                    //$sizeErr = "Size Error!";
                    $size = null;
                } else {
                    $size = validate($_POST['size']);
                }
            } else if ($productType === "book") {
                if (empty($weight) or strlen($weight)>10 or $weight<=0){
                    //$weightErr = "Weight Error!";
                    $weight = null;
                } else {
                    $weight = validate($_POST['weight']);
                }
            } else {
                if (empty($height) or strlen($height)>10 or $height<=0 or empty($width) or strlen($width)>10 or $width<=0 or empty($length) or strlen($length)>10 or $length<=0){
                //$dimErr = "Dimension Error!";
                $height = null;
                $width = null;
                $length = null;
                } else {
                    $height = validate($_POST['height']);
                    $width = validate($_POST['width']);
                    $length = validate($_POST['length']);
                }
            }

            //echo $skuErr . $nameErr . $priceErr . $sizeErr . $weightErr . $dimErr;

            if ($productType === "dvd" && $size != null && $sku != null && $name != null && $price != null) {   
                $stmt = $conn->prepare("INSERT INTO products (pSKU, pName, pPrice, pType, pSize) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $sku, $name, $price, $productType, $size);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header("Location: /");

            } else if ($productType === "book" && $weight != null && $sku != null && $name != null && $price != null) {
                $stmt = $conn->prepare("INSERT INTO products (pSKU, pName, pPrice, pType, pWeight) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $sku, $name, $price, $productType, $weight);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header("Location: /");
                
            } else if ($productType === "furn" && $height != null && $width != null && $length != null && $sku != null && $name != null && $price != null) {
                $stmt = $conn->prepare("INSERT INTO products (pSKU, pName, pPrice, pType, pDimH, pDimW, pDimL) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $sku, $name, $price, $productType, $height, $width, $length);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header("Location: /");
            }
        }
    }
}
?>

<header>
    <table>
        <tr>
            <td><h1>Product Add</h1></td>
            <td class="fright"><input name="cancel" id="cancel-btn" type="submit" value="Cancel" onclick="location.href='/'"></td>
            <td class="fright"><input name="save" id="save-product-btn" type="submit" value="Save" onclick="validate()"></td> <!-- form="product_form" is added if validated -->

        </tr>
    </table>
        <hr>
</header>
<main>
    <form id="product_form" method="post" action="/add-product">
        <table class="addProductTable">
            <tr>
                <td class="namecol"><label for="sku">SKU</label></td>
                <td><input type="text" id="sku" class="rightcol" name="sku" maxlength="50" size="50%"></td>
            </tr>
            <tr>
                <td class="namecol"><label for="name">Name</label></td>
                <td><input type="text" id="name" class="rightcol" name="name" maxlength="50" size="50%"></td>
            </tr>
            <tr>
                <td class="namecol"><label for="price">Price ($)</label></td>
                <td><input type="text" id="price" class="rightcol" name="price" maxlength="10" size="10%" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
            </tr>
            <tr>
                <td class="namecol"><label for="productType">Type switcher</label></td>
                <td>
                    <select id="productType" class="rightcol" name="productType">
                        <optgroup label = "Select type">
                        <option value="dvd" id="DVD">DVD</option>
                        <option value="book" id="Book">Book</option>
                        <option value="furn" id="Furniture">Furniture</option>
                    </select>
                </td>
            </tr>

            <table id="sizein">
                <tr>
                    <td colspan="2">Please, provide size!</td>
                </tr>
                <tr>
                    <td class="namecol"><label for="size">Size (MB)</label></td>
                    <td><input type="text" id="size" class="rightcol" name="size" maxlength="10" size="10%" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                </tr>
            </table>

            <table id="weightin">
                <tr>
                    <td colspan="2">Please, provide weight!</td>
                </tr>
                <tr>
                    <td class="namecol"><label for="weight">Weight (KG)</label></td>
                    <td><input type="text" id="weight" class="rightcol" name="weight" maxlength="10" size="10%" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br></td>
                </tr>
            </table>

            <table id="dimensionsin">
                <tr>
                    <td colspan="2">Please, provide dimensions (H x W x L)!</td>
                </tr>
                <tr>
                    <td class="namecol"><label for="height">Height (CM)</label></td>
                    <td><input type="text" id="height" class="rightcol" name="height" maxlength="10" size="10%" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                </tr>
                <tr>
                    <td class="namecol"><label for="width">Width  (CM)</label></td>
                    <td><input type="text" id="width" class="rightcol" name="width" maxlength="10" size="10%" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                </tr>
                <tr>
                    <td class="namecol"><label for="length">Length  (CM)</label></td>
                    <td><input type="text" id="length" class="rightcol" name="length" maxlength="10" size="10%" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"></td>
                </tr>
            </table>
            <span id="msg"><?php echo $skuerror; ?></span>
        </table>
    </form>
</main>
<footer>
    <hr>
    <span>Scandiweb Test assignment</span>
</footer>

    <script src="/JS/productType_select.js"></script>
    <noscript>JavaScript is not supported by your browser!</noscript>
</body>
</html>