<?php

namespace Tdd\ValueObjects;


class Description
{
    /** @var  string */
    private $content;

    /**
     * Description constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    function __toString()
    {
        return $this->content;
    }
}
