<?php return \Symfony\Component\VarExporter\Internal\Hydrator::hydrate(
    $o = [
        clone (($p = &\Symfony\Component\VarExporter\Internal\Registry::$prototypes)['PHPMaker2024\\AMS\\Attributes\\Map'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\AMS\\Attributes\\Map')),
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone $p['PHPMaker2024\\AMS\\Attributes\\Map'],
        clone ($p['PHPMaker2024\\AMS\\Attributes\\Get'] ?? \Symfony\Component\VarExporter\Internal\Registry::p('PHPMaker2024\\AMS\\Attributes\\Get')),
        clone $p['PHPMaker2024\\AMS\\Attributes\\Get'],
    ],
    null,
    [
        'PHPMaker2024\\AMS\\Attributes\\Map' => [
            'methods' => [
                [
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'OPTIONS',
                ],
                [
                    'POST',
                    'OPTIONS',
                ],
                [
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'DELETE',
                    'OPTIONS',
                ],
                [
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                    'POST',
                    'OPTIONS',
                ],
                [
                    'GET',
                ],
                [
                    'GET',
                ],
            ],
            'pattern' => [
                '/login',
                '/list/{table}[/{params:.*}]',
                '/view/{table}[/{params:.*}]',
                '/add/{table}[/{params:.*}]',
                '/edit/{table}[/{params:.*}]',
                '/delete/{table}[/{params:.*}]',
                '/register',
                '/file/{table}/{param}[/{key:.*}]',
                '/export[/{param}[/{table}[/{key:.*}]]]',
                '/upload',
                '/jupload',
                '/session',
                '/lookup[/{params:.*}]',
                '/chart[/{params:.*}]',
                '/permissions/{level}',
                '/push/{action}',
                '/twofa/{action}[/{parm}]',
                '/metadata',
                '/chat/{value:[01]}',
            ],
            'handler' => [
                'PHPMaker2024\\AMS\\ApiController:login',
                'PHPMaker2024\\AMS\\ApiController:list',
                'PHPMaker2024\\AMS\\ApiController:view',
                'PHPMaker2024\\AMS\\ApiController:add',
                'PHPMaker2024\\AMS\\ApiController:edit',
                'PHPMaker2024\\AMS\\ApiController:delete',
                'PHPMaker2024\\AMS\\ApiController:register',
                'PHPMaker2024\\AMS\\ApiController:file',
                'PHPMaker2024\\AMS\\ApiController:export',
                'PHPMaker2024\\AMS\\ApiController:upload',
                'PHPMaker2024\\AMS\\ApiController:jupload',
                'PHPMaker2024\\AMS\\ApiController:session',
                'PHPMaker2024\\AMS\\ApiController:lookup',
                'PHPMaker2024\\AMS\\ApiController:exportchart',
                'PHPMaker2024\\AMS\\ApiController:permissions',
                'PHPMaker2024\\AMS\\ApiController:push',
                'PHPMaker2024\\AMS\\ApiController:twofa',
                'PHPMaker2024\\AMS\\ApiController:metadata',
                'PHPMaker2024\\AMS\\ApiController:chat',
            ],
            'middleware' => [
                [
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                ],
                [
                    'PHPMaker2024\\AMS\\ApiPermissionMiddleware',
                    'PHPMaker2024\\AMS\\JwtMiddleware',
                ],
            ],
            'name' => [
                'login',
                'list',
                'view',
                'add',
                'edit',
                'delete',
                'register',
                'file',
                'export',
                'upload',
                'jupload',
                'session',
                'lookup',
                'chart',
                'permissions',
                'push',
                'twofa',
                'metadata',
                'chat',
            ],
            'options' => [
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
                [],
            ],
        ],
    ],
    [
        $o[0],
        $o[1],
        $o[2],
        $o[3],
        $o[4],
        $o[5],
        $o[6],
        $o[7],
        $o[8],
        $o[9],
        $o[10],
        $o[11],
        $o[12],
        $o[13],
        $o[14],
        $o[15],
        $o[16],
        $o[17],
        $o[18],
    ],
    []
);