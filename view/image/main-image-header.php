<?php

use PulpFiction\core\PulpFiction;

$imageFile = PulpFiction::$app->callAction('image', 'getImage', ['imageFile' => 'main-image']);

echo '<img src="data:image/jpg;base64,'. $imageFile . '" width="700" 
                                                                         height="700" 
                                                                         class="img-responsive not-found-image">';
