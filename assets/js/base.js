

// navbar
const navbar = document.getElementById("navbar-main"); // navbar
const navIconItem = document.querySelectorAll(".nav-icon-item");
const navItemCaption = document.querySelectorAll("p"); // caption of nav link : TO CHANGE

// dark mode toogle
const btnDarkMode = document.getElementById("btn-dark-mode"); // btn dark mode

// footer
const footer = document.getElementById("footer");
const navFooterLink = document.querySelectorAll(".nav-footer-link");
const footerHr = footer.querySelectorAll("hr-footer");

// main
const body = document.getElementsById("body");


// enable, disable dark mode
function checkForDarkMode(event)
{
    if (event.target.checked)
    {
        navbar.setAttribute("class", "navbar navbar-expand-lg");
        navbar.style.backgroundColor = "rgba(0, 0, 0, 0.8)";


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

        
        footer.setAttribute("class", "pt-5 footer-section");
        footer.style.backgroundColor = "rgba(0, 0, 0, 0.8)";

        footerHr.forEach((hr) =>
        {
            hr.setAttribute("class", "mb-2 mb-md-4 hr-footer");
            hr.style.color = "rgba(255, 255, 255, 0.7)";
        });

        body.backgroundColor = "rgba(0, 0, 0, 0.6)";
    } else
    {
        navbar.setAttribute("class", "navbar navbar-expand-lg");
        navbar.style.backgroundColor = "rgba(255, 255, 255, 0.8)";

        navIconItem.forEach((icon) =>
        { // icon svg light
            icon.setAttribute("fill", "currentColor");
        });

        navItemCaption.forEach((caption) =>
        { // caption right
            caption.setAttribute("class", "nav-caption-item");
        });


        navFooterLink.forEach((link) =>
        {
            link.setAttribute("class", "nav-footer-link");
        });

        footer.setAttribute("class", "pt-5 footer-section");
        footer.style.backgroundColor = "rgba(255, 255, 255, 0.8)";

        footerHr.forEach((hr) =>
        {
            hr.setAttribute("class", "mb-2 mb-md-4 hr-footer");
            hr.style.color = "rgba(0, 0, 0, 0.9)";
        });

        body.backgroundColor = "rgba(255, 255, 255, 0.8)"

    }
}

