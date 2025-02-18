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

class MeasurementUnitsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/MeasurementUnitsList[/{unit_id}]", [PermissionMiddleware::class], "list.measurement_units")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MeasurementUnitsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/MeasurementUnitsAdd[/{unit_id}]", [PermissionMiddleware::class], "add.measurement_units")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MeasurementUnitsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/MeasurementUnitsView[/{unit_id}]", [PermissionMiddleware::class], "view.measurement_units")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MeasurementUnitsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/MeasurementUnitsEdit[/{unit_id}]", [PermissionMiddleware::class], "edit.measurement_units")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MeasurementUnitsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/MeasurementUnitsDelete[/{unit_id}]", [PermissionMiddleware::class], "delete.measurement_units")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "MeasurementUnitsDelete");
    }
}
