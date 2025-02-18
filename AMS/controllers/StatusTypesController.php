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

class StatusTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/StatusTypesList[/{status_id}]", [PermissionMiddleware::class], "list.status_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/StatusTypesAdd[/{status_id}]", [PermissionMiddleware::class], "add.status_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/StatusTypesView[/{status_id}]", [PermissionMiddleware::class], "view.status_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/StatusTypesEdit[/{status_id}]", [PermissionMiddleware::class], "edit.status_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/StatusTypesDelete[/{status_id}]", [PermissionMiddleware::class], "delete.status_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "StatusTypesDelete");
    }
}
