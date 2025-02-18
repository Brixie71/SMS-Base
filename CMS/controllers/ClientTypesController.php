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

class ClientTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ClientTypesList[/{type_id}]", [PermissionMiddleware::class], "list.client_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ClientTypesAdd[/{type_id}]", [PermissionMiddleware::class], "add.client_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ClientTypesView[/{type_id}]", [PermissionMiddleware::class], "view.client_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ClientTypesEdit[/{type_id}]", [PermissionMiddleware::class], "edit.client_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ClientTypesDelete[/{type_id}]", [PermissionMiddleware::class], "delete.client_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientTypesDelete");
    }
}
