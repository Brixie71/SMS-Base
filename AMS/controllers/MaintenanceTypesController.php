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

class MaintenanceTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTypesList[/{type_id}]", [PermissionMiddleware::class], "list.maintenance_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTypesAdd[/{type_id}]", [PermissionMiddleware::class], "add.maintenance_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTypesView[/{type_id}]", [PermissionMiddleware::class], "view.maintenance_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTypesEdit[/{type_id}]", [PermissionMiddleware::class], "edit.maintenance_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTypesDelete[/{type_id}]", [PermissionMiddleware::class], "delete.maintenance_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTypesDelete");
    }
}
