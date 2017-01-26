<?php

namespace Tdd;


use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Tdd\Exception\AuctionStartDateBiggerThanEndDateException;
use Tdd\Exception\BidDateNotBetweenStartAndEndDateException;
use Tdd\Exception\BidHaveToBeBiggerThanThePreviousException;
use Tdd\Exception\UserCannotBidHisOwnAuctionException;
use Tdd\ValueObjects\Description;
use Tdd\ValueObjects\Email;
use Tdd\ValueObjects\Name;

class AuctionTest extends TestCase
{
    /** @var  Auction */
    private $auction;

    /** @var  User */
    private $seller;

    /** @var User */
    private $buyer;

    /** @var  Currency */
    private $currency;

    public function setUp()
    {

        $this->currency = new Currency('eur');

        $this->seller = new User(new Name('jon', 'Doe'), new Email('jon@doe.com'));

        $this->buyer = new User(new Name('John', 'Travolta'), new Email('john@travolta.com'));

        $this->auction = new Auction(new Description('some text'),
            new \DateTime('2017-01-25 12:08:08'),
            new \DateTime('2017-01-25 18:01:01'),
            $this->seller,
            new Money(2, $this->currency));
    }

    public function testAuctionHasDescription()
    {
        $this->assertEquals('some text', $this->auction->getDescription());
    }

    public function testAuctionHasStartDate()
    {
        $this->assertEquals(new \DateTime('2017-01-25 12:08:08'), $this->auction->getStartDate());
    }

    public function testAuctionHasEndDate()
    {
        $this->assertEquals(new \DateTime('2017-01-25 18:01:01'), $this->auction->getEndDate());
    }

    public function testEndDateIsBiggerThanStartDate()
    {
        $this->expectException(AuctionStartDateBiggerThanEndDateException::class);

        new Auction(new Description('some text'),
            new \DateTime('2017-01-25 12:08:08'),
            new \DateTime('2017-01-24 18:01:01'),
            $this->seller,
            new Money(2, $this->currency));
    }

    public function testAuctionHasASeller()
    {
        $this->assertEquals($this->seller, $this->auction->getSeller());
    }

    public function testAuctionHasAStartingPrice()
    {
        $this->assertEquals(2, $this->auction->getStartingPrice()->getAmount());
    }

    public function testAuctionHaveNoBidsWhenCreated()
    {
        $this->assertEmpty($this->auction->getBids());
    }

    public function testCanAddBids()
    {
        $bid = new Bid(new Money(2, $this->currency), $this->buyer, new \DateTime('2017-01-25 13:08:08'));

        $this->auction->addBid($bid);

        $biggerBid = new Bid(new Money(3, $this->currency), $this->buyer, new \DateTime('2017-01-25 13:40:08'));

        $this->auction->addBid($biggerBid);

        $this->assertContains($bid, $this->auction->getBids());
        $this->assertContains($biggerBid, $this->auction->getBids());
    }

    public function testBidDateIsBetweenAuctionStartAndEndDate()
    {
        $this->expectException(BidDateNotBetweenStartAndEndDateException::class);

        $bid = new Bid(new Money(2, $this->currency), $this->buyer, new \DateTime('2018-01-25 13:08:08'));
        $this->auction->addBid($bid);
    }

    public function testUserCannotBidHisOwnAuction()
    {
        $this->expectException(UserCannotBidHisOwnAuctionException::class);

        $bid = new Bid(new Money(2, $this->currency), $this->seller, new \DateTime('2017-01-25 13:08:08'));
        $this->auction->addBid($bid);
    }


    public function testBidIsBiggerThanThePrevious()
    {
        $this->expectException(BidHaveToBeBiggerThanThePreviousException::class);

        $bidOne = new Bid(new Money(2, $this->currency), $this->buyer, new \DateTime('2017-01-25 13:08:08'));
        $this->auction->addBid($bidOne);

        $bidTwo = new Bid(new Money(2, $this->currency), $this->buyer, new \DateTime('2017-01-25 13:18:08'));
        $this->auction->addBid($bidTwo);

    }

}