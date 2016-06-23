<?php
namespace AppBundle\Model;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class FeedsCollection {
	
    private $horizontal_carousel;	
	
    public function __construct() {
    }

    public function getProducts() {
        return $this->products;
    }

    public function setProducts($products) {
        return $this->products = $products;
    }

    public function toJson() {
	$encoders = array(new XmlEncoder(), new JsonEncoder());
	$normalizers = array(new ObjectNormalizer());
	$serializer = new Serializer($normalizers, $encoders);
	$data['result'] = array();
	$data['result'] = json_decode($serializer->serialize($this, 'json'),true);
	return json_encode($data);
    }
	
}
