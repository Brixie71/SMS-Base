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

class ClientContactsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ClientContactsList[/{contact_id}]", [PermissionMiddleware::class], "list.client_contacts")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContactsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ClientContactsAdd[/{contact_id}]", [PermissionMiddleware::class], "add.client_contacts")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContactsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ClientContactsView[/{contact_id}]", [PermissionMiddleware::class], "view.client_contacts")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContactsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ClientContactsEdit[/{contact_id}]", [PermissionMiddleware::class], "edit.client_contacts")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContactsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ClientContactsDelete[/{contact_id}]", [PermissionMiddleware::class], "delete.client_contacts")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContactsDelete");
    }
}
