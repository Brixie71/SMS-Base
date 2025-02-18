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

class AggregatedAuditLogsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/AggregatedAuditLogsList[/{aggregated_id}]", [PermissionMiddleware::class], "list.aggregated_audit_logs")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AggregatedAuditLogsList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/AggregatedAuditLogsView[/{aggregated_id}]", [PermissionMiddleware::class], "view.aggregated_audit_logs")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "AggregatedAuditLogsView");
    }
}
