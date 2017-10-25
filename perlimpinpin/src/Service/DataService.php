<?php
# Service d'accès aux données
class DataService
{
	### Constructeur
	public function __construct()
	{

	}

	### Récupère l'expresion et sa définition en fonction de la date
	# https://www.francebleu.fr/infos/insolite/top-15-des-expressions-en-breton-qu-utilise-au-quotidien-1484578069
	function GetDataByDate($dateTime)
	{
		$result = array("expression" => "Il est parti en riboul à Bres’",
						"definition" => "Quelqu’un qui est allé en piste, faire la fête quoi, et il a choisi d’aller à Brest",
						"imageUri" => "https://sdz-upload.s3.amazonaws.com/prod/users/avatars/alexandrafranco-tux-redhat.png");
		return $result;
	}
}