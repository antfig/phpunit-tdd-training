<?php
/**
 * Bid
 *
 * @author António Figueiredo <antonio.figueiredo@olx.com>
 * @copyright 2017 Naspers Classifieds
 */

namespace Tdd;


use Money\Money;

class Bid
{
    /** @var  Money */
    private $price;

    /** @var  User */
    private $user;

    /** @var  \DateTime */
    private $date;

    /**
     * Bid constructor.
     *
     * @param Money $price
     * @param User $user
     * @param \DateTime $date
     */
    public function __construct(Money $price, User $user, \DateTime $date)
    {
        $this->price = $price;
        $this->user = $user;
        $this->date = $date;
    }

    public function getUser() : User
    {
        return $this->user;
    }

    public function getPrice() : Money
    {
        return $this->price;
    }
    
    public function getDate() : \DateTime
    {
        return $this->date;
    }


}