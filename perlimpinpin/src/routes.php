<?php

use Slim\Http\Request;
use Slim\Http\Response;

include_once 'Service\DataService.php';

// Routes
$app->get('/[{date}]', function (Request $request, Response $response, array $args) {
    // la date doit être au format yyyy-mm-dd

    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    if(array_key_exists("date", $args) && validateDate($args["date"]))
    {
    	$date = new DateTime($args["date"]);
    }
    else
    {
    	// Si la date n'est pas initialisée ou n'est pas valide, on fixe à aujourd'hui
    	$today = getdate();
    	$date = new DateTime($today["year"]."-".$today["mon"]."-".$today["mday"]);
    }

    $args["date"] = $date->format("Y-m-d");

    // On calcule les dates des jours suivants et précédents
    $dateBefore = clone $date;
    $dateBefore->sub(new DateInterval('P1D'));
    $args["dateBefore"] = $dateBefore->format("Y-m-d");

    $dateAfter = clone $date;
    $dateAfter->add(new DateInterval('P1D'));
    $args["dateAfter"] = $dateAfter->format("Y-m-d");

    // Appel au service
    $dataService = new DataService();
    $data = $dataService->GetDataByDate($date);
    $args = array_merge($args, $data);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// Méthode de validation de date
function validateDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}
