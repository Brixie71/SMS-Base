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

class EquipmentSpecificationsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/EquipmentSpecificationsList[/{spec_id}]", [PermissionMiddleware::class], "list.equipment_specifications")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentSpecificationsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/EquipmentSpecificationsAdd[/{spec_id}]", [PermissionMiddleware::class], "add.equipment_specifications")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentSpecificationsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/EquipmentSpecificationsView[/{spec_id}]", [PermissionMiddleware::class], "view.equipment_specifications")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentSpecificationsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/EquipmentSpecificationsEdit[/{spec_id}]", [PermissionMiddleware::class], "edit.equipment_specifications")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentSpecificationsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/EquipmentSpecificationsDelete[/{spec_id}]", [PermissionMiddleware::class], "delete.equipment_specifications")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentSpecificationsDelete");
    }
}
