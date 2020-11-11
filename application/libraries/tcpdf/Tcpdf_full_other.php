<?php
class Tcpdf_full_other extends Tcpdf {

    public $course_selected;
    public $center_selected;
    public $batch_selected;
    public $reg_no;
    public $first_name;
     
    public function setData($course_selected,$center_selected,$batch_selected,$reg_no,$first_name){
        $this->course_selected = $course_selected;
        $this->center_selected = $center_selected;
        $this->batch_selected = $batch_selected;
        $this->reg_no = $reg_no;
        $this->first_name = $first_name;
    }
    
    public function Header() {
        $course_selected =$this->course_selected;
        $center_selected = $this->center_selected;
        $batch_selected = $this->batch_selected;
        $reg_no = $this->reg_no;
        $first_name = $this->first_name;
        
        $image = base_url("uploads/sliate_logo.jpg");
        $this->Image($image, 50, 10, 15, 20, 'jpg');
        $header = '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technological Education (SLIATE)</strong></label><br><br>' .
            '<label align="center" style="font-size:8px;"> '.$course_selected['course_name'].'</label><br>'.
            '<label align="center" style="font-size:8px;"> INSTITUTE: '.$center_selected['br_name'].' - BATCH: '.$batch_selected['batch_code'].'</label><br>'.
            '<label align="center" style="font-size:8px;">Full Result Sheet</label><br/><br/><br/>'.
            '<label align="left" style="font-size:8px;">Reg.No: '.$reg_no.'</label><br/>'.
            '<label align="left" style="font-size:8px;">Name: '.$first_name.'</label><br/>';
            
        
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

