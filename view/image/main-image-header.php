<?php

use PulpFiction\core\PulpFiction;
?>

<head>
    <link rel="stylesheet" href="/css/style.css">
</head>

<?php
$imageFile = PulpFiction::$app->callAction('image', 'getImage', ['imageFile' => 'main-image']);

echo '<img src="data:image/jpg;base64,'. $imageFile . '" class="img-responsive main-header-image-content">';
