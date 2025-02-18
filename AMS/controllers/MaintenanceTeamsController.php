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

class MaintenanceTeamsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTeamsList[/{team_id}]", [PermissionMiddleware::class], "list.maintenance_teams")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTeamsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTeamsAdd[/{team_id}]", [PermissionMiddleware::class], "add.maintenance_teams")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTeamsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTeamsView[/{team_id}]", [PermissionMiddleware::class], "view.maintenance_teams")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTeamsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTeamsEdit[/{team_id}]", [PermissionMiddleware::class], "edit.maintenance_teams")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTeamsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MaintenanceTeamsDelete[/{team_id}]", [PermissionMiddleware::class], "delete.maintenance_teams")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MaintenanceTeamsDelete");
    }
}
