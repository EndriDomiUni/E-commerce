

// navbar
const navbar = document.getElementById("navbar-main"); // navbar
const navIconItem = document.querySelectorAll(".nav-icon-item");
const navItemCaption = document.querySelectorAll("p"); // caption of nav link : TO CHANGE

// dark mode toogle
const btnDarkMode = document.getElementById("btn-dark-mode"); // btn dark mode

// footer
const footer = document.getElementsByTagName("footer");
const navFooterLink = document.querySelectorAll(".nav-footer-link");
const footerHr = document.querySelectorAll("hr-footer");


// enable, disable dark mode
function checkForDarkMode(event)
{
    console.log("darkmode called");
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

        footer.setAttribute("class", "bg-dark pt-5 footer-section");

        footerHr.forEach((hr) =>
        {
            hr.setAttribute("class", "text-light mb-2 mb-md-4 hr-footer");
        });
    } else
    {
        navbar.setAttribute("class", "navbar navbar-expand-lg bg-light");

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

        footer.setAttribute("class", "bg-light pt-5 footer-section");

        footerHr.forEach((hr) =>
        {
            hr.setAttribute("class", "text-dark mb-2 mb-md-4 hr-footer");
        });
    }
}


