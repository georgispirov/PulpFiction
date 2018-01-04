<?php

namespace PulpFiction\controller;

use HttpInvalidParamException;
use PulpFiction\core\BaseController\Controller;
use PulpFiction\core\PulpFiction;

class ImageController extends Controller
{
    /**
     * @param string $imageFile
     * @return string
     * @throws HttpInvalidParamException
     */
    public function getImage(string $imageFile)
    {
        $file = PulpFiction::$app->getImageSourceFolder() . DIRECTORY_SEPARATOR . $imageFile . '.jpg';
        if (file_exists($file)) {
            ob_clean();
            ob_start();
            readfile($file);
            $contentData = ob_get_contents();
            ob_get_clean();
            return base64_encode($contentData);
        }

        throw new HttpInvalidParamException('Image file does not exists.');
    }
}
