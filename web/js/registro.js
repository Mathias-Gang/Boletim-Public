function registro(delay) {
   setTimeout(function() {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            if (document.getElementById("registro").innerHTML != this.responseText) {
                document.getElementById("registro").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "modules/search/registro.php", true);
        xmlhttp.send();
        const delay = 2000;
        registro(delay);
    }, delay);
}
registro(0);