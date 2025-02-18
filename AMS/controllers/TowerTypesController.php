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

class TowerTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/TowerTypesList[/{type_id}]", [PermissionMiddleware::class], "list.tower_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/TowerTypesAdd[/{type_id}]", [PermissionMiddleware::class], "add.tower_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/TowerTypesView[/{type_id}]", [PermissionMiddleware::class], "view.tower_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/TowerTypesEdit[/{type_id}]", [PermissionMiddleware::class], "edit.tower_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/TowerTypesDelete[/{type_id}]", [PermissionMiddleware::class], "delete.tower_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerTypesDelete");
    }
}
