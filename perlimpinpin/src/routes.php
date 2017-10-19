<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Obtention de la date du jour
    $today = getdate();

    // Appel à la couche middleware
    $citation = GetCitationByDate($today);
    $args["citation"] = $citation;

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
