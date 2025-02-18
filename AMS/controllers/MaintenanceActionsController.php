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

class MaintenanceActionsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceActionsList[/{action_id}]", [PermissionMiddleware::class], "list.maintenance_actions")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceActionsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceActionsAdd[/{action_id}]", [PermissionMiddleware::class], "add.maintenance_actions")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceActionsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceActionsView[/{action_id}]", [PermissionMiddleware::class], "view.maintenance_actions")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceActionsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceActionsEdit[/{action_id}]", [PermissionMiddleware::class], "edit.maintenance_actions")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceActionsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceActionsDelete[/{action_id}]", [PermissionMiddleware::class], "delete.maintenance_actions")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceActionsDelete");
    }
}
