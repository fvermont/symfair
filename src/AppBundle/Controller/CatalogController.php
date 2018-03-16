<?php
// src/AppBundle/Controller/AirAzurController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\Dao;
use AppBundle\Service\Util;

class CatalogController extends Controller
{
    public function getFlyListAction()
    {        
        $aRes = $this->get(Dao::class)->getVols();
        //var_dump($aRes);
        /**/
        foreach ($aRes as $key => $value) {
            $aAction = array();
            $aAction[] = '<button type="button"
                            class="btn btn-primary btn-sm" 
                            onclick="showResForm(\''.$value['Vol'].'\', \''.$value['date_dep'].'\')">
            <span class="glyphicon glyphicon-plus"></span> Réserver
        </button>';
            //
            unset($aRes[$key]['date_dep']);
            //
            $aRes[$key]['&nbsp;'] = implode('&nbsp;',$aAction);
        
        }
        /**/
        //
        //return $this->render('<p>Hello Titi</p>'); // if twig is used        
        //return new Response("<html><body>Hello titi !!!! </body></html>");
        return new Response($this->get(Util::class)->mkHtmlTable($aRes));
    }

    /**
     * @Route("/catalog/getItem", name="airazur_catalog_getItem")
     */    
    public function getItemAction()
    {        
        $aRes = $this->get(Dao::class)->getVolRes([':vlg_num' => $_REQUEST['vlg_num'],
            ':date_dep' => $_REQUEST['date_dep']]);
        //
        return $this->json($aRes);
    }    
} 