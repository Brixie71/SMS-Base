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

class TowerSpecificationsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/TowerSpecificationsList[/{spec_id}]", [PermissionMiddleware::class], "list.tower_specifications")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerSpecificationsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/TowerSpecificationsAdd[/{spec_id}]", [PermissionMiddleware::class], "add.tower_specifications")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerSpecificationsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/TowerSpecificationsView[/{spec_id}]", [PermissionMiddleware::class], "view.tower_specifications")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerSpecificationsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/TowerSpecificationsEdit[/{spec_id}]", [PermissionMiddleware::class], "edit.tower_specifications")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerSpecificationsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/TowerSpecificationsDelete[/{spec_id}]", [PermissionMiddleware::class], "delete.tower_specifications")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerSpecificationsDelete");
    }
}
