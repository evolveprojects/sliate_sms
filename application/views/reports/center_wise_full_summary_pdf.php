<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Center wise Full Summary of Students";
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

$total_student1 = 0;
$total_student2 = 0;
$total_student3 = 0;

$item='';
$column_name1='';
$column_name2='';

$header_type = '';

    foreach ($stu_course_wise_count_array as $va) {
       // print_r($stu_course_wise_count_array);
         $item  .= '<tr nobr="true">'.
                    '<td style="width:100px"> ['.$va['br_code'].'] - '.$va['br_name'].'</td>'.
                    '<td style="width:200px"> ['.$va['course_code'].'] - '.$va['course_name'].'</td>'.
                    '<td align="center" style="width:70px">'.$va['type1'].'</td>'.
                    '<td align="center" style="width:70px">'.$va['type2'].'</td>'.
                    '<td align="center" style="width:70px">'.$va['type3'].'</td>'.
                '</tr>';
         
    $i++;

    $total_student1 += $va['type1'];
    $total_student2 += $va['type2'];
    $total_student3 += $va['type3'];
        
    }
    
    if($search_type == 'gender'){
        $column_name1 = 'Male';
        $column_name2 = 'Female';
        
        $header_type = ' Gender wise (Male/Female)';
    }
    
    if($search_type == 'time'){
        $column_name1 = 'Part Time';
        $column_name2 = 'Full Time';
        
        $header_type = ' Time wise (Part time/Full time)';
    }

   // print_r($cheque_return);
  // $chequw_details =  $this->db->get_where('cheque_return_history',array('chq_return_master_id'=>$pay['chq_return_master_id']))->result_array();
 //  foreach ($chequw_details as $cw){
  //     $cheque_no = $cw['chq_no'];
 //  }
   $content =
           '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br>'.
               // '<label align="center">'.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_addl1.'</label><br>'.
               // '<label align="center">Telephone: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'. 
              //  '<label align="center"> Email: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'.
               // '<label align="right">Receipt No:'.$pay['cheque_ref'].'</label><br>'.
               // '<label align="right">Return Date: '.$pay['return_date'].'</label><br>'.
               
               // '<label align="center" style="font-size:14px;"><strong>CHEQUE RETURN</strong></label><br>'.

                '<label align="center" style="font-size:12px;">Center wise Full Summary Report - '.$year.'</label><br/><br/>'.

           '<label align="center" style="font-size:12px;">'.$header_type.'</label><br><br><br>'.
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center"style="width:100px"><b>Center</b></th>'.
            '<th align="center" style="width:200px"><b>Course</b></th>'.
            '<th align="center" style="width:70px"><b>'.$column_name1.'</b></th>'.
            '<th align="center" style="width:70px"><b>'.$column_name2.'</b></th>'.
            '<th align="center" style="width:70px"><b>Total Count</b></th>'.
        '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
    '<tfoot>'.
        '<tr align="center">'.
            '<th><b>Grand Total</b></th>'.
            '<th></th>'.
            '<th><b>'.$total_student1.'</b></th>'.
            '<th><b>'.$total_student2.'</b></th>'.
            '<th><b>'.$total_student3.'</b></th>'.
        '</tr>'.
     '</tfoot>'.
   '</table>';


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 100, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=40, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
