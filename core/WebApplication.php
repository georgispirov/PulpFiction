<?php

namespace PulpFiction\core;

use PulpFiction\core\App\Application;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\core\HttpHandler\HttpInterface;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\core\Session\SessionInterface;
use PulpFiction\core\Template\TemplateInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;

class WebApplication extends Application
{
    /**
     * @var ResponseInterface $response
     */

    private $response;

    /**
     * @var TemplateInterface $template
     */
    private $template;

    /**
     * @var HttpInterface $request
     */
    private $request;

    /**
     * @var SessionInterface $session
     */
    private $session;

    /**
     * WebApplication constructor.
     * @param DatabaseInterface $database
     * @param DispatcherInterface $dispatcher
     * @param ResponseInterface $response
     * @param TemplateInterface $template
     * @param HttpInterface $request
     * @param SessionInterface $session
     */
    public function __construct(DatabaseInterface $database,
                                DispatcherInterface $dispatcher,
                                ResponseInterface $response,
                                TemplateInterface $template,
                                HttpInterface $request,
                                SessionInterface $session)
    {
        $this->response   = $response;
        $this->template   = $template;
        $this->request    = $request;
        $this->session    = $session;
        parent::__construct($database, $dispatcher);
    }


    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
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
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }
}