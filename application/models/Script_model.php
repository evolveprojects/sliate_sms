<?php

class Script_model extends CI_Model {

    // change Course Code (kasun 2018-08-01)

    function change_course_code($data) {
        $stu_update = array();
        $this->db->select('*');
        $this->db->where('sr.center_id', $data['center_id']);
        $this->db->where('sr.approved', 1);
        // $this->db->where('sr.updated_by <>', 1);
        $result_array = $this->db->get('stu_reg sr')->result_array();
        $count = 0;

        foreach ($result_array as $row) {

            //$result = $row['stu_id'] . "count : " . $count;
            $a = explode("/", $row['reg_no']);
            $b = $a[1];
            $new = "";
            switch ($b) {
                case 'HNDIT':
                    $new = 'IT';
                    break;

                case 'HNDM':
                    $new = 'MG';
                    break;

                case 'HNDA':
                    $new = 'AC';
                    break;

                case 'HNDAgri':
                    $new = 'AG';
                    break;

                case 'HNDBSE':
                    $new = 'BSE';
                    break;

                case 'HNDBA':
                    $new = 'BA';
                    break;

                case 'HNDBF':
                    $new = 'BF';
                    break;


                case 'HNDCSPT':
                    $new = 'CS';
                    break;

                case 'HNDCivil':
                    $new = 'CE';
                    break;

                case 'HNDElectri':
                    $new = 'EE';
                    break;

                case 'HNDMechani':
                    $new = 'ME';
                    break;

                case 'HNDEnglish':
                    $new = 'EN';
                    break;

                case 'HNDFT':
                    $new = 'FT';
                    break;

                case 'HNDQS':
                    $new = 'QS';
                    break;

                case 'HNDTHM':
                    $new = 'THM';
                    break;

                default :

                    $new = $b;
                    //break;
            }

            $code = str_replace($b, $new, $row['reg_no']);
            //'stu_id' => $row['stu_id'],
            $hello = array(
                'reg_no' => $code,
            );
            $this->db->where('stu_id', $row['stu_id']);
            $query = $this->db->update('stu_reg_copy', $hello);
        }
        //foreach ($data as $r){
        //$query = $this->db->update_batch('stu_reg_copy', $hello, 'stu_id');
        //}
        //return $result_array;
        return $query;
        //  return var_dump($hello);
        // return $data;
    }
    
    
    function run_user_course_code($data) {
        $stu_update = array();
        $this->db->select('*');
        $this->db->where('au.user_branch', $data['center_id']);
        $this->db->where('au.user_type', 'student');
        
        
        // $this->db->where('sr.updated_by <>', 1);
        $result_array = $this->db->get('ath_user au')->result_array();
        $count = 0;

        foreach ($result_array as $row) {

            //$result = $row['stu_id'] . "count : " . $count;
            $a = explode("/", $row['user_name']);
            $b = $a[1];
            $new = "";
            switch ($b) {
                case 'HNDIT':
                    $new = 'IT';
                    break;

                case 'HNDM':
                    $new = 'MG';
                    break;

                case 'HNDA':
                    $new = 'AC';
                    break;

                case 'HNDAgri':
                    $new = 'AG';
                    break;

                case 'HNDBSE':
                    $new = 'BSE';
                    break;

                case 'HNDBA':
                    $new = 'BA';
                    break;

                case 'HNDBF':
                    $new = 'BF';
                    break;


                case 'HNDCSPT':
                    $new = 'CS';
                    break;

                case 'HNDCivil':
                    $new = 'CE';
                    break;

                case 'HNDElectri':
                    $new = 'EE';
                    break;

                case 'HNDMechani':
                    $new = 'ME';
                    break;

                case 'HNDEnglish':
                    $new = 'EN';
                    break;

                case 'HNDFT':
                    $new = 'FT';
                    break;

                case 'HNDQS':
                    $new = 'QS';
                    break;

                case 'HNDTHM':
                    $new = 'THM';
                    break;

                default :

                    $new = $b;
                    //break;
            }

            $code = str_replace($b, $new, $row['user_name']);
            //'stu_id' => $row['stu_id'],
            $hello = array(
                'user_name' => $code,
            );
            $this->db->where('user_id', $row['user_id']);
            $query = $this->db->update('ath_user_copy', $hello);
        }
        //foreach ($data as $r){
        //$query = $this->db->update_batch('stu_reg_copy', $hello, 'stu_id');
        //}
        //return $result_array;
        return $query;
        //  return var_dump($hello);
        // return $data;
    }
    
    
    //update_need_index
    function update_need_index($data) {
        $stu_update = array();
        $this->db->select('*');
        $this->db->join('stu_reg r', 'r.stu_id = m.stu_id');
        $this->db->join('cfg_branch c', 'c.br_id = r.center_id');
        $this->db->where('r.center_id', $data['center_id']);
        $this->db->where('r.apply_mahapola', 1);
        //$this->db->where('au.user_type', 'student');
        
        $result_array = $this->db->get('stu_reg_mahapola m')->result_array();
        $count = 0;
        //print_r($result_array);
        
        echo nl2br(count($result_array)."\r\n");
        foreach ($result_array as $row) {
            $schl_marks = 0;
            $ou_marks = 0;
            $dis_marks = 0;
            $income_marks = 0;
            
            $schl_attendies = 0;
            $ou_attendies = 0;
            $dis = 0;
            $income_from_land = 0;
            $income_from_rent = 0;
            $grand_total = 0;
            $total_parant_income = 0;
            $family_married_income = 0;
            
            //$result = $row['stu_id'] . "count : " . $count;
            //get school attendies.
            $schl_attendies = $row['schl_attendies'];
            if($schl_attendies > 3)
                $schl_attendies = 3;
            
            $schl_marks = $schl_attendies * 5;
            //get uni student marks..
            $ou_attendies = $row['ou_attendies'];
            $ou_marks = $ou_attendies * 10;
            
            //get Disctance mark
            $dis = $row['distance'];
            
            if ($dis > 0 && $dis <= 25)
                $dis_marks = 2;
            else if ($dis > 25 && $dis <= 50)
                $dis_marks = 5;
            else if ($dis > 50 && $dis <= 100)
                $dis_marks = 10;
            else
                $dis_marks = 15;
            
            //calculate grandtotal income..
            $total_income = $row['total_income'];
            if($row['total_income'] == '')
                $total_income = 0;
            
            $income_from_land = $row['income_from_land'];
            if($income_from_land == '')
                $income_from_land = 0;
            
            $income_from_rent = $row['income_from_rent'];
            if($income_from_rent == '')
                $income_from_rent = 0;
            
            //get the familymarried income..
            $civil_status = $row['civil_status'];
            $family_married_income = $row['spouse_annual_income'];
            
            
            $total_parant_income = $total_income + $income_from_land + $income_from_rent;
            
            $guardians_status = $row['guardians_status'];
            
            if($guardians_status == 'Y')
                $total_parant_income  = $row['ga_income'];
            
            $employeement_status = $row['employeement_status'];
            $empld_salary = $row['empld_salary'];
            if($employeement_status == 'Y')
                $grand_total = $total_parant_income - $empld_salary;
            else
                $grand_total = $total_parant_income;
            
            if($civil_status == 'M')
                $grand_total = $family_married_income;
            
            if($grand_total > 100000)
                $grand_total = $grand_total - ($row['schl_going_concession'] + $row['ou_going_concession']);
            else
                $grand_total = $grand_total;
            
            if ($grand_total >= 0 && $grand_total <= 100000)
                $income_marks = 60;
            else if ($grand_total >= 100001 && $grand_total <= 150000)
                $income_marks = 55;
            else if ($grand_total >= 150001 && $grand_total <= 200000)
                $income_marks = 50;
            else if ($grand_total >= 200001 && $grand_total <= 250000)
                $income_marks = 45;
            else if ($grand_total >= 250001 && $grand_total <= 300000)
                $income_marks = 40;
            else if ($grand_total >= 300001 && $grand_total <= 350000)
                $income_marks = 35;
            else if ($grand_total >= 350001 && $grand_total <= 400000)
                $income_marks = 30;
            else if ($grand_total >= 400001 && $grand_total <= 450000)
                $income_marks = 25;
            else if ($grand_total >= 450001 && $grand_total <= 500000)
                $income_marks = 20;
            else if ($grand_total >= 500001 && $grand_total <= 550000)
                $income_marks = 15;
            else if ($grand_total >= 550001 && $grand_total <= 600000)
                $income_marks = 10;
            
            $Total_marks = $schl_marks + $ou_marks + $dis_marks + $income_marks;
            
            echo nl2br($row['reg_no']." -> "." dis : ".$dis. "  --  ".$dis_marks .
                    ' scl att : '.$schl_attendies ." scl mar : ".$schl_marks .
                    ' uni att : '.$ou_attendies ." uni mar : ".$ou_marks .
                    ' grnd tot : ' . $grand_total. " income Mrk : ".  $income_marks.
                    ' new index : '.$Total_marks . ' old index : '. $row['need_index']. 
                    "\r\n");
            
            $up_array = array(
                'need_index' => $Total_marks,
            );
            $this->db->where('mahapola_id', $row['mahapola_id']);
            $query = $this->db->update('stu_reg_mahapola', $up_array);
        }
        
       
         //return $data;
    }

    
    function check_duplicate_images($fileName) 
    {    
        $this->db->select("*");
        $this->db->from('stu_reg');
        $this->db->where('profileimage', $fileName);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
}
