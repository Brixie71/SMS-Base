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

class ServiceRequestsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ServiceRequestsList[/{request_id}]", [PermissionMiddleware::class], "list.service_requests")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceRequestsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ServiceRequestsAdd[/{request_id}]", [PermissionMiddleware::class], "add.service_requests")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceRequestsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ServiceRequestsView[/{request_id}]", [PermissionMiddleware::class], "view.service_requests")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceRequestsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ServiceRequestsEdit[/{request_id}]", [PermissionMiddleware::class], "edit.service_requests")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceRequestsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ServiceRequestsDelete[/{request_id}]", [PermissionMiddleware::class], "delete.service_requests")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ServiceRequestsDelete");
    }
}
