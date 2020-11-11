<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('L','mm','A3',true,'UTF-8',false);
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

    foreach ($student_mast_array as $va) {
       // print_r($stu_course_wise_count_array);
         $item  .= '<tr nobr="true">'.
                        '<td style="width:80px">' . $va['reg_no'] . '</td>' .
                        '<td style="width:80px">' . $va['first_name'] . '</td>'.
                        '<td>' . $va['nic'] . '</td>'.
                        '<td>' . $va['al_subject_stream'] . '</td>'.
                        '<td>' . $va['al_z_score'] . '</td>'.
                        '<td>' . $va['distance'] . '</td>'.
                        '<td>' . $va['schl_attendies'] . '</td>'.
                        '<td>' . $va['schl_going_concession'] . '</td>'.
                        '<td>' . $va['ou_attendies'] . '</td>'.
                        '<td>' . $va['ou_going_concession'] . '</td>'.
                        '<td>' . $va['income_from_land'] . '</td>'.
                        '<td>' . $va['income_from_rent'] . '</td>'.
                        '<td>' . $va['empld_salary'] . '</td>'.
                        '<td>' . $va['spouse_annual_income'] . '</td>'.
                        '<td>' . $va['fa_annual_income'] . '</td>'.
                        '<td>' . $va['mo_annual_income'] . '</td>'.
                        '<td>' . $va['total_income'] . '</td>'.
                        '<td>' . $va['ga_income'] . '</td>'.
                        '<td>' . $va['need_index'] . '</td>'.
                   '</tr>';
         
    $i++;
    
    //$course = $va['course_id'];
    
    if($va['course_id'] == 'all'){
        $course1 == 'All';
    }else{
        $course1 = $va['course_code'];
    }
    
    $center     = $va['br_name'];
    

    
    
    }
    
$course1;
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
                '<br>'.
                '<label align="center" style="font-size:12px;">'.$center.' Center wise Mahapola Director & Approval approved students Summary Report</label><br><br><br>'.
 
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th style="width:80px"><b>Reg No</b></th>'.
            '<th style="width:80px"><b>Full Name</b></th>'.
            '<th><b>NIC</b></th>'.
            '<th><b>A/L Subject Stream</b></th>'.
            '<th><b>A/L Z-Score</b></th>'.
            '<th><b>Distance</b></th>'.
            '<th><b>No Of school attendees</b></th>'.
            '<th><b>School going concession</b></th>'.
            '<th><b>No of university attendees</b></th>'.
            '<th><b>University going concession</b></th>'.
            '<th><b>Land income</b></th>'.
            '<th><b>Rent income</b></th>'.
            '<th><b>Employed salary</b></th>'.
            '<th><b>Spouse annual income</b></th>'.
            '<th><b>Father income</b></th>'.
            '<th><b>Mother income</b></th>'.
            '<th><b>Parent total income</b></th>'.
            '<th><b>Guardian income</b></th>'.
            '<th><b>Need index</b></th>'.
        '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
   '</table>';


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 200, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=40, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
