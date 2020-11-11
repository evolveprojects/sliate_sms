<?php
class Tcpdf_other extends Tcpdf {
    
    public $year;
    public $semester;
    public $conduct_year;
    public $course_selected;
    public $center_selected;
    public $report_type;
     
    public function setData($report_type,$year,$semester,$conduct_year,$course_selected,$center_selected){
        $this->report_type = $report_type;
        $this->year = $year;
        $this->semester = $semester;
        $this->conduct_year = $conduct_year;
        $this->course_selected = $course_selected;
        $this->center_selected = $center_selected;
    }
    
    public function Header() {
        $report_type = $this->report_type;
        $year = $this->year;
        $semester = $this->semester;
        $conduct_year = $this->conduct_year;
        $course_selected =$this->course_selected;
        $center_selected = $this->center_selected;
        
        $image = base_url("uploads/sliate_logo.jpg");
        $this->Image($image, 50, 10, 15, 20, 'jpg');
        $header = '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technological Education (SLIATE)</strong></label><br><br>' .
            '<label align="center" style="font-size:8px;"> '.$year.$semester.'EXAMINATION '.$conduct_year.'</label><br>'.
            '<label align="center" style="font-size:8px;"> '.$course_selected['course_name'].'</label><br>'.
            '<label align="center" style="font-size:8px;">Result Sheet'.$report_type.'</label><br/>'.
            '<label align="left" style="font-size:8px;"> INSTITUTE: '.$center_selected['br_name'].'</label><br>';
        
        $this->SetY(10);
        $this->writeHTML($header, true, false, true, false, '');
    }

    public function Footer() {
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
        $html = '<table> 
            <tr align="center">
                <td>This is a computer generated report.</td>
                
            </tr>
            
        </table>';   
        
            $this->writeHTML($html, true, false, true, false, '');
    }
}

