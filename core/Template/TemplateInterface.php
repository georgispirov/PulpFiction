<?php

namespace PulpFiction\core\Template;

interface TemplateInterface
{
    /**
     * @param string $view
     * @param array $data
     * @return TemplateInterface
     */
    public function render(string $view,
                           array $data = []): TemplateInterface;
    
    public function setViewFilesPath();

    /**
     * @return string
     */
    public function getViewFilesPath(): string;
}