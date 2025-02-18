<?php

namespace PHPMaker2024\AMS;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\AMS\Attributes\Delete;
use PHPMaker2024\AMS\Attributes\Get;
use PHPMaker2024\AMS\Attributes\Map;
use PHPMaker2024\AMS\Attributes\Options;
use PHPMaker2024\AMS\Attributes\Patch;
use PHPMaker2024\AMS\Attributes\Post;
use PHPMaker2024\AMS\Attributes\Put;

class DepartmentsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/DepartmentsList[/{department_id}]", [PermissionMiddleware::class], "list.departments")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepartmentsList");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/DepartmentsView[/{department_id}]", [PermissionMiddleware::class], "view.departments")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "DepartmentsView");
    }
}
