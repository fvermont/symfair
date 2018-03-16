<?php
namespace AppBundle\Service;
use AppBundle\Service\DataLink;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;


class Pdf extends \FPDF
{
    //mise ne page des titres
    function TitreChapitre ($libelle)
    {
        $this->SetFont('Arial','',12);
        $this->SetFillColor(155,207,255);
        $this->Cell(0,6,$libelle,0,1,'L',true);
        $this->Ln(4);
    }

    // En-tête
    function Header()
    {
        $package = new Package(new EmptyVersionStrategy());
        
        $this->Image($package->getUrl('img/banniere.png'), 10, 6, 190);
        $this->SetFont('Arial','B',15);
        $this->Cell(80);
        $this->Ln(20);
        $this->Ln(20);
    }
    // Pied de page
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/1',0,0,'C');
    }

    //fonction code BArre
    function Codabar($xpos, $ypos, $code, $start='A', $end='A', $basewidth=0.35, $height=16) 
    {
        $barChar = array (
        '0' => array (6.5, 10.4, 6.5, 10.4, 6.5, 24.3, 17.9),
        '1' => array (6.5, 10.4, 6.5, 10.4, 17.9, 24.3, 6.5),
        '2' => array (6.5, 10.0, 6.5, 24.4, 6.5, 10.0, 18.6),
        '3' => array (17.9, 24.3, 6.5, 10.4, 6.5, 10.4, 6.5),
        '4' => array (6.5, 10.4, 17.9, 10.4, 6.5, 24.3, 6.5),
        '5' => array (17.9,    10.4, 6.5, 10.4, 6.5, 24.3, 6.5),
        '6' => array (6.5, 24.3, 6.5, 10.4, 6.5, 10.4, 17.9),
        '7' => array (6.5, 24.3, 6.5, 10.4, 17.9, 10.4, 6.5),
        '8' => array (6.5, 24.3, 17.9, 10.4, 6.5, 10.4, 6.5),
        '9' => array (18.6, 10.0, 6.5, 24.4, 6.5, 10.0, 6.5),
        '$' => array (6.5, 10.0, 18.6, 24.4, 6.5, 10.0, 6.5),
        '-' => array (6.5, 10.0, 6.5, 24.4, 18.6, 10.0, 6.5),
        ':' => array (16.7, 9.3, 6.5, 9.3, 16.7, 9.3, 14.7),
        '/' => array (14.7, 9.3, 16.7, 9.3, 6.5, 9.3, 16.7),
        '.' => array (13.6, 10.1, 14.9, 10.1, 17.2, 10.1, 6.5),
        '+' => array (6.5, 10.1, 17.2, 10.1, 14.9, 10.1, 13.6),
        'A' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
        'T' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
        'B' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
        'N' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
        'C' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
        '*' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
        'D' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
        'E' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5) );
        //
        $this->SetFont('Arial','',13);

        $this->Text($xpos, $ypos + $height + 4, $code);
        $this->SetFillColor(0);
        $code = strtoupper($start.$code.$end);
        //
        for ($i=0; $i<strlen($code); $i++) {
            $char = $code[$i];
            if (!isset($barChar[$char])) {
                $this->Error('Invalid character in barcode: '.$char);
            }
            $seq = $barChar[$char];
            for($bar=0; $bar<7; $bar++){
                $lineWidth = $basewidth*$seq[$bar]/6.5;
                if($bar % 2 == 0){
                    $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
                }
                $xpos += $lineWidth;
            }
            $xpos += $basewidth*10.4/6.5;
        }
    }

    function mkPdf($aParams) 
    {
        //var_dump($aParams);
        //struture de la page
        $pdf = new Pdf('P','mm','A4');
        //
        $pdf->AddPage();
    
        $pdf->TitreChapitre('INFORMATION VOL');
        //--------------------------------- vol
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,utf8_decode('Vol '.$aParams['vol'])) ;
        $pdf->Line(10,70,200,70);
        $pdf->Ln();
        $pdf->Ln();
    
        $pdf->SetFont('Arial','u',12);
        $pdf->Cell(40,10,utf8_decode('Départ: '));
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(40,10,utf8_decode($aParams['depart']));
        $pdf->Ln();
    
        $pdf->SetFont('Arial','u',12);
        $pdf->Cell(40,10,utf8_decode('Arrivée: '));
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(40,10,utf8_decode($aParams['arrivee']));
        $pdf->Ln();
        $pdf->SetFont('Arial','u',12);
        $pdf->Cell(40,10,utf8_decode('Prix du billet: '));
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(40,10,utf8_decode($aParams['prix']." euros"));
        $pdf->Ln();
        $pdf->Ln();
    
        $pdf->TitreChapitre('INFORMATION CLIENT');
        //--------------------------------- client
    
        $pdf->SetFont('Arial','u',12);
        $pdf->Cell(40,10,utf8_decode('Client: '));
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(40,10,utf8_decode($aParams['client']));
        $pdf->Ln();
    
        $pdf->SetFont('Arial','u',12);
        $pdf->Cell(40,10,utf8_decode('Adresse: '));
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(40,10,utf8_decode($aParams['adr_rue']." ".$aParams['adr_cp']." ".$aParams['adr_ville']));
        $pdf->Ln();
        $pdf->Ln();
    
        $pdf->TitreChapitre('INFORMATION RESERVATION');
        //--------------------------------- reservation
        $pdf->Cell(0,10,"Reservation faite par l'agence numero: ".$aParams['gnc_id'],'C');
        $pdf->Line(10,180,200,180);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial','u',12);
        $pdf->Cell(40,10,utf8_decode('Nombre de places: '));
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(40,10,utf8_decode($aParams['nbPlaces']));
        $pdf->Ln();
    
        $pdf->SetFont('Arial','u',12);
        $pdf->Cell(40,10,utf8_decode('Prix total: '));
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(40,10,utf8_decode($aParams['prix_calc']." euros"));
        $pdf->Ln();
    
        //code BArre
        $pdf->Codabar(120,190,$aParams['rsr_num']);
    
        //
        $pdf->Output('I', 'res_'.$aParams['vol'].'.pdf');
    }
}

?>
