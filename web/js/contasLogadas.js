function contasLogadas(delay) {
   setTimeout(function() {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.getElementById("contasLogadas").innerHTML = this.responseText;
            };
        xmlhttp.open("GET", "modules/search/contasLogadas.php", true);
        xmlhttp.send();
        const delay = 10000;
        contasLogadas(delay);
    }, delay);
}
contasLogadas(1000);