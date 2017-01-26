<?php

namespace Tdd\ValueObjects;


use Tdd\Exception\InvalidEmailException;

class Email
{
    /** @var  string */
    private $email;

    /**
     * Email constructor.
     *
     * @param string $email
     */
    public function __construct($email)
    {
        $this->ensureIsValid($email);
        $this->email = $email;
    }


    function __toString()
    {
        return $this->email;
    }

    /**
     * @throws InvalidEmailException
     */
    protected function ensureIsValid($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException;
        }
    }

}