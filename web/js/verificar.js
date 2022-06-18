function verificar(vdelay) {
    setTimeout(function() {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "modules/auth/verificar.php");
        xmlhttp.send();
        const vdelay = 500000;
        verificar(vdelay);
    }, vdelay);
}
verificar(0);