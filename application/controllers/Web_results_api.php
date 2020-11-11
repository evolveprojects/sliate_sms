<?php

class Web_results_api extends CI_Controller{
        
    function Web_results_api() {
        parent::__construct();
        $this->load->model('Web_results_model');
    }

    function get_student_result(){
        $valid1 = false;
        $valid2 = false;
        $valid3 = false;
        $valid4 = false;
        $valid5 = false;
        $error_status = false;
        $error_message = '';

        $hash_decoded = base64_decode(file_get_contents('php://input'));
        if ($hash_decoded != null ) {
            $regArray = explode('/', $hash_decoded);
            $user_type = $regArray[0];
            $parameter_type = $regArray[1];

            if($user_type == 'SLIATE') {
                if($parameter_type == 'REGNO'){
                    //check valid reg no
                    $branchCode = $regArray[2];
                    $courseCode = $regArray[3];
                    $admission_year = $regArray[4];
                    $admission_type = $regArray[5];
                    $reg_sequance_no = $regArray[6];
                    
                    $valid1 = $this->Web_results_model->is_valid_branch_code($branchCode);
                    $valid2 = $this->Web_results_model->is_valid_course_code($courseCode);

                    if(strlen($admission_year) == 4 && (intval($admission_year) >= 1990 && intval($admission_year) <= 2500 )){
                       $valid3 = true;
                       
                    }
                    if($admission_type == 'F' || $admission_type == 'P') {
                        $valid4 = true;
                    }
                    if(is_numeric($reg_sequance_no)){
                        $valid5 = true;
                    }
                    
                    if($valid1 && $valid2 && $valid3 && $valid4 && $valid5){
                        
                        $unique_no_decoded = $regArray[2].'/'.$regArray[3].'/'.$regArray[4].'/'.$regArray[5].'/'.$regArray[6];
                        // todo reg exists or not
                        $is_exists = $this->Web_results_model->is_existing_reg_no($unique_no_decoded);
                        if($is_exists){
                            // todo result flag
                            $result_released_data = $this->Web_results_model->is_result_released_web($unique_no_decoded);
                            if($result_released_data != false ){
                                $result_released_web = $result_released_data['release_result_web'];
                                if($result_released_web){
                                    //proceed to post to given url                                   
                                    $sudent_results = $this->Web_results_model->get_student_results_by_reg_no($unique_no_decoded);
                                    $common_details = $this->Web_results_model->get_student_common_details($unique_no_decoded);
                                    $gpa = $this->Web_results_model->get_student_current_gpa($unique_no_decoded);
                                    $this->postToURL($unique_no_decoded,$error_status,$error_message,$sudent_results,$common_details,$gpa);
                                } else {
                                    $error_status = true;
                                    $error_message = 'results not released for web';
                                    $this->postToURL($unique_no_decoded,$error_status,$error_message, array(),array(),array());
                                }
                            } else {
                                $error_status = true;
                                $error_message = 'no data for student';
                                $this->postToURL($unique_no_decoded,$error_status,$error_message, array(),array(),array());
                            }
                        } else{
                            $error_status = true;
                            $error_message = 'Reg no do not exist';
                            $this->postToURL($unique_no_decoded,$error_status,$error_message, array(),array(),array());
                        }
                    } else {
                        $error_status = true;
                        $error_message = 'invalid Reg no';
                        $this->postToURL(null,$error_status,$error_message, array(),array(),array());
                    }
                } else {
                    $error_status = true;
                    $error_message = 'invalid parameter type';
                    $this->postToURL(null,$error_status,$error_message, array(),array(),array());
                }
            } else {
                $error_status = true;
                $error_message = 'invalid user type';
                $this->postToURL(null,$error_status,$error_message, array(),array(),array());
            }
        } else {
            $error_status = true;
            $error_message = 'invalid post data';
            $this->postToURL(null,$error_status,$error_message, array(),array(),array());
        }
    }

    function postToURL($reg_no,$error_status, $error_message, $results, $common_details, $gpa)
    {
        //$url = 'http://localhost/sampleAPI/results.php';
        $url = 'http://www.sliate.ac.lk/testing/results.php';
        

        //Initiate cURL.
        $ch = curl_init($url);
        
        //The simple JSON data.
         $send_array = array(
            'student_details' =>$common_details,
            'error' => $error_status,
            'error_message' => $error_message,
            'results' =>$results,
            'CGPA' => $gpa
        );
         
        //here Encode the all array into JSON data.
        $jsonDataEncoded = json_encode($send_array);
        
        //here cURL that we want to request send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        //Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        //Execute the request
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            die('Couldn\'t send request: ' . curl_error($ch));
        } else {
            $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($resultStatus == 200) {
                echo $jsonDataEncoded;
            } else {
                die('Request failed: HTTP status code: ' . $resultStatus);
            }
        }
        // close cURL resource, and free up system resources
        curl_close($ch); 
    }
 }


