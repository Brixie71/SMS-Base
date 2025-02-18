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

class SupportTicketUpdatesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketUpdatesList[/{update_id}]", [PermissionMiddleware::class], "list.support_ticket_updates")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketUpdatesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketUpdatesAdd[/{update_id}]", [PermissionMiddleware::class], "add.support_ticket_updates")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketUpdatesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketUpdatesView[/{update_id}]", [PermissionMiddleware::class], "view.support_ticket_updates")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketUpdatesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketUpdatesEdit[/{update_id}]", [PermissionMiddleware::class], "edit.support_ticket_updates")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketUpdatesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketUpdatesDelete[/{update_id}]", [PermissionMiddleware::class], "delete.support_ticket_updates")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketUpdatesDelete");
    }
}
