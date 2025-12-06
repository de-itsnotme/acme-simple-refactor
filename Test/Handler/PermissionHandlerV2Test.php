<?php

declare(strict_types=1);

namespace Test\Handler;

use App\Evaluator\PermissionEvaluator;
use App\Factory\TokenFactory;
use App\Handler\PermissionHandlerV2;
use PHPUnit\Framework\TestCase;
use ProgPhil1337\SimpleReactApp\HTTP\Routing\RouteParameters;
use Psr\Http\Message\ServerRequestInterface;

class PermissionHandlerV2Test extends TestCase
{
    protected function setUp(): void
    {
        /**
         * Tests PermissionHandlerV2 behavior.
         *
         * Note: We mock the concrete classes (PermissionEvaluator, TokenFactory)
         * instead of their interfaces due to current DI limitations.
         *
         * @see \App\Handler\PermissionHandlerV2::__construct
         *      For details on why interfaces cannot be injected directly.
         */
        $this->permissionEvaluatorMock = $this->createMock(PermissionEvaluator::class);
        $this->serverRequestMock = $this->createMock(ServerRequestInterface::class);
        $this->tokenFactory = new TokenFactory();
    }

    public function testAccessWithoutTokenIdShouldReturnFalseAndErrorCode400()
    {
        $permissionHandler = new PermissionHandlerV2($this->permissionEvaluatorMock, $this->tokenFactory);

        $routerParametersMock = $this->createMock(RouteParameters::class);
        $routerParametersMock->method('get')->with('token')->willReturn(null);

        $response = $permissionHandler($this->serverRequestMock, $routerParametersMock);
        $data = json_decode($response->getContent(), true);

        $this->assertFalse($data['permission']);
        $this->assertEquals(400, $response->getCode(), 'Response code should be 400');
    }

    public function testAccessWithValidTokenIdAndNoPermissionShouldReturnPermissionFalseAndStatusCode400()
    {
        $this->permissionEvaluatorMock->method('hasPermission')->willReturn(false);

        $permissionHandler = new PermissionHandlerV2($this->permissionEvaluatorMock, $this->tokenFactory);

        $routerParametersMock = $this->createMock(RouteParameters::class);
        $routerParametersMock->method('get')->with('token')->willReturn('token1234');

        $response = $permissionHandler($this->serverRequestMock, $routerParametersMock);
        $data = json_decode($response->getContent(), true);

        $this->assertFalse($data['permission']);
        $this->assertEquals(400, $response->getCode(), 'Response code should be 401');
    }

    public function testAccessWithValidTokenIdAndValidPermissionShouldReturnPermissionTrueAndStatueCode200()
    {
        $this->permissionEvaluatorMock->method('hasPermission')->willReturn(true);

        $permissionHandler = new PermissionHandlerV2($this->permissionEvaluatorMock, $this->tokenFactory);

        $routerParametersMock = $this->createMock(RouteParameters::class);
        $routerParametersMock->method('get')->with('token')->willReturn('token1234');

        $response = $permissionHandler($this->serverRequestMock, $routerParametersMock);
        $data = json_decode($response->getContent(), true);

        $this->assertTrue($data['permission']);
        $this->assertArrayNotHasKey('error', $data);
        $this->assertEquals(200, $response->getCode(), 'Response code should be 200');
    }
}
