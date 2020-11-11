<?php

if ($year_no == 1) {
    $year = "FIRST YEAR - ";
} else if ($year_no == 2) {
    $year = "SECOND YEAR - ";
} else if ($year_no == 3) {
    $year = "THIRD YEAR - ";
} else {
    $year = "FOURTH YEAR - ";
}

if ($semester_no == 1) {
    $semester = "FIRST SEMESTER - ";
} else if ($semester_no == 2) {
    $semester = "SECOND SEMESTER - ";
} else {
    $semester = "THIRD SEMESTER - ";
}

$course_data = $course_details['course_code'] . " - " . $course_details['course_name'];

$report_type = "Semester Subject wise Analysis Report";

$this->load->library('tcpdf/Tcpdf_data_analysis');
$obj_pdf = new Tcpdf_data_analysis('L', 'mm', 'A4', true, 'UTF-8', false);
$obj_pdf->setData($report_type, $year, $semester, $batch_code, $course_data);

$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Semester Subject wise Analysis Report";
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
$itemSubject = '';
$prevId = 0;
$subj_key_id = 0;
$sta_exam_full = 0;
$sta_exam_part = 0;
$pass_exam_full = 0;
$pass_exam_part = 0;
$fail_exam_full = 0;
$fail_exam_part = 0;
$absent_exam_full = 0;
$absent_exam_part = 0;
$pass_rate_full = 0;
$pass_rate_part = 0;
$itemFullTime = '';
$itemPartTime = '';
$stu_full = 0;
$stu_part = 0;

$pass_fulltime_rate = 0;
$pass_parttime_rate = 0;
$key_id = 0;
$select_value = $_GET['sub'];

$y = 1;
$category = $_GET['cat'];
//$subject  = $_GET['sub'];

if ($category == 1) {
    foreach ($data_array as $va) {

        if (count($va['subjects']) > 0) {

            for ($i = 0; $i < count($va['subjects']); $i++) {

                $subjId = $va['subjects'][$i]['id'];

                if ($i > 0) {
                    $prevId = $va['subjects'][$i - 1]['id'];
                }

                if ($subjId != $prevId) {

                    $item .= '<tr nobr="true" style="height: 20px;">' .
                            '<td align="left" style="width: 40%;"><b>[' . $va['subjects'][$i]['code'] . '] - ' . $va['subjects'][$i]['subject'] . '</b></td>' .
                            '<td align="center" style="width: 10%;"></td>' .
                            '<td align="center" style="width: 10%;"></td>' .
                            '<td align="center" style="width: 10%;"></td>' .
                            '<td align="center" style="width: 10%;"></td>' .
                            '<td align="center" style="width: 10%;"></td>' .
                            '<td align="center" style="width: 10%;"></td>' .
                            '</tr>';
                }

                $total_applicant = 0;
                $total_exm_sat_applicant = 0;
                $total_pass = 0;
                $total_fail = 0;
                $total_absent = 0;
                $total_pass_rate = 0;


                for ($j = 0; $j < count($va['subj_data']); $j++) {

                    for ($k = 0; $k < count($va['subj_data'][$j]['sat_exam']); $k++) {

                        foreach ($va['subj_data'][$j]['sat_exam'][$k] as $key => $value) {
                            $subj_key_id = $key;
                        }

                        if ($subj_key_id == $va['subjects'][$i]['id']) {
                            $sta_exam_full = $va['subj_data'][$j]['sat_exam'][$k][$va['subjects'][$i]['id']]['full_time'];
                            $sta_exam_part = $va['subj_data'][$j]['sat_exam'][$k][$va['subjects'][$i]['id']]['part_time'];

                            $pass_exam_full = $va['subj_data'][$j]['pass_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                            $pass_exam_part = $va['subj_data'][$j]['pass_count'][$k][$va['subjects'][$i]['id']]['part_time'];

                            $fail_exam_full = $va['subj_data'][$j]['fail_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                            $fail_exam_part = $va['subj_data'][$j]['fail_count'][$k][$va['subjects'][$i]['id']]['part_time'];

                            $absent_exam_full = $va['subj_data'][$j]['absent_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                            $absent_exam_part = $va['subj_data'][$j]['absent_count'][$k][$va['subjects'][$i]['id']]['part_time'];

                            $pass_rate_full = $va['subj_data'][$j]['pass_rate'][$k][$va['subjects'][$i]['id']]['full_time'];
                            $pass_rate_part = $va['subj_data'][$j]['pass_rate'][$k][$va['subjects'][$i]['id']]['part_time'];

                            $stu_full = $va['subj_data'][$j]['stu_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                            $stu_part = $va['subj_data'][$j]['stu_count'][$k][$va['subjects'][$i]['id']]['part_time'];

                            //calculate total
                            $total_applicant += ($stu_full + $stu_part);
                            $total_exm_sat_applicant += ($sta_exam_full + $sta_exam_part);
                            $total_pass += ($pass_exam_full + $pass_exam_part);
                            $total_fail += ($fail_exam_full + $fail_exam_part);
                            $total_absent += ($absent_exam_full + $absent_exam_part);
                            $total_pass_rate += ($pass_rate_full + $pass_rate_part);
                        }
                    }

                    $item .= '<tr nobr="true" style="height: 20px;">' .
                            '<td align="left" style="width: 40%;">' . $va['subj_data'][$j]['br_name']['full_time'] . '</td>' .
                            '<td align="center" style="width: 10%;">' . $stu_full . '</td>' .
                            '<td align="center" style="width: 10%;">' . $sta_exam_full . '</td>' .
                            '<td align="center" style="width: 10%;">' . $pass_exam_full . '</td>' .
                            '<td align="center" style="width: 10%;">' . $fail_exam_full . '</td>' .
                            '<td align="center" style="width: 10%;">' . $absent_exam_full . '</td>' .
                            '<td align="center" style="width: 10%;">' . $pass_rate_full . '</td>' .
                            '</tr>' .
                            '<tr nobr="true" style="height: 20px;">' .
                            '<td align="left" style="width: 40%;">' . $va['subj_data'][$j]['br_name']['part_time'] . '</td>' .
                            '<td align="center" style="width: 10%;">' . $stu_part . '</td>' .
                            '<td align="center" style="width: 10%;">' . $sta_exam_part . '</td>' .
                            '<td align="center" style="width: 10%;">' . $pass_exam_part . '</td>' .
                            '<td align="center" style="width: 10%;">' . $fail_exam_part . '</td>' .
                            '<td align="center" style="width: 10%;">' . $absent_exam_part . '</td>' .
                            '<td align="center" style="width: 10%;">' . $pass_rate_part . '</td>' .
                            '</tr>';
                }

                $item .= '<tr nobr="true" style="height: 20px;">' .
                        '<td align="center" style="width: 40%;"><b>Total</b></td>' .
                        '<td align="center" style="width: 10%;"><b>' . $total_applicant . '</b></td>' .
                        '<td align="center" style="width: 10%;"><b>' . $total_exm_sat_applicant . '</b></td>' .
                        '<td align="center" style="width: 10%;"><b>' . $total_pass . '</b></td>' .
                        '<td align="center" style="width: 10%;"><b>' . $total_fail . '</b></td>' .
                        '<td align="center" style="width: 10%;"><b>' . $total_absent . '</b></td>' .
                        '<td align="center" style="width: 10%;"><b>' . $total_pass_rate . '</b></td>' .
                        '</tr>';
            }
        }
        $y++;
    }
    $content = '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
            '<thead>' .
            '<tr>' .
            '<th align="center" style="width: 40%;"><b>Institute</b></th>' .
            '<th align="center" style="width: 10%;"><b>No:of Applicant</b></th>' .
            '<th align="center" style="width: 10%;"><b>No:of Student sat for the Examination</b></th>' .
            '<th align="center" style="width: 10%;"><b>Pass</b></th>' .
            '<th align="center" style="width: 10%;"><b>Fail</b></th>' .
            '<th align="center" style="width: 10%;"><b>Absent</b></th>' .
            '<th align="center" style="width: 10%;"><b>% Pass</b></th>' .
            '</tr>' .
            '</thead>' .
            '<tbody id="tbl_body">' .
            $item .
            '</tbody>' .
            '</table>';
} else if ($category == 2) {
    foreach ($data_array as $va) {
        for ($i = 0; $i < count($va['subjects']); $i++){
        $total_applicant = 0;
        $total_exm_sat_applicant = 0;
        $total_pass = 0;
        $total_fail = 0;
        $total_absent = 0;
        $total_pass_rate = 0;
        for ($j = 0; $j < count($va['subj_data']); $j++) {
            for ($k = 0; $k < count($va['subj_data'][$j]['sat_exam']); $k++) {
                foreach ($va['subj_data'][$j]['sat_exam'][$k] as $key => $value) {
                    $subj_key_id = $key;
                }
                
                if ($subj_key_id == $va['subjects'][$i]['id']){
                    $sta_exam_full = $va['subj_data'][$j]['sat_exam'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $sta_exam_part = $va['subj_data'][$j]['sat_exam'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $pass_exam_full = $va['subj_data'][$j]['pass_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $pass_exam_part = $va['subj_data'][$j]['pass_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $fail_exam_full = $va['subj_data'][$j]['fail_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $fail_exam_part = $va['subj_data'][$j]['fail_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $absent_exam_full = $va['subj_data'][$j]['absent_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $absent_exam_part = $va['subj_data'][$j]['absent_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $pass_rate_full = $va['subj_data'][$j]['pass_rate'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $pass_rate_part = $va['subj_data'][$j]['pass_rate'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $stu_full = $va['subj_data'][$j]['stu_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $stu_part = $va['subj_data'][$j]['stu_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    
                    $total_applicant += ($stu_full + $stu_part);
                    $total_exm_sat_applicant += ($sta_exam_full + $sta_exam_part);
                    $total_pass += ($pass_exam_full + $pass_exam_part);
                    $total_fail += ($fail_exam_full + $fail_exam_part);
                    $total_absent += ($absent_exam_full + $absent_exam_part);
                    $total_pass_rate += ($pass_rate_full + $pass_rate_part);
                }
            }
        }
        
        $item .= '<tr nobr="true" style="height: 20px;">' .
                    '<td align="left" style="width: 40%;"><b>[' . $va['subjects'][$i]['code'] . '] - ' . $va['subjects'][$i]['subject'] . '</b></td>' .
                    '<td align="center" style="width: 10%;">'.$total_applicant.'</td>' .
                    '<td align="center" style="width: 10%;">'.$total_exm_sat_applicant.'</td>' .
                    '<td align="center" style="width: 10%;">'.$total_pass.'</td>' .
                    '<td align="center" style="width: 10%;">'.$total_fail.'</td>' .
                    '<td align="center" style="width: 10%;">'.$total_absent.'</td>' .
                    '<td align="center" style="width: 10%;">'.$total_pass_rate.'</td>' .
                    '</tr>';
        
    }

    $content = '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
            '<thead>' .
            '<tr>' .
            '<th align="center" style="width: 40%;"><b>Subject</b></th>' .
            '<th align="center" style="width: 10%;"><b>Total Applicant</b></th>' .
            '<th align="center" style="width: 10%;"><b>Sat for the exam</b></th>' .
            '<th align="center" style="width: 10%;"><b>Passed</b></th>' .
            '<th align="center" style="width: 10%;"><b>Failed</b></th>' .
            '<th align="center" style="width: 10%;"><b>Absentees</b></th>' .
            '<th align="center" style="width: 10%;"><b>% Pass rate</b></th>' .
            '</tr>' .
            '</thead>' .
            '<tbody id="tbl_body">' .
            $item .
            '</tbody>' .
            '</table>';
    }
    
} else if ($category == 3) {
    
    foreach ($data_array as $va) {
        for ($i = 0; $i < count($va['subjects']); $i++){
        $total_applicant = 0;
        $total_exm_sat_applicant = 0;
        $total_pass = 0;
        $total_fail = 0;
        $total_absent = 0;
        $total_pass_rate = 0;
        for ($j = 0; $j < count($va['subj_data']); $j++) {
            for ($k = 0; $k < count($va['subj_data'][$j]['sat_exam']); $k++) {
                foreach ($va['subj_data'][$j]['sat_exam'][$k] as $key => $value) {
                    $subj_key_id = $key;
                }
                
                if ($subj_key_id == $va['subjects'][$i]['id']){
                    $sta_exam_full = $va['subj_data'][$j]['sat_exam'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $sta_exam_part = $va['subj_data'][$j]['sat_exam'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $pass_exam_full = $va['subj_data'][$j]['pass_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $pass_exam_part = $va['subj_data'][$j]['pass_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $fail_exam_full = $va['subj_data'][$j]['fail_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $fail_exam_part = $va['subj_data'][$j]['fail_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $absent_exam_full = $va['subj_data'][$j]['absent_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $absent_exam_part = $va['subj_data'][$j]['absent_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $pass_rate_full = $va['subj_data'][$j]['pass_rate'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $pass_rate_part = $va['subj_data'][$j]['pass_rate'][$k][$va['subjects'][$i]['id']]['part_time'];
                    $stu_full = $va['subj_data'][$j]['stu_count'][$k][$va['subjects'][$i]['id']]['full_time'];
                    $stu_part = $va['subj_data'][$j]['stu_count'][$k][$va['subjects'][$i]['id']]['part_time'];
                    
                    $total_applicant += ($stu_full + $stu_part);
                    $total_exm_sat_applicant += ($sta_exam_full + $sta_exam_part);
                    $total_pass += ($pass_exam_full + $pass_exam_part);
                    $total_fail += ($fail_exam_full + $fail_exam_part);
                    $total_absent += ($absent_exam_full + $absent_exam_part);
                    $total_pass_rate += ($pass_rate_full + $pass_rate_part);
                }
            }
        }
        
        $item .= '<tr nobr="true" style="height: 20px;">' .
                    '<td align="left" style="width: 40%;"><b>[' . $va['subjects'][$i]['code'] . '] - ' . $va['subjects'][$i]['subject'] . '</b></td>' .
                    '<td align="center" style="width: 10%;">'.$total_pass_rate.'</td>' .
                    '</tr>';
        
    }

    $content = '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
            '<thead>' .
            '<tr>' .
            '<th align="center" style="width: 40%;"><b>Subject</b></th>' .
            '<th align="center" style="width: 10%;"><b>Pass Rate</b></th>' .
            '</tr>' .
            '</thead>' .
            '<tbody id="tbl_body">' .
            $item .
            '</tbody>' .
            '</table>';
    }
    

    
    
    
} else {
    foreach ($data_array as $va) {
        if (count($va['subj_data']) > 0) {
            $chart_data_3 = [];
            $chart_data_4 = [];
            
            for ($t = 0; $t < count($va['subjects']); $t++){
                for ($u = 0; $u < count($va['subj_data']); $u++) {
                    for ($p = 0; $p < count($va['subj_data'][$u]['pass_rate']);$p++) {
                        foreach ($va['subj_data'][$u]['sat_exam'][$p] as $key => $value) {
                            $key_id = $key;
                        }
                        if ($key_id == $va['subjects'][$t]['id']){
                            $pass_fulltime_rate = $va['subj_data'][$u]['pass_rate'][$p][$va['subjects'][$t]['id']]['full_time'];
                            $pass_parttime_rate = $va['subj_data'][$u]['pass_rate'][$p][$va['subjects'][$t]['id']]['part_time'];
                        }
                    }
                    
                    if ($select_value == $va['subjects'][$t]['id']){
                        $item .='<tr nobr="true" style="height: 20px;">' .
                                '<td align="left" style="width: 40%;">'.$va['subj_data'][$u]['br_name']['full_time'].'</td>' .
                                '<td align="center" style="width: 10%;">'.$pass_fulltime_rate.'</td>' .
                                '</tr>';
                        
                        $item .='<tr nobr="true" style="height: 20px;">' .
                                '<td align="left" style="width: 40%;">'.$va['subj_data'][$u]['br_name']['part_time'].'</td>' .
                                '<td align="center" style="width: 10%;">'.$pass_parttime_rate.'</td>' .
                                '</tr>';
                    }
                    $content = '<table align="center" border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
                               '<thead>' .
                               '<tr>' .
                               '<th align="center" style="width: 40%;"><b>Institute</b></th>' .
                               '<th align="center" style="width: 10%;"><b>Pass Rate</b></th>' .
                               '</tr>' .
                               '</thead>' .
                               '<tbody id="tbl_body">' .
                               $item .
                               '</tbody>' .
                               '</table>';
                }
            }
        }
    }
}







$obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 38, $content, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);

$obj_pdf->Output('output.pdf', 'I');
