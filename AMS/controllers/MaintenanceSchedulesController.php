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

class MaintenanceSchedulesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceSchedulesList[/{schedule_id}]", [PermissionMiddleware::class], "list.maintenance_schedules")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceSchedulesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceSchedulesAdd[/{schedule_id}]", [PermissionMiddleware::class], "add.maintenance_schedules")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceSchedulesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceSchedulesView[/{schedule_id}]", [PermissionMiddleware::class], "view.maintenance_schedules")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceSchedulesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceSchedulesEdit[/{schedule_id}]", [PermissionMiddleware::class], "edit.maintenance_schedules")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceSchedulesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceSchedulesDelete[/{schedule_id}]", [PermissionMiddleware::class], "delete.maintenance_schedules")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceSchedulesDelete");
    }
}
