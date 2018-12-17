<?php

namespace App\Exceptions;

use App\Utility\Error;

class ValidationException extends \Exception
{
    /**
     * @var Error
     */
    protected $errors;

    /**
     * Constructor
     *
     * @param Error $errors
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(Error $errors, $message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors->getErrors();
    }
}
