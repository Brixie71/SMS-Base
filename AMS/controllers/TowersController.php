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

class TowersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/TowersList[/{tower_id}]", [PermissionMiddleware::class], "list.towers")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/TowersAdd[/{tower_id}]", [PermissionMiddleware::class], "add.towers")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/TowersView[/{tower_id}]", [PermissionMiddleware::class], "view.towers")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/TowersEdit[/{tower_id}]", [PermissionMiddleware::class], "edit.towers")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/TowersDelete[/{tower_id}]", [PermissionMiddleware::class], "delete.towers")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowersDelete");
    }
}
