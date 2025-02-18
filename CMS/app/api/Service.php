<?php
namespace PHPMaker2024\CMS;

$app->get("/Service", function ($request, $response, $args) {
    $apiService = new Service\ApiService();
    $result = $apiService->generateOAI();
    return $response->write($result);
}); // ->add($jwtMiddleware)

