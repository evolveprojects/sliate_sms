<?php

class Staff_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_qualification($data) {
        $insert_data = array(
            'qualification' => $data['qualification'],
            'description' => $data['description'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now())
        );

        $update_data = array(
            'qualification' => $data['qualification'],
            'description' => $data['description'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now())
        );

        if (empty($data['qualification_id'])) {
            $result = $this->db->insert('sta_qualifications', $insert_data);
            $this->logger->systemlog('Manage Qualification', 'Success', 'Qualification Added Successfully.', date("Y-m-d H:i:s", now()));
        } else {
            $this->db->where('id', $data['qualification_id']);
            $result = $this->db->update('sta_qualifications', $update_data);
            $this->logger->systemlog('Manage Qualification', 'Success', 'Qualification Updated Successfully.', date("Y-m-d H:i:s", now()));
        }

        return $result;
    }
    

    function get_all_qualifications() {
        $this->db->select('*');
        $result_array = $this->db->get('sta_qualifications')->result_array();
        return $result_array;
    }

    function update_qualification_status($data) {
        $is_exist = false;
        if ($data['new_status'] == 1) {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
        } else {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => NULL,
                'deleted_on' => NULL
            );
            $is_exist = $this->check_duplicate_qualification_other($data['qualification'],$data['qualification_id']);
        }
        if($is_exist == false){
            $this->db->where('id', $data['qualification_id']);
            $result = $this->db->update('sta_qualifications', $update_data);
        }
        
        if($is_exist){
            $this->session->set_flashdata('flashError', 'Cannot activate record because same qualification exists.');
        }else if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Qualification Deactivated Successfully.');
                $this->logger->systemlog('Update Qualification Status', 'Success', 'Qualification Deactivated Successfully.', date("Y-m-d H:i:s", now()), array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashSuccess', 'Qualification Activated Successfully.');
                $this->logger->systemlog('Update Qualification Status', 'Success', 'Qualification Activated Successfully.', date("Y-m-d H:i:s", now()),array_merge($data, $update_data));
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate qualification. Retry.');
                $this->logger->systemlog('Update Qualification Status', 'Failure', 'Failed to Deactivate qualification.', date("Y-m-d H:i:s", now()),array_merge($data, $update_data));
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate qualification. Retry.');
                $this->logger->systemlog('Update Qualification Status', 'Failure', 'Failed to Activate qualification.', date("Y-m-d H:i:s", now()),array_merge($data, $update_data));
            }
        }
    }

    
    function get_all_subject_groups() {
        $this->db->select('*');
        $result_array = $this->db->get('sta_qualifications')->result_array();
        return $result_array;
    }

    function save_staff($data) {
        $email_result = 'none';
        if (empty($data['stf_id']))
        {
            $stf_code = $this->sequence->generate_sequence('STF'.date('y'),3);
        }
        else
        {
            $this->db->select('staffindex');
            $this->db->where('stf_id',$data['stf_id']);
            $extcode = $this->db->get('sta_lecturer_details')->row_array();

            $stf_code = $extcode['staffindex'];
        }

        if(!empty($_FILES['staffprof_pic']['name']))
        {
            $name_img = $_FILES['staffprof_pic']['name'];
            $temp_info = explode('.', $name_img);
            $ary_len = count($temp_info);

            $config['upload_path']          = './uploads/staffprofile/';
            $config['allowed_types']        = 'jpg|jpeg|gif|png';
            //$config['max_size']             = 100000;
            //$config['overwrite']            = TRUE;
            $config['file_name']            = $stf_code.'.'.$temp_info[$ary_len-1];

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('staffprof_pic'))
            {
                $error = array('error' => $this->upload->display_errors());
                $img_save_data = null;
            }
            else
            {
                $image_data = $this->upload->data();
                $img_save_data = 'uploads/staffprofile/'.$image_data['file_name'];
                
                $config['image_library'] = 'gd2';
                $config['source_image'] = './uploads/staffprofile/'.$image_data['file_name'];
                $config['create_thumb'] =FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = 50;
                $config['width'] = 200;
                $config['height'] = 250;
                $config['new_image'] = './uploads/staffprofile/'.$image_data['file_name'];


                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                 
                //$image_data = $this->upload->data();
                $img_save_data = 'uploads/staffprofile/'.$image_data['file_name'];
            }
        }
        else
        {
            $img_save_data = null;
        }

        $insert_data = array(
            'staffindex' => $stf_code,
            'center_id'  => $data['center_id'],
            'tit_name' => $data['tit_name'],
            'stf_fname' => $data['stf_fname'],
            'stf_lname' => $data['stf_lname'],
            'stf_address' => $data['stf_address'],
            'nic' => $data['nic'],
            
            'designation' => $data['designation'],
            'qualification' => $data['qualification'],
            
            
            
            //'stf_acc' => $data['stf_acc'],
            //'stf_faculty_id' => $data['stf_faculty'],
            'stf_mobi' => $data['stf_mobi'],
            'stf_home' => $data['stf_home'],
            'stf_email' => $data['stf_email'],
            //'stf_national' => $data['stf_national'],
            'stf_marital' => $data['stf_marital'],
            'research_interest' => $data['research_interest'],
            //'publications_achive' => $data['publications_achive'],
            //'awards_achive' => $data['awards_achive'],
            //'memberships_achive' => $data['memberships_achive'],
            //'public_achievements' => $data['public_achievements'],
            'added_by' => $this->session->userdata('u_id'),
            'added_on' => date("Y-m-d h:i:s", now()),
            'profileimage' => $img_save_data,
            'academic_status' => $data['aca_status']
                
        );

        $update_data = array(
            'tit_name' => $data['tit_name'],
            'center_id'  => $data['center_id'],
            'stf_fname' => $data['stf_fname'],
            'stf_lname' => $data['stf_lname'],
            'stf_address' => $data['stf_address'],
            'nic' => $data['nic'],
            
            
            'designation' => $data['designation'],
            'qualification' => $data['qualification'],
            
            //'stf_acc' => $data['stf_acc'],
            //'stf_faculty_id' => $data['stf_faculty'],
            'stf_mobi' => $data['stf_mobi'],
            'stf_home' => $data['stf_home'],
            'stf_email' => $data['stf_email'],
            //'stf_national' => $data['stf_national'],
            'stf_marital' => $data['stf_marital'],
            'research_interest' => $data['research_interest'],
            //'publications_achive' => $data['publications_achive'],
            //'awards_achive' => $data['awards_achive'],
            //'memberships_achive' => $data['memberships_achive'],
            //'public_achievements' => $data['public_achievements'],
            'updated_by' => $this->session->userdata('u_id'),
            'updated_on' => date("Y-m-d h:i:s", now()),
            'academic_status' => $data['aca_status']
        );

        if($img_save_data != null)
        {
            $update_data['profileimage'] = $img_save_data;
        }

        if (empty($data['stf_id'])) {
            if($data['aca_status'] == 1) { // Academic(staff)
                $insert_data['approved'] = 0;
                $result = $this->db->insert('sta_lecturer_details', $insert_data);
                $this->logger->systemlog('Manage Staff', 'Success', 'Added Staff(Academic) Successfully.', date("Y-m-d H:i:s", now()), $insert_data);
            } else { //non-academic (Exam marrk enterers)
                $insert_data['approved'] = 1;
                $result = $this->db->insert('sta_lecturer_details', $insert_data);
                $this->logger->systemlog('Manage Staff', 'Success', 'Added Staff(non-Academic) Successfully.', date("Y-m-d H:i:s", now()), $insert_data);
                
                //create user and send mail
                $this->db->select('*');
                $this->db->where($insert_data);
                $staff_data = $this->db->get('sta_lecturer_details')->row_array();
                
                $hashed_password = hash('sha512', $staff_data['nic']);
                 
                $user_data = array(
                    'user_name' => $staff_data['staffindex'],
                    'user_password' => $hashed_password,
                    'user_ref_id' => $staff_data['stf_id'],
                    'user_type' => 'exam',
                    'user_ugroup' => $data['user_group'],
                    'user_branch' => $staff_data['center_id'],
                    'user_email' => $staff_data['stf_email'],
                    'user_status' => 'A',
                    'created_by' => $this->session->userdata('u_id'),
                    'created_datetime' => date("Y-m-d H:i:s", now())
                );
                $result = $this->db->insert('ath_user', $user_data);
                
                $this->load->model('Approval_model');
                $email_reslt = $this->Approval_model->get_staff_email($staff_data['stf_id']);
                
                $config = Array(
                        'protocol' => 'HTTP',
                        'smtp_host' => 'ssl://smtp.gmail.com',   //smtp.gmail.com
                        'smtp_port' => 465,
                        'auth' => true,
                        'smtp_user' => 'sms@sliate.ac.lk', // change it to yours     // sms@sliate.ac.lk
                        'smtp_pass' => 'Password@sms', // change it to yours   //Password@sms
                        'mailtype' => 'html',
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                    );
                
                $htmlContent = '<div style="background: #0c6388; padding-bottom: 0.1px; padding-top: 0.1px;" align="center"><h2 style="color: #fff">Staff Registered Successfully!</h2></div>';
                $htmlContent .= '<p>' . $email_reslt['title_name'] . ' ' . $email_reslt['stf_fname'] . ',</p>';
                $htmlContent .= '<h2>CONGRATULATIONS!</h2>';
                $htmlContent .= '<p>You have successfully completed your online registration at SLIATE-SMS at Advanced Technological Institute - ' . $email_reslt['br_name'] . '. We warmly welcome you to the  SLIATE Family. Your staff profile has been created and the login information is as follows:</p>';
                $htmlContent .= 'Link : <a href="http://student.sliate.ac.lk/">student.sliate.ac.lk</a><br/>';
                $htmlContent .= 'User Name : ' . $email_reslt['staffindex'] . '<br/>';
                $htmlContent .= 'Passoword : ' . $email_reslt['nic'];
                $htmlContent .= '<br/><br/>We wish you all the best for your future endeavours.<br/>';
                $htmlContent .= '<p><b><i><span style="font-family: Helvetica,sans-serif; color:#440062">Team-MIS</span></i></b></p>';
                //$message = 'Dear ' +$email_reslt['first_name']+ '! <br/> You have registered successfully for “Course Name” in “Center Name”.';
                $this->load->library('Email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from('sms@sliate.ac.lk');
                $this->email->to($staff_data['stf_email']);
                $this->email->bcc('student.sliate.ac.lk@gmail.com');
                $this->email->subject('Auto reply at staff registration !');
                $this->email->message($htmlContent);
                
                if ($this->email->send()) {
                    $email_result = true;
                } else {
                    $email_result = false;
                }
                
                $this->logger->systemlog('Manage Staff', 'Success', 'Added user(non-Academic) Successfully.', date("Y-m-d H:i:s", now()), $user_data);
            }
            
            
        } else {
            if($data['aca_status'] == 1) { // Academic(staff)
                $update_data['approved'] = 0;
                $this->db->where('stf_id', $data['stf_id']);
                $result = $this->db->update('sta_lecturer_details', $update_data);
                $this->logger->systemlog('Manage Staff', 'Success', 'Updated Staff (Academic) Successfully.', date("Y-m-d H:i:s", now()), $update_data);
                
            } else { // non-academic(exam mark enterers)
                $update_data['approved'] = 1;
                $user_update_data['user_ugroup'] = $data['user_group'];
                
                $this->db->where('stf_id', $data['stf_id']);
                $result = $this->db->update('sta_lecturer_details', $update_data);
                
                $this->logger->systemlog('Manage Staff', 'Success', 'Updated Staff (non-Academic) Successfully.', date("Y-m-d H:i:s", now()), $update_data);
                
                $where_array = array (
                    'user_ref_id' => $data['stf_id'],
                    'user_name' => $stf_code,
                    'user_status' => 'A'
                );
//                $this->db->where('user_name',$stf_code);
                
                $this->db->select('*');
                $this->db->where($where_array);
                $user_exist_data = $this->db->get('ath_user')->row_array();
                
                print_r($user_exist_data);
                $this->db->where('user_id',$user_exist_data['user_id']);
                $result = $this->db->update('ath_user', $user_update_data);
                
                $this->logger->systemlog('Manage Staff', 'Success', 'Updated user (non-Academic) Successfully.', date("Y-m-d H:i:s", now()), $user_update_data);

            }
            
        }
        
        return array('result'=>$result, 'email_result'=>$email_result);
    }
    
     function check_duplicate_nic_no_for_staff(){
        
        $nic_no = $this->input->post('nic_no');
        
        $this->db->select('count(stf_id) as stf_nic_count');
        $this->db->where('nic',$nic_no);
        $stf_nic_query = $this->db->get('sta_lecturer_details')->row_array();
        
        return $stf_nic_query;
    }

    function view_staff_all() {
        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,cb.br_id,ti.id,ti.title_name, sd.deleted as staff_deleted');
        $this->db->join('com_title ti', 'ti.id=sd.tit_name','left');
        $this->db->join('cfg_branch cb', 'cb.br_id=sd.center_id','left');
        $this->db->join('cfg_common cc', 'cc.id=sd.designation','left');
        
        //$this->db->join('edu_faculty fa', 'fa.id=sd.stf_faculty_id');
        $this->db->where('sd.approved',1);
        
        $stf_view = $this->db->get('sta_lecturer_details sd')->result_array();
        
        return $stf_view;
    }
    
    
    function view_staff_by_center($center_id) {
        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,cb.br_id,ti.id,ti.title_name, sd.deleted as staff_deleted');
        $this->db->join('com_title ti', 'ti.id=sd.tit_name','left');
        $this->db->join('cfg_branch cb', 'cb.br_id=sd.center_id','left');
        $this->db->join('cfg_common cc', 'cc.id=sd.designation','left');
        if($center_id != 0){
            $this->db->where('sd.center_id',$center_id);
        }
        $this->db->where('sd.approved',1);
        $this->db->order_by('sd.stf_fname', 'ASC');
        $stf_view = $this->db->get('sta_lecturer_details sd')->result_array();
        
        return $stf_view;
    }
    function view_staff() {

        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        //$this->db->select('staff_details.*,department.dep_id,department.department,designation.des_id,designation.designation_name,title.id,title.title_name');
        //$this->db->join('department', 'department.dep_id=staff_details.stf_department');
        //$this->db->join('designation', 'designation.des_id=staff_details.stf_designation');
        
        $this->db->select('sd.*,ti.id,ti.title_name');
        $this->db->join('com_title ti', 'ti.id=sd.tit_name');
        $this->db->where('sd.deleted', 0);
        $this->db->where('sd.approved', 1);
        $this->db->order_by('sd.stf_fname', 'ASC');
        //$this->db->where_in('sd.stf_faculty_id',$faclist);
        $stf_view = $this->db->get('sta_lecturer_details sd')->result_array();

        return $stf_view;
    }

    function view_stf_prof($id) {
        //$id = $this->input->get('id');

        $this->db->select('*, c1.name as qualification, cc.name as designation');
        $this->db->join('cfg_branch br', 'br.br_id=sd.center_id');
        $this->db->join('com_title tl', 'tl.id=sd.tit_name');
        $this->db->join('cfg_common cc', 'cc.id=sd.designation','left');
        $this->db->join('cfg_common c1', 'c1.id=sd.qualification','left');
        $this->db->where('sd.stf_id', $id);
        $stf_prof = $this->db->get('sta_lecturer_details sd')->row_array();

        return $stf_prof;
    }

    function view_stf_qualifications($id) {
        //$id = $this->input->get('id');
        $this->db->select('sd.*,lq.*,qu.*');
        $this->db->join('sta_qualifications qu', 'qu.id=lq.qualification_id');
        $this->db->join('sta_lecturer_details sd', 'sd.stf_id=lq.lecturer_id');
        $this->db->where('sd.stf_id', $id);
        $result = $this->db->get('sta_lecturer_qualifications lq')->result_array();

        return $result;
    }

    function view_stf_subjects($id) {
        //$id = $this->input->get('id');
        $this->db->select('sd.*,lc.*,co.*');
        $this->db->join('mod_subject co', 'co.id=lc.subject_id');
        $this->db->join('sta_lecturer_details sd', 'sd.stf_id=lc.lecturer_id');
        $this->db->where('sd.stf_id', $id);
        $this->db->where('lc.deleted', 0);
        $result = $this->db->get('sta_lecturer_subject lc')->result_array();

        return $result;
    }

    function update_staff_status($data) {

        $update_data = array(
            'deleted' => $data['new_status'],
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('stf_id', $data['stf_id']);
        $result = $this->db->update('sta_lecturer_details', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Staff member Deactivated Successfully.');
                $this->logger->systemlog('Staff Status Update', 'Success', 'Staff member Deactivated Successfully.', date("Y-m-d H:i:s", now()));
            } else {
                $this->session->set_flashdata('flashSuccess', 'Staff member Activated Successfully.');
                $this->logger->systemlog('Staff Status Update', 'Success', 'Staff member Activated Successfully.', date("Y-m-d H:i:s", now()));
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate staff member. Retry.');
                $this->logger->systemlog('Staff Status Update', 'Failure', 'Failed to Deactivate staff member.', date("Y-m-d H:i:s", now()));
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate staff member. Retry.');
                $this->logger->systemlog('Staff Status Update', 'Failure', 'Failed to Activate staff member.', date("Y-m-d H:i:s", now()));
            }
        }

        return $result;
    }

    function edit_staff($id) {
        //$id = $this->input->get('id');
        $this->db->select('sd.*,ti.id,ti.title_name');
        $this->db->join('com_title ti', 'ti.id=sd.tit_name');
        $this->db->where('sd.stf_id', $id);
        $edit_stf = $this->db->get('sta_lecturer_details sd')->row_array();

        return $edit_stf;
    }

//    function get_all_title(){
//        $this->db->select('*');
//        $result_array = $this->db->get('com_title')->result_array();
//        return $result_array;
//    }
    
    
    function get_title() {

        $this->db->select('*');
        $this->db->where('title_status', '1');
        $title_new = $this->db->get('com_title')->result_array();

        return $title_new;
    }
    
    function get_designation(){
        $this->db->select('*');
        $this->db->where('group', '2');
        $this->db->or_where('group', '3');
        $this->db->order_by('name', 'ASC');
        $desig = $this->db->get('cfg_common')->result_array();

        return $desig;
    }

    function save_staff_assign($data) {

        if (empty($data['assign_id'])) {
            //insert
            $insert_assign = array(
                'lecturer_id' => $data['lecturer_id'],
                'course_id' => $data['course_id'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->insert('sta_lecturer_assign', $insert_assign);

            //removed qualification section
//            if (!empty($data['qualifications'])) {
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $insert_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'added_by' => $this->session->userdata('u_id'),
//                        'added_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $result = $this->db->insert('sta_lecturer_qualifications', $insert_qualifications);
//                }
//            }
            if (!empty($data['subject_ids'])) {
                for ($i = 0; $i < count($data['subject_ids']); $i++) {
                    $insert_subjects = array(
                        'lecturer_id' => $data['lecturer_id'],
                        'course_id' => $data['course_id'],
                        'subject_id' => $data['subject_ids'][$i],
                        'hourly_rate' => $data['hourly_rate'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $result = $this->db->insert('sta_lecturer_subject', $insert_subjects);
                }
            }
        } else {
            //update
//            $result = true;
            //removed Qualification section
//            $quali_count = $this->get_lecturer_quali_count($data['lecturer_id']);
//            $quali_ids = $this->get_quali_assign_ids($data['lecturer_id']);
//            if ($quali_count == 0) {
//                //insert all 
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $insert_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'updated_by' => $this->session->userdata('u_id'),
//                        'updated_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $result2 = $this->db->insert('sta_lecturer_qualifications', $insert_qualifications);
//                }
//            } else if ($quali_count == count($data['qualifications'])) {
//                //update all 
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $update_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'added_by' => $this->session->userdata('u_id'),
//                        'added_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $this->db->where('id', $quali_ids[$x]['id']);
//                    $result2 = $this->db->update('sta_lecturer_qualifications', $update_qualifications);
//                }
//            } else {
//                // delete existing and insert new  
//                $this->delete_lecturer_quali($data['lecturer_id']);
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $insert_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'added_by' => $this->session->userdata('u_id'),
//                        'added_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $result2 = $this->db->insert('sta_lecturer_qualifications', $insert_qualifications);
//                }
//            }
///////////////////////////////////////
            $subjects_count = $this->get_lecturer_subjects_count($data['lecturer_id'],$data['course_id']);
            $lecturer_subject_ids = $this->get_subject_assign_ids($data['lecturer_id'], $data['course_id']);
            if ($subjects_count == count($data['subject_ids'])) {
                //update all
                for ($i = 0; $i < count($data['subject_ids']); $i++) {
                    $update_subjects = array(
                        'lecturer_id' => $data['lecturer_id'],
                        'course_id' => $data['course_id'],
                        'subject_id' => $data['subject_ids'][$i],
                        'hourly_rate' => $data['hourly_rate'][$i],
                        'updated_by' => $this->session->userdata('u_id'),
                        'updated_on' => date("Y-m-d h:i:s", now())
                    );
                   
                    $this->db->where('id', $lecturer_subject_ids[$i]['id']);
                    $result = $this->db->update('sta_lecturer_subject', $update_subjects);
                }
                
            } else {
                //delete existing and add new
                $this->delete_lecturer_subjects($data['lecturer_id'],$data['course_id']);
                for ($i = 0; $i < count($data['subject_ids']); $i++) {
                    $insert_subjects = array(
                        'lecturer_id' => $data['lecturer_id'],
                        'course_id' => $data['course_id'],
                        'subject_id' => $data['subject_ids'][$i],
                        'hourly_rate' => $data['hourly_rate'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now())
                    );
                    $result = $this->db->insert('sta_lecturer_subject', $insert_subjects);
                }
            }
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function get_all_staff_with_subjects() {

        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*, la.id as assign_id, la.deleted as assign_deleted');
        $this->db->join('sta_lecturer_details sd', 'sd.stf_id=la.lecturer_id');
        $this->db->join('edu_course co', 'co.id=la.course_id');
        $this->db->where('sd.deleted', 0);
        $this->db->where('sd.approved', 1);
        //$this->db->where_in('sd.stf_faculty_id',$faclist);
        $result_array = $this->db->get('sta_lecturer_assign la')->result_array();
        return $result_array;
    }
    
    function get_all_staff_with_subjects_by_center($ug_course) {

        //$faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');
        $center = $this->session->userdata('user_branch');

        $this->db->select('*, la.id as assign_id, la.deleted as assign_deleted');
        $this->db->join('sta_lecturer_details sd', 'sd.stf_id=la.lecturer_id');
        $this->db->join('edu_course co', 'co.id=la.course_id');
        $this->db->where('sd.deleted', 0);
        $this->db->where('sd.center_id', $center);
        if($ug_course != NULL && $ug_course != ''){
            $this->db->where('la.course_id', $ug_course);
        }
        $this->db->where('sd.approved', 1);
        //$this->db->where_in('sd.stf_faculty_id',$faclist);
        $result_array = $this->db->get('sta_lecturer_assign la')->result_array();
        return $result_array;
    }

    function edit_assign_load($assign_id, $lecturer_id,$ug_data,$course_id) {
        $this->db->where('as.id', $assign_id);
        $this->db->where('as.course_id', $course_id);
        $this->db->join('sta_lecturer_details sdd', 'sdd.stf_id=as.lecturer_id');
        $assign = $this->db->get('sta_lecturer_assign as')->row_array();

//        $this->db->where('lq.lecturer_id', $lecturer_id);
//        $this->db->where('sd.deleted', 0);
//        $this->db->where('lq.deleted', 0);
//        $this->db->join('sta_lecturer_details sd', 'sd.stf_id=lq.lecturer_id');
//        $qualifications = $this->db->get('sta_lecturer_qualifications lq')->result_array();
        $this->db->where('lc.lecturer_id', $lecturer_id);
        $this->db->where('lc.course_id',$course_id);
        $this->db->where('sd.deleted', 0);
        $this->db->where('lc.deleted', 0);
        $this->db->join('mod_subject ms', 'ms.id=lc.subject_id');
        $this->db->join('sta_lecturer_details sd', 'sd.stf_id=lc.lecturer_id');
        $subjects = $this->db->get('sta_lecturer_subject lc')->result_array();

        
        $all = array(
            "assign" => $assign,
//            "qualifications" => $qualifications,
            "subjects" => $subjects,
            "ug_data" => $ug_data
        );

        return $all;
    }

    function load_subjectss_lecturers($center_id, $lecturer_id){
        $this->db->select('la.course_id');
        $this->db->join('sta_lecturer_details sdd', 'sdd.stf_id=la.lecturer_id');
        $this->db->where('la.lecturer_id', $lecturer_id);
        $this->db->where('sdd.center_id', $center_id);
        $this->db->group_by('la.course_id');
        $course_ids = $this->db->get('sta_lecturer_assign la')->result_array();

        $result_array = Array();
        $i = 0;
        foreach ($course_ids as $key2=>$course_id){
            if($course_id['course_id'] != NULL && $course_id['course_id'] != '' && $course_id['course_id'] != 0){
                $this->db->select('*');
                $this->db->where('cou.id', $course_id['course_id']);
                $result_array[$i]['course'] = $this->db->get('edu_course cou')->row_array();
                
                $this->db->select('*,msub.code as sub_code, msub.subject as sub_name');
                $this->db->where('sd.deleted', 0);
                $this->db->where('lc.deleted', 0);
                $this->db->where('sd.center_id', $center_id);
                $this->db->where('lc.lecturer_id', $lecturer_id);
                $this->db->where('lc.course_id', $course_id['course_id']);
                $this->db->join('sta_lecturer_details sd', 'sd.stf_id=lc.lecturer_id');
                $this->db->join('mod_subject msub', 'msub.id=lc.subject_id');
                $result_array[$i]['subjects'] = $this->db->get('sta_lecturer_subject lc')->result_array();
                $i++; 
            }
        }
        return $result_array;
    }
    
    function get_lecturer_quali_count($lecturer_id) {
        $this->db->select('count(lq.id)');
        $this->db->where('lq.lecturer_id', $lecturer_id);
        $this->db->where('lq.deleted', 0);
        $result_array = $this->db->get('sta_lecturer_qualifications lq')->result_array();
        if (!empty($result_array)) {
            foreach ($result_array as $row) {
                return $row['count(lq.id)'];
            }
        } else {
            return 0;
        }
    }

    function get_lecturer_subjects_count($lecturer_id,$course_id) {
        $this->db->select('count(lc.id)');
        $this->db->where('lc.lecturer_id', $lecturer_id);
        $this->db->where('lc.course_id', $course_id);
        $this->db->where('lc.deleted', 0);
        $result_array = $this->db->get('sta_lecturer_subject lc')->result_array();
        if (!empty($result_array)) {
            foreach ($result_array as $row) {
                return $row['count(lc.id)'];
            }
        } else {
            return 0;
        }
    }

    function get_quali_assign_ids($lecturer_id) {
        $this->db->select('*');
        $this->db->from('sta_lecturer_qualifications');
        $this->db->where('lecturer_id', $lecturer_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->result_array();
        return $result;
    }

    function get_subject_assign_ids($lecturer_id, $course_id) {
        $this->db->select('*');
        $this->db->from('sta_lecturer_subject');
        $this->db->where('lecturer_id', $lecturer_id);
         $this->db->where('course_id', $course_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->result_array();
        return $result;
    }

    function delete_lecturer_quali($lecturer_id) {
        $update_data = array(
            'deleted' => 1,
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('lecturer_id', $lecturer_id);
        $result = $this->db->update('sta_lecturer_qualifications', $update_data);
        return $result;
    }

    function delete_lecturer_subjects($lecturer_id,$course_id) {
        $update_data = array(
            'deleted' => 1,
            'deleted_by' => $this->session->userdata('u_id'),
            'deleted_on' => date("Y-m-d h:i:s", now())
        );
        $this->db->where('lecturer_id', $lecturer_id);
        $this->db->where('course_id', $course_id);
        $result = $this->db->update('sta_lecturer_subject', $update_data);
        return $result;
    }

    function change_assign_status($data) {

        if ($data['new_status'] == 0) {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => NULL,
                'deleted_on' => NULL
            );
        } else {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
        }

        $this->db->where('id', $data['assign_id']);
        $result = $this->db->update('sta_lecturer_assign', $update_data);

        if ($result) {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashSuccess', 'Lecturer assign Deactivated Successfully.');
            } else {
                $this->session->set_flashdata('flashSuccess', 'Lecturer assign Activated Successfully.');
            }
        } else {
            if ($data['new_status']) {
                $this->session->set_flashdata('flashError', 'Failed to Deactivate lecturer assign. Retry.');
            } else {
                $this->session->set_flashdata('flashError', 'Failed to Activate lecturer assign. Retry.');
            }
        }
        return $result;
    }

    function is_lecturer_assigned($lecturer_id, $course_id) {
        $this->db->select('*');
        $this->db->from('sta_lecturer_assign');
        $this->db->where('lecturer_id', $lecturer_id);
        $this->db->where('course_id', $course_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->result_array();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    function get_staff_by_faculty($faculty_id) {
        $this->db->select('*, ti.title_name');
        $this->db->join('com_title ti', 'ti.id=sd.tit_name');
        $this->db->where('sd.stf_faculty_id', $faculty_id);
        $result = $this->db->get('sta_lecturer_details sd')->result_array();
        return $result;
    }

    function load_lecturers_by_date($data) {
        $this->db->select('*,co.id as subject_id');
        $this->db->join('tta_timetable tt', 'tt.ttbl_id=tl.ttlc_timetable');
        $this->db->join('tta_assign as', 'tt.ttbl_id=as.ttas_timetable');
        $this->db->join('sta_lecturer_details st', 'st.stf_id=tl.ttlc_lecturer');
        $this->db->join('mod_subject co', 'co.id=tl.ttlc_subject');
        $this->db->where('st.stf_faculty_id', $data['faculty_id']);
        $this->db->where('as.ttas_startdate <=', $data['att_date']);
        $this->db->where('as.ttas_enddate >=', $data['att_date']);
        $this->db->where('as.ttas_branch', $data['center_id']);
        $this->db->where('tl.ttlc_weekday', $data['dayofweek']);
        $this->db->where('tl.ttlc_lecturer', $data['lecturer_id']);
        $result = $this->db->get('tta_lecture tl')->result_array();

        for ($i = 0; $i < count($result); $i++) {

            $start_time = date("H:i", $result[$i]['ttlc_starttime']);
            $end_time = date("H:i", $result[$i]['ttlc_endtime']);

            $interval = date_diff(date_create($start_time), date_create($end_time));
            $hours = $interval->format('%h');
            $minutes = $interval->format('%i');
            $total_minutes = ($hours * 60) + $minutes;
            if ($hours <= 3) {
                $no_of_breaks = 0;
            } else if ($hours > 3 && $hours <= 4) {
                $no_of_breaks = 1;
                $total_minutes = $total_minutes - 15;
            } else if ($hours > 4 && $hours <= 6) {
                $no_of_breaks = 3;
                $total_minutes = $total_minutes - 45;
            } else if ($hours > 6) {
                $no_of_breaks = 4;
                $total_minutes = $total_minutes - 60;
            } else {
                $no_of_breaks = 0;
            }

            $result[$i]['no_of_breaks'] = $no_of_breaks;
            $new_hours = floor($total_minutes / 60);
            $new_minutes = $total_minutes % 60;

            if (strlen($new_hours) < 2) {
                $new_hours = "0" . $new_hours;
            }
            if (strlen($new_minutes) < 2) {
                $new_minutes = "0" . $new_minutes;
            }
            $result[$i]['time_diff'] = $new_hours . ":" . $new_minutes;

            $start = date('g:i A', $result[$i]['ttlc_starttime']);
            $end = date('g:i A', $result[$i]['ttlc_endtime']);

            $result[$i]['ttlc_starttimedisplay'] = $start;
            $result[$i]['ttlc_endtimedisplay'] = $end;
        }
        return $result;
    }

    function save_lecturer_attendance($data) {
        $this->db->trans_begin();
        $result_array = $this->load_lecturers_by_date($data);

        for ($i = 0; $i < count($data['is_checked']); $i++) {
            $payment_detais = $this->get_payment_details_by_lec_id($result_array[$i]['stf_id'], $result_array[$i]['subject_id'], $data['worked_hours'][$i]);
            if ($data['is_checked'][$i]) {
                $insert_array = array(
                    'ttable_assign_id' => $result_array[$i]['ttas_id'],
                    'ttable_id' => $result_array[$i]['ttbl_id'],
                    'center_id' => $result_array[$i]['ttas_branch'],
                    'lecturer_id' => $result_array[$i]['stf_id'],
                    'subject_id' => $result_array[$i]['subject_id'],
                    'attendance_date' => $data['att_date'],
                    'tt_start_time' => $result_array[$i]['ttlc_starttime'],
                    'tt_end_time' => $result_array[$i]['ttlc_endtime'],
                    'actual_start_time' => $data['actual_ls_time'][$i],
                    'actual_end_time' => $data['actual_le_time'][$i],
                    'no_of_breaks' => $data['no_of_breaks'][$i],
                    'worked_hours' => $data['worked_hours'][$i],
                    'hourly_rate' => $payment_detais['hourly_rate'],
                    'payment' => $payment_detais['payment'],
                    'added_by' => $this->session->userdata('u_id'),
                    'added_on' => date("Y-m-d h:i:s", now())
                );

                $exists = $this->is_attendance_record_exists($insert_array);
                if ($exists) {
                    $this->db->trans_rollback();
                    $res['status'] = 'Warning';
                    $res['message'] = "Attendance Data Exists. " . $insert_array['tt_start_time'] . "-" . $insert_array['tt_end_time'] . " Not Inserted";
                    return $res;
                } else {
                    $this->db->insert('sta_lecturer_attendance', $insert_array);
                }
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to save Lecturer Attendance';
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Lecturer Attendance saved successfully.';
        }
        return $res;
    }

    function get_payment_details_by_lec_id($lecturer_id, $subject_id, $worked_hours) {
        $this->db->select('*');
        $this->db->where('ltc.lecturer_id', $lecturer_id);
        $this->db->where('ltc.subject_id', $subject_id);
        $this->db->where('ltc.deleted', 0);
        $result = $this->db->get('sta_lecturer_subject ltc')->row_array();

        $worked_details = explode(":", $worked_hours);
        $min_rate = round((intval($result['hourly_rate']) / 60), 2);
        $total_minutes = (intval($worked_details[0]) * 60) + intval($worked_details[1]);
        $payment = ($total_minutes * $min_rate);
        $result['payment'] = $payment;
        return $result;
    }

    function is_attendance_record_exists($data) {
        $this->db->select('*');
        $this->db->where('la.lecturer_id', $data['lecturer_id']);
        $this->db->where('la.subject_id', $data['subject_id']);
        $this->db->where('la.attendance_date', $data['attendance_date']);
        $this->db->where('la.tt_start_time', $data['tt_start_time']);
        $this->db->where('la.tt_end_time', $data['tt_end_time']);
        $this->db->where('la.deleted', 0);
        $result = $this->db->get('sta_lecturer_attendance la')->result_array();
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function view_lecturer_attendance($data) {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('*,la.deleted as la_deleted, la.id as la_id');
        $this->db->join('sta_lecturer_details st', 'st.stf_id=la.lecturer_id');
        $this->db->join('mod_subject co', 'co.id=la.subject_id');
//        $this->db->join('tta_timetable tt', 'tt.ttbl_id=la.ttable_id');
//        $this->db->join('tta_lecture ttl', 'tt.ttbl_id=ttl.ttlc_timetable');
//        $this->db->join('tta_assign ttas', 'ttas.ttas_id=la.ttable_assign_id');
        $this->db->join('cfg_branch br', 'br.br_id=la.center_id');
        $this->db->where('st.stf_id', $data['staff_member']);
        $this->db->where('la.attendance_date', $data['att_date']);
        $this->db->where_in('la.center_id', $branchlist);
        $this->db->where_in('st.stf_faculty_id', $faclist);
        $result = $this->db->get('sta_lecturer_attendance la')->result_array();

        $x = 0;
        foreach ($result as $slot) 
        {
            $eststart = date('g:i A', $slot['tt_start_time']);
            $estend = date('g:i A', $slot['tt_end_time']);
            // $actstart = date('g:i A', $slot['actual_start_time']);
            // $actend = date('g:i A', $slot['actual_end_time']);

            $result[$x]['ttlc_eststarttimedisplay'] = $eststart;
            $result[$x]['ttlc_estendtimedisplay'] = $estend;
            // $result[$x]['ttlc_actstarttimedisplay'] = $actstart;
            // $result[$x]['ttlc_actendtimedisplay'] = $actend;
            $x++;
        }

        return $result;
    }

    function get_att_data_by_id($att_id) {
        $this->db->select('*');
        $this->db->where('id', $att_id);
        $result = $this->db->get('sta_lecturer_attendance')->row_array();

        return $result;
    }

    function update_staff_attendance_status($data) {
        $this->db->trans_begin();
        $att_data = $this->get_att_data_by_id($data['lec_att_id']);
        $exists = $this->is_attendance_record_exists($att_data);
        if ($data['new_status'] == 0) {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => NULL,
                'deleted_on' => NULL
            );
        } else {
            $update_data = array(
                'deleted' => $data['new_status'],
                'deleted_by' => $this->session->userdata('u_id'),
                'deleted_on' => date("Y-m-d h:i:s", now())
            );
        }

        if ($data['new_status'] == 0 && $exists == TRUE) {
            $res['status'] = 'Warning';
            $res['message'] = 'Failed to Activate lecturer attendance. Record Exists.';
            return $res;
        } else {
            $this->db->where('id', $data['lec_att_id']);
            $this->db->update('sta_lecturer_attendance', $update_data);
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            if ($data['new_status']) {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Deactivate lecturer attendance. Retry.';
            } else {
                $res['status'] = 'Failed';
                $res['message'] = 'Failed to Activate lecturer attendance. Retry.';
            }
        } else {
            $this->db->trans_commit();
            if ($data['new_status']) {
                $res['status'] = 'success';
                $res['message'] = 'Lecturer Attendance Deactivated Successfully';
            } else {
                $res['status'] = 'success';
                $res['message'] = 'Lecturer Attendance Activated Successfully';
            }
        }
        return $res;
    }

    function load_data_for_update_staff_attendance($data) {

        $branchlist = $this->auth->get_accessbranch();
        $faclist = $this->auth->get_accessfaculties($branch=array(),'ID_ARY');

        $this->db->select('la.*,st.stf_lname,st.stf_fname,co.code as subject_code,co.subject');
        $this->db->join('sta_lecturer_details st', 'st.stf_id=la.lecturer_id');
        $this->db->join('mod_subject co', 'co.id=la.subject_id');
        $this->db->where('la.id', $data['attendance_id']);
        $this->db->where('la.lecturer_id', $data['lecturer_id']);
        $this->db->where('la.subject_id', $data['subject_id']);
        $this->db->where('la.attendance_date', $data['attendance_date']);
        $this->db->where('la.deleted', 0);
        $this->db->where_in('la.center_id', $branchlist);
        $this->db->where_in('st.stf_faculty_id', $faclist);
        $result = $this->db->get('sta_lecturer_attendance la')->row_array();

        $eststart = date('g:i A', $result['tt_start_time']);
        $estend = date('g:i A', $result['tt_end_time']);
        // $actstart = date('g:i A', $result['actual_start_time']);
        // $actend = date('g:i A', $result['actual_end_time']);

        $result['ttlc_eststarttimedisplay'] = $eststart;
        $result['ttlc_estendtimedisplay'] = $estend;
        // $result['ttlc_actstarttimedisplay'] = $actstart;
        // $result['ttlc_actendtimedisplay'] = $actend;

        return $result;
    }

    function update_attendance_data()
    {
        $atn_id             = $this->input->post('atn_id');
        $tt_start_time      = $this->input->post('tt_start_time');
        $tt_end_time        = $this->input->post('tt_end_time');
        $ac_start_time      = $this->input->post('ac_start_time');
        $ac_end_time        = $this->input->post('ac_end_time');
        $up_breaks          = $this->input->post('up_breaks');
        $up_worked_hours    = $this->input->post('up_worked_hours');
        $up_hourly_rate     = $this->input->post('up_hourly_rate');
        $up_payment         = $this->input->post('up_payment');

        $this->db->trans_begin();

        $atndata['actual_start_time']   = $ac_start_time;
        $atndata['actual_end_time']     = $ac_end_time;
        $atndata['no_of_breaks']        = $up_breaks;
        $atndata['worked_hours']        = $up_worked_hours;
        $atndata['hourly_rate']         = $up_hourly_rate;
        $atndata['payment']             = $up_payment;
        $atndata['updated_by']          = $this->session->userdata('u_id');

        $this->db->where('id',$atn_id);
        $this->db->update('sta_lecturer_attendance',$atndata);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $res['status'] = 'Failed';
            $res['message'] = 'Failed to Update Staff Attendance';
            $this->logger->systemlog('Update Staff Attendance', 'Failure', 'Failed to Update Staff Attendance', date("Y-m-d H:i:s", now()),$atndata);
        } else {
            $this->db->trans_commit();
            $res['status'] = 'success';
            $res['message'] = 'Staff Attendance Updated successfully.';
            $this->logger->systemlog('Update Staff Attendance', 'Success', 'Staff Attendance Updated successfully.', date("Y-m-d H:i:s", now()), $atndata);
        }
        return $res;
    }
    
    
    
    function get_all_centers() {

        $this->db->select('*');
        $title_new = $this->db->get('cfg_branch')->result_array();

        return $title_new;
    }
    
    function get_center_admin_login_centers() {

        $loginuser_group = $this->session->userdata('u_ugroup');
        
        $this->db->select('*');
        $this->db->join('ath_usergroup au', 'au.ug_branch=cb.br_id');
        $this->db->where('au.ug_id', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();
        
        return $user_centers;
    }
    
    function get_login_user_centers() {

        $loginuser_group = $this->session->userdata('u_ugroup');
        
        $this->db->select('*');
        $this->db->join('ath_authbranchlist ab', 'ab.arbl_branch=cb.br_id');
        $this->db->join('ath_authrightgroup ag', 'ag.rlist_branchlist=ab.arbl_listid');
        $this->db->where('ag.rlist_usergroup', $loginuser_group);
        $user_centers = $this->db->get('cfg_branch cb')->result_array();

        return $user_centers;
    }
    
    
    function search_staff_lookup($data){
       
        $this->db->select('*');
        
        $this->db->join('sta_lecturer_details sld', 'sld.stf_id = sls.lecturer_id');
        $this->db->join('mod_subject ms', 'ms.id = sls.subject_id');
        
        $this->db->where('sld.center_id', $data['center_id']);
        $this->db->where('sls.subject_id', $data['subject_id']);
        $this->db->where('sld.approved', 1);
        
        
        $staff_result_array = $this->db->get('sta_lecturer_subject sls')->result_array();
        
        return $staff_result_array;
    }
    
    function check_duplicate_qualification($qualification_name){
        $this->db->select('*');
        $this->db->where('qualification', $qualification_name);
        $this->db->where('deleted', 0);
        $staff_result_array = $this->db->get('sta_qualifications')->row_array();
        
        if(!empty($staff_result_array)){
            return true;
        } else {
            return false;
        }
    }
    
    function check_duplicate_qualification_other($qualification_name,$qualification_id){
        $this->db->select('*');
        $this->db->where('qualification', $qualification_name);
        $this->db->where('id != ', $qualification_id);
        $this->db->where('deleted', 0);
        $staff_result_array = $this->db->get('sta_qualifications')->row_array();
        
        if(!empty($staff_result_array)){
            return true;
        } else {
            return false;
        }
    }
    
    function load_lecturers_for_center($center_id){
        $this->db->select('*');
        $this->db->join('com_title tit', 'tit.id=sta.tit_name');
        $this->db->where('sta.center_id', $center_id);

        $sta_list = $this->db->get('sta_lecturer_details sta')->result_array();

        return $sta_list;
    }
    
    function load_subjectss_for_course_details($course_id){
        $this->db->select('*');
        $this->db->join('mod_semester_subject ss', 'ssub.semester_subject_id=ss.id');
        $this->db->join('edu_semester se', 'se.id=ss.semester_id');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course co', 'co.id=yr.course_id');
        $this->db->join('mod_subject ms', 'ms.id=ssub.subject_id');
        $this->db->where('co.id', $course_id);
        $this->db->group_by('ms.id');
        
        $sub_list = $this->db->get('mod_semester_subject_details ssub')->result_array();
        
        return $sub_list;
    }
    
    function load_subjects_to_assign_staff($data){
        $this->db->select('*');
        $this->db->join('mod_semester_subject ss', 'ssub.semester_subject_id=ss.id');
        $this->db->join('edu_semester se', 'se.id=ss.semester_id');
        $this->db->join('edu_year yr', 'yr.id=se.year_id');
        $this->db->join('edu_course co', 'co.id=yr.course_id');
        $this->db->join('mod_subject ms', 'ms.id=ssub.subject_id');
        $this->db->where('co.id', $data['course_id']);
        $this->db->where('se.year_no', $data['year_id']);
        $this->db->where('ss.semester_no', $data['semester_id']);
        $this->db->group_by('ms.id');
        
        $sub_list = $this->db->get('mod_semester_subject_details ssub')->result_array();
        
        return $sub_list;
    }
    
    function is_lecturer_assigned_dummy($lecturer_id, $course_id) {
        $this->db->select('*');
        $this->db->from('sta_lecturer_assign');
        $this->db->where('lecturer_id', $lecturer_id);
        $this->db->where('course_id', $course_id);
        $this->db->where('deleted', 0);
        $result = $this->db->get()->result_array();
        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }
    
    
    function save_staff_assign_dummy($data) {

        if (empty($data['assign_id'])) {
            //insert
            $insert_assign = array(
                'lecturer_id' => $data['lecturer_id'],
                'course_id' => $data['course_id'],
                'added_by' => $this->session->userdata('u_id'),
                'added_on' => date("Y-m-d h:i:s", now())
            );
            $this->db->insert('sta_lecturer_assign', $insert_assign);

            //removed qualification section
//            if (!empty($data['qualifications'])) {
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $insert_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'added_by' => $this->session->userdata('u_id'),
//                        'added_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $result = $this->db->insert('sta_lecturer_qualifications', $insert_qualifications);
//                }
//            }
            if (!empty($data['subject_ids'])) {
                for ($i = 0; $i < count($data['subject_ids']); $i++) {
                    $insert_subjects = array(
                        'lecturer_id' => $data['lecturer_id'],
                        'course_id' => $data['course_id'],
                        'subject_id' => $data['subject_ids'][$i],
//                        'hourly_rate' => $data['hourly_rate'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now()),
                        'lecturer_type' => $data['teach_type_ids'][$i]
                        
                    );
                    $result = $this->db->insert('sta_lecturer_subject', $insert_subjects);
                }
            }
        } else {
            //update
//            $result = true;
            //removed Qualification section
//            $quali_count = $this->get_lecturer_quali_count($data['lecturer_id']);
//            $quali_ids = $this->get_quali_assign_ids($data['lecturer_id']);
//            if ($quali_count == 0) {
//                //insert all 
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $insert_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'updated_by' => $this->session->userdata('u_id'),
//                        'updated_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $result2 = $this->db->insert('sta_lecturer_qualifications', $insert_qualifications);
//                }
//            } else if ($quali_count == count($data['qualifications'])) {
//                //update all 
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $update_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'added_by' => $this->session->userdata('u_id'),
//                        'added_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $this->db->where('id', $quali_ids[$x]['id']);
//                    $result2 = $this->db->update('sta_lecturer_qualifications', $update_qualifications);
//                }
//            } else {
//                // delete existing and insert new  
//                $this->delete_lecturer_quali($data['lecturer_id']);
//                for ($x = 0; $x < count($data['qualifications']); $x++) {
//                    $insert_qualifications = array(
//                        'lecturer_id' => $data['lecturer_id'],
//                        'qualification_id' => $data['qualifications'][$x],
//                        'added_by' => $this->session->userdata('u_id'),
//                        'added_on' => date("Y-m-d h:i:s", now())
//                    );
//                    $result2 = $this->db->insert('sta_lecturer_qualifications', $insert_qualifications);
//                }
//            }
///////////////////////////////////////
            $subjects_count = $this->get_lecturer_subjects_count($data['lecturer_id'],$data['course_id']);
            $lecturer_subject_ids = $this->get_subject_assign_ids($data['lecturer_id'], $data['course_id']);
            if ($subjects_count == count($data['subject_ids'])) {
                //update all
                for ($i = 0; $i < count($data['subject_ids']); $i++) {
                    $update_subjects = array(
                        'lecturer_id' => $data['lecturer_id'],
                        'course_id' => $data['course_id'],
                        'subject_id' => $data['subject_ids'][$i],
//                        'hourly_rate' => $data['hourly_rate'][$i],
                        'updated_by' => $this->session->userdata('u_id'),
                        'updated_on' => date("Y-m-d h:i:s", now()),
                        'lecturer_type' => $data['teach_type_ids'][$i]
                    );
                   
                    $this->db->where('id', $lecturer_subject_ids[$i]['id']);
                    $result = $this->db->update('sta_lecturer_subject', $update_subjects);
                }
                
            } else {
                //delete existing and add new
                $this->delete_lecturer_subjects($data['lecturer_id'],$data['course_id']);
                for ($i = 0; $i < count($data['subject_ids']); $i++) {
                    $insert_subjects = array(
                        'lecturer_id' => $data['lecturer_id'],
                        'course_id' => $data['course_id'],
                        'subject_id' => $data['subject_ids'][$i],
//                        'hourly_rate' => $data['hourly_rate'][$i],
                        'added_by' => $this->session->userdata('u_id'),
                        'added_on' => date("Y-m-d h:i:s", now()),
                        'lecturer_type' => $data['teach_type_ids'][$i]
                    );
                    $result = $this->db->insert('sta_lecturer_subject', $insert_subjects);
                }
            }
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
}
