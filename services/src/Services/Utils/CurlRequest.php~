<?php
namespace Services\Utils;

class CurlRequest {
	
	public function getRequest($url) {
		
		// Sample Response
		//return '';
		
		// Live Response
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json')); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
		$response = curl_exec($ch);
		
		curl_close($ch);
		return $response;
    }
	
}
