$(document).ready(function () {
    
});

function copyToClipboard(elemento) {
    var $temp = $("<input>")
    $("body").append($temp);
    $temp.val($(elemento).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

