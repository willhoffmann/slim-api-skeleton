<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class PingController
{
    /**
     * Get action
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function getAction(Request $request, Response $response)
    {
        $data = ['time' => gmdate('Y-m-d H:i:s')];

        return $response->withJson($data);
    }
}
