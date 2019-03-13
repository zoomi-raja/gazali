<?php
/**
 * Created by PhpStorm.
 * User: zamurd
 * Date: 3/10/2019
 * Time: 9:31 AM
 */

namespace App\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use \DomainException;
use \UnexpectedValueException;
use Illuminate\Auth\Access\AuthorizationException;
class JwtTokenizer{
    /**
     * Create a new token.
     *
     * @param User $user
     * @return string
     */
    public function jwt( $user ) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];
        return JWT::encode($payload, env('JWT_SECRET', 'anycustomhardtorememberkey23423'));
    }
    /**
     * @param null $authToken
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     */
    public function validateJwtToken($authToken = null ){
        if ( $authToken ) {
            try {
                $credentials = JWT::decode($authToken,env('JWT_SECRET', 'anycustomhardtorememberkey23423'), ['HS256']);
            } catch(ExpiredException $e) {
                throw new AuthorizationException('Provided token is expired.',403);
            } catch(Exception $e) {
                throw new AuthorizationException('An error while decoding token.',403);
            } catch(DomainException $e) {
                throw new AuthorizationException('An error while decoding token.',403);
            } catch(UnexpectedValueException $e) {
                throw new AuthorizationException('An error while decoding token.',403);
            }
            return $credentials;
        }
        throw new AuthorizationException('Auth token is missing.',403);
    }
}
