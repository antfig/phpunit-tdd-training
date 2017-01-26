<?php

namespace Tdd\ValueObjects;


class Name
{
    /** @var  string */
    private $firstName;

    /** @var  string */
    private $lastName;

    /**
     * Name constructor.
     */
    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function __toString() : string
    {
        return $this->firstName . " " . $this->lastName;
    }

}