<?php

namespace PHPMaker2024\UAC;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\UAC\Attributes\Delete;
use PHPMaker2024\UAC\Attributes\Get;
use PHPMaker2024\UAC\Attributes\Map;
use PHPMaker2024\UAC\Attributes\Options;
use PHPMaker2024\UAC\Attributes\Patch;
use PHPMaker2024\UAC\Attributes\Post;
use PHPMaker2024\UAC\Attributes\Put;

/**
 * UserAccess controller
 */
class UserAccessController extends ControllerBase
{
    // custom
    #[Map(["GET", "POST", "OPTIONS"], "/UserAccess[/{params:.*}]", [PermissionMiddleware::class], "custom.UserAccess")]
    public function custom(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UserAccess");
    }
}
