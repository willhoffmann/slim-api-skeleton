<?php

namespace App\Controller;

use App\Service\UserService;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var UserService
     */
    protected $service;

    /**
     * Constructor
     *
     * @param Container $container
     * @param UserService $service
     */
    public function __construct(Container $container, UserService $service)
    {
        $this->container = $container;
        $this->service = $service;
    }

    /**
     * Post
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function postAction(Request $request, Response $response)
    {
        return $this->service->create($request, $response);
    }
}
