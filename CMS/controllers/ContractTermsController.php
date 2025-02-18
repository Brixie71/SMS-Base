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

class ContractTermsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ContractTermsList[/{term_id}]", [PermissionMiddleware::class], "list.contract_terms")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ContractTermsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ContractTermsAdd[/{term_id}]", [PermissionMiddleware::class], "add.contract_terms")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ContractTermsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ContractTermsView[/{term_id}]", [PermissionMiddleware::class], "view.contract_terms")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ContractTermsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ContractTermsEdit[/{term_id}]", [PermissionMiddleware::class], "edit.contract_terms")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ContractTermsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ContractTermsDelete[/{term_id}]", [PermissionMiddleware::class], "delete.contract_terms")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ContractTermsDelete");
    }
}
