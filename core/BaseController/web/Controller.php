<?php

namespace PulpFiction\core\BaseController\web;

use PulpFiction\core\BaseController;
use PulpFiction\core\HttpHandler\HttpInterface;
use PulpFiction\core\HttpHandler\Request;
use PulpFiction\core\PulpFiction;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\core\Session\SessionInterface;
use PulpFiction\core\Template\TemplateInterface;

class Controller extends BaseController implements BaseWebControllerInterface
{
    /**
     * @var TemplateInterface $template
     */
    private $template;

    /**
     * @var HttpInterface $request
     */
    private $request;

    /**
     * @var ResponseInterface $response
     */
    private $response;

    /**
     * @var SessionInterface $session
     */
    private $session;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->template = PulpFiction::$app->getTemplate();
        $this->request  = PulpFiction::$app->getRequest();
        $this->response = PulpFiction::$app->getResponse();
        $this->session  = PulpFiction::$app->getSession();
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }

    /**
     * @return HttpInterface
     */
    public function getRequest(): HttpInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    protected function findModel(string $modelClass): Model
    {
        $fullName = '\\PulpFiction\\model\\' . $modelClass;
        if (class_exists($fullName)) {
            return new $fullName();
        }
        return null;
    }

    protected function inPost(string $keys, array $post): bool
    {
        if (strpos('|', $keys) === false) {
            $this->oneKeyInPost($keys, $post);
        }

        $exploded = explode('|', $keys);
        if (is_array($exploded) && is_array($post)) {
            foreach ($exploded as $key) {
                if (array_key_exists($key, $post)) {
                    return true;
                }
                return false;
            }
        }
        return false;
    }

    private function oneKeyInPost(string $key, array $post) : bool
    {
        if (array_key_exists($key, $post)) {
            return true;
        }
        return false;
    }

    protected function getPostDataFromForm(string $postData)
    {
        $data = [];
        if (is_string($postData) && $postData !== null) {
            $exploded = explode('&', $postData);
            foreach ($exploded as $post) {
                $name  = substr($post, 0, strpos($post, '='));
                $value = substr($post, strpos($post, '=') + 1);
                $data[$name] = $value;
            }
            return $data;
        }
        return [];
    }

    public function redirect(string $route)
    {
        $request = new Request();
        $request->set("Location: ", "../$route");
        if ($_SERVER['REQUEST_URI'] == $route) {
            return true;
        }
        return false;
    }

    /**
     * @param string $view
     * @param array $data
     * @return mixed
     */
    public function render(string $view, array $data = [])
    {
        return $this->getTemplate()->render($view, $data);
    }

    /**
     * @return mixed
     */
    public function attachServiceComponent()
    {
        // TODO: Implement attachServiceComponent() method.
    }
}