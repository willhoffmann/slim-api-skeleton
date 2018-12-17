<?php

namespace App\Service;

use App\Entity\User;
use App\Exceptions\ValidationException;
use App\Listener\HashPasswordListener;
use App\Utility\Error;
use App\Utility\JsonResponse;
use App\Utility\Jwt;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class UserService
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Error
     */
    protected $errors;

    /**
     * Constructor
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->errors = new Error();
    }

    /**
     * Create
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function create(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        if (! $this->checkDataIsNotEmpty($data)) {
            return JsonResponse::setErrorJson($response, $this->errors->getErrors());
        }
        $this->addPasswordEncoderListener();
        try {
            $user = $this->createUser($data);
            $result = [
                'id'     => $user->getId(),
                'name'   => $user->getName(),
                'email'  => $user->getEmail(),
                'status' => $user->getStatus(),
            ];
        } catch (ValidationException $e) {
            return JsonResponse::setErrorJson($response, $e->getErrors());
        }

        return JsonResponse::setSuccessJson($response, $result);
    }

    /**
     * Create new user
     *
     * @param $data
     * @return User
     */
    private function createUser($data) : User
    {
        $user = new User();
        $this->persistUserData($data, $user);

        return $user;
    }

    /**
     * Check data is not empty
     *
     * @param $data
     * @return bool
     */
    private function checkDataIsNotEmpty($data)
    {
        if (empty($data)) {
            $message = 'No valid data. Post username, email, password and status as json';
            $this->errors->addError($message, 'validation');
        }

        return ! $this->errors->hasErrors();
    }

    /**
     * Add password encoder listener
     */
    private function addPasswordEncoderListener()
    {
        $this->container->entityManager->getEventManager()->addEventListener(
            ['prePersist', 'preUpdate'],
            new HashPasswordListener()
        );
    }

    /**
     * Persist user
     *
     * @param $data
     * @param User $user
     */
    private function persistUserData($data, User $user)
    {
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPlainPassword($data['password']);
        $user->setStatus($data['status']);
        $this->container->entityManager->persist($user);
        $this->container->entityManager->flush();
    }
}
