<?php

namespace GapaBundle\Controller;

use GapaBundle\Entity\Location;
use GapaBundle\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction(Request $request = null)
    {
        return $this->render('@Gapa/Default/index.html.twig');
    }

    public function ajaxGetVehicleDataAction(Request $request){

        $serializer = $this->prepareSerializer();
        $vehicle = new Vehicle();

        $req = $request->request;

        $vehicle->setName($req->get('name'))
                ->setPlate($req->get('plate'));

        $session = $request->getSession();

        $session->set('name', $req->get('name'));
        $session->set('plate', $req->get('plate'));

        $response = new Response();
        $response->setContent($serializer->serialize($vehicle, 'json'));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function responseTrackDataAction(){

        $serializer = $this->prepareSerializer();
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository('GapaBundle:Location')->findAll();

        foreach($data as $index => $location){
            $locArr[$index]['lat'] = $location->getLatitude();
            $locArr[$index]['lon'] = $location->getLongitude();
        }

        $locJson = $serializer->serialize($locArr, 'json');


        return new JsonResponse($locArr);
    }

    public function ajaxGetPositionDataAction(Request $request){
        $req = $request->getContent();
        $serializer = $this->prepareSerializer();
        $data = $serializer->decode($req, 'json');


        $location = new Location();
        $location->setLatitude((float)$data['lat'])
            ->setLongitude((float)$data['lon'])
            ->setAccuracy((integer)$data['acc'])
            ->setAltitude((float)$data['alt'])
            ->setAltAcc((integer)$data['altAcc'])
            ->setTime(null);
        if(!is_nan($data['dir'])){
            $location->setDirection((integer)$data['dir']);
        }
        if(!is_nan($data['spd'])){
            $location->setSpeed((integer)$data['spd']);
        }

        var_dump($location);

        $em = $this->getDoctrine()->getManager();
        $em->persist($location);
        $em->flush();

        return new JsonResponse();

    }



    private function prepareSerializer(){
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        return new Serializer($normalizers, $encoders);
    }
}
