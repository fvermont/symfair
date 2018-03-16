<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\Dao;
use AppBundle\Entity\Agence;

class AgenceController extends Controller
{    
    /**
     * @Route("/agence/getList", name="airazur_agence_list")
     */    
    public function getAgenceListAction()
    {        
        $aRes = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Agence')
            ->createQueryBuilder('a')
            ->getQuery()
            ->getArrayResult();
        //
        return $this->json($aRes);
    }

    /**
     * @Route("/agence/add", name="airazur_agence_add")
     */    
    public function addAction()
    {   
        //------------------ using Doctrine
        $agence = new Agence();
        $agence->setCodeAgence($_REQUEST['code']);
        $agence->setMotDePasse($_REQUEST['pwd']);
        //
        $em = $this->getDoctrine()->getManager();
        //
        $em->persist($client);
        $em->flush();
        //
        return $this->json('success');
    }    
}