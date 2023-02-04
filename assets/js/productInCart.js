

function drawProductCardOnClick() {
    let productCardInCart = document.createElement("div");
    productCardInCart.innerHTML =
        "<div class=\"card\">\n" +
        "    <div class=\"card-body\">\n" +
        "        <h5 class=\"card-title\">Product Name</h5>\n" +
        "        <p class=\"card-text\">Product Description: </p>\n" +
        "        <p class=\"card-text\">Quantity: </p> <!-- da aggiungere due pulsanti -->\n" +
        "        <p class=\"card-text\">Price: </p>\n" +
        "    </div>\n" +
        "</div>";
}