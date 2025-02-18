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

class SystemsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/SystemsList[/{system_id}]", [PermissionMiddleware::class], "list.systems")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SystemsList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/SystemsView[/{system_id}]", [PermissionMiddleware::class], "view.systems")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SystemsView");
    }
}
