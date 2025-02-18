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

class UnitCategoriesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/UnitCategoriesList[/{category_id}]", [PermissionMiddleware::class], "list.unit_categories")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UnitCategoriesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/UnitCategoriesAdd[/{category_id}]", [PermissionMiddleware::class], "add.unit_categories")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UnitCategoriesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/UnitCategoriesView[/{category_id}]", [PermissionMiddleware::class], "view.unit_categories")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UnitCategoriesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/UnitCategoriesEdit[/{category_id}]", [PermissionMiddleware::class], "edit.unit_categories")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UnitCategoriesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/UnitCategoriesDelete[/{category_id}]", [PermissionMiddleware::class], "delete.unit_categories")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "UnitCategoriesDelete");
    }
}
