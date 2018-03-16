<?php
// src/AppBundle/Controller/TestController.php
namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use AppBundle\Service\Dao;
use AppBundle\Entity\Agence;  

class UserController extends Controller
{  
    private function startSession($session) 
    {
        $session->start();
        $session->set('valid_user', true);
        $session->set('login_time', time());
    }
    
    private function endSession($session) 
    {
        $session->invalidate();
    }

    private function getCredentials($user, $pwd) 
    {      
        //return $this->get(Dao::class)->getCredendials($user, $pwd);

        $res = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Agence')
            ->createQueryBuilder('a')
            ->select('count(a)')
            ->where('a.codeAgence = :login')
            ->andWhere('a.motDePasse = :pwd')
            ->setParameter('login', $user)
            ->setParameter('pwd', $pwd)            
            ->getQuery()
            ->getSingleScalarResult();
        //
        return $res > 0;        
    }

    /**
     * @Route("/user/login", name="user_login")
     */    
    public function loginAction(Request $request, SessionInterface $session)
    {        
        $user = $request->get('user');
        $pwd = $request->get('password');
        //
        if($this->getCredentials($user, $pwd)) {
            $this->startSession($session);
            //
            return $this->redirectToRoute('airazur_home');
        }
        //
        $this->addFlash('warning', "Accès non autorisé!");
        return $this->redirectToRoute('airazur_login');            
        /*
        if ($user !== 'admin') {
            $this->addFlash('warning', "L'utilisateur '$user' n'a pas les droits d'accès !");
            return $this->redirectToRoute('airazur_login');
        }

        if ($pwd !== '1234') {
            $this->addFlash('warning', "Mauvais mot de passe !");
            return $this->redirectToRoute('airazur_login');
        }
        */
    }    

    /**
     * @Route("/user/logout", name="user_logout")
     */    
    public function logoutAction(SessionInterface $session)
    {        
        $this->endSession($session);
        //
        return $this->redirectToRoute('airazur_login');
    }
}