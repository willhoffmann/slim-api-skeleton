<?php

namespace App\Utility;

use Slim\Http\Response;

class JsonResponse
{
    /**
     * Set error json
     *
     * @param Response $response
     * @param $errorMessages
     * @param int $statusCode
     * @return Response
     */
    public static function setErrorJson(Response $response, $errorMessages, $statusCode = 400): Response
    {
        $data = [
            'code'    => $statusCode,
            'message' => $errorMessages,
        ];

        return $response->withJson($data, $statusCode);
    }

    /**
     * Set success json
     *
     * @param Response $response
     * @param $content
     * @param int $statusCode
     * @return Response
     */
    public static function setSuccessJson(Response $response, $content, $statusCode = 200) : Response
    {
        return $response->withJson($content, $statusCode);
    }
}
