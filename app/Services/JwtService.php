<?php

namespace App\Services;

use App\Models\JWTToken;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Token;
use Illuminate\Support\Facades\Auth;

class JwtService
{
    private $config;

    public function __construct()
    {
        $privateKey = InMemory::file(storage_path('oauth-private.key'));
        $publicKey = InMemory::file(storage_path('oauth-public.key'));

        $this->config = Configuration::forAsymmetricSigner(
            new Sha256(),
            $privateKey,
            $publicKey
        );
    }

    public function createToken($user)
    {
        $now = new \DateTimeImmutable();
        $tokenId = bin2hex(random_bytes(16));
        $token = $this->config->builder()
            ->issuedBy(config('app.url'))
            ->permittedFor(config('app.url'))
            ->identifiedBy($tokenId, true)
            ->issuedAt($now)
            ->canOnlyBeUsedAfter($now)
            ->expiresAt($now->modify('+1 hour'))
            ->withClaim('uid', $user->id)
            ->withClaim('is_admin', $user->is_admin)
            ->getToken($this->config->signer(), $this->config->signingKey());

        // Store the token in the database
        JWTToken::create([
            'user_id' => $user->id,
            'unique_id' => $tokenId,
            'token_title' => 'Default Title',
            'restrictions' => json_encode([]),
            'permissions' => json_encode([]),
            'expires_at' => $now->modify('+1 hour'),
            'last_used_at' => null,
            'refreshed_at' => null,
        ]);

        return $token->toString();
    }

    public function parseToken($token)
    {
        return $this->config->parser()->parse($token);
    }

    public function validateToken(Token $token)
    {
        $constraints = $this->config->validationConstraints();
        return $this->config->validator()->validate($token, ...$constraints);
    }

    public function getUserFromToken(Token $token)
    {
        $userId = $token->claims()->get('uid');
        return Auth::find($userId);
    }
}
