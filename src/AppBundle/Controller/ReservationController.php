<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Service\Dao;
use AppBundle\Service\Util;
use AppBundle\Service\Pdf;
use AppBundle\Entity\Reservation;  

class ReservationController extends Controller
{
    private function getReservationList()
    {
        $result = $this->get(Dao::class)->getReservations();
        //
        if(!is_array($result))
          return $result; // null or error message
        //
        //--------------------------- add buttons
        foreach($result as $k=>$v) {
          $aAction = array();
          $aAction[] = '<button type="button"
                              class="btn btn-primary btn-sm" onclick="editRes('.$v['gnc_id'].', '.$v['rsr_num'].')">
          <span class="glyphicon glyphicon-pencil"></span>
        </button>';
          $aAction[] = '<button type="button"
                               class="btn btn-primary btn-sm" onclick="deleteRes('.$v['gnc_id'].', '.$v['rsr_num'].')" >
          <span class="glyphicon glyphicon-trash"></span>
        </button>';
          $aAction[] = '<button type="button"
                               class="btn btn-primary btn-sm" onclick="getPdf('.$v['gnc_id'].', '.$v['rsr_num'].')">
          <span class="glyphicon glyphicon-file"></span>
        </button>';
          //
          unset($result[$k]['gnc_id']);
          unset($result[$k]['rsr_num']);
          //
          $result[$k]['&nbsp;'] = implode( '&nbsp;', $aAction);
        }
        //
        return $this->get(Util::class)->mkHtmlTable($result);
    }

    /**
     * @Route("/reservation/getList", name="airazur_reservation_getList")
     */    
    public function getListAction()
    {
        return new Response($this->getReservationList());
    }

    /**
     * @Route("/reservation/add", name="airazur_reservation_add")
     */    
    public function addAction()
    {        
        $aRes = $this->get(Dao::class)->addReservation([':cln_id' => $_REQUEST['cln_id'],
            ':date_dep' => $_REQUEST['date_dep'],
            ':vlg_num' => $_REQUEST['vlg_num'],
            ':nbr_places_res' => $_REQUEST['nbr_places_res']]);
        //
        
        return new Response($aRes ? 'success' : 'error');
    }

    /**
     * @Route("/reservation/update", name="airazur_reservation_update")
     */    
    public function updateAction()
    {        
        $aRes = $this->get(Dao::class)->updateReservation([':gnc_id' => $_REQUEST['gnc_id'],
            ':rsr_num' => $_REQUEST['rsr_num'],
            ':nbr_places_res' => $_REQUEST['nbr_places_res']]);
        //
        return new Response($this->getReservationList());
    }

    /**
     * @Route("/reservation/delete", name="airazur_reservation_delete")
     */    
    public function deleteAction()
    {        
        /*
        $aRes = $this->get(Dao::class)->deleteReservation([':gnc_id' => $_REQUEST['gnc_id'],
            ':rsr_num' => $_REQUEST['rsr_num']]);
        */
        $this->getDoctrine()
            ->getManager()
            ->createQueryBuilder('r')
            ->delete('AppBundle:Reservation', 'r')
            ->where('r.gnc = :gncId')
            ->andWhere('r.rsrNum = :rsrNum')
            ->setParameter('gncId', $_REQUEST['gnc_id'])
            ->setParameter('rsrNum', $_REQUEST['rsr_num'])
            ->getQuery()
            ->execute();
        //        
        return new Response($this->getReservationList());
    }

    /**
     * @Route("/reservation/getItem", name="airazur_reservation_getItem")
     */    
    public function getItemAction()
    {        
        $aRes = $this->get(Dao::class)->getReservation([':gnc_id' => $_REQUEST['gnc_id'],
            ':rsr_num' => $_REQUEST['rsr_num']]);
        
        if (! $aRes )
            return $this->json($_REQUEST);    
        //
        if (isset($_REQUEST['pdf']))
            $this->get(Pdf::class)->mkPdf($aRes);   
    
        else
            return $this->json($aRes);
        //
        return $this->json($aRes);    
    }

}