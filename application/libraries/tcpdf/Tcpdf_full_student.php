<?php
class Tcpdf_full_student extends Tcpdf {
//    private $authority;
//            function __construct($authority) {
//        $this->some_parameter = $init_parameter;
//    }
    
    public $course_selected;
    public $center_selected;
    public $batch_selected;
    public $authority_data;
    public $reg_no;
    public $first_name;
     
    public function setData($course_selected,$center_selected,$batch_selected,$authority_data,$reg_no,$first_name){
        $this->course_selected = $course_selected;
        $this->center_selected = $center_selected;
        $this->batch_selected = $batch_selected;
        $this->authority_data = $authority_data;
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
//        $this->load->model('Report_model');
//        $authority_data = $this->Report_model->get_result_authorities();
//        
        $authority_data = $this->authority_data;
        //$effective_date = $this->effective_date;
        $current_date = date('d-m-Y');
        $x = 0;
        $authority = '';
        foreach ($authority_data as $aut){

            $name = $aut['name'];
            $position = $aut['position'];

            if($x == 0){
               // $authority .= '<td align="left"><b><br>'.$name.'<br/>'.$position.'</b><br/><br/>Effective Date&nbsp;&nbsp;&nbsp; : '.$effective_date.'<br/><br/>Date of Issuing&nbsp; : '.$current_date.'</td>';
                $authority .= '<td align="left"><b><br>'.$name.'<br/>'.$position.'</b><br/><br/><br/>Date of Issuing&nbsp; : '.$current_date.'</td>';
                $x++;
            }
            else{
                $authority .= '<td align="left"><b><br>'.$name.'<br/>'.$position.'</b></td>';
            }
        }

        $this->SetY(-35);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        
//        $html = '<table> 
//            <tr>
//                <td>Prepared By: ...............................</td>
//                <td>Checked By: ...............................</td>
//                <td>Certified By: ...............................</td>
//                <td>Approved By: ...............................</td>
//            </tr>
//            
//        </table>';   
        $table = '<table> <tr><td>Prepared By: ...............................</td><td>Checked By: ...............................</td><td>Certified By: ...............................</td><td>Approved By: ...............................</td></tr><tr>'.$authority.'</tr></table>';
            $this->writeHTML($table, true, false, true, false, '');
    }
    
}

