<?php

declare(strict_types=1);

namespace App\Security;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;


class KeycloakAuthenticator extends AbstractAuthenticator
{

    private string $publicKey;

    public function __construct(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function supports(Request $request): ?bool
    {
        return str_starts_with($request->getPathInfo(), '/api')
            && !str_starts_with($request->getPathInfo(), '/api/public');
    }

    public function authenticate(Request $request): Passport
    {
        echo "<pre>";
        print_r(111111111);
        echo "</pre>";
        die();

        $token = $this->extractToken($request);

        try {
            $payload = JWT::decode($token, new Key($this->publicKey, 'RS256'));

            return new SelfValidatingPassport(
                new UserBadge($payload->preferred_username ?? $payload->sub, function() use ($payload) {
                    return new KeycloakUser(
                        $payload->sub,
                        $payload->preferred_username ?? '',
                        $payload->email ?? '',
                        $payload->given_name ?? '',
                        $payload->family_name ?? '',
                        $payload->realm_access->roles ?? []
                    );
                })
            );
        } catch (SignatureInvalidException $e) {
            throw new CustomUserMessageAuthenticationException('Invalid JWT signature');
        } catch (\Exception $e) {
            throw new CustomUserMessageAuthenticationException('Invalid JWT token');
        }
    }

    private function extractToken(Request $request): string
    {
        echo "<pre>";
        print_r(222222);
        echo "</pre>";
        die();

        if (!$request->headers->has('Authorization')) {
            throw new CustomUserMessageAuthenticationException('No Authorization header provided');
        }

        if (!preg_match('/Bearer\s(\S+)/', $request->headers->get('Authorization'), $matches)) {
            throw new CustomUserMessageAuthenticationException('Malformed Authorization header');
        }

        return $matches[1];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'error' => 'Authentication failed',
            'message' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }
}