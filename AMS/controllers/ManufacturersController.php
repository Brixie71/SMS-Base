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

class ManufacturersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ManufacturersList[/{manufacturer_id}]", [PermissionMiddleware::class], "list.manufacturers")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ManufacturersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ManufacturersAdd[/{manufacturer_id}]", [PermissionMiddleware::class], "add.manufacturers")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ManufacturersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ManufacturersView[/{manufacturer_id}]", [PermissionMiddleware::class], "view.manufacturers")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ManufacturersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ManufacturersEdit[/{manufacturer_id}]", [PermissionMiddleware::class], "edit.manufacturers")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ManufacturersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ManufacturersDelete[/{manufacturer_id}]", [PermissionMiddleware::class], "delete.manufacturers")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ManufacturersDelete");
    }
}
