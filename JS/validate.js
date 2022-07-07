function validate() {
    var sku = document.getElementById("sku").value;
    var name = document.getElementById("name").value;
    var price = document.getElementById("price").value;
    var type = document.getElementById("productType").value;
    var size = document.getElementById("size").value;
    var weight = document.getElementById("weight").value;
    var height = document.getElementById("height").value;
    var width = document.getElementById("width").value;
    var length = document.getElementById("length").value;
    let empty = "Please fill out all fields!";

    if (type === "dvd") {
        if (sku.trim() == "" || name.trim() == "" || price.trim() == "" || size.trim() == "") {
            document.getElementById("msg").innerHTML = empty;
        }
        else if (price == "0") {
            document.getElementById("msg").innerHTML = "Price value cannot be 0!";
        }
        else if (size == "0") {
            document.getElementById("msg").innerHTML = "Size value cannot be 0!";
        }
        else {
            document.getElementById("save-product-btn").setAttribute("form", "product_form");
            document.getElementById("save-product-btn").click;
        }
    }
    if (type === "book") {
        if (sku == "" || name == "" || price == "" || weight == "") {
            document.getElementById("msg").innerHTML = empty;
        }
        else if (price == "0") {
            document.getElementById("msg").innerHTML = "Price value cannot be 0!";
        }
        else if (weight == "0") {
            document.getElementById("msg").innerHTML = "Weight value cannot be 0!";
        }
        else {
            document.getElementById("save-product-btn").setAttribute("form", "product_form");
            document.getElementById("save-product-btn").click;
        }
    }
    if (type === "furn") {
        if (sku == "" || name == "" || price == "" || height == "" || width == "" || length == "") {
            document.getElementById("msg").innerHTML = empty;
        }
        else if (price == "0") {
            document.getElementById("msg").innerHTML = "Price value cannot be 0!";
        }
        else if (height == "0" || width == "0" || length == "0") {
            document.getElementById("msg").innerHTML = "Dimension values cannot be 0!";
        }
        else {
            document.getElementById("save-product-btn").setAttribute("form", "product_form");
            document.getElementById("save-product-btn").click;
        }
    }
}