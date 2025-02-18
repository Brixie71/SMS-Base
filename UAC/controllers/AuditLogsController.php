<?php

namespace PHPMaker2024\UAC;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\UAC\Attributes\Delete;
use PHPMaker2024\UAC\Attributes\Get;
use PHPMaker2024\UAC\Attributes\Map;
use PHPMaker2024\UAC\Attributes\Options;
use PHPMaker2024\UAC\Attributes\Patch;
use PHPMaker2024\UAC\Attributes\Post;
use PHPMaker2024\UAC\Attributes\Put;

class AuditLogsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/AuditLogsList[/{id}]", [PermissionMiddleware::class], "list.audit_logs")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AuditLogsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/AuditLogsAdd[/{id}]", [PermissionMiddleware::class], "add.audit_logs")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AuditLogsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/AuditLogsView[/{id}]", [PermissionMiddleware::class], "view.audit_logs")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AuditLogsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/AuditLogsEdit[/{id}]", [PermissionMiddleware::class], "edit.audit_logs")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AuditLogsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/AuditLogsDelete[/{id}]", [PermissionMiddleware::class], "delete.audit_logs")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AuditLogsDelete");
    }
}
