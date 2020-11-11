<?php

if($year_no == 1){
    $year = "FIRST YEAR - ";
}
else if ($year_no == 2){
    $year = "SECOND YEAR - ";
}
else if ($year_no == 3){
    $year = "THIRD YEAR - ";
}
else {
    $year = "FOURTH YEAR - ";
}

if($semester_no = 1){
    $semester = "FIRST SEMESTER ";
}
else if ($semester_no = 2){
    $semester = "SECOND SEMESTER ";
}
else {
    $semester = "THIRD SEMESTER ";
}

if($ug_level == '5'){
    $this->load->library('tcpdf/Tcpdf_other');
    $obj_pdf = new Tcpdf_other('L', 'mm', 'A4', true, 'UTF-8', false);
    $obj_pdf->setData($year,$semester,$conduct_year,$course_selected,$center_selected);
}
else {
    $this->load->library('tcpdf/Tcpdf_stu');
    $obj_pdf = new Tcpdf_stu('L', 'mm', 'A4', true, 'UTF-8', false);
    $obj_pdf->setData($authority_data,$year,$semester,$conduct_year,$course_selected,$center_selected,$effective_date);
//    $obj_pdf = new Tcpdf_stu($authority_data);
    
}



//$this->load->library('tcpdf/tc');

//$obj_pdf = new tc('L', 'mm', 'A4', true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Student Exam Mark Report";
$obj_pdf->SetTitle($title);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
//$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetAutoPageBreak(TRUE, 50);
$obj_pdf->SetFont('helvetica', '', 8);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetPrintHeader(true);
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

//$ug_level = 1;



foreach($student_exam_subject_array[(count($student_exam_subject_array) - 1)]['lecturer_subject']  as $subj){

    $subjectHeaders .= '<th align="center"><b>'.$subj['subject'].'<br/>['.$subj['code'].']</b></th>';  
    array_push($header_subj, $subj['code']);
}
$subjectHeaders .= '<th align="center"><b>SGPA</b></th>';


$y = 1;
foreach ($student_exam_mark_array as $va) {

    for($x = 0; $x < count($va['applied_subjects']); $x++){
        array_push($body_subj, $va['applied_subjects'][$x]['subject_code']);
    }
    
    for ($z = 0; $z < count($va['exam_mark']); $z++) {
        $mark = '';
        $examData = searchArray($va['exam_mark'][$z]['subject_code'], $va['applied_subjects']);
        if(empty($examData)){
            $mark = "INC";
        }else if ($examData['is_approved'] == '3' || $examData['is_approved'] == '4'){ //rejected
            $mark = "NE";
        } else if($va['exam_mark'][$z]['is_ex_director_mark_approved'] == 1){//ex_dir approved // done SE process
            
            
//            if($va['exam_mark'][$z]['overall_grade'] == 'AB'){
//                $mark = 'AB';
//            } else {
                if($va['exam_mark'][$z]['result'] === '-'){
                    // if the student is absent
                    if($examData['is_absent'] == '1'){
                        // deferment
                        if($examData['is_absent_approve'] == '1'){
                            if($examData['absent_deferement'] != '' || $examData['absent_deferement'] != null ){
                                $mark = 'DFR';
                            } else {
                                $mark = 'AB';
                            }
                        } else {
                           $mark = 'AB'; 
                        }
                    } else {
                        $mark = $va['exam_mark'][$z]['result'];
                    } 
                } else {
                    $mark = $va['exam_mark'][$z]['result'];
                }
//            }
            
        //done only CA process
        } else if($va['exam_mark'][$z]['is_hod_mark_aproved'] == 1 && $va['exam_mark'][$z]['is_director_mark_approved'] == 1 && $va['exam_mark'][$z]['is_ex_director_mark_approved'] == 0){
             $mark = "I(SE)";        
        // incomplete 
        } else {
           $mark = "INC"; 
        }
        $subjects_marks[$va['exam_mark'][$z]['subject_code']] = $mark;
    }
 
    for ($t = 0; $t < count($header_subj); $t++) {        
        if(in_array($header_subj[$t], $body_subj)){                
            $subjects .= '<td align="center">'.$subjects_marks[$header_subj[$t]].'</td>';
        }
        else{
            $subjects .= '<td align="center">INC</td>';
        }               
    }
    $subjects .= '<td align="center">'.$va['gpa'].'</td>';
    
    
    $item .= '<tr nobr="true" style="height: 20px;">'.
            '<td align="center">'.$y.'</td>'.
            '<td align="center">' . $va['reg_no'] . '</td>'.
            '<td>' . $va['first_name'] . '</td>'.
            $subjects.
            '</tr>';
  
    $subjects_marks = [];
    $body_subj = [];
    $subjects = '';
    $y++;   
}


$x = 0;
foreach ($authority_data as $aut){
    
    $name = $aut['name'];
    $position = $aut['position'];
    
    if($x == 0){
        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b><br/><br/><br/>Effective Date&nbsp;&nbsp;&nbsp; : '.$effective_date.'<br/><br/>Date of Issuing&nbsp; : '.$current_date.'</td>';
        $x++;
    }
    else{
        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b></td>';
    }
}






function searchArray($nameKey, $myArray){
    for ($i=0; $i < count($myArray); $i++) {
        if ($myArray[$i]['subject_code'] == $nameKey) {
            return $myArray[$i];
        }
    }
}


    
$content = '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
        '<thead>'.
        '<tr>'.
        '<th align="center"><b>No</b></th>'.
        '<th align="center"><b>Index No</b></th>'.
        '<th align="center"><b>Name with Initials</b></th>'.
        $subjectHeaders.
        '</tr>'.
        '</thead>'.
        '<tbody id="tbl_body">'.
        $item.
        //$item.
        '</tbody>'.
        '</table>'.
        '<br>'.
        '<br>'.
        '<br>'.
        '<br>'.
        $table;  

$tab .= '<table nobr="true">'. 
                '<tr nobr="true">'.
                    '<td>Prepared By: ...............................</td>'.
                    '<td>Checked By: ...............................</td>'.
                    '<td>Certified By: ...............................</td>'.
                    '<td>Approved By: ...............................</td>'.
                '</tr>'.
                
            '</table>';
$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 38, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);


//$txt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.
//Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';
//$obj_pdf->SetFillColor(220, 255, 220);
//$obj_pdf->MultiCell(100, 40, $txt, 1, 'J', 1, 0, '', '', true, 0, false, true, 40, 'T');

//$obj_pdf->writeHTML($content, true, false, true, false, '');
$obj_pdf->Output('output.pdf', 'I');
