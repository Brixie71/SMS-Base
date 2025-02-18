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

class TowerEquipmentController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/TowerEquipmentList[/{equipment_id}]", [PermissionMiddleware::class], "list.tower_equipment")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerEquipmentList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/TowerEquipmentAdd[/{equipment_id}]", [PermissionMiddleware::class], "add.tower_equipment")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerEquipmentAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/TowerEquipmentView[/{equipment_id}]", [PermissionMiddleware::class], "view.tower_equipment")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerEquipmentView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/TowerEquipmentEdit[/{equipment_id}]", [PermissionMiddleware::class], "edit.tower_equipment")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerEquipmentEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/TowerEquipmentDelete[/{equipment_id}]", [PermissionMiddleware::class], "delete.tower_equipment")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TowerEquipmentDelete");
    }
}
