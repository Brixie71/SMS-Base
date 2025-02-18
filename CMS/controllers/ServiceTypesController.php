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

class ServiceTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ServiceTypesList[/{service_id}]", [PermissionMiddleware::class], "list.service_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ServiceTypesAdd[/{service_id}]", [PermissionMiddleware::class], "add.service_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ServiceTypesView[/{service_id}]", [PermissionMiddleware::class], "view.service_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ServiceTypesEdit[/{service_id}]", [PermissionMiddleware::class], "edit.service_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ServiceTypesDelete[/{service_id}]", [PermissionMiddleware::class], "delete.service_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceTypesDelete");
    }
}
