<?php 
if(!defined('ROOT')) exit('No direct script access allowed');

if(!function_exists("printReportPreform")) {

	loadModuleLib("reports", "api");
	loadModuleLib("forms", "api");

	function getPreformTypes() {
		return ["report"];
	}

	function printPreform($src, $type = "report") {
		switch($type) {
			case "report":case "reports":
				printReportPreform($src);
			break;
			default:
				echo "<h3 class='text-center errormsg'>Preform Type `{$type}` not Supported</h3>";
			break;
		}
	}

	function printReportPreform($reportSrc) {
		if(is_array($reportSrc)) $reportConfig = $reportSrc;
		else $reportConfig = findReport($reportSrc);

		if(!is_array($reportConfig) || count($reportConfig)<=2) {
			trigger_logikserror("Corrupt report defination");
			return false;
		}

		if(!isset($reportConfig['preform'])) {
			trigger_logikserror("Preform block not found for the report");
			return false;
		}

		$page = current(explode("/", PAGE));
		if(!in_array($page, ["modules", "popup", "singlepage", "single"])) {
			$page = "modules";
		}

		if(!isset($reportConfig['dbkey'])) $reportConfig['dbkey']="app";
		if(!isset($reportConfig['preform']['dbkey'])) $reportConfig['preform']['dbkey']=$reportConfig['dbkey'];

		$reportConfig['preform']['source'] = [
			"type"=> "php",
			"file"=>__DIR__."/data.php"
		];
		if(!isset($reportConfig['preform']['gotolink'])) {
			$reportConfig['preform']['gotolink'] = _link("{$page}/reports/{$reportConfig['srckey']}");
		}
		$reportConfig['preform']['form-target'] = _link("{$page}/reports/{$reportConfig['srckey']}");
		$reportConfig['preform']['template'] = __DIR__."/templates/reports.php";

		$file = $reportConfig['sourcefile'];
		$fileName = basename($file);

		$reportConfig['preform']['sourcefile'] = $file;
		$reportConfig['preform']['srckey'] = $fileName;
		$reportConfig['preform']['formkey']=md5(session_id().$file);

		// $reportConfig['preform']['simpleform'] = true;
		$reportConfig['preform']['disable_simpleform'] = true;

		printForm("search",$reportConfig['preform']);//,$dbKey="app",$whereCondition=false,$params=[]
	}
}
?>