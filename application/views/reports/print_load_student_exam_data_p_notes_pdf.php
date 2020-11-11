<?php

$this->load->library('tcpdf/tcpdf');

$obj_pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Student Exam P-Note";
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
$obj_pdf->SetPrintFooter(true);
$obj_pdf->AddPage();

ob_start();

$i = 1;

$total_student1 = 0;
$total_student2 = 0;

$item = '';
$subjectHeaders = '';
$subjectMarks = '';

$column_name1 = '';
$column_name2 = '';

$subjetCount = 0;
$markCount = 0;

$header_subj = [];
$body_subj = [];
$subjects_marks = [];
$subjects_approved_status = [];
$subjects = '';
$authority = '';
$authority_date = '';
$repeat_status = '';

$regYear = 0;
$preYear = 0;
$blankSubjects = '';


foreach($student_exam_subject_array[(count($student_exam_subject_array) - 1)]['lecturer_subject']  as $subj){

    $subjectHeaders .= '<th align="center" ><b>'.$subj['subject'].'<br/>['.$subj['code'].']</b></th>';  
    array_push($header_subj, $subj['code']);
}
//$subjectHeaders .= '<th align="center"><b>SGPA</b></th>';


$y = 1;

//foreach ($student_exam_mark_array as $va) {
for($j = 0; $j < count($student_exam_mark_array); $j++){   
        
    for($x = 0; $x < count($student_exam_mark_array[$j]['applied_subjects']); $x++){
        
        array_push($body_subj, $student_exam_mark_array[$j]['applied_subjects'][$x]['subject_code']);
        
        //print_r($student_exam_mark_array[$j]['applied_subjects'][$x]['exm_sub_approved']);
        //echo '</br>';
        if($pnote_print_status == 2){
            $repeat_status = "- Repeat";
            if($student_exam_mark_array[$j]['applied_subjects'][$x]['is_repeat'] == 1 && $student_exam_mark_array[$j]['applied_subjects'][$x]['is_repeat_approved'] == 1){
                $subjects_approved_status[$student_exam_mark_array[$j]['applied_subjects'][$x]['subject_code']] = "X";
            }
            else{
                $subjects_approved_status[$student_exam_mark_array[$j]['applied_subjects'][$x]['subject_code']] = "N/E";
            }
        }
        else{
            $repeat_status = '';
            if($student_exam_mark_array[$j]['applied_subjects'][$x]['exm_sub_approved'] == 2)
            {
                $subjects_approved_status[$student_exam_mark_array[$j]['applied_subjects'][$x]['subject_code']] = "X";
            }
            else
            {
                $subjects_approved_status[$student_exam_mark_array[$j]['applied_subjects'][$x]['subject_code']] = "N/E";
            }
        }
    }
    
    /*for ($z = 0; $z < count($student_exam_mark_array[$j]['exam_mark']); $z++) {
        $subjects_marks[$student_exam_mark_array[$j]['exam_mark'][$z]['subject_code']] = $student_exam_mark_array[$j]['exam_mark'][$z]['result'];
        if([$student_exam_mark_array[$j]['exam_mark'][$z]['is_approved']] == 2)
        {
            $subjects_approved_status[$student_exam_mark_array[$j]['exam_mark'][$z]['subject_code']] = "";
        }
        else
        {
            $subjects_approved_status[$student_exam_mark_array[$j]['exam_mark'][$z]['subject_code']] = "N/E";
        }
    }*/
    //    if($subjects_marks[$header_subj[$t]] == "--"){
//                $subjects .= '<td align="center"></td>';
//            }
 
    for ($t = 0; $t < count($header_subj); $t++) {        
        if(in_array($header_subj[$t], $body_subj)){                
            $subjects .= '<td align="center">'.$subjects_approved_status[$header_subj[$t]].'</td>';
        }
        else{
            $subjects .= '<td align="center">--</td>';
        }  
        
        $blankSubjects .= '<td align="center" style="border-right: 0px solid white;"></td>';
    }
    //$subjects .= '<td align="center">'.$student_exam_mark_array[$j]['gpa'].'</td>';
    
        $regYear = $student_exam_mark_array[$j]['reg_year'];
    
        if($j>0){
            $preYear = $student_exam_mark_array[$j-1]['reg_year'];
        }
    
    
    if($regYear != $preYear){
        $item .= '<tr nobr="true">'.
            '<td align="center" style="width:30px;border-right: 0px solid #ffffff;"><b>'.$student_exam_mark_array[$j]['reg_year'].'</b></td>'.
            '<td align="center" style="width:90px;border-right: 0px solid #ffffff;"></td>'.
            '<td align="center" style="width:90px;border-right: 0px solid #ffffff;"></td>'.
            $blankSubjects.
            '</tr>';
    }
    
    $item .= '<tr nobr="true">'.
            '<td align="center" style="width:30px;">'.$y.'</td>'.
            '<td align="center" style="width:90px; font-size:8px;">' . $student_exam_mark_array[$j]['reg_no'] . '</td>'.
            '<td style="font-size:8px; width:90px;">' . $student_exam_mark_array[$j]['first_name'] . '</td>'.
            $subjects.
            '</tr>';
  
    $subjects_marks = [];
    $body_subj = [];
    $subjects = '';
    $blankSubjects = '';
    $y++;   
}

//$str  = $student_exam_mark_array[$j]['reg_no'];
//$string = 'AAA/BBB/CCC';
//echo preg_replace('#[^/]*$#', '', $string);


$string= trim($student_exam_mark_array[0]['reg_no']);
$parts = explode("/", $string);

$xxx = $parts[3];
//echo $xxx;

if($xxx == "F"){
    $time = "FULL TIME";
}else if($xxx == "P"){
    $time = "PART TIME";
}


$x = 0;
foreach ($authority_data as $aut){
    
    $name = $aut['name'];
    $position = $aut['position'];
    
    if($x == 0){
        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b><br/><br/><br/>Effective Date&nbsp;&nbsp;&nbsp; : '.$current_date.'<br/><br/>Date of Issuing&nbsp; : '.$current_date.'</td>';
        $x++;
    }
    else{
        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b></td>';
    }
}



if($year_no == 1){
    $year = "FIRST YEAR ";
}
else if ($year_no == 2){
    $year = "SECOND YEAR ";
}
else if ($year_no == 3){
    $year = "THIRD YEAR ";
}
else {
    $year = "FOURTH YEAR ";
}

if($semester_no = 1){
    $semester = "FIRST SEMESTER";
}
else if ($semester_no = 2){
    $semester = "SECOND SEMESTER";
}
else {
    $semester = "THIRD SEMESTER";
}
    
$content = '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technological Education (SLIATE)</strong></label><br>' .
        '<br>'.
        
        '<label align="center" style="font-size:10px;"> List of Students '.$repeat_status.'</label><br><br>'.
        '<label align="center" style="font-size:10px;"> '.$semester.' EXAMINATION '.$current_year.'</label><br><br>'. //$year
//        '<label align="center" style="font-size:10px;"> '.$course_selected['course_name'].'</label><br><br>'.
        //'<label align="center" style="font-size:10px;">Result Sheet</label><br><br><br>'.
//        '<label align="left" style="font-size:10px;"> INSTITUTE: '.$center_selected['br_name'].'</label><br><br>'.
        '<label align="left" style="font-size:9px;">Name of the Course :- '.$course_selected['course_name'].'</label><br><br>'.
//        '<label align="left" style="font-size:9px;">New/Old Syllabus :- </label><br><br>'.
        '<label align="left" style="font-size:9px;">Full Time/ Part Time :- '.$time.' </label><br><br>'.
        '<label align="left" style="font-size:9px;">Course Year :- '.$year.'</label><br><br>'.
        '<table border="0.5" style="width:100%; vertical-align:center; border-color: black;" cellspacing="0" cellpadding="5">'.
        '<thead>'.
        '<tr>'.
        '<th align="center" style="width:30px;"><b>No</b></th>'.
        '<th align="center" style="font-size:8px; width:90px;"><b>Index No</b></th>'.
        '<th align="center" style="font-size:8px; width:90px;"><b>Name with Initials</b></th>'.
        $subjectHeaders.
        '</tr>'.
        '</thead>'.
        '<tbody id="tbl_body">'.
        $item.
        '</tbody>'.
        '</table>'.
        '<br>'.
        '<br>'.
        '<br>'.
        '<table border="0" style="width:100%; vertical-align:center;" cellspacing="5" cellpadding="5">'.
        '<tr>'.
        '<th style="font-size:9px; width:90px;" align="left">Present:</th>'.
        '<th align="left" border="0.5" style="width:80px;"></th>'.
        '<th></th>'.
        '<th style="font-size:9px; width:90px;" align="left">Absent:</th>'.
        '<th align="left" border="0.5" style="width:80px;"></th>'.
        '</tr>'.
        '<tr>'.
        '<th style="font-size:9px; width:90px;" align="left">Not Eligible:</th>'.
        '<th align="left" border="0.5" style="width:80px;"></th>'.
        '<th></th>'.
        '<th style="font-size:9px; width:90px;" align="left">Total:</th>'.
        '<th align="left" border="0.5" style="width:80px;"></th>'.
        '</tr>'.
        '</table>'.
        '<br>'.
        '<br>'.
        '<table nobr="true">'. 
            '<tr nobr="true">'.
                '<td>I certify I have carefullty checked the admission cards (a) the same of candidates (b) the index No. and (C) the sbjects taken by each candidates. <br>Signature of Permanent Invigilator ................................... <br>N.B : Absence of a candidat from a paper should be a vertical line across the Horizontal line thus "AB <br>Signature of Supervisor ...............................................</td>'.
                
                
            '</tr>'.
//            '<tr nobr="true">'.
//               $authority.
//            '</tr>'.
        '</table>';   


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 150, 15, 15, 20, 'jpg');


$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 40, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
