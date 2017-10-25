<?php

use Slim\Http\Request;
use Slim\Http\Response;

include_once 'Service\DataService.php';
include_once 'Service\DateBuildingService.php';

// Routes
$app->get('/[{date}]', function (Request $request, Response $response, array $args) {
    // la date doit être au format yyyy-mm-dd

    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $dateBuildingService = new DateBuildingService();

    // Par défaut, on initialise la date à aujourd'hui
    $today = getdate();
    $dateTime = new DateTime($today["year"]."-".$today["mon"]."-".$today["mday"]);

    // Si l'argument date est correct, on l'utilise
    if(array_key_exists("date", $args) && $dateBuildingService->isStringDateFormatValid($args["date"]) 
		&& $dateBuildingService->isDateTimeNotAfterToday(new DateTime($args["date"]) == false))
    {	
    	$dateTime = new DateTime($args["date"]);
    }

    $dates = $dateBuildingService->computeDates($dateTime);

    // Appel au service qui renvoie les donnée pour la date à afficher
    $dataService = new DataService();
    $data = $dataService->GetDataByDate($dateTime);

    $args = array_merge($args, $dates);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
