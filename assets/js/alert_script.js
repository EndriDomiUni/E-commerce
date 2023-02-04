
function showSuccessAlert(id, msg) {
    const element = document.getElementById(id);
    element.innerHTML = '<div className="alert alert-success" role="alert">';
    element.innerHtml = msg;
    element.innerHTML = '</div>';
}

function showDangerAlert(id, msg) {
    const element = document.getElementById(id);
    element.innerHTML = '<div className="alert alert-danger" role="alert">';
    element.innerHtml = msg;
    element.innerHTML = '</div>';
}