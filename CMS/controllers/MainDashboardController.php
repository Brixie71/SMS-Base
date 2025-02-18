<?php

namespace PHPMaker2024\CMS;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\CMS\Attributes\Delete;
use PHPMaker2024\CMS\Attributes\Get;
use PHPMaker2024\CMS\Attributes\Map;
use PHPMaker2024\CMS\Attributes\Options;
use PHPMaker2024\CMS\Attributes\Patch;
use PHPMaker2024\CMS\Attributes\Post;
use PHPMaker2024\CMS\Attributes\Put;

/**
 * MainDashboard controller
 */
class MainDashboardController extends ControllerBase
{
    // custom
    #[Map(["GET", "POST", "OPTIONS"], "/MainDashboard[/{params:.*}]", [PermissionMiddleware::class], "custom.MainDashboard")]
    public function custom(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MainDashboard");
    }
}
