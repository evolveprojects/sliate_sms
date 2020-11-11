<?php

if($ug_level == '5'){
    $this->load->library('tcpdf/Tcpdf_full_other');
    $obj_pdf = new Tcpdf_full_other('L', 'mm', 'A4', true, 'UTF-8', false);
    $obj_pdf->setData($course_selected,$center_selected,$batch_selected,$stu_data['reg_no'],$stu_data['first_name']);
}
else {
    $this->load->library('tcpdf/Tcpdf_full_student');
    $obj_pdf = new Tcpdf_full_student('L', 'mm', 'A4', true, 'UTF-8', false);
    $obj_pdf->setData($course_selected,$center_selected,$batch_selected,$authority_data,$stu_data['reg_no'],$stu_data['first_name']); 
}



//$this->load->library('tcpdf/tc');

//$obj_pdf = new tc('L', 'mm', 'A4', true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Student Exam Full Results Report";
$obj_pdf->SetTitle($title);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, 55, PDF_MARGIN_RIGHT);
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

$prevId = "";
$yearId = "";
$semId = "";
$prevSemId = "";
$sgpa = "";

$ug_level = 1;
                
                
for($i = 0; $i<count($student_full_exam_results['mark_details']); $i++) {
    
    $yearId = $student_full_exam_results['mark_details'][$i]['year'];
    $semId = $student_full_exam_results['mark_details'][$i]['semester'];
    
    //spga
    $sgpa = $student_full_exam_results['mark_details'][$i]['stu_data']['gpa'];
    
    if($sgpa == null){
        $sgpa = "  --";
    }else if($sgpa == ""){
        $sgpa = "  --";
    }
    else{
        $sgpa = $student_full_exam_results['mark_details'][$i]['stu_data']['gpa'];
    }
 

    if($i > 0){
        $prevId = $student_full_exam_results['mark_details'][$i-1]['year'];
        $prevSemId = $student_full_exam_results['mark_details'][$i-1]['semester'];
    }

    if($yearId != $prevId){
        $item .= '<tr nobr="true" style="height: 20px;">'.
            '<td><b>' . $yearId . ' Year - '. $semId .' Semester</b></td>'.
            '<td align="center"><b>SGPA -: ' . $sgpa . '</b></td>'.
            '</tr>';       
    }
    else{
       if($semId != $prevSemId){
            $item .= '<tr nobr="true" style="height: 20px;">'.
            '<td><b>' . $yearId . ' Year - '. $semId .' Semester</b></td>'.
            '<td align="center"><b>SGPA -: ' . $sgpa . '</b></td>'.
            '</tr>'; 
        } 
    }
    
    for ($y = 0; $y < count($student_full_exam_results['mark_details'][$i]['stu_data']['exam_mark']); $y++) {
        
        $result = '';
        if($student_full_exam_results['mark_details'][$i]['stu_data']['exam_mark'][$y]['release_result'] == 0){
            $result = "Results not released.";
        }
        else{
            $result = $student_full_exam_results['mark_details'][$i]['stu_data']['exam_mark'][$y]['result'];
        }
        
        //cgpa
        $cgpa = $student_full_exam_results['mark_details'][$i]['stu_data']['cgpa'];

        if($cgpa == null){
            $cgpa = "  --";
        }else if($cgpa == ""){
            $cgpa = "  --";
        }
        else{
            $cgpa = $student_full_exam_results['mark_details'][$i]['stu_data']['cgpa'];
        }
        
        $item .= '<tr nobr="true" style="height: 20px;">'.
            '<td>['.$student_full_exam_results['mark_details'][$i]['stu_data']['exam_mark'][$y]['subject_code'].'] - '.$student_full_exam_results['mark_details'][$i]['stu_data']['exam_mark'][$y]['subject'].'</td>'.
            '<td align="center">'.$result.'</td>'.
            '</tr>';
    }
 
}


$x = 0;
foreach ($authority_data as $aut){
    
    $name = $aut['name'];
    $position = $aut['position'];
    
    if($x == 0){
        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b><br/><br/><br/>Date of Issuing&nbsp; : '.$current_date.'</td>';
        $x++;
    }
    else{
        $authority .= '<td align="left"><b>'.$name.'<br/>'.$position.'</b></td>';
    }
}



    
$content = 
        '<label>Overall GPA: <b>'.$cgpa.'</b></label><br/><br/>'.
        '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
        '<thead>'.
        '<tr>'.
        '<th align="center"><b>Subject</b></th>'.
        '<th align="center"><b>Result</b></th>'.
        '</tr>'.
        '</thead>'.
        '<tbody id="tbl_body">'.
        $item.
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


$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 55, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);

$obj_pdf->Output('output.pdf', 'I');
