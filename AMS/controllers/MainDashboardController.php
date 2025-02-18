<?php

namespace PHPMaker2024\AMS;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\AMS\Attributes\Delete;
use PHPMaker2024\AMS\Attributes\Get;
use PHPMaker2024\AMS\Attributes\Map;
use PHPMaker2024\AMS\Attributes\Options;
use PHPMaker2024\AMS\Attributes\Patch;
use PHPMaker2024\AMS\Attributes\Post;
use PHPMaker2024\AMS\Attributes\Put;

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
