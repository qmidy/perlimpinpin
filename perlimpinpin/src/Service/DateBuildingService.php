<?php
# Service permettant de valider les dates reçues en arguments et d'effectuer d'éventuels traitements
class DateBuildingService
{
	### Constructeur
	public function __construct()
	{

	}

	# Renvoie un booléen qui indique si la date est au bon format (true si c'est bon ; false sinon)
	function isStringDateFormatValid($date)
	{
    	$d = DateTime::createFromFormat('Y-m-d', $date);
    	return $d && $d->format('Y-m-d') === $date;
	}

	# Renvoie un booléen qui indique si la date est d'un jour précédent ou égal à aujourd'hui
	function isDateTimeNotAfterToday($dateTime)
	{
		$today = getdate();
    	$todayDateTime = new DateTime($today["year"]."-".$today["mon"]."-".$today["mday"]);

    	return ($dateTime <= $todayDateTime);
	}

	# Renvoie un tableau qui contient la date du jour précédent (dateBefore), la date courante (date) et la date suivante si elle existe (dateAfter)
	function computeDates($dateTime)
	{
		$result = array();

		$result["date"] = $dateTime->format("Y-m-d");

	    // On calcule les dates des jours suivants et précédents
	    $dateBefore = clone $dateTime;
	    $dateBefore->sub(new DateInterval('P1D'));
	    $result["dateBefore"] = $dateBefore->format("Y-m-d");

	    // TODO Checker si date != today
	    $dateAfter = clone $dateTime;
	    $dateAfter->add(new DateInterval('P1D'));
	    $result["dateAfter"] = $dateAfter->format("Y-m-d");

	    return $result;
	}
}