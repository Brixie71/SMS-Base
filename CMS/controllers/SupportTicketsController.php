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

class SupportTicketsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketsList[/{ticket_id}]", [PermissionMiddleware::class], "list.support_tickets")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketsAdd[/{ticket_id}]", [PermissionMiddleware::class], "add.support_tickets")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketsView[/{ticket_id}]", [PermissionMiddleware::class], "view.support_tickets")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketsEdit[/{ticket_id}]", [PermissionMiddleware::class], "edit.support_tickets")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/SupportTicketsDelete[/{ticket_id}]", [PermissionMiddleware::class], "delete.support_tickets")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SupportTicketsDelete");
    }
}
