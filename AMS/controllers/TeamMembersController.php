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

class TeamMembersController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/TeamMembersList[/{keys:.*}]", [PermissionMiddleware::class], "list.team_members")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "TeamMembersList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/TeamMembersAdd[/{keys:.*}]", [PermissionMiddleware::class], "add.team_members")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "TeamMembersAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/TeamMembersView[/{keys:.*}]", [PermissionMiddleware::class], "view.team_members")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "TeamMembersView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/TeamMembersEdit[/{keys:.*}]", [PermissionMiddleware::class], "edit.team_members")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "TeamMembersEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/TeamMembersDelete[/{keys:.*}]", [PermissionMiddleware::class], "delete.team_members")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $this->getKeyParams($args), "TeamMembersDelete");
    }

    // Get keys as associative array
    protected function getKeyParams($args)
    {
        global $RouteValues;
        if (array_key_exists("keys", $args)) {
            $sep = Container("team_members")->RouteCompositeKeySeparator;
            $keys = explode($sep, $args["keys"]);
            if (count($keys) == 2) {
                $keyArgs = array_combine(["team_id","user_id"], $keys);
                $RouteValues = array_merge(Route(), $keyArgs);
                $args = array_merge($args, $keyArgs);
            }
        }
        return $args;
    }
}
