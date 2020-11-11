<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('L','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Mahapola Eligible Students Summary";
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
		$obj_pdf->SetFont('helvetica', '', 7);
		$obj_pdf->setFontSubsetting(false);
                $obj_pdf->SetPrintHeader(false);
                $obj_pdf->SetPrintFooter(true);
		$obj_pdf->AddPage();
		
ob_start();

$i = 1;

$item='';
$authority = '';
$search_course = '';

    foreach ($mahapola_report_data['mahapola'] as $va) {
        //print_r($course);
         $item  .= '<tr nobr="true">'.
                    '<td align="center" style="width: 5%">'.$i.'</td>'.
                    '<td style="width: 18%">'.$va['full_name'].'</td>'.
                    '<td style="width: 15%">'.$va['first_name'].'</td>'.
                    '<td align="center" style="width: 5%">'.$va['al_year'].'</td>'.
                    '<td align="center">'.$va['al_index_no'].'</td>'.
                    '<td align="center" style="width: 6%">'.$va['al_z_core'].'</td>'.
                    '<td align="center" style="width: 6%">'.$va['sex'].'</td>'.
                    '<td align="center">'.$va['nic_no'].'</td>'.
                    '<td>'.$va['course_code_mahapola'].'</td>'.
                    '<td style="width: 13%">'.$va['reg_no'].'</td>'.
                    '<td style="width: 13%">'.$va['permanent_address'].'</td>'.
                    '<td align="right" style="width: 6%">'.$va['need_index'].'</td>'.
                    //'<td></td>'.
                '</tr>';
         
    $i++;
      
    }
    
  
    foreach ($mahapola_report_data['authority'] as $mrda){
       $name = $mrda['name'];
       $position = $mrda['position'];
       
       $authority .= '<td align="left">'.$name.'<br/><b>'.$position.'</b></td>';
            
   }
   $Mahapola_commence_dates = $mahapola_report_data['Mahapola_commence_dates'][0];
   $admitted_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_admitted']));
   $commence_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_commence']));
   
   if($course == 'all'){
       $search_course = 'All Courses';
   }
   else{
       if($all == '1')
           $search_course = 'All Courses';
       else
        $search_course =  $va['course_code_mahapola'];
   }

   if($all == '1'){
       $search_center = 'All Centers';
   }
   else{
      $search_center =  $va['center_name'];
   }
   
   $echo_center = "";
    if($center != 'all')
        $echo_center = '<tr><td><label align="left" style="font-size:8px;">Name of the ATI/ Section</label> </td><td><label align="left" style="font-size:8px;"><b>'.$search_center.'</b></label></td></tr>';
   $content =
           '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br>'.
            '<br>'.
            '<label align="center" style="font-size:12px;">Name List of the Selected Students</label><br><br><br>'.
            '<table>'.
            $echo_center.
            '<tr><td><label align="left" style="font-size:8px;">Name of the Approved Course for Mahapola Scholarship</label> </td><td><label align="left" style="font-size:8px;"><b>'.$search_course.'</b></label></td></tr>'.
            '<tr><td><label align="left" style="font-size:8px; line-height: 6%;">Date of Students Admitted </label> </td><td><label align="left" style="font-size:8px;"><b>'.$admitted_date.'</b></label></td></tr>'.
            '<tr><td><label align="left" style="font-size:8px; line-height: 6%;">Date of Course Commenced </label> </td><td><label align="left" style="font-size:8px;"><b>'.$commence_date.'</b></label></td></tr>'.
            '<tr><td><label align="left" style="font-size:8px; line-height: 6%;">No of Students Enrollment</label> </td><td><label align="left" style="font-size:8px;"><b>'.$mahapola_report_data['stu_count'][0]['stu_count'].'</b></label></td></tr>'.
            '<tr><td><label align="left" style="font-size:8px; line-height: 6%;">No of Eligible Students for Mahapola</label> </td><td><label align="left" style="font-size:8px;"><b>'.$mahapola_report_data['mp_count'][0]['mp_count'].'</b></label></td></tr>'.
            '</table><br><br>'.
    '<table border="0.5" style="width:90%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center" style="width: 5%"><b>S/No</b></th>'.
            '<th align="center" style="width: 18%"><b>Name in Full</b></th>'.
            '<th align="center" style="width: 15%"><b>Name with Initial</b></th>'.
            '<th align="center" style="width: 5%"><b>Year<br/>(A/L)</b></th>'.
            '<th align="center"><b>Index No<br/>(G.C.E. A/L)</b></th>'.
            '<th align="center" style="width: 6%"><b>Z-Score</b></th>'.
            '<th align="center" style="width: 6%"><b>Gender</b></th>'.
            '<th align="center"><b>NIC No</b></th>'.
            '<th align="center"><b>Name of<br/>the Course</b></th>'.
            '<th align="center" style="width: 13%"><b>Registration No</b></th>'.
            '<th align="center" style="width: 13%"><b>Address</b></th>'.
            '<th align="center" style="width: 6%"><b>Need<br/>Index</b></th>'.
            //'<th align="center"><b>Other</b></th>'.
        '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
    '<tfoot border="0">'.
    '<tr>'.
      '<td></td>'.
      '<td></td>'.
    '</tr>'.
  '</tfoot>'.
   '</table><br><br><br>'.
    '<table nobr="true">'. 
        '<tr nobr="true">'.
            '<td>Prepared By: ...............................</td>'.
            '<td>Checked By: ...............................</td>'.
            '<td>Recommended By: ...............................</td>'.
            '<td>Approved By: ...............................</td>'.
        '</tr>'.
        '<tr nobr="true">'.
           $authority.
        '</tr>'.
        '<tr nobr="true">'.
         '<td></td>'.
         '<td></td>'.
         '<td>'.date("......./m/Y").'</td>'.
         '<td>'.date("......./m/Y").'</td>'.
     '</tr>'.
    '</table>';    
          
    


//        if (!empty($stu_all_count_array)) {
//            foreach ($stu_all_count_array as $va) {

    

//            }
//        }

                 

//}

$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 140, 7, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=30, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$obj_pdf->Output('output.pdf', 'I');
