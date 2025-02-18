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

class ClientContractsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ClientContractsList[/{contract_id}]", [PermissionMiddleware::class], "list.client_contracts")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContractsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ClientContractsAdd[/{contract_id}]", [PermissionMiddleware::class], "add.client_contracts")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContractsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ClientContractsView[/{contract_id}]", [PermissionMiddleware::class], "view.client_contracts")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContractsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ClientContractsEdit[/{contract_id}]", [PermissionMiddleware::class], "edit.client_contracts")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContractsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ClientContractsDelete[/{contract_id}]", [PermissionMiddleware::class], "delete.client_contracts")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientContractsDelete");
    }
}
