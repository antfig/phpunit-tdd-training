<?php

namespace Tdd;


use Tdd\ValueObjects\Email;
use Tdd\ValueObjects\Name;

class User
{

    /** @var  Name */
    private $name;

    /** @var  Email */
    private $email;

    /**
     * User constructor.
     *
     * @param Name $name
     * @param Email $email
     */
    public function __construct(Name $name, Email $email)
    {
        $this->name = $name;
        $this->email = $email;
    }


    public function getName() : Name
    {
        return $this->name;
    }

    public function getEmail() : Email
    {
        return $this->email;
    }

}