console.log("sidebar called");
let sidebar = document.getElementById("sidebar");
sidebar.innerHTML += '<div class="sidebar">\n' +
    '            <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">\n' +
    '                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">\n' +
    '                    <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>\n' +
    '                    <span class="fs-4">Take it</span>\n' +
    '                </a>\n' +
    '                <hr>\n' +
    '                <ul class="nav nav-pills flex-column mb-auto">\n' +
    '                    <li>\n' +
    '                        <a href="./productInsertion.php" class="nav-link link-white active showContent" >\n' +
    '                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>\n' +
    '                            Inserisci prodotto\n' +
    '                        </a>\n' +
    '                    </li>\n' +
    '                    <li>\n' +
    '                        <a href="./editProduct.php" class="nav-link link-dark showContent">\n' +
    '                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>\n' +
    '                            Modifica prodotto\n' +
    '                        </a>\n' +
    '                    </li>\n' +
    '                    <li>\n' +
    '                        <a href="#" class="nav-link link-dark showContent">\n' +
    '                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>\n' +
    '                            Elimina prodotto\n' +
    '                        </a>\n' +
    '                    </li>\n' +
    '                    <li>\n' +
    '                        <a href="#" class="nav-link link-dark showContent">\n' +
    '                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>\n' +
    '                            Magazzino\n' +
    '                        </a>\n' +
    '                    </li>\n' +
    '                    <li>\n' +
    '                        <a href="#" class="nav-link link-dark showContent">\n' +
    '                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>\n' +
    '                            Articoli in Magazzino\n' +
    '                        </a>\n' +
    '                    </li>\n' +
    '                    <li>\n' +
    '                        <a href="#" class="nav-link link-dark showContent">\n' +
    '                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>\n' +
    '                            Finanze\n' +
    '                        </a>\n' +
    '                    </li>\n' +
    '                </ul>\n' +
    '                <hr>\n' +
    '                 </div>\n' +
    '            </div>';
