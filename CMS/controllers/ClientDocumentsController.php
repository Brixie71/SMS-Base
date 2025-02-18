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

class ClientDocumentsController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/ClientDocumentsList[/{document_id}]", [PermissionMiddleware::class], "list.client_documents")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientDocumentsList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/ClientDocumentsAdd[/{document_id}]", [PermissionMiddleware::class], "add.client_documents")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientDocumentsAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/ClientDocumentsView[/{document_id}]", [PermissionMiddleware::class], "view.client_documents")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientDocumentsView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/ClientDocumentsEdit[/{document_id}]", [PermissionMiddleware::class], "edit.client_documents")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientDocumentsEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/ClientDocumentsDelete[/{document_id}]", [PermissionMiddleware::class], "delete.client_documents")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "ClientDocumentsDelete");
    }
}
