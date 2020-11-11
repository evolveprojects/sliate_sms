<?php

$this->load->library('tcpdf/tcpdf');

$obj_pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Student Exam Details Report";
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
for($main_loop=0;$main_loop<$student_details['count'];$main_loop++)
{

    $item = '';
    $item_subject = '';
    $common_person = '';

    $main_timetable = array();
    $student_timetable = array();
    $student_follow_subject = array();


    $maintbl_count = 0;
    $date = '';


    foreach ($student_details[$main_loop]['stu_all_count_array'] as $va) {

//        $exam_year = $va['exam_year'];
        $stu_name = $va['first_name']; //. ' ' . $va['last_name'];
        $reg_no = $va['reg_no'];
        $course_name = $va['course_name'];
        $center_name = $va['br_name'];
        
        if($student_status == 1){
            $current_semester = get_Ordinal($va['current_semester']);
            $current_year = get_Ordinal($va['current_year']);
        } else {
            $current_semester = get_Ordinal($va['applying_semester']);
            $current_year = get_Ordinal($va['applying_year']);
        }
        
    }
    $sfs_count = 0;
    foreach ($student_details[$main_loop]['student_follow_subject'] as $sfs) {

        $student_follow_subject[$sfs_count]['no'] = ($sfs_count + 1);
        $student_follow_subject[$sfs_count]['code'] = $sfs['code'];
        $student_follow_subject[$sfs_count]['version_name'] = $sfs['version_name'];
        $student_follow_subject[$sfs_count]['subject'] = $sfs['subject'];
        $sfs_count++;
    }


    foreach ($student_details['schedules'] as $sa) {
        $sub_ver = '';
        $time_temp = '';
        $format_starttime = '';
        $time_temp_end = '';
        $format_endtime = '';

        $time_temp = strtotime($sa['esch_stime']);
        $format_starttime = date('H:i', $time_temp);
        $time_temp_end = strtotime( $sa['esch_etime']);
        $format_endtime = date('H:i', $time_temp_end);
        $exam_year = date('Y', strtotime($sa['esch_date']));

        foreach ($sa['subjects_version'] as $sv) {
            $sub_ver .= $sv['version_name'] . '/';
        }
        $sub_ver .= $sa['version_name'];

        
        $sub_code = $sa['code'] . '<br>(' . $sub_ver . ')';
        $sub_name = $sa['subject'] . '[' . $sa['name'].']';
        $time = $format_starttime . ' - ' . $format_endtime;
        
        if (date('H', $time_temp) < 12) {
            $main_timetable[$maintbl_count]['morning']['date'] = $sa['esch_date'];
            $main_timetable[$maintbl_count]['morning']['sub_code'] = $sub_code;
            $main_timetable[$maintbl_count]['morning']['sub_name'] = $sub_name;
            $main_timetable[$maintbl_count]['morning']['time'] = $time;
        }
        if (date('H', $time_temp) >= 12) 
        {
            if($date == $sa['esch_date'])
                $in_c = $maintbl_count - 1;
            else 
                $in_c = $maintbl_count;
            
            $main_timetable[$in_c]['evening']['date'] = $sa['esch_date'];
            $main_timetable[$in_c]['evening']['sub_code'] = $sub_code;
            $main_timetable[$in_c]['evening']['sub_name'] = $sub_name;
            $main_timetable[$in_c]['evening']['time'] = $time;
        }
        
        $maintbl_count++;
        $date = $sa['esch_date'];
        
    }

//$cp=0;
    foreach ($student_details['common_details'] as $cd) {
        // $common_person[$cp]['name']=$student_details['common_details']['name'];
        // $common_person[$cp]['position']=$student_details['common_details']['position'];
        $common_person .=
            '<td align="left" style="font-family: Times New Roman; font-size:9px;width: 70%;"><label><b>' . $cd['name'] . '</b></label><br><label>' . $cd['position'] . '</label><br><label>SLIATE</label></td>';

    }


    foreach ($student_follow_subject as $sub_list) {


        $item_subject .= '<tr>' .
            '<td align="center" style="font-family: Times New Roman; width: 25px;">' . (isset($sub_list['no']) ? $sub_list['no'] : '') . '</td>' .
            '<td align="center" style="font-family: Times New Roman; width: 50px;">' . (isset($sub_list['code']) ? $sub_list['code'] : '') . '<br>(' . (isset($sub_list['version_name']) ? $sub_list['version_name'] : '') . ')</td>' .
            '<td align="center" style="font-family: Times New Roman; width: 115px;">' . (isset($sub_list['subject']) ? $sub_list['subject'] : '') . '</td>' .
            '<td align="center" style="font-family: Times New Roman; width: 50px;"> </td>' .
            '<td align="center" style="font-family: Times New Roman; width: 100px;"> </td>' .
            '<td align="center" style="font-family: Times New Roman; width: 100px;"> </td>' .
            '<td align="center" style="font-family: Times New Roman; width: 100px;"> </td>' .
            '</tr>';

    }

    foreach ($main_timetable as $mt) {
        $item .= '<tr nobr="true">' .
            '<td align="center" style="width:60px">' . (isset($mt['morning']['date']) ? $mt['morning']['date'] : '') . '</td>' .
            '<td align="center" style="width:70px">' . (isset($mt['morning']['sub_code']) ? $mt['morning']['sub_code'] : '') . '</td>' .
            '<td align="center" style="width:70px">' . (isset($mt['morning']['sub_name']) ? $mt['morning']['sub_name'] : '') . '</td>' .
            '<td align="center" style="width:60px">' . (isset($mt['morning']['time']) ? $mt['morning']['time'] : '') . '</td>' .
            //Evening
            '<td align="center" style="width:60px">' . (isset($mt['evening']['date']) ? $mt['evening']['date'] : '') . '</td>' .
            '<td align="center" style="width:70px">' . (isset($mt['evening']['sub_code']) ? $mt['evening']['sub_code'] : '') . '</td>' .
            '<td align="center" style="width:70px">' . (isset($mt['evening']['sub_name']) ? $mt['evening']['sub_name'] : '') . '</td>' .
            '<td align="center" style="width:60px">' . (isset($mt['evening']['time']) ? $mt['evening']['time'] : '') . '</td>' .
            '</tr>';

    }

    $content[$main_loop] =
        '<label align="center" style="font-size:15px;font-family:Times New Roman;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br/>' .
        '<label align="center" style="font-size:10px;font-family:Times New Roman;">(Established under the Ministry of Higher Education, ACT No. 29 of 1995)</label><br>' .
        // '<label align="center">'.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_addl1.'</label><br>'.
        // '<label align="center">Telephone: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'.
        //  '<label align="center"> Email: '.$this->db->get_where('hgc_branch', array('br_id' => $pay['br_id']))->row()->br_telephone.'</label><br>'.
        // '<label align="right">Receipt No:'.$pay['cheque_ref'].'</label><br>'.
        // '<label align="right">Return Date: '.$pay['return_date'].'</label><br>'.

        // '<label align="center" style="font-size:14px;"><strong>CHEQUE RETURN</strong></label><br>'.
        '<hr>'.
        '<br>' .
        '<label align="center" style="font-size:13px;font-family:Times New Roman"><br><strong>' . $current_semester . ' Semester Examination - ' . $exam_year . '</strong></label><br>' .
        '<label align="center" style="font-size:13px;font-family:Times New Roman"><strong>Admission Card </strong></label><br><br>' .

        '<table border="0.5" style="width:520px; vertical-align:center;" cellspacing="0" cellpadding="5">' .
        '<thead>' .
        '<tr>' .
        '<td align="center" style="font-family: Times New Roman; font-size:12px"><label><b>Name</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; font-size:12px"><label><b>Index No.</b></label></td>' .
        '</tr>' .
        '</thead>' .
        '<tbody id="tbl_body">' .
        '<tr>' .
        '<td align="center" style="font-family: Times New Roman;">' . $stu_name . '</td>' .
        '<td align="center" style="font-family: Times New Roman;">' . $reg_no . '</td>' .
        '</tr>' .
        '<tr>' .
        '<td align="center" style="font-family: Times New Roman;">Advanced Technology: Institute/Section</td>' .
        '<td align="center">' . $center_name . '</td>' .
        '</tr>' .
        '<tr>' .
        '<td align="center" style="font-family: Times New Roman;">If any changes of the name, Please note.<br><br><br>.............................................</td>' .
        '<td align="center" style="font-family: Times New Roman;">Recommendation of the Supervisor <br><br><br>....................................................<br>Signature</td>' .
        '</tr>' .
        '</tbody>' .
        '</table>' .
        '<br><br><br>' .
        '<label align="center" style="font-family:Times New Roman;font-size:16px">' . $course_name . '</label><br>' .
        '<label align="center" style="font-family:Times New Roman;font-size:10px">' . $current_year . ' Year</label><label style="font-family:Times New Roman;font-size:10px"> (New/Old)</label><br><br>' .
        '<font size="7"><table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
        '<thead>' .
        '<tr>' .
        '<td align="center" style="font-family: Times New Roman; width:60px"><label><b>Date</b></label></td>' .
        '<td  style="font-family: Times New Roman; width:70px"><label><b>Subject Code</b></label></td>' .
        '<td style="font-family: Times New Roman; width:70px"><label><b>Subject Name</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width:60px"><label><b>Morning</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width:60px"><label><b>Date</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width:70px "><label><b>Subject Code</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width:70px"><label><b>Subject Name</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width:60px"><label><b>Evening</b></label></td>' .
        '</tr>' .
        '</thead>' .
        '<tbody id="tbl_body">' .
        $item .

        '</tbody>' .
        '</table></font>' .
        '<br>' .
        '<label align="center" style="font-family: Times New Roman; font-size:10px">This candidate is hereby admitted to the above mentioned Examination.</label><br><br>' .

        '<table border="0" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5" >' .
        '<thead>' .
        '<tr>' .
        $common_person .
        '</tr>' .
        '</thead>' .
        '<tbody id="tbl_body">' .
        '</tbody>' .
        '</table>' .
        '<h1 style="font-family: Times New Roman;page-break-before: always">Attestation</h1>' .
        '<br>' .
        '<p style="font-family: Times New Roman; font-size:10px">The identity of the candidate should be attested by the Director/Academic Co-ordinator/ Head of Department/Academic Staff Member/Registrar/Assistant Registrar.</p>' .
        '<br>' .
        '<p style="font-family: Times New Roman; font-size:10px">Student Identity Card /National Identity Card Number : .................................. </p>' .
        '<p>' .
        '<br>' .
        '<p style="font-family: Times New Roman; font-size:10px">Candidate’s Signature : .........................................</p>' .
        '<br>' .
        '<p style="font-family: Times New Roman; font-size:10px">I do certify that the candidate whose name is given overleaf placed his/her signature in my presence today.</p>' .
        '<br>' .
        '<p style="font-family: Times New Roman; font-size:10px">Signature of Attestor : .........................................</p>' .
        '<br>' .
        '<p style="font-family: Times New Roman; font-size:10px">Place of Attestation: ...........................................</p>' .
        '<br>' .
        '<p style="font-family: Times New Roman; font-size:10px">Name of Attestor, Designation and Address: ................................................................................................................................................................................................................................................</p>' .
        '<br><br>' .

        '<label align="center" style="font-family:Times New Roman;font-size:14px">' . $course_name . '</label><br>' .
        '<label align="center" style="font-family:Times New Roman;font-size:10px">' . $current_year . ' Year</label><label style="font-family:Times New Roman;font-size:10px"> (New/Old)</label><br><br>' .
        '<font size="7"><table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
        '<thead>' .
        '<tr>' .
        '<td align="center" style="font-family: Times New Roman; width: 25px;"><label><b>No</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width: 165px;" colspan="2"><label><b>Subject</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width: 50px;"><label><b>Date</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width: 100px;"><label><b>Signature of Candidate</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width: 100px;"><label><b>Name of the Invigilator</b></label></td>' .
        '<td align="center" style="font-family: Times New Roman; width: 100px;"><label><b>Signature of the Invigilator</b></label></td>' .
        '</tr>' .
        '</thead>' .
        '<tbody id="tbl_body">' .
        $item_subject .
        '</tbody>' .
        '</table></font>' .
        '<br><br><br><br>' .
        '<table border="0" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">' .
        '<thead>' .
        '<tr>' .
        '<td align="left" style="font-family: Times New Roman; font-size:10px"><label><b>Date :.......................</b></label><br></td>' .
        '<td></td>' .
        '<td align="left" style="font-family: Times New Roman; font-size:10px"><label><b>Signature of the Supervisor :<br><br>............................................</b></label><br></td>' .

        '</tr>' .
        '</thead>' .
        '<tbody id="tbl_body">' .
        '</tbody>' .
        '</table>';


//print_r($content);

//print_r($student_details['schedules']);

}
function get_Ordinal($No)
{
    $Ordinal = '';
    if ($No == 1)
        $Ordinal = $No . "<sup>st</sup>";
    elseif ($No == 2)
        $Ordinal = $No . "<sup>nd</sup>";
    elseif ($No == 3)
        $Ordinal = $No . "<sup>rd</sup>";
    elseif ($No == 4)
        $Ordinal = $No . "<sup>th</sup>";
    return $Ordinal;
}




for ($r = 0; $r < sizeof($content); $r++) {
    $image = base_url("uploads/sliate_logo.jpg");
    $obj_pdf->Image($image, 96, 15, 15, 20, 'jpg');
    $obj_pdf->writeHTMLCell($w = 0, $h = 0, $x = 14, $y = 40, $content[$r], $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'L', $autopadding = true);
    //if ($r < 1) {
        $obj_pdf->AddPage();
   // }
}
$obj_pdf->Output('uploads/'.$filename.'.pdf', 'F');


//$obj_pdf->Output('uploads/filename.pdf', 'F');
