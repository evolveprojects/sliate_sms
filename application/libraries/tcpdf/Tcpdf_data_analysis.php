<?php
class Tcpdf_data_analysis extends Tcpdf {

    public $report_type;
    public $year;
    public $semester;
    public $batch;
    public $course;
    
    public function setData($report_type, $year, $semester,$batch,$course){
        $this->year = $year;
        $this->semester = $semester;
        $this->report_type = $report_type;
        $this->batch = $batch;
        $this->course = $course;
    }

    public function Header() {
        $report_type = $this->report_type;
        $year = $this->year;
        $semester = $this->semester;
        $batch = $this->batch;
        $course = $this->course;
        
        $image = base_url("uploads/sliate_logo.jpg");
        $this->Image($image, 50, 10, 15, 20, 'jpg');
        $header = '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technological Education (SLIATE)</strong></label><br><br>' .
                  '<label align="center" style="font-size:8px;"> '.$course.'</label><br>'.
                  '<label align="center" style="font-size:8px;"> '.$year.$semester.$batch.'</label><br>'.
                  '<label align="center" style="font-size:8px;"> '.$report_type.' </label><br/>';
        
        $this->SetY(10);
        $this->writeHTML($header, true, false, true, false, '');
    }
    
}

