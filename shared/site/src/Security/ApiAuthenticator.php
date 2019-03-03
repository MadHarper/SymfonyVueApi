<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use App\Repository\ApiTokenRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiAuthenticator extends AbstractGuardAuthenticator
{
    use TargetPathTrait;

    private $entityManager;
    private $apiTokenRepository;
    private $urlGenerator;
    private $csrfTokenManager;

    public function __construct(EntityManagerInterface $entityManager,
                                UrlGeneratorInterface $urlGenerator,
                                ApiTokenRepository $apiTokenRepository,
                                CsrfTokenManagerInterface $csrfTokenManager)
    {
        $this->entityManager = $entityManager;
        $this->apiTokenRepository = $apiTokenRepository;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function supports(Request $request)
    {
//        return $request->headers->has('Authorization')
//            && 0 === strpos($request->headers->get('Authorization'), 'Bearer ');

        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function getCredentials(Request $request)
    {
//        $authorizationHeader = $request->headers->get('Authorization');
//        return substr($authorizationHeader, 7);

        return $request->headers->get('X-AUTH-TOKEN');
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
//        $token = $this->apiTokenRepository->findOneBy([
//            'token' => $credentials
//        ]);
//
//        if (!$token) {
//            throw new CustomUserMessageAuthenticationException(
//                'Invalid API Token'
//            );
//        }
//        if ($token->isExpired()) {
//            throw new CustomUserMessageAuthenticationException(
//                'Token expired'
//            );
//        }
//        return $token->getApiUser();

        $token = $this->apiTokenRepository->findOneBy([
            'token' => $credentials
        ]);

        if (!$token) {
            throw new CustomUserMessageAuthenticationException(
                'Invalid API Token'
            );
        }
        if ($token->isExpired()) {
            throw new CustomUserMessageAuthenticationException(
                'Token expired'
            );
        }
        return $token->getApiUser();
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'message' => $exception->getMessageKey()
        ], 401);
    }

    public function supportsRememberMe()
    {
        return false;
    }

    /**
     * Called when authentication is needed, but it's not sent
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }
}
