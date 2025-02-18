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

class EquipmentModelsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/EquipmentModelsList[/{model_id}]", [PermissionMiddleware::class], "list.equipment_models")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentModelsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/EquipmentModelsAdd[/{model_id}]", [PermissionMiddleware::class], "add.equipment_models")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentModelsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/EquipmentModelsView[/{model_id}]", [PermissionMiddleware::class], "view.equipment_models")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentModelsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/EquipmentModelsEdit[/{model_id}]", [PermissionMiddleware::class], "edit.equipment_models")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentModelsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/EquipmentModelsDelete[/{model_id}]", [PermissionMiddleware::class], "delete.equipment_models")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "EquipmentModelsDelete");
    }
}
