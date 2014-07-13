<?php

class GooglePlayAPI {

	private $pythonAPILocation = "/opt/googleplay-api/";
	private $tmpFile = "tmpresults.csv";

	public function search($str, $nbrResults = 20, $page = 0) {
		$page *= $nbrResults;
		$command = $this->command("search", array($str, $nbrResults, $page), true);
		system($command);
		
		$csv = new Kiss\Csv\CSV($this->tmpFile, true, ";");

		return $csv;
	}

	public function download($folder, $appid, $versionCode = NULL, $resultFolder = __DIR__) {
		$resultUrl .= $folder . $appid;
		if($versionCode !== NULL)
			$resultUrl .= "_".$versionCode.".apk";
		else
			$resultUrl .= ".apk";

		if(!file_exists($resultUrl)) {
			$command = $this->command("download", array($appid, $resultUrl));
			system($command);
		}

		return $resultUrl;
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
