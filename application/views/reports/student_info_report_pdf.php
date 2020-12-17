<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('L','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Students Info Report";
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
$item = '';

    foreach ($stu_id_card_data as $va) {
       // print_r($stu_course_wise_count_array);
       
        $temp_sex=$va['sex'];
        if($temp_sex=="F")
        $sex="Female";
        elseif($temp_sex=="M")
        $sex="Male";

        $temp_civil_status=$va['civil_status'];
        if($temp_civil_status=="S")
        $civil_status="Single";
        elseif($temp_civil_status=="M")
        $civil_status="Married";
        
        $item  .= '<tr nobr="true">'.
                   '<td> ['.$va['br_code'].'] - '.$va['br_name'].'</td>'.
                   '<td> '.$va['first_name'].'</td>'.
                   '<td>'.$va['reg_no'].'</td>'.
                   '<td> ['.$va['course_code'].'] - '.$va['course_name'].'</td>'.
                   '<td>'.$va['nic_no'].'</td>'.
                   '<td>'.$va['district'].'</td>'.
                   '<td>'.$va['mobile_no'].'</td>'.
                   '<td>'.$va['fixed_tp'].'</td>'.
                   '<td>'.$va['permanent_address'].'</td>'.
                   '<td>'.$va['email'].'</td>'.
                   '<td>'.$va['birth_date'].'</td>'.
                   '<td>'.$sex.'</td>'.
                   '<td>'.$civil_status.'</td>'.
                   '<td>'.$va['rel_name'].'</td>'.
               '</tr>';
         
    $i++;
        
    }

   $content =
           '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br>'.
               // '<label align="center">'.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_addl1.'</label><br>'.
               // '<label align="center">Telephone: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'. 
              //  '<label align="center"> Email: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'.
               // '<label align="right">Receipt No:'.$pay['cheque_ref'].'</label><br>'.
               // '<label align="right">Return Date: '.$pay['return_date'].'</label><br>'.
               
               // '<label align="center" style="font-size:14px;"><strong>CHEQUE RETURN</strong></label><br>'.
                '<br><label align="center" style="font-size:10px;">Students Info Report - '.$year.'</label><br><br>'.
                '<label align="center" style="font-size:8px;">Center - '.$center_name.', '.$course_name.'</label><br><br><br>'.
 
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center"><b>Center</b></th>'.
            '<th align="center"><b>Name</b></th>'.
            '<th align="center"><b>Register No</b></th>'.
            '<th align="center"><b>Course Name</b></th>'.
            '<th align="center"><b>NIC</b></th>'.
            '<th align="center"><b>District</b></th>'.
            '<th align="center"><b>Mobile </b></th>'.
            '<th align="center"><b>Home </b></th>'.
            '<th align="center"><b>Address</b></th>'.
            '<th align="center"><b>E-Mail</b></th>'.
            '<th align="center"><b>Date of Birth</b></th>'.
            '<th align="center"><b>Gender</b></th>'.
            '<th align="center"><b>Civil Status</b></th>'.
            '<th align="center"><b>Religion</b></th>'.
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
$obj_pdf->Output('student_info.pdf', 'I');
