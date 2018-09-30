<?php
    /* @var $this \PulpFiction\Controller\HomeController */
?>

<head>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="main-header">
        <h1>The streets seeks you!</h1>
    </div>
    <div class="main-header-image">
        <?php
            $this->render('image/main-image-header');
        ?>
    </div> <br/>
    <div class="form-user-security-login">
        <form action="/security/login" method="POST">
            <div class="content-security-login">
                <div class="username-login-security col-xs-6">
                    <label for="username">Потребител: </label>
                    <input type="text" name="username" id="username" autocomplete="off">
                </div>

                <div class="password-login-security col-xs-6">
                    <label for="password">Парола: </label>
                    <input type="password" name="password" id="password" autocomplete="off">
                </div>
            </div>
            <div class="button-login">
                <input type="submit" name="login-button" id="login-button" value="Вход">
            </div>
            <div class="button-register">
                <a href="/security/register">РЕГИСТРАЦИЯ</a>
            </div>
        </form>
    </div>
</body>

<?php
var_dump(\PulpFiction\core\PulpFiction::$app->getEventHandler());