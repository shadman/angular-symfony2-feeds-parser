<?php
namespace Services\Utils;

use Services\Utils\CurlRequest;

class ServiceFeedParsing {

	public function __construct() {
		$maximum_records = 500;
	}


	/*
	* Get records from xml/json URL  
	*/
    	public function getFeedRecords($url, $type='xml', $limit=100) {
		$request = new CurlRequest();
		parse_str($url);

		// Restricting limit on per request, not allowing morethan defined max limit at a time
		if ( $limit > $maximum_records ) $url = $url."&limit=$maximum_records";

		$response = $request->getRequest($url);

		if ($type=="json")		
			$result = $this->parseJsonData($response);
		else
			$result = $this->parseXmlData($response);

		return $result;
		
    	}
	

	/*
	* Parsing Json
	*/
	public function parseJsonData($data) {
		
		$index = 0;

		$data = json_decode($data);
		$result['products'] = array();
		
		if (!isset($data)) return $result;
		
		foreach($data->products as $items){
		    $result['products'] = $this->settingJsonResponse($index, $items); 
		    $index++;
		}
		return $result;
	}
	
	/*
	* Parsing XML
	*/
	public function parseXmlData($data) {
		
		$index = 0;

		$data = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA | LIBXML_NOBLANKS); //("Error: Cannot create object");

		$result['products'] = array();
		
		if ( !isset($data) || !is_object($data) ) return $result;

		foreach($data->product as $items){
			$result['products'] = $this->settingXmlReponse($index, $items); 
			$index++;
		}

		return $result;
	}

	/*
	* Setting Json Response
	*/
	function settingJsonResponse($index, $items) {

		$data[$index]['id'] = (isset($items->ID))?$items->ID:'';
		$data[$index]['name'] = (isset($items->name))?$items->name:'';
		$data[$index]['description'] = (isset($items->description))?$items->description:'';
		$data[$index]['price']['currency'] = (isset($items->price->currency))?$items->price->currency:'';
		$data[$index]['price']['amount'] = (isset($items->price->amount))?$items->price->amount:'';
		$data[$index]['url'] = (isset($items->URL))?$items->URL:'';
		$data[$index]['image_url'] = (isset($items->images))?$items->images[0]:'';

		$data[$index]['categories'] = array();
		if (isset($items->categories) ){
			foreach ($items->categories as $category) {
				$data[$index]['categories'][] = $category;
			}
		}

		return $data;

	}

	/*
	* Setting XML Response
	*/
	function settingXmlReponse($index, $items) {

		$data[$index]['id'] = (isset($items->productID)) ? $this->dataToString($items->productID) : '';
		$data[$index]['name'] = (isset($items->name)) ? $this->dataToString($items->name) : '';
		$data[$index]['description'] = (isset($items->description)) ? $this->dataToString($items->description) : '';
		$data[$index]['price']['currency'] = (isset($items->price->attributes()->currency)) ? $this->dataToString($items->price->attributes()->currency) : 'EUR';
		$data[$index]['price']['amount'] = (isset($items->price)) ? $this->dataToString($items->price) : '';
		$data[$index]['url'] = (isset($items->productURL)) ? $this->dataToString($items->productURL) : '';
		$data[$index]['image_url'] = (isset($items->imageURL)) ? $this->dataToString($items->imageURL) : '';

		$data[$index]['categories'] = array();
		if (isset($items->categories) ){
			foreach ($items->categories as $category) {
				$data[$index]['categories'][] = $this->dataToString($category->category);
			}
		}

		$result['products'] = $data;

	}

	/*
	* Converting XML Object to String
	*/
	function dataToString($object=null) {
		return $object->__toString();
	}


	
}
