<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Lecturer Subjects Report";
		$obj_pdf->SetTitle($title);
		
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		
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

$total_student1 = 0;
$total_student2 = 0;

$item='';
$column_name1='';
$column_name2='';
$banch;
    foreach ($lecturer_subjects as $va) {
       
         $item  .= '<tr nobr="true">'.
//                    
                    '<td align="left" style="width:170px">'.$va['stf_fname'].' '. $va['stf_lname'].'</td>'.
                    '<td style="width:170px">'.$va['code'].'</td>'.
                    '<td align="left" style="width:170px">'.$va['subject'].'</td>'.
                   '</tr>';
         
    $i++;
    
    if($lecturer_id == "all"){
        $lecturer = "All";
    }
    else{
        $lecturer = $va['stf_fname'].' '. $va['stf_lname'];
    }
    
    $branch     = $va['br_name'];
    }
    
    $branch;

 
   $content =
           
           '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br>'.
            
                '<br>'.
                '<label align="center" style="font-size:10px;">'.$branch.' Center - '.$lecturer.'</label><br><br>'.
                '<label align="center" style="font-size:10px;">Lecturer Subjects Report</label><br><br>'.
 
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
//            
           '<th align="center" style="width:170px"><b>Lecturer Name</b></th>'.
            '<th align="center" style="width:170px"><b>Subject Code</b></th>'.
            '<th align="center" style="width:170px"><b>Subject Name</b></th>'.
            '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
   '</table>';


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 100, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=40, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);


$obj_pdf->Output('output.pdf', 'I');
