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

if($semester_no == 1){
    $semester = "FIRST SEMESTER - ";
}
else if ($semester_no == 2){
    $semester = "SECOND SEMESTER - ";
}
else {
    $semester = "THIRD SEMESTER - ";
}

$course_data = $course_details['course_code']." - ".$course_details['course_name'];

$report_type = "Semester Analysis Report";

    $this->load->library('tcpdf/Tcpdf_data_analysis');
    $obj_pdf = new Tcpdf_data_analysis('L', 'mm', 'A4', true, 'UTF-8', false);
    $obj_pdf->setData($report_type,$year,$semester,$batch_code,$course_data);

$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Semester Analysis Report";
$obj_pdf->SetTitle($title);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, 50);
$obj_pdf->SetFont('helvetica', '', 8);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetPrintHeader(true);
$obj_pdf->SetPrintFooter(false);
$obj_pdf->AddPage();

ob_start();
$table_data = '';
$content = '';
$item = '';

$y = 1;

foreach ($data_array as $va){

    if($va['course_type'] == 'F'){
        $cou_type = 'Full Time';
    } else {
        $cou_type = 'Part Time';
    }
    
    $item .= '<tr nobr="true" style="height: 20px;">'.
            '<td align="center">'.$y.'</td>'.
            '<td align="center">' . $va['br_name'] . '</td>'.
            '<td align="center">' . $cou_type . '</td>'.
            '<td align="center">' . $va['stu_count'] . '</td>'.
            '<td align="center">' . $va['sat_exam'] . '</td>'.
            '<td align="center">' . $va['pass_count'] . '</td>'.
            '<td align="center">' . $va['inc_count'] . '</td>'.
            '<td align="center">' . $va['ab_ne_count'] . '</td>'.
            '<td align="center">' . $va['pass_rate_round'] . '</td>'.
            '</tr>';
    $y++;  
}
    
$content = '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
        '<thead>'.
        '<tr>'.
        '<th align="center"><b>No</b></th>'.
        '<th align="center"><b>Institute</b></th>'.
        '<th align="center"><b>Full Time/Part Time</b></th>'.
        '<th align="center"><b>No of Total Applicants</b></th>'.
        '<th align="center"><b>Sat for the exam</b></th>'.
        '<th align="center"><b>Passed All Subjects</b></th>'.
        '<th align="center"><b>In-completed</b></th>'.
        '<th align="center"><b>All AB+NE</b></th>'.
        '<th align="center"><b>Pass Rate %</b></th>'.
        '</tr>'.
        '</thead>'.
        '<tbody id="tbl_body">'.
        $item.
        '</tbody>'.
        '</table>';


$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 38, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);

$obj_pdf->Output('output.pdf', 'I');
