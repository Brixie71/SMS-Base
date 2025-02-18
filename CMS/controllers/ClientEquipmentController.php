<?php

namespace PHPMaker2024\CMS;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\CMS\Attributes\Delete;
use PHPMaker2024\CMS\Attributes\Get;
use PHPMaker2024\CMS\Attributes\Map;
use PHPMaker2024\CMS\Attributes\Options;
use PHPMaker2024\CMS\Attributes\Patch;
use PHPMaker2024\CMS\Attributes\Post;
use PHPMaker2024\CMS\Attributes\Put;

class ClientEquipmentController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ClientEquipmentList[/{equipment_id}]", [PermissionMiddleware::class], "list.client_equipment")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientEquipmentList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ClientEquipmentAdd[/{equipment_id}]", [PermissionMiddleware::class], "add.client_equipment")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientEquipmentAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ClientEquipmentView[/{equipment_id}]", [PermissionMiddleware::class], "view.client_equipment")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientEquipmentView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ClientEquipmentEdit[/{equipment_id}]", [PermissionMiddleware::class], "edit.client_equipment")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientEquipmentEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ClientEquipmentDelete[/{equipment_id}]", [PermissionMiddleware::class], "delete.client_equipment")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientEquipmentDelete");
    }
}
