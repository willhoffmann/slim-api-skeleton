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
            'status' => 'error',
            'errors' => $errorMessages,
        ];

        return $response->withJson($data, $statusCode);
    }

    /**
     * Set success json
     *
     * @param Response $response
     * @param null $messages
     * @param null $data
     * @param int $statusCode
     * @return Response
     */
    public static function setSuccessJson(
        Response $response,
        $messages = null,
        $data = null,
        $statusCode = 200
    ): Response {
        $jsonData = ['status' => 'success'];

        if ($data) {
            $jsonData['data'] = $data;
        }

        if ($messages) {
            $jsonData['messages'] = $messages;
        }

        return $response->withJson($jsonData, $statusCode);
    }
}
