<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Center wise Staff Detail Summary";
		$obj_pdf->SetTitle($title);
		//$title = "PDF Report";

             //   $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		//$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 8);
		$obj_pdf->setFontSubsetting(false);
                $obj_pdf->SetPrintHeader(false);
                $obj_pdf->SetPrintFooter(false);
		$obj_pdf->AddPage();
		
ob_start();

$i = 1;
$item='';
$status = '';
$title = '';

    foreach ($staff_course_detail_array as $va) {
        
        if (($va['stf_acc']) == 1) {
            $status= "Acedemic";
        } else {
            $status= "Non-Academic";
        }

//        if (($va['tit_name']) == 1) {
//            $title= "Rev.";
//        }else if (($va['tit_name']) == 2) {
//            $title= "Prof.";
//        }else if (($va['tit_name']) == 3) {
//            $title= "Dr.";
//        }else if (($va['tit_name']) == 4) {
//            $title= "Mr.";
//        }else if (($va['tit_name']) == 5) {
//            $title= "Mrs.";
//        }else {
//            $title= "Miss.";
//        }
     
         $item  .= '<tr nobr="true">'.
                    '<td> ['.$va['br_code'].'] - '.$va['br_name'].'</td>'.
//                    '<td style="width:200px"> ['.$va['course_code'].'] - '.$va['course_name'].'</td>'.
                    '<td>'.$va['title_name'].' '.$va['stf_fname'].' '.$va['stf_lname'].'</td>'.
                    '<td align="center">'.$va['nic'].'</td>'.
                    '<td align="center">'.$status.'</td>'.
                '</tr>';
         
    $i++;
        
    }
    
   $content =
           '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br>'.
                '<br>'.
                '<label align="center" style="font-size:12px;">Center wise Staff Detail Summary Report</label><br><br><br>'.
 
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center"><b>Center</b></th>'.
            '<th align="center"><b>Name</b></th>'.
            '<th align="center"><b>NIC No</b></th>'.
            '<th align="center"><b>Status</b></th>'.
        '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
   '</table>';


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 100, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=40, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
