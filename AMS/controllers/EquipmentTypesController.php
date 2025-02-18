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

class EquipmentTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/EquipmentTypesList[/{type_id}]", [PermissionMiddleware::class], "list.equipment_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/EquipmentTypesAdd[/{type_id}]", [PermissionMiddleware::class], "add.equipment_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/EquipmentTypesView[/{type_id}]", [PermissionMiddleware::class], "view.equipment_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/EquipmentTypesEdit[/{type_id}]", [PermissionMiddleware::class], "edit.equipment_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/EquipmentTypesDelete[/{type_id}]", [PermissionMiddleware::class], "delete.equipment_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentTypesDelete");
    }
}
