<?php
if(!function_exists("getTimeFormat")) {
	function getTimeFormat($str) {
		$mydate = new \DateTime($str);
		$mydate->modify('+7 hours');

		return $mydate->format('H:i d/m/Y');
	}
}


