function getData() {
    $.get("http://nrnk.infinityfreeapp.com/data", function(data) {
        //console.log("result length: " +data.length);
        if (data.length > 0) {
            let result = JSON.parse(data);
            
            result.forEach((product) => {
                const container = document.getElementById("container");
                const card = document.createElement("div");
                card.setAttribute("class", "card");

                const checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                checkbox.setAttribute("class", "delete-checkbox");
                checkbox.setAttribute("value", "p" +product.pID);
                checkbox.setAttribute("name", "checkbox[]");
                
                const span = document.createElement("span");

                const sku = document.createElement("p");
                sku.textContent = product.pSKU;

                const name = document.createElement("p");
                name.textContent = product.pName;

                const price = document.createElement("p");
                price.textContent = product.pPrice +" $";

                const weight = document.createElement("p");
                weight.textContent = product.pWeight +" Kg";

                const size = document.createElement("p");
                size.textContent = product.pSize +" MB";

                const dimensions = document.createElement("p");
                dimensions.textContent= "Dimensions: " +product.pDimH +" x " +product.pDimW+ " x " +product.pdimL +" CM";

                //Create card
                container.appendChild(card);
                card.appendChild(span);
                span.appendChild(checkbox);
                card.appendChild(sku);
                card.appendChild(name);
                card.appendChild(price);
                if (product.pSize != null) {
                    card.appendChild(size);
                }
                else if (product.pWeight != null) {
                    card.appendChild(weight);
                }
                else {
                    card.appendChild(dimensions);
                }
            });
        }
    });
}
getData();