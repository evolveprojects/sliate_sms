<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('L','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Center wise Detail Summary of Students";
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

$item='';
$column_name1='';
$column_name2='';

    foreach ($stu_course_detail_array as $va) {
        
        if($va['apply_mahapola'] == 1){
            $ma = 'Applied';
        }else{
            $ma = 'Not applied';
        }
       // print_r($stu_course_wise_count_array);
         $item  .= '<tr nobr="true">'.
                    '<td style="width:100px">['.$va['br_code'].'] - '.$va['br_name'].'</td>'.
                    '<td style="width:120px"> ['.$va['reg_no'].'</td>'.
                    '<td align="left" style="width:100px">'.$va['first_name'].'</td>'.
                    '<td align="center" style="width:90px">'.$va['nic_no'].'</td>'.
                    '<td style="width:100px">['.$va['course_code'].'] - '.$va['course_name'].'</td>'.
                    '<td style="width:140px">'.$va['cas1s'].'-'.$va['sub1g'].'<br>'.$va['cas2s'].'-'.$va['sub2g'].'<br>'.$va['cas3s'].'-'.$va['sub3g'].'<br>'.$va['cas4s'].'-'.$va['sub4g'].'</td>'.
                    '<td style="width:70px">Maths - '.$va['olmathg'].'<br>English - '.$va['olenglishg'].'</td>'.
                    '<td style="width:70px">'.$ma.'</td>'.
                '</tr>';
         
    $i++;
        
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
                '<label align="center" style="font-size:12px;">Center wise Detail Summary Report</label><br><br>'.
                 '<label align="center" style="font-size:8px;">'.$course_name.'</label><br><br>'.
                '<label align="center" style="font-size:8px;">Center - '.$center_name.' , Batch - '.$batch_name.' </label><br><br><br>'.
                
 
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center"style="width:100px"><b>Center</b></th>'.
            '<th align="center" style="width:120px"><b>Register No</b></th>'.
            '<th align="center" style="width:100px"><b>Student Name</b></th>'.
            '<th align="center" style="width:90px"><b>NIC No</b></th>'.
           '<th align="center" style="width:100px"><b>Course</b></th>'.
           '<th align="center" style="width:140px"><b>A/L Results</b></th>'.
           '<th align="center" style="width:70px"><b>O/L Results</b></th>'.
           '<th align="center" style="width:70px"><b>Mahapola</b></th>'.
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
