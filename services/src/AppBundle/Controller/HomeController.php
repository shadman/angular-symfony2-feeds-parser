<?php
namespace AppBundle\Controller;

use AppBundle\Model\FeedsCollection;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Services\Utils\ServiceFeedParsing;

/**
 * Rest controller for feeds
 *
 * @package AppBundle\Controller
 */
class HomeController extends FOSRestController {
	
    /**
     * Get feeds data.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return json
     */
    public function getFeedsAction(Request $request, ParamFetcherInterface $paramFetcher) {

	$url = $request->query->get('feed_url'); 

	//$url = 'http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=5'; //Site Url
	//$url = 'http://localhost/productfeed.xml'; //Test File

	$service = new ServiceFeedParsing();
	$results = $service->getFeedRecords($url);

	$data = new FeedsCollection();
	$data->setProducts($results['products']);	

//    $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
//    $responseHeaders->set('Access-Control-Allow-Origin', '*');
//    $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');


	return new Response($data->toJson(), 200, array('Content-Type'=>'application/json'));

    }
	
}
