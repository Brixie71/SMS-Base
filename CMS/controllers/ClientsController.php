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

class ClientsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ClientsList[/{client_id}]", [PermissionMiddleware::class], "list.clients")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ClientsAdd[/{client_id}]", [PermissionMiddleware::class], "add.clients")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ClientsView[/{client_id}]", [PermissionMiddleware::class], "view.clients")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ClientsEdit[/{client_id}]", [PermissionMiddleware::class], "edit.clients")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ClientsDelete[/{client_id}]", [PermissionMiddleware::class], "delete.clients")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientsDelete");
    }
}
