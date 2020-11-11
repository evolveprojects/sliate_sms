<?php

$this->load->library('tcpdf/tcpdf');
$obj_pdf = new TCPDF('L','mm','A4',true,'UTF-8',false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Student Exam Mark Report";
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
$table = '';
$tab = '';
$subjectHeaders = '';
$subjectMarks = '';

$column_name1 = '';
$column_name2 = '';

$subjetCount = 0;
$markCount = 0;

$header_subj = [];
$body_subj = [];
$subjects_marks = [];
$subjects = '';
$authority = '';
$authority_date = '';

$content = '';

//$ug_level = 1;

/*foreach ($student_exam_subject_array as $subj) {
    $subjectHeaders .= '<th align="center"><b>'.$subj['subject'].'<br/>['.$subj['code'].']</b></th>';
    array_push($header_subj, $subj['code']);
}   */
//print_r($subjectHeaders);
//$student_recorrection_student_array;

/*$student_recorrection_student_array;
foreach($student_exam_subject_array[(count($student_exam_subject_array) - 1)]['lecturer_subject']  as $subj){

    $subjectHeaders .= '<th align="center"><b>'.$subj['subject'].'<br/>['.$subj['code'].']</b></th>';  
    array_push($header_subj, $subj['code']);
}
$subjectHeaders .= '<th align="center"><b>SGPA</b></th>'; */


$count = 1;
$type = '';
$course_name = '';

/* foreach ($student_recorrection_student_array as $va){
    for($x = 0; $x < count($va['subjects']); $x++){
        array_push($body_subj, $va['subjects'][$x]['code']);
    }
//    
    for ($z = 0; $z < count($va['subjects']); $z++) {
//        $subjects_marks[$va['exam_mark'][$z]['subject_code']] = $va['exam_mark'][$z]['result'];
        $subjects_marks[$va['subjects'][$z]['code']] = $va['subjects'][$z]['total_marks'];
    }
//    
    for ($t = 0; $t < count($header_subj); $t++) {        
        if(in_array($header_subj[$t], $body_subj)){                
            $subjects .= '<td align="center">'.$subjects_marks[$header_subj[$t]].'</td>';
        }
        else{
            $subjects .= '<td align="center">--</td>';
        }               
    }
    
    
    $item .= '<tr nobr="true" style="height: 20px;">'.
            '<td align="center" style="width:30px;">'.$y.'</td>'.
            '<td align="center">' . $va['reg_no'] . '</td>'.
            '<td>' . $va['first_name'] . '</td>'.
            $subjects.
            '</tr>';
    
    $subjects_marks = [];
    $body_subj = [];
    $subjects = '';
    $y++;  
} */



//print_r($va);

foreach ($student_applied_exam_array as $va) {
$subj_status ="";
$reject_reason ='-';
 
//    if (data[j]['subj_approved'] == 1) {
//        subj_status = "Not Approved by Lecturer";
//        reject_reason = "-";
//    } else if (data[j]['subj_approved'] == 2) {
//        subj_status = "Subject Approved";
//        reject_reason = "-";
//    } else if (data[j]['subj_approved'] == 3) {
//        subj_status = "Rejected by Lecturer";
//        if (data[j]['rejected_reason'] != "") {
//            reject_reason = data[j]['rejected_reason'];
//        } else {
//            reject_reason = "-";
//        }
//    } else if (data[j]['subj_approved'] == 4) {
//        subj_status = "Rejected by Director";
//        reject_reason = "-";
//    } else {
//        subj_status = "Subject Not Approved";
//        reject_reason = "-";
//    }
    
    if($va['subj_approved'] == 1){
        $subj_status = "Not Approved by Lecturer";
    }else if ($va['subj_approved'] == 2) {
        $subj_status = "Subject Approved";
        $reject_reason = "-";
    }else if ($va['subj_approved'] == 3) {
        $subj_status = "Rejected by Lecturer";
        if ($va['rejected_reason'] != "") {
            $reject_reason = $va['rejected_reason'];
        } else {
            $reject_reason = "-";
        }
    } else if ($va['subj_approved'] == 4) {
        $subj_status = "Rejected by Director";
        $reject_reason = "-";
    } else {
        $subj_status = "Subject Not Approved";
        $reject_reason = "-";
    }
    
    $item .= '<tr nobr="true" style="height: 20px;">'.
            '<td align="center" style="width:30px;">'.$count.'</td>'.
            '<td align="center">' . $va['reg_no'] . '</td>'.
            '<td>' . $va['first_name'] . '</td>'.
            '<td>' . $va['batch_code'] . '</td>'.
            '<td>' . $va['code'] .' - '.$va['subject'].'</td>'.
            '<td>' . $subj_status . '</td>'.
            '<td>' . $reject_reason . '</td>'.
            '</tr>';
    
    $count++;
    
    
    if($subject_id == 'all'){
        $course_name = 'All Subject';
    }else{
        $course_name = $va['code'];
    }
    
    
    if($east_type == 1){
        $type = 'All Students';
    }elseif($east_type == 2){
        $type = 'Exam Approved Students';
    }elseif($east_type == 3){
        $type = 'Exam Rejected Students';
    }else{}
    
    
}
//
//
//$x = 0;
//foreach ($authority_data as $aut){
//    
//    $name = $aut['name'];
//    $position = $aut['position'];
//    
//    if($x == 0){
//        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b><br/><br/><br/>Effective Date&nbsp;&nbsp;&nbsp; : '.$current_date.'<br/><br/>Date of Issuing&nbsp; : '.$current_date.'</td>';
//        $x++;
//    }
//    else{
//        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b></td>';
//    }
//}
//


$content = '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br>' .
        '<br>'.
        '<label align="center" style="font-size:8px;">Subject Wise Students Approvals  </label><br><br>'.
        '<label align="center" style="font-size:8px;"><b>Student List</b></label><br>'.
        '<label align="center" style="font-size:8px;"><b>'.$course_name.' - '.$type.'</b></label><br><br><br>'.
        '<label align="left" style="font-size:8px;"></label>'.
        '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
        '<thead>'.
        '<tr>'.
        '<th align="center" style="width:30px;"><b>No</b></th>'.
        '<th align="center"><b>Reg No</b></th>'.
        '<th align="center"><b>Full Name</b></th>'.
        '<th align="center"><b>Batch</b></th>'.
        '<th align="center"><b>Subject</b></th>'.
        '<th align="center"><b>Subject Status</b></th>'.
        '<th align="center"><b>Subject Reject Reason</b></th>'.
//        $subjectHeaders.
        '</tr>'.
        '</thead>'.
        '<tbody id="tbl_body">'.
        $item.
        '</tbody>'.
        '</table>'.
        '<br>'.
        '<br>'.
        '<br>'.
        '<br>';
        

$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 140, 15, 15, 20, 'jpg');


$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 40, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);


//$txt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.
//Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';
//$obj_pdf->SetFillColor(220, 255, 220);
//$obj_pdf->MultiCell(100, 40, $txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'T');

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
