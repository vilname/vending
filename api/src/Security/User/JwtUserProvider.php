<?php

declare(strict_types=1);

namespace App\Security\User;

use Lexik\Bundle\JWTAuthenticationBundle\Exception\UserNotFoundException;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUser;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\PayloadAwareUserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class JwtUserProvider implements PayloadAwareUserProviderInterface
{
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return new JwtUser($identifier);
    }

    public function loadUserByIdentifierAndPayload(string $identifier, array $payload): UserInterface
    {
        echo "<pre>";
        print_r(44444444444);
        echo "</pre>";
        die();

        return JwtUser::createFromPayload($identifier, $payload);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return is_a($class, JwtUser::class, true);
    }
}