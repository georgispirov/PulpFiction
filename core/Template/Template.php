<?php

namespace PulpFiction\core\Template;

class Template implements TemplateInterface
{
    /**
     * @var array $properties
     */
    private $properties;

    /**
     * @var string
     */
    private $viewFilesPath;

    /**
     * Invoked method after cloning the object and removes all applied properties to the class.
     */
    public function __clone()
    {
        $this->properties = [];
    }

    public function __construct()
    {
        $this->setViewFilesPath();
    }

    /**
     * @param string $view
     * @param array $data
     * @return TemplateInterface
     */
    public function render(string $view,
                           array $data = []): TemplateInterface
    {
        if (isset($this->properties)) {
            extract($this->properties);
        }

        ob_start();
        require_once $this->getViewFilesPath() . $view . '.php';
        $contentData = ob_get_contents();
        ob_get_clean();
        echo $contentData;
        return $this;
    }

    public function setViewFilesPath()
    {
        $this->viewFilesPath =  '../view' . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    public function getViewFilesPath(): string
    {
        return $this->viewFilesPath;
    }
}