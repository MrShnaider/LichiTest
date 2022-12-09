<?php


namespace App\Answers\Feat5;


class UserRepository
{
    public static function isUserWithEmailExists(string $email): bool
    {
        foreach (self::getUserDB() as $user) {
            if ($user['email'] === $email) return true;
        }

        return false;
    }

    private static function getUserDB(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'test_name',
                'email' => 'test_email@test.com'
            ]
        ];
    }
}
