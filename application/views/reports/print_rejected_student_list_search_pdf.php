<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('L','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Rejected Students Lists";
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
//print_r($deactivate_student_array);
//die;
    foreach ($rejected_student_array as $va) {
       // print_r($stu_course_wise_count_array);
         $item  .= '<tr nobr="true">'.
                    '<td align="center">'.$va['br_name'].'</td>'.
                    '<td align="center">'.$va['reg_no'].'</td>'.
                    '<td align="center">'.$va['first_name'].'</td>'.
                    '<td align="center">'.$va['nic_no'].'</td>'.
                    '<td align="center">'.$va['course_code'].'</td>'.
                '</tr>';
    
    $i++;
    
    $center = $center_id;
    $course = $course_id;
    $year   = $year;
    
    if($center == 'all'){
        $center_sentence = 'All Center';
    }else{
        $center_sentence = $va['br_name'];
    }
    
    if($course == 'all'){
        $course_sentence = 'All Course';
    }else{
        $course_sentence = $va['course_code'];
    }

   }

   $content =
           
           '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br>'.
               // '<label align="center">'.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_addl1.'</label><br>'.
               // '<label align="center">Telephone: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'. 
              //  '<label align="center"> Email: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'.
               // '<label align="right">Receipt No:'.$pay['cheque_ref'].'</label><br>'.
               // '<label align="right">Return Date: '.$pay['return_date'].'</label><br>'.
               
                '<label align="center" style="font-size:14px;"><strong>Rejected Students Lists</strong></label><br>'.
                '<br>'.
                '<label align="center" style="font-size:12px;"> '.$year.' '.$center_sentence.' '.$course_sentence.'  List </label><br><br><br>'.
//                '<label align="center" style="font-size:12px;">'.$center.' - '.$course .' - '.$batch.' Batch</label><br><br><br>'.
 
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center"><b>Center</b></th>'.
            '<th align="center"><b>Name</b></th>'.
            '<th align="center"><b>Reg No</b></th>'.
            '<th align="center"><b>NIC</b></th>'.
            '<th align="center"><b>Course</b></th>'.
        '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
   '</table>';


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 145, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=40, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
