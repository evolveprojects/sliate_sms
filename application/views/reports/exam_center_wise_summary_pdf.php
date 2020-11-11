<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Center wise Exam Summary of Students";
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

$x = 1;
$status_header = '';
$status = '';

$item = '';

    foreach ($student_exam_count as $va)
    {    
        $item  .= '<tr>'.
            '<td align="center" style="width: 40px;">'.$x.'</td>'.
            '<td style="width: 90px;">'.$va['reg_no'].'</td>'.
            '<td>'.$va['first_name'].'</td>'.
            '<td>'.$va['br_code'].' - '.$va['br_name'].'</td>'.
            '<td>'.$va['course_code'].' - '.$va['course_name'].'</td>'.
            '<td>'.$va['exam_code'].' - '.$va['exam_name'].'</td>'.
            '<td align="center">'.$va['status_count'].'</td>'.
        '</tr>'; 
        
        $x++;
    }
    
    if($selected_type == '1'){
        $status_header = '<th align="center"><b>Total No of Applied Subjects</b></th>';
        $status = 'Exam Applied Students';
    }
    else if($selected_type == '2'){
        $status_header = '<th align="center"><b>No of Approved Subjects</b></th>';
        $status = 'Exam Approved Students';
    }
    else{
        $status_header = '<th align="center"><b>No of Rejected Subjects</b></th>'; 
        $status = 'Exam Rejected Students';
    }
    

 
   $content =
 
    '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br>'.
    '<br>'.
    '<label align="center" style="font-size:12px;">Student Center wise Exam Summary Report - ('.$status.')</label><br><br><br>'.
           
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center" style="width: 40px;"><b>#</b></th>'.
            '<th align="center" style="width: 90px;"><b>Reg No</b></th>'.
            '<th align="center"><b>Name</b></th>'.
            '<th align="center"><b>Center</b></th>'.
            '<th align="center"><b>Course</b></th>'.
            '<th align="center"><b>Exam</b></th>'.
            $status_header.
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
