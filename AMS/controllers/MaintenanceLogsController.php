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

class MaintenanceLogsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceLogsList[/{log_id}]", [PermissionMiddleware::class], "list.maintenance_logs")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceLogsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceLogsAdd[/{log_id}]", [PermissionMiddleware::class], "add.maintenance_logs")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceLogsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceLogsView[/{log_id}]", [PermissionMiddleware::class], "view.maintenance_logs")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceLogsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceLogsEdit[/{log_id}]", [PermissionMiddleware::class], "edit.maintenance_logs")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceLogsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceLogsDelete[/{log_id}]", [PermissionMiddleware::class], "delete.maintenance_logs")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceLogsDelete");
    }
}
