<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title>Redefinir senha - Boletim ISERJ</title>
        <link rel="icon" href="img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/redefinir.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <a class="iserj" href="https://www.iserj.edu.br/">
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 425.000000 425.000000" preserveAspectRatio="xMidYMid meet">
                <g class="iserj_icon" transform="translate(0.000000,425.000000) scale(0.100000,-0.100000)" fill="white" stroke="none">
                    <path d="M1982 4101 l-142 -149 0 -256 0 -256 -239 0 -239 0 -624 -655 c-343
                    -360 -623 -661 -623 -669 0 -7 281 -309 624 -670 l625 -656 238 0 238 0 0
                    -258 0 -257 138 -138 c75 -75 144 -137 152 -137 9 0 77 62 153 138 l137 137 0
                    258 0 257 238 0 237 0 238 249 c130 138 237 252 237 255 0 3 -214 6 -475 6
                    l-475 0 0 220 0 220 689 0 689 0 177 185 c97 101 175 189 173 194 -1 5 -79 91
                    -173 190 l-170 180 -692 0 -693 1 0 220 0 220 476 0 c284 0 474 4 472 9 -1 5
                    -108 120 -237 255 l-233 246 -239 0 -239 0 0 256 0 256 -142 147 c-77 80 -144
                    147 -147 149 -3 1 -70 -65 -149 -147z m-142 -1391 l0 -220 -125 0 -125 0 0
                    220 0 220 125 0 125 0 0 -220z m0 -1190 l0 -220 -125 0 -125 0 0 220 0 220
                    125 0 125 0 0 -220z"/>
                </g>
            </svg>
        </a>        
        <form class="login" method="post" action="modules/auth/requestRedefinicao.php">
            <div>
                <div class="barraCima"></div>
                <h1 style="color: white; font-size: 24px;">Redefinir senha no Boletim ISERJ</h1>
            </div>
            <div>
                <label style="font-weight: 700;" for="email_inst">Email</label>
                <input class="entrada" id="email_inst" type="text" name="email" autocomplete="off" required="required" placeholder="conta@gmail.com"/>
            </div>
            <div class="g-recaptcha" data-sitekey="6LfUsfMcAAAAAO8ROgp89AyGWD8OBTjtH9laS1zt" style="-webkit-transform: scale(0.994);-webkit-transform-origin:0 0;"></div>
            <div style="align-items: center;">
                <input class="submit" type="submit" value="Redefinir" disabled>
            </div>
            <a href="login">Login</a>
        </form>
    </body>
</html>