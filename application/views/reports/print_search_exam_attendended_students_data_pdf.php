<?php

$this->load->library('tcpdf/tcpdf');

$obj_pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Student Exam Attendance Report";
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

$item = '';
$column_name1 = '';
$column_name2 = '';

foreach ($student_attendees_array as $va) {
    // print_r($stu_course_wise_count_array);
    $code = '';
    $attempts = '';
    for ($e = 0; $e < sizeof($va['subjectsatt']); $e++) {

        $attempts .= $va['subjectsatt'][$e]['no_of_attempts'] . "<br>";
        $code .= $va['subjectsatt'][$e]['code']." - ".$va['subjectsatt'][$e]['subject'] . "<br>";
    }
    $item .= '<tr nobr="true">' .
            '<td align="center" style="width:100px">' . $va['reg_no'] . '</td>' .
            '<td align="center" style="width:100px">' . $va['first_name'] . '</td>' .
            '<td align="center" style="width:250px">' . $code . '</td>' .
            '<td align="center" style="width:50px">' . $attempts . '</td>' .
            
            //     data[j]['esch_date'] + ' [' + data[j]['esch_stime'] +' - ' + data[j]['esch_etime']+']'
            '</tr>';

    $i++;


    $course = $va['course_code'];
    $course_name = $va['course_name'];
    $batch  = $va['batch_code'];
    $year  = $va['year_no'];
    $semester  = $va['semester_no'];
//    $year       = $va['ttbl_year'];
//    $semester   = $va['ttbl_semester'];
    $Ordinal = '';
    if ($year == 1){
        $Ordinal = "<sup>st</sup><label> Year</label>";
    }
    elseif ($year == 2){
        $Ordinal = "<sup>nd</sup><label> Year</label>";
    }
    elseif ($year == 3){
        $Ordinal = "<sup>rd</sup><label> Year</label>";
    }
    elseif ($year == 4){
        $Ordinal = "<sup>th</sup><label> Year</label>";
    }
    else{}
    
    $Ordinaly = '';
    if ($semester == 1){
        $Ordinaly = "<sup>st</sup><label> Semester</label>";
    }
    elseif ($semester == 2){
        $Ordinaly = "<sup>nd</sup><label> Semester</label>";
    }
    elseif ($semester == 3){
        $Ordinaly = "<sup>rd</sup><label> Semester</label>";
    }
    elseif ($semester == 4){
        $Ordinaly = "<sup>th</sup><label> Semester</label>";
    }
    else{}
//    if($year_no == "all" && $semester_no == "all"){
//        $subject = "All Year and All Semester";
//    }
//    else if($semester_no == "all"){
//        $subject = $year."".$Ordinal." Year and All Semester";
//    }
//    else{
//        $subject = $year."".$Ordinal. " Year and ".$semester."".$Ordinaly."Semester";
//    }
}

$repeat_status = '';
if($student_status == 2){
    $repeat_status = ' - Repeat';
}

//$course;
//$year;
//$semester;
//$subject;
//$Ordinal;
// print_r($cheque_return);
// $chequw_details =  $this->db->get_where('cheque_return_history',array('chq_return_master_id'=>$pay['chq_return_master_id']))->result_array();
//  foreach ($chequw_details as $cw){
//     $cheque_no = $cw['chq_no'];
//  }
$content = '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br>' .
        // '<label align="center">'.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_addl1.'</label><br>'.
        // '<label align="center">Telephone: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'. 
        //  '<label align="center"> Email: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'.
        // '<label align="right">Receipt No:'.$pay['cheque_ref'].'</label><br>'.
        // '<label align="right">Return Date: '.$pay['return_date'].'</label><br>'.
        // '<label align="center" style="font-size:14px;"><strong>CHEQUE RETURN</strong></label><br>'.
        '<br>' .
        '<label align="center" style="font-size:12px;"> '.$course_name.' ['.$course.'] - '.$batch.' Batch</label><br><br>' .
        '<label align="center" style="font-size:12px;"> '.$year.''.$Ordinal.' '.$semester.''.$Ordinaly.'  Exam Attendees Details Report'.$repeat_status.'</label><br><br><br>' .
        '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
        '<thead>' .
        '<tr>' .
        '<th align="center" style="width:100px"><b>Name</b></th>' .
        '<th align="center" style="width:100px"><b>Index No</b></th>' .
        '<th align="center" style="width:250px"><b>Subject</b></th>' .
        '<th align="center" style="width:50px"><b>Attempt</b></th>' .
        '</tr>' .
        '</thead>' .
        '<tbody id="tbl_body">' .
        $item .
        '</tbody>' .
        '</table>';


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 100, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 40, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
