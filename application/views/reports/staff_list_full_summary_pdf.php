<?php

        $this->load->library('tcpdf/tcpdf');
	
		$obj_pdf = new TCPDF('P','mm','A4',true,'UTF-8',false);
		$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "Full Summary of Staff";
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

$i = 1;

$total_staff = 0;
$total_approved = 0;
$total_reject = 0;
$total_not_approve = 0;

$center_total_staff = 0;
$center_total_approved = 0;
$center_total_reject = 0;
$center_total_not_approve = 0;
$item='';

    for($k=0; $k < count($staff_all_count_array);$k++)
    {
        $va = $staff_all_count_array[$k];
        if($k == 0)
        {
            $item  .= '<tr nobr="true">'.
                    '<td> ['.$va['br_code'].'] - '.$va['br_name'].'</td>'.
//                    '<td align="center">'.$va['course_code'].'</td>'.
                    '<td align="center">'.$va['staff_count'].'</td>'.
                    '<td align="center">'.$va['apprv_status'].'</td>'.
                    '<td align="center">'.$va['status'].'</td>'.
                    '<td align="center">'.$va['reject_status'].'</td>'. 
                '</tr>';
        }
        else
        {
            if($staff_all_count_array[$k-1]['br_code'] != $staff_all_count_array[$k]['br_code'])
            {
                $item  .= '<tr style="font-weight:bold;">'.
                    '<td colspan="1" >'.$staff_all_count_array[$k-1]['br_name'].' ATI Total</td>'.

                    '<td align="center">'.$center_total_staff.'</td>'.
                    '<td align="center">'. $center_total_approved.'</td>'.
                    '<td align="center">'. $center_total_not_approve.'</td>'.
                    '<td align="center">'. $center_total_reject.'</td>'.
                '</tr>';

                $center_total_staff = 0;
                $center_total_approved = 0;
                $center_total_reject = 0;
                $center_total_not_approve = 0;
            }
            
            $item  .= '<tr nobr="true">'.
                    '<td> ['.$va['br_code'].'] - '.$va['br_name'].'</td>'.
//                    '<td align="center">'.$va['course_code'].'</td>'.
                    '<td align="center">'.$va['staff_count'].'</td>'.
                    '<td align="center">'.$va['apprv_status'].'</td>'.
                    '<td align="center">'.$va['status'].'</td>'.
                    '<td align="center">'.$va['reject_status'].'</td>'. 
                '</tr>';
        }
         
    $i++;
    
    $center_total_staff += $va['staff_count'];
    $center_total_approved += $va['apprv_status'];
    $center_total_reject += $va['reject_status'];
    $center_total_not_approve += $va['status']; 

    $total_staff += $va['staff_count'];
    $total_approved += $va['apprv_status'];
    $total_reject += $va['reject_status'];
    $total_not_approve += $va['status'];
        
    }
    
    $item  .= '<tr style="font-weight:bold;">'.
        '<td colspan="1" style="font-weight:bold;">'.$staff_all_count_array[$k-1]['br_name'].' ATI Total</td>'.

        '<td align="center">'.$center_total_staff.'</td>'.
        '<td align="center">'. $center_total_approved.'</td>'.
        '<td align="center">'. $center_total_not_approve.'</td>'.
        '<td align="center">'. $center_total_reject.'</td>'.
    '</tr>';

   $content =
 
           '<label align="center" style="font-size:13px;"><strong>Sri Lanka Institute of Advanced Technoligical Education (SLIATE)</strong></label><br><br>'.
            '<br>'.
                '<label align="center" style="font-size:12px;">Staff Full Summary Report</label><br><br><br>'.
           
    '<table border="0.5" style="width:100%; vertical-align:center;" cellspacing="0" cellpadding="5">'.
    '<thead>'.
        '<tr>'.
            '<th align="center"><b>Center</b></th>'.
//            '<th align="center"><b>Course</b></th>'.
            '<th align="center"><b>Total Staff</b></th>'.
            '<th align="center"><b>Approve</b></th>'.
            '<th align="center"><b>Not Approve</b></th>'.
            '<th align="center"><b>Reject</b></th>'.
        '</tr>'.
    '</thead>'.
    '<tbody id="tbl_body">'.
    $item.
    '</tbody>'.
    '<tfoot>'.
        '<tr align="center">'.
            '<th><b>Grand Total</b></th>'.
//            '<th></th>'.
            '<th><b>'.$total_staff.'</b></th>'.
            '<th><b>'.$total_approved.'</b></th>'.
            '<th><b>'.$total_not_approve.'</b></th>'.
            '<th><b>'.$total_reject.'</b></th>'.
        '</tr>'.
     '</tfoot>'.
   '</table>';


$image = base_url("uploads/sliate_logo.jpg");
$obj_pdf->Image($image, 100, 15, 15, 20, 'jpg');

$obj_pdf->writeHTMLCell($w=0, $h=0, $x=14, $y=40, $content, $border=0, $ln=1, $fill=0, $reseth=true, $align='L', $autopadding=true);

$obj_pdf->Output('output.pdf', 'I');
