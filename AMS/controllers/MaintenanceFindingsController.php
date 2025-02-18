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

class MaintenanceFindingsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceFindingsList[/{finding_id}]", [PermissionMiddleware::class], "list.maintenance_findings")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceFindingsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceFindingsAdd[/{finding_id}]", [PermissionMiddleware::class], "add.maintenance_findings")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceFindingsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceFindingsView[/{finding_id}]", [PermissionMiddleware::class], "view.maintenance_findings")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceFindingsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceFindingsEdit[/{finding_id}]", [PermissionMiddleware::class], "edit.maintenance_findings")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceFindingsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceFindingsDelete[/{finding_id}]", [PermissionMiddleware::class], "delete.maintenance_findings")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceFindingsDelete");
    }
}
