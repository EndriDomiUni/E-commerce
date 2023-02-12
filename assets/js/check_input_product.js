

var categoryCheckBoxes = document.querySelectorAll('input[type="checkbox"]');
var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
if (!checkedOne) {
    alert ("please check a checkbox")
}