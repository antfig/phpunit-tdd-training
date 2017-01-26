<?php

namespace Tdd;


use Tdd\Exception\UserEmailNotUniqueException;

final class UserCollection
{
    /** @var  array */
    private $users = [];

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->checkEmailIsUnique($user);

        $this->users[] = $user;
    }

    /**
     * @param User $user
     *
     * @throws UserEmailNotUniqueException
     */
    private function checkEmailIsUnique(User $user)
    {
        foreach ($this->users as $oldUser) {
            if ($user->getEmail() == $oldUser->getEmail()) {
                throw new UserEmailNotUniqueException();
            }
        }
    }

    public function getUsers() : array
    {
        return $this->users;
    }

}