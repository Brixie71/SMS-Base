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

class MaintenancePartsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MaintenancePartsList[/{part_id}]", [PermissionMiddleware::class], "list.maintenance_parts")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenancePartsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MaintenancePartsAdd[/{part_id}]", [PermissionMiddleware::class], "add.maintenance_parts")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenancePartsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MaintenancePartsView[/{part_id}]", [PermissionMiddleware::class], "view.maintenance_parts")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenancePartsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MaintenancePartsEdit[/{part_id}]", [PermissionMiddleware::class], "edit.maintenance_parts")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenancePartsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MaintenancePartsDelete[/{part_id}]", [PermissionMiddleware::class], "delete.maintenance_parts")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenancePartsDelete");
    }
}
