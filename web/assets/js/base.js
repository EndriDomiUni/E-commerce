
// check if btn dark mode is pressed or not
let btnDarkModeStatus = false;

document.addEventListener("DOMContentLoaded", (event) => {

    // navbar dark mode
    const btnDarkMode = document.querySelector("#btn-dark-mode");
    btnDarkMode.addEventListener("click", () => {

        const navbar = document.querySelector("#navbar-main");
        const navIconItem = document.querySelectorAll(".nav-icon-item");
        //const navItemCaption = document.querySelectorAll(".nav-caption-item");
        const navItemCaption = document.querySelectorAll("p");

        
        // DARK
        if (btnDarkModeStatus === false) {
            navbar.setAttribute("class", "navbar navbar-expand-lg bg-dark");

            // icon svg right
            navIconItem.forEach((icon) => {
                icon.setAttribute("fill", "#fff");
            });

            // caption right
            navItemCaption.forEach((caption) => {
                caption.setAttribute("class", "nav-caption-item dark-mode");
            });

            btnDarkModeStatus = true;
        
        // Light
        } else if (btnDarkModeStatus === true) {
            navbar.setAttribute("class", "navbar navbar-expand-lg bg-light");

            // icon svg light
            navIconItem.forEach((icon) => {
                icon.setAttribute("fill", "#000");
            });

            // caption right
            navItemCaption.forEach((caption) => {
                caption.setAttribute("class", "nav-caption-item");
            });

            btnDarkModeStatus = false;
        }
    });
});
