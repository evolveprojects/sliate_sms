<?php
class Tcpdf_data_exam_sub_mark extends Tcpdf {

    public $course_name;
    public $course_code;
    public $batch_code;
    public $year_no;
    public $semester_no;
    public $exam_code;
    public $exam_year;
    public $center_name;
    public $examination_date;
    public $examination_time;
    public $sub_name;

    public function setData($course_name,$course_code,$batch_code,$year_no,$semester_no,$exam_code,$exam_year,$center_name,$examination_date,$examination_time,$sub_name){
        $this->course_name = $course_name;
        $this->course_code = $course_code;
        $this->batch_code = $batch_code;
        $this->year_no = $year_no;
        $this->semester_no = $semester_no;
        $this->exam_code = $exam_code;
        $this->exam_year = $exam_year;
        $this->center_name = $center_name;
        $this->examination_date = $examination_date;
        $this->examination_time = $examination_time;
        $this->sub_name = $sub_name;
    }
    public function Header() {
        $course_name = $this->course_name;
        $course_code = $this->course_code;
        $batch_code =  $this->batch_code;
        $year_no = $this->year_no;
        $semester_no = $this->semester_no;
        $exam_code = $this->exam_code;
        $exam_year = $this->exam_year;
        $center_name = $this->center_name;
        $examination_date = $this->examination_date;
        $examination_time = $this->examination_time;
        $sub_name = $this->sub_name;
        
        $year_text = '';
        $Ordinal = '';
        if ($year_no == 1){
            $year_text = 'Year 1';
            $Ordinal = "<sup>st</sup><label> Year</label>";
        }
        elseif ($year_no == 2){
            $year_text = 'Year 2';
            $Ordinal = "<sup>nd</sup><label> Year</label>";
        }
        elseif ($year_no == 3){
            $year_text = 'Year 3';
            $Ordinal = "<sup>rd</sup><label> Year</label>";
        }
        elseif ($year_no == 4){
            $year_text = 'Year 4';
            $Ordinal = "<sup>th</sup><label> Year</label>";
        }
        else{}

        $semester_text = '';
        $Ordinaly = '';
        if ($semester_no == 1){
            $semester_text = 'Semester 1';
            $Ordinaly = "<sup>st</sup><label> Semester</label>";
        }
        elseif ($semester_no == 2){
            $semester_text = 'Semester 2';
            $Ordinaly = "<sup>nd</sup><label> Semester</label>";
        }
        elseif ($semester_no == 3){
            $semester_text = 'Semester 3';
            $Ordinaly = "<sup>rd</sup><label> Semester</label>";
        }
        elseif ($semester_no == 4){
            $semester_text = 'Semester 4';
            $Ordinaly = "<sup>th</sup><label> Semester</label>";
        }
        
        $image = base_url("uploads/sliate_logo.jpg");
        $this->Image($image, 15, 10, 15, 20, 'jpg');
        
        $header = '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technological Education (SLIATE)</strong></label><br><br>' .
                '<label align="center" style="font-size:9px;"> '
                . ''.$course_name.' ['.$course_code.'] - '.$batch_code.' Batch</label><br><br>' .
                '<label align="center" style="font-size:9px;"> '
                .$year_no.''.$Ordinal.' '.$semester_no.''.$Ordinaly.' Examination ['.$exam_code.'] - '.$exam_year.' </label><br><br/>' .
                '<label align="center" style="font-size:9px;"> '
                .'Exam Subject Mark Sheet Report</label><br/>'
                . '<hr/>'
                .'<table border="0" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'
                . '<tr><th></th><th></th></tr>'
                . '<tr>'
                . '<th style="font-size:9px;" align="left">Examination Center : '.$center_name.'</th>'
                . '<th style="font-size:9px;" align="left">Course : ['.$course_code.'] '.$course_name.'</th>'
                . '</tr>'
                . '<tr>'
                . '<th style="font-size:9px;" align="left">Year : '.$year_no.'</th>'
                . '<th style="font-size:9px;" align="left">Semester : '.$semester_no.' </th>'
                . '</tr>'
                . '<tr>'
                . '<th style="font-size:9px;" align="left">Subject : '.$sub_name.'</th>'
                . '<th style="font-size:9px;" align="left">Medium : </th>'
                . '</tr>'
                . '<tr>'
                . '<th style="font-size:9px;" align="left">Examination Date : '.$examination_date.'</th>'
                . '<th style="font-size:9px;" align="left">Examination Time : '.$examination_time.'</th>'
                . '</tr>'
                . '<tr>'
                . '<th style="font-size:9px;" align="left">Name of the Supervisor : .......................................... </th>'
                . '<th style="font-size:9px;" align="left">Signature : .......................................... </th>'
                . '</tr>' 
                . '</table>';
                
        $this->SetY(10);
        $this->writeHTML($header, true, false, true, false, '');
    }
    
}

