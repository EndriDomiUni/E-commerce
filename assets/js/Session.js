
function notifyAlert(msg, attribute){
    let alert = document.createElement("div");
    alert.innerHTML = '<div class="alert alert-' + attribute + '" role="alert">' + msg + '</div>';
}