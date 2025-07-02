<?php

declare(strict_types=1);

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class KeycloakUser implements UserInterface
{

    public function __construct(
        private string $id,
        private string $username,
        private string $email,
        private string $firstName,
        private string $lastName,
        private array $roles = []
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getRoles(): array
    {
        return array_unique(array_merge($this->roles, ['ROLE_USER']));
    }

    public function eraseCredentials():void {}

    public function getPassword(): ?string
    {
        return null;
    }
}