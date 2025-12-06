<?php

declare(strict_types=1);

namespace App\Handler;

use App\Evaluator\PermissionEvaluator;
use App\Evaluator\PermissionEvaluatorInterface;
use App\Factory\TokenFactory;
use App\Factory\TokenFactoryInterface;
use InvalidArgumentException;
use ProgPhil1337\SimpleReactApp\HTTP\Response\JSONResponse;
use ProgPhil1337\SimpleReactApp\HTTP\Response\ResponseInterface;
use ProgPhil1337\SimpleReactApp\HTTP\Routing\Attribute\Route;
use ProgPhil1337\SimpleReactApp\HTTP\Routing\Handler\HandlerInterface;
use ProgPhil1337\SimpleReactApp\HTTP\Routing\HttpMethod;
use ProgPhil1337\SimpleReactApp\HTTP\Routing\RouteParameters;
use Psr\Http\Message\ServerRequestInterface;

#[Route(httpMethod: HttpMethod::GET, uri: '/v2/has_permission/{token}')]
class PermissionHandlerV2 implements HandlerInterface
{
    private PermissionEvaluatorInterface $permissionEvaluator;
    private TokenFactoryInterface $tokenFactory;

    /**
     * Dependency Injection would be available here
     *
     * Note: Due to limitations in the current Dependency Injection setup, the
     * - PermissionEvaluatorInterface and
     * - TokenFactoryInterface
     * could not be utilized directly. As a workaround, the concrete implementation PermissionEvaluator has been
     * registered and used instead.
     */
    public function __construct(PermissionEvaluator $evaluator, TokenFactory $tokenFactory)
    {
        $this->permissionEvaluator = $evaluator;
        $this->tokenFactory = $tokenFactory;
    }

    public function __invoke(ServerRequestInterface $serverRequest, RouteParameters $parameters): ResponseInterface
    {
        /** @var string $tokenId */
        $tokenId = $parameters->get('token');

        try {
            $token = $this->tokenFactory->createTokenById($tokenId);
        } catch (InvalidArgumentException $e) {
            return new JSONResponse(
                [
                    'permission' => false,
                    'error' => 'Invalid token was provided.',
                ],
                400
            );
        }

        $hasPermission = $this->permissionEvaluator->hasPermission($token);

        if ($hasPermission) {
            return new JSONResponse(
                [
                    'permission' => true,
                ],
                200
            );
        }

        return new JSONResponse(
            [
                'permission' => false,
                'error' => 'Permission is not allowed.',
            ],
            400
        );
    }
}
