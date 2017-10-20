<?php

use Slim\Http\Request;
use Slim\Http\Response;

include_once 'Service\DataService.php';

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Obtention de la date du jour
    $today = getdate();

    // Appel au service
    $dataService = new DataService();
    $data = $dataService->GetDataByDate($today);
    $args = array_merge($args, $data);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
