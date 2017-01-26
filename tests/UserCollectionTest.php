<?php

namespace Tdd;

use PHPUnit\Framework\TestCase;
use Tdd\Exception\UserEmailNotUniqueException;
use Tdd\ValueObjects\Email;
use Tdd\ValueObjects\Name;
use Tdd\User;
use Tdd\UserCollection;

class UserCollectionTest extends TestCase
{

    /** @var UserCollection */
    private $userCollection;

    public function setUp()
    {
        $this->userCollection = new UserCollection();
    }

    public function testCanAddUser()
    {
        $userFoo = new User(new Name('Foo', 'Bar'), new Email('foo@bar.com'));
        $this->userCollection->addUser($userFoo);

        $this->assertContains($userFoo, $this->userCollection->getUsers());

        return $this->userCollection;

    }

    /**
     * @depends testCanAddUser
     *
     * @param UserCollection $userCollection
     */
    public function testUserEmailIsUnique(UserCollection $userCollection)
    {
        $this->expectException(UserEmailNotUniqueException::class);

        $userSameEmail = new User(new Name('Jon', 'Doe'), new Email('foo@bar.com'));

        $userCollection->addUser($userSameEmail);
    }

}