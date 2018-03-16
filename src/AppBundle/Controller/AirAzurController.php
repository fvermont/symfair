<?php
// src/AppBundle/Controller/AirAzurController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AirAzurController extends Controller
{
    private function checkSession($session) 
    {
        $timeout = 300; // 5 * 60 seconds
        //
        if ($session->has('valid_user') && $session->has('login_time')) {
            if (time() < $session->get('login_time') + 300 )
                return true;
            else
                $this->addFlash('warning', "Session expirée");    
        }
        else {
            $this->addFlash('warning', "Session invalide!");
        }
        //
        return false;
    }
    
    /**
     * @Route("/airazur/login", name="airazur_login")
     */
    public function loginAction()
    {        
        return $this->render('air_azur/login.html.twig');
    }

    /**
     * @Route("/airazur/home", name="airazur_home")
     */    
    public function homeAction(SessionInterface $session)
    {        
        if($this->checkSession($session))
            return $this->render('air_azur/home.html.twig');
        else
            return $this->render('air_azur/login.html.twig');
    }

    /**
     * @Route("/airazur/reservation", name="airazur_reservation")
     */
    public function reservationAction(SessionInterface $session)
    {
        if($this->checkSession($session))
            return $this->render('air_azur/reservation.html.twig');
        else
            return $this->render('air_azur/login.html.twig');        
    }

    /**
     * @Route("/airazur/catalog", name="airazur_catalog")
     */
    public function catalogAction(SessionInterface $session)
    {
        if($this->checkSession($session))
            return $this->render('air_azur/catalog.html.twig');
        else
            return $this->render('air_azur/login.html.twig');
    }

    /**     
     * @Route("/airazur/{any}")
     */    
    public function anyAction($stuff)
    {        
        return $this->redirectToRoute('airazur_logout');
    }

}