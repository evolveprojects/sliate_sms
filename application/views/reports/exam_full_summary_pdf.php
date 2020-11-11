<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Full Exam Summary of Students";
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

$total_student = 0;
$total_approved = 0;
$total_reject = 0;
$total_not_approve = 0;

$grand_total_students = 0;
$grand_total_approved = 0;
$grand_total_not_approved = 0;
$grand_total_rejected = 0;

$br_name = '';
$br_code = '';
$course_name = '';
$course_code = '';
$exam_name = '';
$exam_code = '';


$item = '';

    foreach ($student_all_count_exms as $va)
    {              
        $br_name = $va['br_name'];
        $br_code = $va['br_code'];
        $course_name = $va['course_name'];
        $course_code = $va['course_code'];
        $exam_name = $va['exam_name'];
        $exam_code = $va['exam_code'];

        if($va['final_reject'] > 0){
            $total_reject += 1;
        }
        else if($va['final_not_approve'] > 0){
            $total_not_approve += 1;
        }
        else{
           $total_approved += 1; 
        }

        if($va['stu_id'] != ""){
            $total_student += 1;
        }     
    }
    
    $grand_total_students += $total_student;
    $grand_total_approved += $total_approved;
    $grand_total_not_approved += $total_not_approve;
    $grand_total_rejected += $total_reject;
    
    $item  .= '<tr>'.
            '<td>'.$br_name.'</td>'.
            '<td>'.$br_code.'</td>'.
            '<td>'.$course_name.'</td>'.
            '<td style="width: 60px;">'.$course_code.'</td>'.
            '<td>'.$exam_name.'</td>'.
            '<td>'.$exam_code.'</td>'.
            '<td align="center">'.$total_student.'</td>'.
            '<td align="center">'.$total_approved.'</td>'.
            '<td align="center">'.$total_not_approve.'</td>'.
            '<td align="center">'.$total_reject.'</td>'.
        '</tr>';

 
   $content =
 
    '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br>'.
    '<br>'.
    '<label align="center" style="font-size:12px;">Student Full Exam Summary Report</label><br><br><br>'.
           
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center"><b>Center</b></th>'.
            '<th align="center"><b>Center Code</b></th>'.
            '<th align="center"><b>Course</b></th>'.
            '<th align="center" style="width: 60px;"><b>Course Code</b></th>'.
            '<th align="center"><b>Exam</b></th>'.
            '<th align="center"><b>Exam Code</b></th>'.         
            '<th align="center"><b>Total Students</b></th>'.
            '<th align="center"><b>Approve</b></th>'.
            '<th align="center"><b>Not Approve</b></th>'.
            '<th align="center"><b>Reject</b></th>'.
        '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
    '<tfoot>'.
        '<tr align="center">'.
            '<th><b>Grand Total</b></th>'.
            '<th></th>'.
            '<th></th>'.
            '<th></th>'.
            '<th></th>'.
            '<th></th>'.
            '<th><b>'.$grand_total_students.'</b></th>'.
            '<th><b>'.$grand_total_approved.'</b></th>'.
            '<th><b>'.$grand_total_not_approved.'</b></th>'.
            '<th><b>'.$grand_total_rejected.'</b></th>'.
        '</tr>'.
        '</tfoot>'.
    '</table>';
    


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 100, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=40, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$obj_pdf->Output('output.pdf', 'I');