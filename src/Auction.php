<?php

namespace Tdd;


use Money\Money;
use Tdd\Exception\AuctionStartDateBiggerThanEndDateException;
use Tdd\Exception\BidDateNotBetweenStartAndEndDateException;
use Tdd\Exception\BidHaveToBeBiggerThanThePreviousException;
use Tdd\Exception\UserCannotBidHisOwnAuctionException;
use Tdd\ValueObjects\Description;

final class Auction
{
    /** @var  Description */
    private $description;

    /** @var  \DateTime */
    private $startDate;

    /** @var  \DateTime */
    private $endDate;

    /** @var  User */
    private $seller;

    /** @var  Money */
    private $startingPrice;

    /** @var Bid[] */
    private $bids = [];

    /**
     * Auction constructor.
     *
     * @param Description $description
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param User $seller
     */
    public function __construct(
        Description $description,
        \DateTime $startDate,
        \DateTime $endDate,
        User $seller,
        Money $startingPrice
    ) {

        $this->ensureEndDateIsBiggerThanStartDate($startDate, $endDate);

        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->seller = $seller;
        $this->startingPrice = $startingPrice;

    }

    /**
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     *
     * @throws AuctionStartDateBiggerThanEndDateException
     */
    protected function ensureEndDateIsBiggerThanStartDate(\DateTime $startDate, \DateTime $endDate)
    {
        if ($startDate > $endDate) {
            throw new AuctionStartDateBiggerThanEndDateException();
        }
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getStartDate() : \DateTime
    {
        return $this->startDate;
    }

    public function getEndDate() : \DateTime
    {
        return $this->endDate;
    }

    public function getSeller() : User
    {
        return $this->seller;
    }

    public function getStartingPrice() : Money
    {
        return $this->startingPrice;
    }

    public function getBids() : array
    {
        return $this->bids;
    }

    /**
     * @param Bid $bid
     *
     * @throws UserCannotBidHisOwnAuctionException
     */
    public function addBid(Bid $bid)
    {
        if ($this->seller == $bid->getUser()) {
            throw new UserCannotBidHisOwnAuctionException();
        }

        $this->ensureBidIsBiggerThanPrevious($bid);
        $this->ensureBidIsBetweenStartAndEndDate($bid);

        $this->bids[] = $bid;
    }

    /**
     * @param Bid $bid
     *
     * @throws BidHaveToBeBiggerThanThePreviousException
     */
    protected function ensureBidIsBiggerThanPrevious(Bid $bid)
    {
        if (!empty($this->bids)) {

            $lastBid = end($this->bids);

            if ($bid->getPrice()->lessThanOrEqual($lastBid->getPrice())) {
                throw new BidHaveToBeBiggerThanThePreviousException();
            }

            reset($this->bids);
        }

    }

    /**
     * @param $bid
     *
     * @throws BidDateNotBetweenStartAndEndDateException
     */
    private function ensureBidIsBetweenStartAndEndDate(Bid $bid)
    {
        if ($this->startDate > $bid->getDate() ||
            $this->endDate < $bid->getDate()
        ) {
            throw new BidDateNotBetweenStartAndEndDateException();
        }
    }

}