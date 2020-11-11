<?php

$course_name = '';
$course_code = '';
$batch_code = '';
$year_no = '';
$semester_no = '';
$exam_code = '';
$exam_year = '';
$item = '';
$center_name = '';
$examination_date = '';
$examination_time = '';
$sub_name = '';

$i = 1;

if(!empty($student_sub_mark_array)){
    foreach ($student_sub_mark_array as $va) {
        if($i == 1){
            $course_name = $va['course_name'];
            $course_code = $va['course_code'];
            $batch_code = $va['batch_code'];
            $year_no = $va['year_no'];
            $semester_no = $va['semester_no'];
            $exam_code = $va['exam_code'];
            $exam_year = $va['exam_year'];
            $center_name = $va['br_name'];
            $examination_date = $va['examination_date'];
            $examination_time = $va['examination_time'];
            $sub_name = '['.$va['sub_code'].'] '.$va['sub_name'];
        }

        $item .= '<tr nobr="true">' .
                '<td align="center" style="width:26px">'.$i.'</td>' .
                '<td align="center" style="width:107px">'.$va['reg_no'].'</td>' .
                '<td align="center" style="width:75px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '<td align="center" style="width:30px"></td>' .
                '</tr>';

        $i++;
    }
}

$this->load->library('tcpdf/Tcpdf_data_exam_sub_mark');
$obj_pdf = new Tcpdf_data_exam_sub_mark('P', 'mm', 'A4', true, 'UTF-8', false);
$obj_pdf->setData($course_name,$course_code,$batch_code,$year_no,$semester_no,$exam_code,$exam_year,$center_name,$examination_date,$examination_time,$sub_name);

$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Exam Subject Mark Sheet Report";
$obj_pdf->SetTitle($title);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, 100, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, 50);
$obj_pdf->SetFont('helvetica', '', 8);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->SetPrintHeader(true);
$obj_pdf->SetPrintFooter(true);
$obj_pdf->AddPage();

ob_start();

$content = 
        '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
        '<thead>' .
        '<tr>' .
        '<th align="center" style="width:26px"><b>Ser.No</b></th>' .
        '<th align="center" style="width:107px"><b>Index No</b></th>' .
        '<th align="center" style="width:75px"><b>Total</b></th>' .
        '<th align="center" style="width:30px"><b>Q.01</b></th>' .
        '<th align="center" style="width:30px"><b>Q.02</b></th>' .
        '<th align="center" style="width:30px"><b>Q.03</b></th>' .
        '<th align="center" style="width:30px"><b>Q.04</b></th>' .
        '<th align="center" style="width:30px"><b>Q.05</b></th>' .
        '<th align="center" style="width:30px"><b>Q.06</b></th>' .
        '<th align="center" style="width:30px"><b>Q.07</b></th>' .
        '<th align="center" style="width:30px"><b>Q.08</b></th>' .
        '<th align="center" style="width:30px"><b>Q.09</b></th>' .
        '<th align="center" style="width:30px"><b>Q.10</b></th>' .
        '</tr>' .
        '</thead>' .
        '<tbody id="tbl_body">'.
        $item .
        '</tbody>' .
        '</table>'.
        
        '<table style="border:1px solid black; width:100%; vertical-align:center;" cellspacing="0" cellpadding="10">'.
        '<tbody>'.
        '<tr >'.
        '<td style="border-right: none">'.
        'Total Applicants : '.($i-1).
        '</td>'.
        '<td style="border-right: none">'.
        'Not Eligible : '.
        '</td>'.
        '<td style="border-right: none">'.
        'Sat for the Exam : '.
        '</td>'.
        '<td style="border-right: none">'.
        'Absent : '.
        '</td>'.
        '<td style="border-right: none">'.
        'Examination Fraud : '.
        '</td>'.
        '</tr>'.
        '<tr >'.
        '<td style="border-right: none" colspan="4">'.
        '<b>No. of Answer Scripts enclosed:.................................</b>(i) Supervisor Name & Signature'.
        '</td>'.
        '</tr>'.
        '</tbody>'.
        '</table>'.
        '&nbsp;<br/>'.
        
        '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
        '<tbody>'.
        '<tr >'.
        '<th style="width:179px" colspan="2">'.
        '<b>Name</b>'.
        '</th>'.
        '<th style="width:110px" colspan="2">'.
        '<b>Date of Commencement</b>'.
        '</th>'.
        '<th style="width:110px" colspan="2">'.
        '<b>Date of Completion</b>'.
        '</th>'.
        '<th style="width:110px" colspan="2">'.
        '<b>Signature</b>'.
        '</th>'.
        '</tr>'.
        
        '<tr>'.
        '<th>'.
        '<b>Examiner</b>'.
        '</th>'.
        '<th>'.
        '<b>Marking Moderator</b>'.
        '</th>'.
        '<th>'.
        '<b>Examiner</b>'.
        '</th>'.
        '<th>'.
        '<b>Marking Moderator</b>'.
        '</th>'.
        '<th>'.
        '<b>Examiner</b>'.
        '</th>'.
        '<th>'.
        '<b>Marking Moderator</b>'.
        '</th>'.
        '<th>'.
        '<b>Examiner</b>'.
        '</th>'.
        '<th>'.
        '<b>Marking Moderator</b>'.
        '</th>'.
        '</tr>'.
        
        '<tr style="line-height: 22px">'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '</tr>'.
        '</tbody>'.
        '</table>'.
        '&nbsp;<br/>'.
        
        '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
        '<tbody>'.
        '<tr >'.
        '<th>'.
        '</th>'.
        '<th style="width:138px">'.
        '<b>Name of Examiner / Moderator</b>'.
        '</th>'.
        '<th style="width:90px">'.
        '<b>ATI</b>'.
        '</th>'.
        '<th style="width:90px">'.
        '<b>Date</b>'.
        '</th>'.
        '<th style="width:90px">'.
        '<b>Signature</b>'.
        '</th>'.
        '</tr>'.
        '<tr>'.
        '<td>'.
        'Total marks entered to the Mark Sheet by'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '</tr>'.
        '<tr>'.
        '<td>'.
        'Total marks entered to the System by'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '<td>'.
        '</td>'.
        '</tr>'.
        '</tbody>'.
        '</table>';

$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 100, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);

$obj_pdf->Output('output.pdf', 'I');
