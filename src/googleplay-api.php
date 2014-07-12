<?php

require_once __DIR__ . '/vendor/autoload.php';

class GooglePlayAPI {

	private $pythonAPILocation = "/opt/googleplay-api/";
	private $tmpFile = "tmpresults.csv";

	public function search($str, $nbrResults = 20, $page = 0) {
		$page *= $nbrResults;
		$command = $this->command("search", array($str, $nbrResults, $page), true);
		system($command);
		
		$csv = new Kiss/Csv/CSV($this->tmpFile, true, ";");

		return $csv;
	}

	public function download($appid, $versionCode = NULL, $resultFolder = __DIR__) {
		$resultFolder .= "/packages/" . $appid;
		if($versionCode !== NULL)
			$resultFolder .= "_".$versionCode.".apk";
		else
			$resultFolder .= ".apk";

		if(!file_exists($resultFolder)) {
			$command = $this->command("download", array($appid, $resultFolder));
			system($command);
		}

		return $resultFolder;
	}
	
	public function command($command, $params, $redirectOutput = false) {
		if(is_array($params)) {
			$strparams = "";
			foreach($params as $param) {
				$strparams .= '"' . $param . '" ';
			}
			
			$params = $strparams;
		} else {
			$params = '"' . $params . '"';
		}

		if($redirectOutput)
			$redirect = " > " . $this->tmpFile;
		else
			$redirect = "";
			
		$command .= ".py ";		

		return "python ". $this->pythonAPILocation . $command . $params . $redirect;
	}
}

?>
