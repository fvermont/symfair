<?php
// src/AppBundle/Controller/TestController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{

    
    /**
     * @Route("/testor/")
     */    
    public function titiAction()
    {        
        return new Response(
            '<html><body>unique titi: '.uniqid().'</body></html>'
        );
    }    

    /**
     * @Route("/testor/number")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);
        /*
        return new Response(
            '<html><body>Test number: '.$number.'</body></html>'
        );
        */
        return $this->render('test/testor.html.twig', array(
            'number' => $number,
        ));
    }
    /**
     * @Route("/testor/{stuff}")
     */    
    public function anyAction($stuff)
    {        
        return new Response(
            "<html><body>Hello $stuff !!!! </body></html>"
        );
    }

    /**
     * @Route("/testor/{stuff}/getPage/{page}")
     */    
    public function anyPageAction($stuff, $page = 1)
    {        
        return new Response(
            "<html><body>Getting page $page for $stuff !!!! </body></html>"
        );
    }

    /**
     * @Route("/airazur/")
     */    
    public function homeAction()
    {        
        return $this->render('air_azur/home.html.twig');
    }    

}