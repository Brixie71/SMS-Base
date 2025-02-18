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

class ContractServicesController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ContractServicesList[/{keys:.*}]", [PermissionMiddleware::class], "list.contract_services")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "ContractServicesList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ContractServicesAdd[/{keys:.*}]", [PermissionMiddleware::class], "add.contract_services")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "ContractServicesAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ContractServicesView[/{keys:.*}]", [PermissionMiddleware::class], "view.contract_services")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "ContractServicesView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ContractServicesEdit[/{keys:.*}]", [PermissionMiddleware::class], "edit.contract_services")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "ContractServicesEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ContractServicesDelete[/{keys:.*}]", [PermissionMiddleware::class], "delete.contract_services")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "ContractServicesDelete");
    }

    // Get keys as associative array
    protected function getKeyParams($args)
    {
        global $RouteValues;
        if (array_key_exists("keys", $args)) {
            $sep = Container("contract_services")->RouteCompositeKeySeparator;
            $keys = explode($sep, $args["keys"]);
            if (count($keys) == 2) {
                $keyArgs = array_combine(["contract_id","service_id"], $keys);
                $RouteValues = array_merge(Route(), $keyArgs);
                $args = array_merge($args, $keyArgs);
            }
        }
        return $args;
    }
}
