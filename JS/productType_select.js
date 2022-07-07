    var product = document.getElementById("productType");
    product.addEventListener("change", function() {
        let type = product.value;
        if (type === "dvd") {
            document.getElementById("sizein").style.display = "block";
            document.getElementById("weightin").style.display = "none";
            document.getElementById("dimensionsin").style.display = "none";
        }
        else if (type === "book") {
            document.getElementById("sizein").style.display = "none";
            document.getElementById("weightin").style.display = "block";
            document.getElementById("dimensionsin").style.display = "none";
        }
        else {
            document.getElementById("sizein").style.display = "none";
            document.getElementById("weightin").style.display = "none";
            document.getElementById("dimensionsin").style.display = "block";
        }
    });