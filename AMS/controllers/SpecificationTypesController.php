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

class SpecificationTypesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/SpecificationTypesList[/{spec_type_id}]", [PermissionMiddleware::class], "list.specification_types")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SpecificationTypesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/SpecificationTypesAdd[/{spec_type_id}]", [PermissionMiddleware::class], "add.specification_types")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SpecificationTypesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/SpecificationTypesView[/{spec_type_id}]", [PermissionMiddleware::class], "view.specification_types")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SpecificationTypesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/SpecificationTypesEdit[/{spec_type_id}]", [PermissionMiddleware::class], "edit.specification_types")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SpecificationTypesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/SpecificationTypesDelete[/{spec_type_id}]", [PermissionMiddleware::class], "delete.specification_types")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SpecificationTypesDelete");
    }
}
