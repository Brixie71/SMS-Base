<?php

namespace PHPMaker2024\AMS;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\AMS\Attributes\Delete;
use PHPMaker2024\AMS\Attributes\Get;
use PHPMaker2024\AMS\Attributes\Map;
use PHPMaker2024\AMS\Attributes\Options;
use PHPMaker2024\AMS\Attributes\Patch;
use PHPMaker2024\AMS\Attributes\Post;
use PHPMaker2024\AMS\Attributes\Put;

class UsersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/UsersList[/{user_id}]", [PermissionMiddleware::class], "list.users")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/UsersView[/{user_id}]", [PermissionMiddleware::class], "view.users")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UsersView");
    }
}
