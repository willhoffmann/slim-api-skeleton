<?php

namespace App\Utility;

class Error
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * Constructor
     *
     * @param array $errors
     */
    public function __construct($errors = [])
    {
        if ($errors) {
            $this->errors = $errors;
        }

        $this->name = 'default';
    }

    /**
     * Add error
     *
     * @param $message
     * @param null $name
     */
    public function addError($message, $name = null)
    {
        if (! $name) {
            $name = $this->name;
        }

        $this->errors[$name][] = $message;
    }

    /**
     * Has errors
     *
     * @return bool
     */
    public function hasErrors()
    {
        return ! empty($this->errors);
    }

    /**
     * Get errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Set name
     *
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
