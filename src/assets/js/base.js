// check if btn dark mode is pressed or not
let isDarkMode = false;
// check if btn dark mode is pressed or not
let isBtnToogleNavbarPressed = false;

// navbar dark mode
const navbar = document.getElementById("navbar-main"); // navbar
const navIconItem = document.querySelectorAll(".nav-icon-item");
const navItemCaption = document.querySelectorAll("p"); // caption of nav link : TO CHANGE
const btnDarkMode = document.getElementById("btn-dark-mode"); // btn dark mode
const footer = document.querySelector("footer"); // footer
const navFooterLink = document.querySelectorAll(".nav-footer-link");
// const btnToogleNavbar = document.querySelector("#tn-toogle-navbar"); // toogle btn


// Codice che va precompilato 
document.addEventListener("DOMContentLoaded", (event) =>
{
});


// enable, disable dark mode
function checkForDarkMode(event)
{
    if (event.target.checked)
    {
        navbar.setAttribute("class", "navbar navbar-expand-lg bg-dark");

        navIconItem.forEach((icon) =>
        {  // icon svg right
            icon.setAttribute("fill", "#fff");
        });

        navItemCaption.forEach((caption) =>
        {  // caption right
            caption.setAttribute("class", "nav-caption-item dark-mode");
        });

        navFooterLink.forEach((link) =>
        {
            link.setAttribute("class", "nav-footer-link dark-mode");
        });

        footer.setAttribute("class", "bg-dark pt-5");

        isDarkMode = false;
    } else
    {
        navbar.setAttribute("class", "navbar navbar-expand-lg bg-light");

        navIconItem.forEach((icon) =>
        { // icon svg light
            icon.setAttribute("fill", "#000");
        });

        navItemCaption.forEach((caption) =>
        { // caption right
            caption.setAttribute("class", "nav-caption-item");
        });

        navFooterLink.forEach((link) =>
        {
            link.setAttribute("class", "nav-footer-link");
        });

        footer.setAttribute("class", "bg-light pt-5");

        isDarkMode = true;
    }
}

// display "User" & "shop" correctly
function justifyRightMenuItem()
{
    if (isBtnToogleNavbarPressed)
    {
        btnToogleNavbar.remove("justify-content-between");
        isBtnToogleNavbarPressed = false;
    } else
    {
        btnToogleNavbar.addAttribute("class", "justify-content-between");
        isBtnToogleNavbarPressed = true;
    }
}