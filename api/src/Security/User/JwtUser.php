<?php

declare(strict_types=1);

namespace App\Security\User;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

class JwtUser implements JWTUserInterface
{
    public function __construct(
        private string $username,
        private array $roles = [],
        private array $payload = []
    ) {}

    public static function createFromPayload($username, array $payload): self
    {
        $roles = ['ROLE_USER'];

        if (isset($payload['realm_access']['roles'])) {
            $roles = array_map(
                fn($role) => 'ROLE_'.strtoupper($role),
                $payload['realm_access']['roles']
            );
        }

        return new self($username, $roles, $payload);
    }

    // Методы UserInterface
    public function getRoles(): array { return $this->roles; }
    public function getPassword(): ?string { return null; }
    public function getSalt(): ?string { return null; }
    public function eraseCredentials(): void {}
    public function getUsername(): string { return $this->username; }
    public function getUserIdentifier(): string { return $this->username; }
    public function getPayload(): array { return $this->payload; }
}