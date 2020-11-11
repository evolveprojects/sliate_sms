<?php
class Csv_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function uploadData()
    {
        $count=0;
     // echo  $fp = fopen($_FILES['form1']['tmp_name'],'r') or die("can't open file");
		$fp = fopen('studentexcel.csv','r') or die("can't open file");
		
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $insert_csv = array();
                $insert_csv['name'] = $csv_line[0];//remove if you want to have primary key,
                $insert_csv['full_name'] = $csv_line[1];
                $insert_csv['civil_status'] = $csv_line[2];
                $insert_csv['sex'] = $csv_line[3];
		$insert_csv['birth'] = $csv_line[4];
                $insert_csv['place_birth'] = $csv_line[1];//remove if you want to have primary key,
                $insert_csv['mobile_no'] = $csv_line[2];
                $insert_csv['email'] = $csv_line[3];
                $insert_csv['nic_no'] = $csv_line[4];
		$insert_csv['nic_date'] = $csv_line[5];
                $insert_csv['index_no'] = $csv_line[6];//remove if you want to have primary key,
                $insert_csv['id_type'] = $csv_line[7];
                $insert_csv['id_no'] = $csv_line[8];
                $insert_csv['citizen'] = $csv_line[9];
		$insert_csv['religion'] = $csv_line[10];
                $insert_csv['citizenship'] = $csv_line[11];
                $insert_csv['ordination'] = $csv_line[12];
                $insert_csv['distric'] = $csv_line[13];
		$insert_csv['distric_no'] = $csv_line[14];
                $insert_csv['address_resi'] = $csv_line[15];//remove if you want to have primary key,
                $insert_csv['distric_admi'] = $csv_line[16];
                $insert_csv['distri_no'] = $csv_line[17];
                $insert_csv['tele'] = $csv_line[18];
		$insert_csv['year'] = $csv_line[19];
				  
            }
            $i++;
		print_r($insert_csv);
            $data = array(
			'stu_id' => $insert_csv['name'] ,
                'name' => $insert_csv['name'] ,
                'full_name' => $insert_csv['full_name'],
                'civil_status' => $insert_csv['civil_status'],
				'sex' => $insert_csv['sex'] ,
                'birth' => $insert_csv['birth'],
               'place_birth' => $insert_csv['splace_birth'],
				'mobile_no' => $insert_csv['smobile_no'] ,
                'email' => $insert_csv['semail'],
                'nic_no' => $insert_csv['snic_no'],
				'nic_date' => $insert_csv['snic_date'] ,
                'index_no' => $insert_csv['sindex_no'],
                'id_type' => $insert_csv['sid_type'],
				'id_no' => $insert_csv['sid_no'] ,
                'citizen' => $insert_csv['scitizen'],
                'race' => $insert_csv['srace'],
				'religion' => $insert_csv['sreligion'] ,
                'citizenship' => $insert_csv['scitizenship'],
                'ordination' => $insert_csv['sordination'],
				'distric' => $insert_csv['sdistric'] ,
                'distric_no' => $insert_csv['sdistric_no'],
                'address_resi' => $insert_csv['saddress_resi'],
				'distric_admi' => $insert_csv['sdistric_admi'] ,
                'distri_no' => $insert_csv['sdistri_no'],
                'tele' => $insert_csv['stele'],
				'year' => $insert_csv['syear'] ,
                'month' => $insert_csv['smonth'],
                'date' => $insert_csv['sdate'],
				'name_fath' => $insert_csv['sname_fath'] ,
                'name_moth' => $insert_csv['sname_moth'],
                'name_guar' => $insert_csv['sname_guar'],
				'name_inst' => $insert_csv['sname_inst'] ,
                'course_study' => $insert_csv['scourse_study'],
                'year_regi' => $insert_csv['syear_regi'],
				'duration' => $insert_csv['sduration'] ,
                'fp_time' => $insert_csv['sfp_time'],
				'reg_no' => $insert_csv['sreg_no']);
            $data['crane_features']=$this->db->insert('student_reg', $data);
        }
        fclose($fp) or die("can't close file");
        $data['success']="success";
        return $data;
    }
}