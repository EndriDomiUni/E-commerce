// ottini il json da php
// se esiste $_SESS "id"

// richiama alert_src > suss ok (msg)
// richiama alert_src > fail ok (msg)
let currentUser = '<?php echo json_decode($_SESSION["CurrentUserJson"]); ?>';
let jsonData = new Array(currentUser);
// jsonData = JSON.parse(currentUser);
document.write(jsonData[0].something);

function notifyAlert(msg, attribute){
    let alert = document.createElement("div");
    alert.innerHTML = '<div class="alert alert-' + attribute + '" role="alert">' + msg + '</div>';
}