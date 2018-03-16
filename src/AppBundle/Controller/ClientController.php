<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\Dao;
use AppBundle\Entity\Client;

class ClientController extends Controller
{    
    /**
     * @Route("/client/getClientList", name="airazur_client_list")
     */    
    public function getClientListAction()
    {        
        //$aRes = $this->get(Dao::class)->getClients();
        //
        $aRes = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Client')
            ->createQueryBuilder('c')
            ->getQuery()
            ->getArrayResult();
        //
        return $this->json($aRes);
    }

    /**
     * @Route("/client/add", name="airazur_client_add")
     */    
    public function addAction()
    {   /*
        //------------------ dao     
        $aRes = $this->get(Dao::class)->addClient([':prenom' => $_REQUEST['prenom'],
            ':nom' => $_REQUEST['nom'],
            ':adr_cp' => $_REQUEST['adr_cp'],
            ':adr_rue' => $_REQUEST['adr_rue'],
            ':adr_ville' => $_REQUEST['adr_ville']]);
        */
        //------------------ using Doctrine
        $client = new Client();
        $client->setPrenom($_REQUEST['prenom']);
        $client->setNom($_REQUEST['nom']);
        $client->setAdrCp($_REQUEST['adr_cp']);
        $client->setAdrRue($_REQUEST['adr_rue']);
        $client->setAdrVille($_REQUEST['adr_ville']);
        //
        $em = $this->getDoctrine()->getManager();
        //
        $em->persist($client);
        $em->flush();
        //
        return $this->json('success');
    }    
}