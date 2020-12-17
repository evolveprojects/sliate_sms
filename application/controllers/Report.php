<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function report() {
        parent::__construct();
        $this->load->model('Student_model');
        $this->load->model('Exam_model');
        $this->load->model('hall_model');
        $this->load->model('course_model');
        $this->load->model('faculty_model');
        $this->load->model('batch_model');
        $this->load->model('company_model');
        $this->load->model('timetable_model');
        $this->load->model('Report_model');
        $this->load->model('Util_model');
        $this->load->model('Subject_model');
        $this->load->model('Approval_model');
        $this->load->library('zip');
        $this->load->library('tcpdf/tcpdf');
        $this->load->model('Data_analysis_model');
    }

    function staff_list_view() {
        $data['staff_all_count'] = $this->Report_model->get_all_staff_count();

        $data['main_content'] = 'reports/staff_list_view';
        $data['title'] = 'Staff List View';

        $this->load->view('includes/template', $data);
    }

    function student_list_view() {

        //$data['stu_all_count_array'] = $this->Report_model->get_all_stu_count();
        // $data['mahapola_data'] = $this->Report_model->get_mahapola_data();
        $data['centers'] = $this->Report_model->get_all_centers();
        $data['mahapola_course_list'] = $this->Report_model->load_mahapola_course_list();
        $data['mpyear_list'] = $this->Report_model->get_student_list_years();
        $data['fulsumyr'] = $this->Report_model->get_all_stu_count();
        $data['stu_data'] = null;
        $data['main_content'] = 'reports/student_list_view';
        $data['title'] = 'Student List View';

        $this->load->view('includes/template', $data);
    }

    function get_rpt_student_list_view() {
        $fulsumyr = $this->input->post('fulsumyr');
        //$data['stu_all_count_array']
        $reslt = $this->Report_model->get_rpt_all_stu_count($fulsumyr);
        echo json_encode($reslt);
    }

    function mahapola_student_list_view() {
        $data['stu_all_mahapola_count'] = $this->Report_model->get_all_mahapola_student_count();
        // $data['mahapola_data'] = $this->Report_model->get_mahapola_data();
        $data['mahapola_course_list'] = $this->Report_model->load_mahapola_course_list();
        $data['stu_data'] = null;
        $data['main_content'] = 'reports/mahapola_student_list_view';
        $data['title'] = 'Mahapola Student List';

        $this->load->view('includes/template', $data);
    }

    function student_list_full_summary_pdf() {
        $data['full_year'] = $_GET['year'];

        $data['stu_all_count_array'] = $this->Report_model->get_rpt_all_stu_count($data['full_year']);
//        $data['stu_all_count_array'] = $this->Report_model->get_all_stu_count();

        $this->load->view('reports/student_list_full_summary_pdf', $data);
    }

    function staff_list_full_summary_pdf() {

        $data['staff_all_count_array'] = $this->Report_model->get_all_staff_count();

        $this->load->view('reports/staff_list_full_summary_pdf', $data);
    }

    function course_wise_full_summary_pdf() {

        if (isset($_GET['search_type'])) {
            $data['search_type'] = $_GET['search_type'];
        } else {
            $data['search_type'] = null;
        }

        if (isset($_GET['year'])) {
            $data['year'] = $_GET['year'];
        } else {
            $data['year'] = $_GET['year'];
        }

        $data['stu_course_wise_count_array'] = $this->Report_model->student_course_wise_details_stu_info($data['search_type'], $data['year']);

        $this->load->view('reports/center_wise_full_summary_pdf', $data);
    }

    function course_detail_summary_pdf() {

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yr'];
        $data['semester_no'] = $_GET['sem'];
        $data['batch_id'] = $_GET['bat'];
        $data['type_student'] = $_GET['type_student'];



        $data['center_name'] = $this->Report_model->get_center_by_id($data['center_id']);

        if ($data['course_id'] == 'all') {
            $data['course_name'] = 'All Courses';
        } else {
            $data['course_name'] = $this->Report_model->get_course_by_id($data['course_id']);
        }

        if ($data['batch_id'] == '' || $data['batch_id'] == null) {
            $data['batch_name'] = 'All';
        } else {
            $data['batch_name'] = $this->Report_model->get_batch_by_id($data['course_id']);
        }


        $data['stu_course_detail_array'] = $this->Report_model->search_students_lookup($data);

        $this->load->view('reports/course_detail_summary_pdf', $data);
    }

    function center_staff_detail_summary_pdf() {

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];

        $data['staff_course_detail_array'] = $this->Report_model->search_staff_lookup($data);

        $this->load->view('reports/staff_list_center_detail_pdf', $data);
    }

//    function student_exam_details_pdf() {
////        $data['center_id'] = $_GET['cen'];
////        $data['course_id'] = $_GET['cou'];
//        
//        //$data['staff_course_detail_array'] = $this->Report_model->search_staff_lookup($data);
//
//        $this->load->view('reports/student_exam_details_pdf');
//    }


    function mahapola_eligible_list_view() {
        //$data['mahapola_course_list'] = $this->Report_model->load_mahapola_course_list();
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            $data['centers'] = $this->Report_model->get_all_centers();
        } else if ($ug_level == 2) { //
            $data['centers'] = $this->Report_model->get_center_admin_login_centers();
            //$data['centers'] = $this->Report_model->get_all_centers();
            //$data['ug_level'] = $this->Util_model->check_access_level();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Report_model->get_login_user_centers();
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            $data['centers'] = $this->Report_model->get_login_user_centers();
        }

        $data['mpyear_list'] = $this->Approval_model->get_mahapola_applied_years();
        $data['ug_level'] = $ug_level;
        $data['stu_data'] = null;
        $data['main_content'] = 'reports/mahapola_eligible_list_view';
        $data['title'] = 'Mahapola Eligible List View';

        $this->load->view('includes/template', $data);
    }

    function mahapola_list_view_pdf() {

        $data['course'] = $_GET['cou'];
        $data['center'] = $_GET['cen'];
        $data['all'] = $_GET['all'];
        $data['mp_year'] = $_GET['mp_year'];

        $data['mahapola_report_data'] = $this->Report_model->get_mahapola_data_eligible_list($data['course'], $data['center'], $data['all'], $data['mp_year']);

        $this->load->view('reports/mahapola_list_view_pdf', $data);
    }

    function mahapola_list_view_excel() {

        $data['course'] = $_GET['cou'];
        $data['center'] = $_GET['cen'];
        $data['all'] = $_GET['all'];
        $data['mp_year'] = $_GET['mp_year'];

        $result = $this->Report_model->get_mahapola_data_eligible_list($data['course'], $data['center'], $data['all'], $data['mp_year']);

        $Mahapola_commence_dates = $result['Mahapola_commence_dates'][0];
        $stu_count = $result['stu_count'][0]['stu_count'];
        $mp_count = $result['mp_count'][0]['mp_count'];

        $mahapola = $result['mahapola'][0];
        $course_code = $mahapola['course_code_mahapola'];
        $center_name = $mahapola['center_name'];

        $admitted_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_admitted']));
        $commence_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_commence']));


        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("Center Name", "Student Name", "REG No", "Course", "NIC");
        $column = 0;

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 1, "Sri Lanka Institute of Advanced Technoligical Education (SLIATE)");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 2, "Name List of the Selected Students");

        if ($data['course'] == 'all') {
            $search_course = 'All Courses';
        } else {
            if ($data['all'] == '1')
                $search_course = 'All Courses';
            else
                $search_course = $course_code;
        }

        if ($data['all'] == '1') {
            $search_center = 'All Centers';
        } else {
            $search_center = $center_name;
        }

        $ATI = "Name of the ATI/ Section : " . $search_center;
        $course = "Name of the Approved Course for Mahapola Scholarship : " . $search_course;
        $admitted_date_str = "Date of Students Admitted : " . $admitted_date;
        $commence_date_str = "Date of Course Commenced : " . $commence_date;
        $Tot_student = "No of Students Enrollment : " . $stu_count;
        $mahapola_stu = "No of Eligible Students for Mahapola : " . $mp_count;

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, $ATI);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 5, $course);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 6, $admitted_date_str);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 7, $commence_date_str);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 8, $Tot_student);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 9, $mahapola_stu);

        $object->setActiveSheetIndex(0);
        $table_columns = array("S/No", "Name in Full", "Name with Initial", "Year (A/L)", "(G.C.E. A/L)", "Z-Score",
            "Gender", "NIC No",
            "Name of the Course", "Registration No", "Address", "Need Index");
        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 11, $field);
            $column++;
        }
//        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
//            $object->getActiveSheet()
//                    ->getColumnDimension($col)
//                    ->setAutoSize(true);
//        }
        $from = "A1"; // or any value
        $to = "E1"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $from = "A11"; // or any value
        $to = "L11"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $excel_row = 12;
        $i = 1;

        foreach ($result['mahapola'] as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['full_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['first_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['al_year']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['al_index_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['al_z_core']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['sex']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['nic_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['course_code_mahapola']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['reg_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['permanent_address']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['need_index']);

            $excel_row++;

            $i++;
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 2, "Prepared By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 2, "Checked By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 2, "Recommended By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 2, "Approved By: ...............................");


        $auth1 = $result['authority'][0];
        $auth2 = $result['authority'][1];
        $auth3 = $result['authority'][2];
        $auth4 = $result['authority'][3];

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 3, $auth1['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 3, $auth2['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 3, $auth3['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 3, $auth4['name']);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 4, $auth1['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 4, $auth2['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 4, $auth3['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 4, $auth4['position']);

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Student_Data.xls"');
        $object_writer->save('php://output');

        //$this->load->view('reports/student_id_card_report_pdf',$data);
    }

    function mahapola_full_list_view_pdf() {

        $data['course1'] = $_GET['cou1'];
        $data['center1'] = $_GET['cen1'];
        $data['mp_year'] = $_GET['mp_year'];
        $data['all'] = $_GET['all'];
        $data['limit'] = $_GET['limit'];

        $data['mahapola_report_data'] = $this->Report_model->get_mahapola_data_full_list($data['course1'], $data['center1'], $data['mp_year'], $data['all'], $data['limit']);

        $this->load->view('reports/mahapola_full_list_view_pdf', $data);
    }

    function print_mahapola_data_full_excel() {
        $data['course1'] = $_GET['cou1'];
        $data['center1'] = $_GET['cen1'];
        $data['mp_year'] = $_GET['mp_year'];
        $data['all'] = $_GET['all'];
        $data['limit'] = $_GET['limit'];

        $result = $this->Report_model->get_mahapola_data_full_list($data['course1'], $data['center1'], $data['mp_year'], $data['all'], $data['limit']);

        $Mahapola_commence_dates = $result['Mahapola_commence_dates'][0];
        $stu_count = $result['stu_count'][0]['stu_count'];
        $mp_count = $result['mp_count'][0]['mp_count'];

        $mahapola = $result['mahapola'][0];
        $course_code = $mahapola['course_code'];
        $center_name = $mahapola['center_name'];

        $admitted_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_admitted']));
        $commence_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_commence']));


        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("Center Name", "Student Name", "REG No", "Course", "NIC");
        $column = 0;

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 1, "Sri Lanka Institute of Advanced Technoligical Education (SLIATE)");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 2, "Mahapola Student Full list Report");

        if ($data['course1'] == "all")
            $search_course = "All Courses";
        else
            $search_course = $course_code;


        $ATI = "Name of the ATI/ Section : " . $center_name;
        $course = "Name of the Approved Course for Mahapola Scholarship : " . $search_course;
        $admitted_date_str = "Date of Students Admitted : " . $admitted_date;
        $commence_date_str = "Date of Course Commenced : " . $commence_date;
        $Tot_student = "No of Students Enrollment : " . $stu_count;
        $mahapola_stu = "No of Eligible Students for Mahapola : " . $mp_count;

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, $ATI);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 5, $course);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 6, $admitted_date_str);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 7, $commence_date_str);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 8, $Tot_student);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 9, $mahapola_stu);

        $object->setActiveSheetIndex(0);
        $table_columns = array("S/No", "Name in Full", "Name with Initial", "Year (A/L)", "(G.C.E. A/L)", "Z-Score",
            "Gender", "NIC No",
            "Name of the Course", "Registration No", "Address", "Need Index");
        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 11, $field);
            $column++;
        }
//        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
//            $object->getActiveSheet()
//                    ->getColumnDimension($col)
//                    ->setAutoSize(true);
//        }
        $from = "A1"; // or any value
        $to = "E1"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $from = "A11"; // or any value
        $to = "L11"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $excel_row = 12;
        $i = 1;

        foreach ($result['mahapola'] as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['full_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['first_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['al_year']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['al_index_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['al_z_core']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['sex']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['nic_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['course_code_mahapola']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['reg_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['permanent_address']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['need_index']);

            $excel_row++;

            $i++;
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 2, "Prepared By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 2, "Checked By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 2, "Recommended By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 2, "Approved By: ...............................");


        $auth1 = $result['authority'][0];
        $auth2 = $result['authority'][1];
        $auth3 = $result['authority'][2];
        $auth4 = $result['authority'][3];

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 3, $auth1['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 3, $auth2['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 3, $auth3['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 3, $auth4['name']);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 4, $auth1['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 4, $auth2['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 4, $auth3['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 4, $auth4['position']);



        //body goes here...


        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Mahapola_Scholarship_full_list.xls"');
        $object_writer->save('php://output');

        //$this->load->view('reports/mahapola_full_list_view_pdf', $data);
    }

    function mahapola_not_eligible_list_view_pdf() {

        $data['course2'] = $_GET['cou2'];
        $data['center2'] = $_GET['cen2'];
        $data['mp_year'] = $_GET['mp_year'];
        $data['all'] = $_GET['all'];

        $data['mahapola_report_data'] = $this->Report_model->get_mahapola_data_ne($data['course2'], $data['center2'], $data['mp_year'], $data['all']);

        $this->load->view('reports/mahapola_not_eligible_list_view_pdf', $data);
    }

    function mahapola_not_eligible_list_view_excel() {

        $data['course2'] = $_GET['cou2'];
        $data['center2'] = $_GET['cen2'];
        $data['mp_year'] = $_GET['mp_year'];
        $data['all'] = $_GET['all'];

        $result = $this->Report_model->get_mahapola_data_ne($data['course2'], $data['center2'], $data['mp_year'], $data['all']);

        $Mahapola_commence_dates = $result['Mahapola_commence_dates'][0];
        $stu_count = $result['stu_count'][0]['stu_count'];
        $mp_count = $result['mp_count'][0]['mp_count'];

        $mahapola = $result['mahapola'][0];
        $course_code = $mahapola['course_code'];
        $center_name = $mahapola['center_name'];

        $admitted_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_admitted']));
        $commence_date = date('Y-m-d', strtotime($Mahapola_commence_dates['date_commence']));


        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("Center Name", "Student Name", "REG No", "Course", "NIC");
        $column = 0;

        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 1, "Sri Lanka Institute of Advanced Technoligical Education (SLIATE)");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, 2, "Mahapola student not eligible list Report");

        if ($data['course2'] == "all")
            $search_course = "All Courses";
        else
            $search_course = $course_code;


        $ATI = "Name of the ATI/ Section : " . $center_name;
        $course = "Name of the Approved Course for Mahapola Scholarship : " . $search_course;
        $admitted_date_str = "Date of Students Admitted : " . $admitted_date;
        $commence_date_str = "Date of Course Commenced : " . $commence_date;
        $Tot_student = "No of Students Enrollment : " . $stu_count;
        $mahapola_stu = "No of not Eligible Students for Mahapola : " . $mp_count;

        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, $ATI);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 5, $course);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 6, $admitted_date_str);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 7, $commence_date_str);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 8, $Tot_student);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 9, $mahapola_stu);

        $object->setActiveSheetIndex(0);
        $table_columns = array("S/No", "Name in Full", "Name with Initial", "Year (A/L)", "(G.C.E. A/L)", "Z-Score",
            "Gender", "NIC No",
            "Name of the Course", "Registration No", "Address", "Need Index");
        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 11, $field);
            $column++;
        }
//        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
//            $object->getActiveSheet()
//                    ->getColumnDimension($col)
//                    ->setAutoSize(true);
//        }
        $from = "A1"; // or any value
        $to = "E1"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $from = "A11"; // or any value
        $to = "L11"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $excel_row = 12;
        $i = 1;

        foreach ($result['mahapola'] as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['full_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['first_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['al_year']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['al_index_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['al_z_core']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['sex']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['nic_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['course_code_mahapola']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['reg_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['permanent_address']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $row['need_index']);

            $excel_row++;

            $i++;
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 2, "Prepared By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 2, "Checked By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 2, "Recommended By: ...............................");
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 2, "Approved By: ...............................");


        $auth1 = $result['authority'][0];
        $auth2 = $result['authority'][1];
        $auth3 = $result['authority'][2];
        $auth4 = $result['authority'][3];

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 3, $auth1['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 3, $auth2['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 3, $auth3['name']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 3, $auth4['name']);

        $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row + 4, $auth1['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row + 4, $auth2['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row + 4, $auth3['position']);
        $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row + 4, $auth4['position']);



        //body goes here...


        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Mahapola_scholarship_not_eligible_list.xls"');
        $object_writer->save('php://output');
    }

    function mahapola_student_full_summary_pdf() {

        $data['type_val'] = $_GET['cen_type'];

        $data['mahapola_student_list_data'] = $this->Report_model->student_course_wise_mahapola_details($data['type_val']);

        $this->load->view('reports/mahapola_student_list_view_pdf', $data);
    }

    function student_course_wise_details() {
        $type = $this->input->post('type_val');

        echo json_encode($this->Report_model->student_course_wise_details($type));
    }

    function student_course_wise_mahapola_details() {
        $type = $this->input->post('type_val');

        echo json_encode($this->Report_model->student_course_wise_mahapola_details($type));
    }

    function student_id_card_info_report() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['year_list'] = $this->Report_model->get_student_list_years();


        if ($ug_level == 1) { //Admin
            //get All students
            $data['centers'] = $this->Report_model->get_all_centers();
        } else if ($ug_level == 2) { //
            $data['centers'] = $this->Report_model->get_center_admin_login_centers();
            // $data['ug_level'] = $this->Util_model->check_access_level();
            //$data['ug_level'] = $this->Util_model->check_access_level();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Report_model->get_login_user_centers();
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            $data['centers'] = $this->Report_model->get_login_user_centers();
        }

        $data['ug_level'] = $ug_level;
        $data['main_content'] = 'reports/student_id_card_info_report';
        $data['title'] = 'Student Id Card Info Report';

        $this->load->view('includes/template', $data);
    }

    function get_mahapola_data() {
        $course = $this->input->post('course');
        $center = $this->input->post('center');
        $mp_year = $this->input->post('mp_year');
        $all = $this->input->post('all');
        echo json_encode($this->Report_model->get_mahapola_data_eligible_list($course, $center, $all, $mp_year));
    }

    function get_mahapola_data_full() {
        $course1 = $this->input->post('course1');
        $center1 = $this->input->post('center1');
        $mp_year = $this->input->post('mp_year');
        $all = $this->input->post('all');
        $limit = $this->input->post('limit');
        echo json_encode($this->Report_model->get_mahapola_data_full_list($course1, $center1, $mp_year, $all, $limit));
    }

    function get_mahapola_data_ne() {
        $course2 = $this->input->post('course2');
        $center2 = $this->input->post('center2');
        $mp_year = $this->input->post('mp_year');
        $all = $this->input->post('all');
        echo json_encode($this->Report_model->get_mahapola_data_ne($course2, $center2, $mp_year, $all));
    }

    function load_course_list() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin - get All students
            echo json_encode($this->Report_model->load_course_list());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Report_model->load_user_course_list());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            //echo json_encode($this->Report_model->load_user_course_list());
            echo json_encode($this->Report_model->load_user_level_course_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Report_model->load_user_course_list());
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            echo json_encode($this->Report_model->load_user_course_list());
        }
    }

    function load_year_list() {
        echo json_encode($this->Report_model->load_year_list());
    }

    function load_batch_list() {
        echo json_encode($this->Report_model->load_batch_list());
    }

    function load_semesters() {
        echo json_encode($this->Report_model->load_semesters());
    }

    function search_students_lookup() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['type_student'] = $this->input->post('type_student');

        echo json_encode($this->Report_model->search_students_lookup($data));
    }

    function search_staff_lookup() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');

        echo json_encode($this->Report_model->search_staff_lookup($data));
    }

    function search_students_id_card_details() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year'] = $this->input->post('year');

        $stu_id_data = $this->Report_model->search_students_id_card_details_year_wise($data);

        echo json_encode($stu_id_data);
    }
    //kasun 2020-12-16
    function search_info_students() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year'] = $this->input->post('year');

        $stu_id_data = $this->Report_model->search_students_id_card_details_year_wise($data);

        echo json_encode($stu_id_data);
    }

    public function download_bulk_profile_images() {
        $center_id = $this->uri->segment(3);
        $course_id = $this->uri->segment(4);
        $center_name = $this->uri->segment(5);
        $course_name = $this->uri->segment(6);
        $year = $this->uri->segment(7);

        $data['center_id'] = $center_id;
        $data['course_id'] = $course_id;
        $data['year'] = $year;

        $stu_id_card_data = $this->Report_model->search_students_id_card_details_year_wise($data);
        //var_dump($stu_id_card_data);

        foreach ($stu_id_card_data as $row) {
            if ($row['profileimage'] != '') {
                $path = $row['profileimage'];
                //echo $path. "<br>";
                if (file_exists($path)) {
                    //$this->zip->read_file($path);
                    //$path = 'uploads/studentprofile/AMPHNDIT2018F21.jpg';
                    $this->zip->read_file($path);
                }
            }
        }

        $zip_name = $center_name . "_" . $course_name . ".zip";
        $this->zip->archive('uploads/studentprofile/' . $zip_name);
        $this->zip->download($zip_name);


        //$file = 'uploads/studentprofile/my_backup.zip';
        //force_download($file, NULL);
    }

    function student_id_card_report_pdf() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year'] = $_GET['year'];

        $data['center_name'] = $this->Report_model->get_center_by_id($data['center_id']);
        if ($data['course_id'] == 'all') {
            $data['course_name'] = 'All Courses';
        } else {
            $data['course_name'] = 'Course -' . $this->Report_model->get_course_by_id($data['course_id']);
        }

        $data['stu_id_card_data'] = $this->Report_model->search_students_id_card_details_year_wise($data);

        $this->load->view('reports/student_id_card_report_pdf', $data);
    }
    //Kasun 2020-12-16
    function student_info_report_pdf() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year'] = $_GET['year'];

        $data['center_name'] = $this->Report_model->get_center_by_id($data['center_id']);
        if ($data['course_id'] == 'all') {
            $data['course_name'] = 'All Courses';
        } else {
            $data['course_name'] = 'Course -' . $this->Report_model->get_course_by_id($data['course_id']);
        }

        $data['stu_id_card_data'] = $this->Report_model->search_students_id_card_details_year_wise($data);

        $this->load->view('reports/student_info_report_pdf', $data);
    }

    function student_id_card_report_excel() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year'] = $_GET['year'];

        //$data['stu_id_card_data'] = $this->Report_model->search_students_id_card_details($data);
        $data = $this->Report_model->search_students_id_card_details_year_wise($data);
        //var_dump($data);
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("Center Name", "Student Name", "REG No", "Course", "NIC");
        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }
        $from = "A1"; // or any value
        $to = "E1"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $excel_row = 2;

        foreach ($data as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['br_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['first_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['reg_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['course_code']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['nic_no']);
            //            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Student_Data.xls"');
        $object_writer->save('php://output');

        //$this->load->view('reports/student_id_card_report_pdf',$data);
    }
    //kasun 2020-12-16
    function student_info_report_excel() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year'] = $_GET['year'];

        //$data['stu_id_card_data'] = $this->Report_model->search_students_id_card_details($data);
        $data = $this->Report_model->search_students_id_card_details_year_wise($data);
        //var_dump($data);
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("Center Name", "Student Name", "REG No", "Course", "NIC","District","Mobile Number","Home Number","Address","E-Mail","Date of Birth","Gender","Civil Status","Religion");
        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }
        $from = "A1"; // or any value
        $to = "N1"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $excel_row = 2;

        foreach ($data as $row) {
            $temp_sex='';
            $temp_civil_status='';
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['br_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['first_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['reg_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['course_code']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['nic_no']);

            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['district']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['mobile_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['fixed_tp']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row['permanent_address']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row['email']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row['birth_date']);
            $temp_sex=$row['sex'];
            if($temp_sex=="F")
            $sex="Female";
            elseif($temp_sex=="M")
            $sex="Male";
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $sex);
            $temp_civil_status=$row['civil_status'];
            if($temp_civil_status=="S")
            $civil_status="Single";
            elseif($temp_civil_status=="M")
            $civil_status="Married";
            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $civil_status);
            $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $row['rel_name']);
            //            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Students_info.xls"');
        $object_writer->save('php://output');

        //$this->load->view('reports/student_id_card_report_pdf',$data);
    }

    function imageResize() {
        $this->load->view('reports/image_resize');
    }

    function load_mahapola_course_list() {
        echo json_encode($this->Report_model->load_mahapola_course_list());
    }

    function student_exam_details_pdf() {
        $data['id'] = $_GET['id'];
        // $data['id'] = $this->input->post('id');
        // $data['stu_ids'] = $this->input->post('stu_ids');
        // $data['student_details'] = $this->Report_model->get_student_exam_details($data);

        $data['stu_status'] = $_GET['stu_status'];
        $data['sitting_batch'] = $_GET['sitting_batch'];
        $data['sitting_exam'] = $_GET['sitting_exam'];

        if ($data['stu_status'] == 1) {
            $data['student_details'] = $this->Report_model->get_student_exam_details($data);
        } else {
            $data['student_details'] = $this->Report_model->get_student_exam_details_repeat($data);
        }


        $this->load->view('reports/student_exam_details_pdf', $data);
    }

    function student_exam_details_pdf_bulk() {

        $data['filename'] = $this->input->post('filename');
        $data['stu_ids'] = $this->input->post('stu_ids');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['student_status'] = $this->input->post('student_status');
        $data['batch_id'] = $this->input->post('batch_id');


        // $data['student_details'] = $this->Report_model->get_student_exam_details($data);
        if ($data['student_status'] == 1) {
            $data['student_details'] = $this->Report_model->get_student_exam_details_bulk($data);
        } else {
            $data['student_details'] = $this->Report_model->get_student_exam_details_bulk_repeat($data);
        }

        $this->load->view('reports/student_exam_details_pdf_bulk', $data);
    }

    function student_exam_report() {

        //$data['stu_all_count_array'] = $this->Report_model->get_all_stu_count();
        // $data['mahapola_data'] = $this->Report_model->get_mahapola_data();
        //$data['mahapola_course_list'] = $this->Report_model->load_mahapola_course_list();

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            $data['centers'] = $this->Report_model->get_all_centers();
            $data['ay_info'] = $this->Report_model->get_ay_info();
            // $data['exam_data'] = $this->Report_model->get_exam_applied_students();
        } else if ($ug_level == 2) { //
            $data['centers'] = $this->Report_model->get_center_admin_login_centers();
        } else if ($ug_level == 3) { // Registrar
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else if ($ug_level == 4) { // Lecturer
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else { // Student
            $data['centers'] = $this->Report_model->get_login_user_centers();
        }

        $data['stu_data'] = null;
        $data['main_content'] = 'reports/student_exam_details_view';
        $data['title'] = 'Student Exam Report';

        $this->load->view('includes/template', $data);
        //$this->load->view('reports/student_exam_details_pdf',$data);
    }

    function get_exam_applied_students() {

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['names'] = $this->input->post('names');
        $data['student_status'] = $this->input->post('student_status');

        echo json_encode($this->Report_model->get_exam_applied_students($data));
    }

    function lecturer_subject_report() {
        //$data['mahapola_course_list'] = $this->Report_model->load_mahapola_course_list();
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            $data['centers'] = $this->Report_model->get_all_centers();
            $data['subjects'] = $this->Report_model->get_all_subjects();
            $data['courses'] = $this->Report_model->get_all_courses_list();
            $data['ay_info'] = $this->company_model->get_ay_info();
        } else if ($ug_level == 2) { //
            $data['centers'] = $this->Report_model->get_center_admin_login_centers();
            //$data['centers'] = $this->Report_model->get_all_centers();
            //$data['ug_level'] = $this->Util_model->check_access_level();
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            $data['centers'] = $this->Report_model->get_login_user_centers();
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            $data['centers'] = $this->Report_model->get_login_user_centers();
        }

        $data['ug_level'] = $ug_level;
        $data['stu_data'] = null;
        $data['main_content'] = 'reports/lecturer_subjects_view';
        $data['title'] = 'General Reports';

        $this->load->view('includes/template', $data);
    }

    function load_staff_pdf() {

        $data['center_id'] = $_GET['cen'];
        $data['subject_id'] = $_GET['sub'];


        $data['dip_eligible_student'] = $this->Report_model->load_staff_pdf($data);
        if ($data['subject_id'] == 'all') {
            $this->load->view('reports/load_staff_subject_pdf', $data);
        } else {

            $this->load->view('reports/load_staff_pdf', $data);
        }
    }

    function search_pdf_staff_lookup() {
        $data['center_id'] = $this->input->post('center_id');
        $data['subject_id'] = $this->input->post('subject_id');

        echo json_encode($this->Report_model->search_pdf_staff_lookup($data));
    }

    function load_year_list_for_semsubject() {
        echo json_encode($this->Report_model->load_year_list_for_semsubject());
    }

    function load_semesters_list_for_semsubject() {
        echo json_encode($this->Report_model->load_semesters_list_for_semsubject());
    }

    function search_load_semester_sub_data() {
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');

        echo json_encode($this->Report_model->search_load_semester_sub_data($data));
    }

    function load_sem_subject_pdf() {

        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];


        $data['sem_subject_detail_array'] = $this->Report_model->load_sem_subject_pdf($data);

        $this->load->view('reports/load_semester_subject_pdf', $data);
    }

    function search_load_semester_sub_exam_data() {
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');

        echo json_encode($this->Report_model->search_load_semester_sub_exam_data($data));
    }

    function load_sem_subject_exam_pdf() {
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];


        $data['sem_exam_subject_detail_array'] = $this->Report_model->load_sem_subject_exam_pdf($data);

        $this->load->view('reports/load_semester_exam_subject_pdf', $data);
    }

    function search_students_semester_subject() {

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');


        echo json_encode($this->Report_model->search_students_semester_subject($data));
    }

    function print_students_semester_subject() {

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];


        $data['student_sem_subject_detail_array'] = $this->Report_model->print_students_semester_subject($data);

        $this->load->view('reports/print_student_semester_subject_details_pdf', $data);
    }

    function load_student_subjectwise() {
        $id = $this->input->post('id');
        $exam_id = $this->input->post('exam_id');
        $center_id = $this->input->post('center_id');


        echo json_encode($this->Report_model->load_student_subjectwise($id, $exam_id, $center_id));
    }

    function print_exam_attendees() {

        $data['center_id'] = $_GET['cen'];
        $data['subject_id'] = $_GET['sub'];
        $data['exam_id'] = $_GET['ex'];


        $data['student_sttendees_detail_array'] = $this->Report_model->print_exam_attendees($data);

        $this->load->view('reports/print_student_exam_attendees_pdf', $data);
    }

    function search_exam_attendended_students_data() {

        $data['batch_id'] = $this->input->post('batch_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['student_status'] = $this->input->post('student_status');

        echo json_encode($this->Report_model->search_exam_attendended_students_data($data));
    }

    function print_search_exam_attendended_students_data() {
        $data['batch_id'] = $_GET['ssid'];
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['student_status'] = $_GET['sstatus'];

        $data['student_attendees_array'] = $this->Report_model->print_search_exam_attendended_students_data($data);

        $this->load->view('reports/print_search_exam_attendended_students_data_pdf', $data);
    }

    function load_exams() {
        echo json_encode($this->Report_model->load_exams());
    }

    function load_years() {
        echo json_encode($this->Report_model->load_years());
    }

    function load_semester() {
        echo json_encode($this->Report_model->load_semester());
    }

    function load_students_who_applied_for_exams() {

        // $data['study_season_id'] = $this->input->post('study_season_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['east_type'] = $this->input->post('east_type');



        echo json_encode($this->Report_model->load_students_who_applied_for_exams($data));
    }

    function load_exam_subjects() {
        echo json_encode($this->Report_model->load_exam_subjects());
    }

    function dummy_load_students_who_applied_for_exams() {

        $data['study_season_id'] = $this->input->post('study_season_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
//        $data['subject_id'] = $this->input->post('subject_id');


        echo json_encode($this->Report_model->dummy_load_students_who_applied_for_exams($data));
    }

    function print_dummy_load_students_who_applied_for_exams() {///////////Won't Function//////////////
        $data['batch_id'] = $_GET['bat'];
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['subject_id'] = $_GET['sub'];
        $data['east_type'] = $_GET['eastty'];

        $data['student_applied_exam_array'] = $this->Report_model->print_dummy_load_students_who_applied_for_exams($data);

        $this->load->view('reports/print_load_students_who_applied_for_exams_report_pdf', $data);
    }

    function student_exam_marks_report() {

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) {           //Admin
            $data['centers'] = $this->Report_model->get_all_centers();
        } else if ($ug_level == 2) {    //
            $data['centers'] = $this->Report_model->get_center_admin_login_centers();
        } else if ($ug_level == 3) {    //Registrar
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else if ($ug_level == 4) {    //Lecturer
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else {                        //Student
            $data['centers'] = $this->Report_model->get_login_user_centers();
//            $data['gpaa']    = $this->Report_model->get_student_gpa_value_show();
        }


        $data['overallgpa'] = $this->Report_model->get_student_gpa_value_show();
        $data['ug_level'] = $ug_level;
        $data['stu_data'] = null;
        $data['main_content'] = 'reports/students_exam_marks_report_view';
        $data['title'] = 'Students Exam Marks Report';

        $this->load->view('includes/template', $data);
    }

    function search_students_exam_marks() {

        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');


        echo json_encode($this->Report_model->search_students_exam_marks($data));
    }

    function semester_subjects_by_semester() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');

        echo json_encode($this->Report_model->semester_subjects_by_semester($data));
    }

    function load_student_for_exam_marks() {
        $data['center_id'] = $this->input->post('center_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['exam_id'] = $this->input->post('exam_id');

        echo json_encode($this->Report_model->load_student_for_exam_marks_ca($data));

//        $user_level = $this->input->post('user_level');
        // if($user_level=='lec')
//        switch ($user_level) {
//            case 'ca_mark':
//                echo json_encode($this->Student_model->load_student_for_exam_marks_ca($data));
//                break;
//            case 'se_mark':
//                echo json_encode($this->Student_model->load_student_for_exam_marks_se($data));
//                break;
//            case 'hod':
//                echo json_encode($this->Student_model->load_student_for_exam_marks_approval_hod_ca($data));
//                break;
//            case 'dir':
//                echo json_encode($this->Student_model->load_student_for_exam_marks_approval_dir_ca($data));
//                break;
//            case 'ex_dir':
//                echo json_encode($this->Student_model->load_student_for_exam_marks_approval_dir_se($data));
//                break;
//
//            default:
//                $message_403 = "request failed!!!";
//                show_error($message_403, 403);
//        }
        //echo json_encode($this->Student_model->load_student_for_exam_marks_hod($data));
    }

    function load_student_for_p_note() {
        $data['center_id'] = $this->input->post('center_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['pnote_status'] = $this->input->post('pnote_status');

        if ($data['pnote_status'] == 1) {
            $result_data = $this->Report_model->load_student_for_p_note($data);
        } else {
            $result_data = $this->Report_model->load_repeat_student_for_p_note($data);
        }

        echo json_encode($result_data);
    }

    function print_load_student_data_p_notes() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['pnote_print_status'] = $_GET['pnote'];

        $data['student_exam_subject_array'] = $this->Report_model->semester_subjects_by_semester($data);

        if ($data['pnote_print_status'] == 1) {
            $data['student_exam_mark_array'] = $this->Report_model->print_load_student_data_for_p_note($data);
        } else {
            $data['student_exam_mark_array'] = $this->Report_model->print_repeat_load_student_data_for_p_note($data);
        }
        $data['course_selected'] = $this->Report_model->get_selected_course_name($data['course_id']);
        $data['center_selected'] = $this->Report_model->get_selected_center_name($data['center_id']);
        $data['authority_data'] = $this->Report_model->get_result_authorities();
        $data['current_year'] = date("Y");
        $data['current_date'] = date('d-m-Y');

        $this->load->view('reports/print_load_student_exam_data_p_notes_pdf', $data);
    }

    function load_student_for_exam_mark_report() {
        $data['center_id'] = $this->input->post('center_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['exam_id'] = $this->input->post('exam_id');

        echo json_encode($this->Report_model->load_student_exam_marks_report($data));
    }

    function print_load_student_data() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];


        $data['student_exam_subject_array'] = $this->Report_model->semester_subjects_by_semester($data);
        $data['student_exam_mark_array'] = $this->Report_model->print_load_student_data($data);
        $data['course_selected'] = $this->Report_model->get_selected_course_name($data['course_id']);
        $data['center_selected'] = $this->Report_model->get_selected_center_name($data['center_id']);
        $data['authority_data'] = $this->Report_model->get_result_authorities();
        $data['current_year'] = date("Y");
        $data['current_date'] = date('d-m-Y');
        $data['ug_level'] = $ug_level;

        $temp_date = $this->Report_model->get_exam_conduct_year($data['course_id'], $data['year_no'], $data['semester_no'], $data['exam_id']);

        if ($temp_date == null || $temp_date == '') {
            $data['conduct_year'] = date('Y');
            $data['effective_date'] = date('d-m-Y');
        } else {
            $temp_date_array = explode('-', $temp_date);
            $data['conduct_year'] = $temp_date_array[0];
            $data['effective_date'] = date('d-m-Y', strtotime("+2 day", strtotime($temp_date)));
        }

        $this->load->view('reports/print_load_student_exam_data_pdf', $data);
        $this->load->library('tcpdf/tc', $data);
    }

    function search_mast_students() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['mp_year'] = $this->input->post('mp_year');
        $data['all'] = $this->input->post('all');

        echo json_encode($this->Report_model->search_mast_students($data));
    }

    function print_mast_search() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['mp_year'] = $_GET['mp_year'];
        $data['all'] = $_GET['all'];

        $data['student_mast_array'] = $this->Report_model->print_mast_search($data);

        $this->load->view('reports/print_mast_student_pdf', $data);
    }

    function search_diploma_eligible_students() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');

        echo json_encode($this->Report_model->search_diploma_eligible_students($data));
    }

    function print_search_diploma_eligible_students() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];

        $data['dip_eligible_student'] = $this->Report_model->print_search_diploma_eligible_students($data);

        $this->load->view('reports/diploma_eligible_students_report_pdf', $data);
    }

    function load_exam_batch_list() {
        echo json_encode($this->Report_model->load_exam_batch_list());
    }

    function load_exam_apply_course_list() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin - get All students
            echo json_encode($this->Report_model->load_admin_course_list());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Report_model->load_lecturer_course_list());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Report_model->load_registar_course_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Report_model->load_lecturer_course_list());
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            echo json_encode($this->Report_model->load_lecturer_course_list());
        }
    }

    function load_exam_apply_years() {
        echo json_encode($this->Report_model->load_exam_apply_years());
    }

    function load_exam_apply_semesters() {
        echo json_encode($this->Report_model->load_exam_apply_semesters());
    }

    function load_exm_apply_batches() {
        echo json_encode($this->Report_model->load_exm_apply_batches());
    }

    function load_exm_apply_exams() {
        echo json_encode($this->Report_model->load_exm_apply_exams());
    }

    function load_exam_course_list() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin - get All students
            echo json_encode($this->Report_model->load_exm_admin_course_list());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Report_model->load_exm_lecturer_course_list());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Report_model->load_exm_registar_course_list());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Report_model->load_exm_lecturer_course_list());
            //get access rights to that user
        } else { // Student
            //get only logged in user records. 
            echo json_encode($this->Report_model->load_exm_lecturer_course_list());
        }
    }

    function load_exam_years() {
        echo json_encode($this->Report_model->load_exam_years());
    }

    function load_exam_semesters() {
        echo json_encode($this->Report_model->load_exam_semesters());
    }

    function load_exm_batches() {
        echo json_encode($this->Report_model->load_exm_batches());
    }

    function load_exm_exams() {
        echo json_encode($this->Report_model->load_exm_exams());
    }

    function load_all_exam_count() {
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');
        $data['course'] = $this->input->post('course');
        $data['batch'] = $this->input->post('batch');
        $data['center'] = $this->input->post('center');
        $data['exam'] = $this->input->post('exam');
        $data['current_status'] = $this->input->post('current_status');

        if ($data['current_status'] == 1) {
            echo json_encode($this->Report_model->load_all_exam_count($data));
        } else {
            echo json_encode($this->Report_model->load_all_exam_count_repeat($data));
        }
    }

    function exam_full_summary_pdf() {

        $data['year'] = $_GET['year'];
        $data['semester'] = $_GET['semester'];
        $data['course'] = $_GET['course'];
        $data['batch'] = $_GET['batch'];
        $data['center'] = $_GET['center'];
        $data['exam'] = $_GET['exam'];
        $data['current_status'] = $_GET['curr'];

        if ($data['current_status'] == 1) {
            $data['student_all_count_exms'] = $this->Report_model->load_all_exam_count($data);
        } else {
            $data['student_all_count_exms'] = $this->Report_model->load_all_exam_count_repeat($data);
        }

        $this->load->view('reports/exam_full_summary_pdf', $data);
    }

    function load_center_wise_student_exams() {
        $data['ap_center'] = $this->input->post('ap_center');
        $data['ap_course'] = $this->input->post('ap_course');
        $data['ap_batch'] = $this->input->post('ap_batch');
        $data['ap_year'] = $this->input->post('ap_year');
        $data['ap_semester'] = $this->input->post('ap_semester');
        $data['ap_exam'] = $this->input->post('ap_exam');
        $data['selected_type'] = $this->input->post('selected_type');
        $data['current_status'] = $this->input->post('current_status');

        if ($data['current_status'] == 1) {
            echo json_encode($this->Report_model->load_center_wise_student_exams($data));
        } else {
            echo json_encode($this->Report_model->load_center_wise_student_exams_repeat($data));
        }
    }

    function exam_center_wise_summary_pdf() {

        $data['ap_center'] = $_GET['ap_center'];
        $data['ap_course'] = $_GET['ap_course'];
        $data['ap_batch'] = $_GET['ap_batch'];
        $data['ap_year'] = $_GET['ap_year'];
        $data['ap_semester'] = $_GET['ap_semester'];
        $data['ap_exam'] = $_GET['ap_exam'];

        $data['selected_type'] = $_GET['selected_type'];

        $data['current_status'] = $_GET['current_status'];

        if ($data['current_status'] == 1) {
            $data['student_exam_count'] = $this->Report_model->load_center_wise_student_exams($data);
        } else {
            $data['student_exam_count'] = $this->Report_model->load_center_wise_student_exams_repeat($data);
        }

        $this->load->view('reports/exam_center_wise_summary_pdf', $data);
    }

    function user_action_log_report() {
        $data['user_groups'] = $this->Report_model->get_user_groups();

        $data['main_content'] = 'reports/user_action_log_report';
        $data['title'] = 'User Action Log';

        $this->load->view('includes/template', $data);
    }

    function get_user_types() {
        $user_group = $this->input->post('user_group');
        echo json_encode($this->Report_model->get_user_types($user_group));
    }

    function search_user_log_actions() {

        //$data['user_group'] = $this->input->post('sel_user_group');
        $data['user'] = $this->input->post('sel_user');
        $data['from_date'] = $this->input->post('from_date') . ' 00:00:00';
        $data['to_date'] = $this->input->post('to_date') . ' 23:59:59';

        echo json_encode($this->Report_model->search_user_log_actions($data));
    }

    function load_semester_subjects() {
        $data['batch_id'] = $this->input->post('batch_id');
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);
        echo json_encode($this->Report_model->load_semester_subjects($data, $batch_details));
    }

    function load_semester_subjects_recorrection() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');

        echo json_encode($this->Report_model->load_semester_subjects_recorrection($data));
    }

    function load_student_for_repeated() {
        $data['center_id'] = $this->input->post('center_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['exam_id'] = $this->input->post('exam_id');

        echo json_encode($this->Report_model->load_student_for_repeated($data));
    }

////////////////////////////////////////////////////////////////

    function load_recorrection_student_data() {
        echo json_encode($this->Report_model->load_recorrection_student_data());
    }

    function load_rpt_semester_subjects_by_semester() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        echo json_encode($this->Report_model->load_rpt_semester_subjects_by_semester($data));
    }

    function load_rpt_student_for_exam_marks() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['course_id'] = $this->input->post('course_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['exam_id'] = $this->input->post('exam_id');


        echo json_encode($this->Report_model->load_rpt_student_for_exam_marks($data));
    }

    function load_recorrection_students() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['year'] = $this->input->post('year');
        $data['semester'] = $this->input->post('semester');

        echo json_encode($this->Report_model->load_recorrection_students($data));
    }

    function prnt_load_recorrection_student_data() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['exam_id'] = $_GET['exm'];
        $data['year'] = $_GET['yr'];
        $data['semester'] = $_GET['sem'];
        $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);

        //$data['student_exam_subject_array'] = $this->Report_model->load_semester_subjects($data, $batch_details);
        $data['student_exam_subject_array'] = $this->Report_model->load_semester_subjects_recorrection($data);
        $data['student_recorrection_student_array'] = $this->Report_model->print_load_recorrection_students($data);
        $data['course_selected'] = $this->Report_model->get_selected_recorrection_course_name($data['course_id']);
        $data['center_selected'] = $this->Report_model->get_selected_recorrection_center_name($data['center_id']);

        $data['authority_data'] = $this->Report_model->get_result_authorities();
        $data['current_year'] = date("Y");
        $data['current_date'] = date('d-m-Y');
        $data['ug_level'] = $ug_level;

        $temp_date = $this->Report_model->get_exam_conduct_year($data['course_id'], $data['year'], $data['semester'], $data['exam_id']);
        if ($temp_date == null || $temp_date == '') {
            $data['conduct_year'] = date('Y');
            $data['effective_date'] = date('d-m-Y');
        } else {
            $temp_date_array = explode('-', $temp_date);
            $data['conduct_year'] = $temp_date_array[0];
            $data['effective_date'] = date('d-m-Y', strtotime("+2 day", strtotime($temp_date)));
        }

        $this->load->view('reports/prnt_load_recorrection_student_data_pdf', $data);
    }

    function prnt_load_repeat_student_data_report() {

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['batch_id'] = $_GET['bat'];
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];

        $data['student_exam_subject_array'] = $this->Report_model->load_rpt_semester_subjects_by_semester($data);
        $data['student_repeat_array'] = $this->Report_model->prnt_load_repeat_student_data_report($data);
        $data['course_selected'] = $this->Report_model->get_selected_repeat_course_name($data['course_id']);
        $data['center_selected'] = $this->Report_model->get_selected_repeat_center_name($data['center_id']);
        $data['ug_level'] = $ug_level;
        $data['current_year'] = date("Y");
        $data['current_date'] = date('d-m-Y');
        $data['authority_data'] = $this->Report_model->get_result_authorities();

        $temp_date = $this->Report_model->get_exam_conduct_year($data['course_id'], $data['year_no'], $data['semester_no'], $data['exam_id']);
        if ($temp_date == null || $temp_date == '') {
            $data['conduct_year'] = date('Y');
            $data['effective_date'] = date('d-m-Y');
        } else {
            $temp_date_array = explode('-', $temp_date);
            $data['conduct_year'] = $temp_date_array[0];
            $data['effective_date'] = date('d-m-Y', strtotime("+2 day", strtotime($temp_date)));
        }

        $this->load->view('reports/print_repeat_students_approved_pdf', $data);
    }

    function differ_load_students_who_applied_for_exams() {

        // $data['study_season_id'] = $this->input->post('study_season_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['is_attend'] = $this->input->post('is_attend');
        $data['student_status'] = $this->input->post('student_status');

        echo json_encode($this->Report_model->differ_load_students_who_applied_for_exams($data));
    }

    function print_differ_load_students_who_applied() {
        $data['batch_id'] = $_GET['bat'];
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['subject_id'] = $_GET['sub'];
        $data['is_attend'] = $_GET['is_att'];


        $data['student_applied_exam_array'] = $this->Report_model->print_differ_load_students_who_applied($data);
//print_differ_load_students_who_applied     print_dummy_load_students_who_applied_for_exams
        $this->load->view('reports/print_differ_load_students_who_applied_report', $data);
    }

    function sign_load_exams() {
        echo json_encode($this->Report_model->sign_load_exams());
    }

    function sign_load_exam_subjects() {
        echo json_encode($this->Report_model->sign_load_exam_subjects());
    }

    function sign_load_students_who_applied_for_exams() {

        // $data['study_season_id'] = $this->input->post('study_season_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['current_status'] = $this->input->post('current_status');

        if ($data['current_status'] == 1) {
            echo json_encode($this->Report_model->sign_load_students_who_applied_for_exams($data));
        } else {
            echo json_encode($this->Report_model->sign_load_students_who_applied_for_exams_repeat($data));
        }
    }

    function print_sign_load_students_who_applied_for_exams() {///////////Won't Function//////////////
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['subject_id'] = $_GET['sub'];

        $data['curr'] = $_GET['curr'];

        if ($data['curr'] == 1) {
            $data['student_applied_exam_array'] = $this->Report_model->print_sign_load_students_who_applied_for_exams($data);
        } else {
            $data['student_applied_exam_array'] = $this->Report_model->print_sign_load_students_who_applied_for_exams_repeat($data);
        }

        $this->load->view('reports/print_sign_students_who_applied_for_exams_report_pdf', $data);
    }

    function get_recorrection_years() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];
        $course_id = $this->input->post('course_id');

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Report_model->get_recorrection_years($course_id));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Report_model->get_recorrection_years($course_id));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Report_model->get_recorrection_years($course_id));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Report_model->get_recorrection_years($course_id));

            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            echo json_encode($this->Report_model->get_recorrection_years_students($course_id, $this->session->userdata('user_ref_id')));
        }





//        $course_id = $this->input->post('course_id');
//        echo json_encode($this->Report_model->get_recorrection_years($course_id));
    }

    function get_recorrection_semesters() {
        $course_id = $this->input->post('course_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

//        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Report_model->get_recorrection_semesters($course_id, $year_no));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Report_model->get_recorrection_semesters($course_id, $year_no));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Report_model->get_recorrection_semesters($course_id, $year_no));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Report_model->get_recorrection_semesters($course_id, $year_no));

            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            echo json_encode($this->Report_model->get_recorrection_semesters_students($course_id, $year_no, $this->session->userdata('user_ref_id')));
        }


//        $course_id = $this->input->post('course_id');
//        $year_no = $this->input->post('year_no');
//        echo json_encode($this->Report_model->get_recorrection_semesters($course_id,$year_no));
    }

    function get_recorrection_semesters_marks() {

        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');
        $year_id = $this->input->post('year_id');

        echo json_encode($this->Report_model->get_recorrection_semesters_marks($course_id, $year_no, $year_id));
    }

    function load_repeat_batches() {
        $course_id = $this->input->post('course_id');
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->batch_model->load_batches($course_id));
        } else if ($ug_level == 2) { //
            echo json_encode($this->batch_model->load_batches($course_id));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->batch_model->load_batches($course_id));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->batch_model->load_batches($course_id));

            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            echo json_encode($this->Report_model->load_repeat_batches_student($course_id, $this->session->userdata('user_ref_id')));
        }
    }

    /*     * ******************************************************************************************************** */

    function analysis_get_semester_subjects() {
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');

        echo json_encode($this->Data_analysis_model->analysis_get_semester_subjects($data));
    }

    function load_data_for_subj_analysis_report() {
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['analysis_attempt'] = $this->input->post('attempt');

        echo json_encode($this->Data_analysis_model->load_data_for_subj_analysis_report($data));
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function data_analysis_report() {
        //$data['staff_all_count'] = $this->Report_model->get_all_staff_count();

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];


        if ($ug_level == 1) {           //Admin
            $data['centers'] = $this->Report_model->get_all_centers();
            $data['courses'] = $this->Data_analysis_model->analysis_load_subject_selection_course_list();
        } else if ($ug_level == 2) {    //
            $data['centers'] = $this->Report_model->get_center_admin_login_centers();
        } else if ($ug_level == 3) {    //Registrar
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else if ($ug_level == 4) {    //Lecturer
            $data['centers'] = $this->Report_model->get_login_user_centers();
        } else {                        //Student
            $data['centers'] = $this->Report_model->get_login_user_centers();
//            $data['gpaa']    = $this->Report_model->get_student_gpa_value_show();
        }


        $data['ug_level'] = $ug_level;
        $data['main_content'] = 'reports/data_analysis_report_view';
        $data['title'] = 'Data Analysis Report View';

        $this->load->view('includes/template', $data);
    }

    function analysis_load_subject_selection_course_list() {
//        $access_level = $this->Util_model->check_access_level();
//        //print_r($access_level);
//        $ug_level = $access_level[0]['ug_level'];
//        $stu_id = 0;
//        $course_id = 0;
//        if ($ug_level == 5) {
//            $stu_id = $this->CI->session->userdata('user_ref_id');
//
//            $data_stu = $this->Student_model->edit_student($stu_id);
//            // print_r($data_stu);
//            $course_id = $data_stu[0]['course_id'];
//        }
        echo json_encode($this->Data_analysis_model->analysis_load_subject_selection_course_list());
    }

    function analysis_get_course() {

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Data_analysis_model->analysis_get_course());
        } else if ($ug_level == 2) { //
            echo json_encode($this->Data_analysis_model->analysis_get_course());
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Data_analysis_model->analysis_get_course());
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Data_analysis_model->analysis_get_course());

            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            //echo json_encode($this->course_model->get_course_student($this->session->userdata('user_ref_id')));
        }
    }

    function analysis_load_semester_exam() {
        $data['batch_id'] = $this->input->post('batch_id');
        $data['analys_course_id'] = $this->input->post('analys_course_id');
        $data['analys_year'] = $this->input->post('analys_year');
        $data['analys_semester'] = $this->input->post('analys_semester');

        // $batch_details = $this->batch_model->batch_details_by_id($data['batch_id']);

        echo json_encode($this->Data_analysis_model->analysis_load_semester_exam($data));
    }

    function analysis_load_semesters() {
        $course_id = $this->input->post('course_id');
        $year_no = $this->input->post('year_no');

        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Data_analysis_model->analysis_load_semesters($course_id, $year_no));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Data_analysis_model->analysis_load_semesters($course_id, $year_no));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Data_analysis_model->analysis_load_semesters($course_id, $year_no));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Data_analysis_model->analysis_load_semesters($course_id, $year_no));

            //get access rights to that user
        } else { // Student
            //get only logged in user records.
//            echo json_encode($this->Subject_model->load_semesters_student($course_id, $year_no, $this->session->userdata('user_ref_id')));
        }
    }

    function analysis_student_mark_details() {
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year');
        $data['semester_no'] = $this->input->post('semester');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['analysis_attempt'] = $this->input->post('analysis_attempt');
        $data['time'] = $this->input->post('time');

        echo json_encode($this->Data_analysis_model->analysis_student_mark_details($data));
    }

    function analysis_print_load_student_data() {

        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['analysis_attempt'] = $_GET['analy_att'];
        $data['time'] = $_GET['time'];

        // print_r($data);

        $data['batch_code'] = $this->Data_analysis_model->get_selected_batch_name($data['batch_id']);
        $data['course_details'] = $this->Data_analysis_model->get_selected_course_name($data['course_id']);
        $data['data_array'] = $this->Data_analysis_model->analysis_student_mark_details($data);

        $this->load->view('reports/print_center_student_analysis_pdf', $data);
    }

    function print_analysis_sub_wise_data_load() {

        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['analysis_attempt'] = $_GET['analy_att'];
        $data['cat'] = $_GET['cat'];
        $data['sub'] = $_GET['sub'];
        
        

        $data['batch_code'] = $this->Data_analysis_model->get_selected_batch_name($data['batch_id']);
        $data['course_details'] = $this->Data_analysis_model->get_selected_course_name($data['course_id']);
        $data['data_array']['subj_data'] = $this->Data_analysis_model->load_data_for_subj_analysis_report($data);

        $this->load->view('reports/print_center_student_subj_wise_analysis_pdf', $data);
    }

    function search_stu_request_course_students_load() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['request_type'] = $this->input->post('request_type');

        echo json_encode($this->Report_model->search_stu_request_course_students_load($data));
    }

    function print_stu_request_course_students_load() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['request_type'] = $_GET['sel'];


        $data['dip_eligible_student'] = $this->Report_model->search_stu_request_course_students_load($data);

        $this->load->view('reports/student_request_report_pdf', $data);
    }

    //Student Full Marks Report
    function load_batches_full_results() {
        $course_id = $this->input->post('course_id');
        $access_level = $this->Util_model->check_access_level();

        $ug_level = $access_level[0]['ug_level'];

        if ($ug_level == 1) { //Admin
            //get All students
            echo json_encode($this->Report_model->load_batches_full_results($course_id));
        } else if ($ug_level == 2) { //
            echo json_encode($this->Report_model->load_batches_full_results($course_id));
        } else if ($ug_level == 3) { // Registrar
            //get the only Logged in user center Students details.
            echo json_encode($this->Report_model->load_batches_full_results($course_id));
        } else if ($ug_level == 4) { // Lecturer
            //get the only Logged in user center Students details and send rights to the controls like buttons.
            echo json_encode($this->Report_model->load_batches_full_results($course_id));

            //get access rights to that user
        } else { // Student
            //get only logged in user records.
            echo json_encode($this->Report_model->load_batches_full_results_student($course_id, $this->session->userdata('user_ref_id')));
        }
    }

    function load_student_data_full_results() {

        $data['center_id'] = $this->input->post('center_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['course_id'] = $this->input->post('course_id');

        echo json_encode($this->Report_model->load_student_data_full_results($data));
    }

    function load_student_full_results_list() {

        $data['stu_id'] = $this->input->post('stu_id');

        echo json_encode($this->Report_model->load_student_full_results_list($data));
    }

    function print_stu_full_results() {

        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['stu_id'] = $_GET['stu'];
        $data['course_id'] = $_GET['cou'];
        $data['center_id'] = $_GET['cen'];
        $data['batch_id'] = $_GET['bat'];

        $data['student_full_exam_results'] = $this->Report_model->load_student_full_results_list($data);
        $data['stu_data'] = $this->Report_model->get_selected_stu_data($data['stu_id']);
        $data['course_selected'] = $this->Report_model->get_selected_course_name($data['course_id']);
        $data['center_selected'] = $this->Report_model->get_selected_center_name($data['center_id']);
        $data['batch_selected'] = $this->Report_model->get_selected_batch_name($data['batch_id']);
        $data['authority_data'] = $this->Report_model->get_result_authorities();
        $data['ug_level'] = $ug_level;
        $data['current_date'] = date('d-m-Y');


        $this->load->view('reports/student_full_exam_results_report_pdf', $data);
        $this->load->library('tcpdf/tc', $data);
    }

    function excel_stu_request_course_students_load_btn() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['request_type'] = $_GET['sel'];

        //$data['stu_id_card_data'] = $this->Report_model->search_students_id_card_details($data);
        $data = $this->Report_model->search_stu_request_course_students_load($data);
        //var_dump($data);
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("REG No", "Student Name", "NIC", "Tel No", "Course", "Center", "CGPA", "Address");
        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 6, $field);
            $column++;
        }
        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }
        $from = "A6"; // or any value
        $to = "H6"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $excel_row = 7;

        foreach ($data as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['reg_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['first_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['nic_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['mobile_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['course_code']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row['br_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row['max']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row['permanent_address']);
//            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $excel_row++;
        }
        /////////////////Header Part//////////
        $center = $row['br_name'];
        $course = $row['course_code'];
        $batch = $row['batch_code'];
        $req = $row['request_type'];
        $is_approve = $row['is_approved'];
        $status = $row['status'];

        $sentence = "";

        if ($req == 1) {
            $sentence = "Postpone Students";
        } else if ($req == 2 && $is_approve == 1) {
            $sentence = "Graduation Request Approved";
        } else if ($req == 2 && $is_approve == 3) {
            $sentence = "Graduation Rejected Students";
        }



        $req_ATI = "Name of the ATI/ Section : " . $center;
        $req_course = "Name of the Course : " . $course;
        $req_batch = "Batch : " . $batch;
        $req_sentecnce = "Type : " . $sentence;


        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 1, $req_ATI);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 2, $req_course);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 3, $req_batch);
        $object->getActiveSheet()->setCellValueByColumnAndRow(0, 4, $req_sentecnce);

        /////////////////Header Part End//////

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Student_Request_Data.xls"');
        $object_writer->save('php://output');



        //$this->load->view('reports/student_id_card_report_pdf',$data);
    }

    function setter_load_exam_subjects() {
        echo json_encode($this->Report_model->setter_load_exam_subjects());
    }

    function setter_paper_data() {

        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');


        echo json_encode($this->Report_model->setter_paper_data($data));
    }

    function setter_data_pdf() {
        $data['course_id'] = $_GET['cou'];
        $data['batch_id'] = $_GET['bat'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['subject_id'] = $_GET['sub'];

        $data['student_applied_exam_array'] = $this->Report_model->setter_paper_data($data);

        $this->load->view('reports/print_setter_paper_data_pdf', $data);
    }

    function print_search_exam_subject_mark_data() {
        $data['batch_id'] = $_GET['batch_id'];
        $data['center_id'] = $_GET['center'];
        $data['course_id'] = $_GET['course'];
        $data['year_no'] = $_GET['year_no'];
        $data['semester_no'] = $_GET['sem_no'];
        $data['sem_exam_id'] = $_GET['sem_exm'];
        $data['sub_id'] = $_GET['sub_id'];
        $data['current_status'] = $_GET['curr'];

        if ($data['current_status'] == 1) {
            $data['student_sub_mark_array'] = $this->Report_model->print_search_exam_subject_mark_data($data);
        } else {
            $data['student_sub_mark_array'] = $this->Report_model->print_search_exam_subject_mark_data_repeat($data);
        }

        if (empty($data['student_sub_mark_array'])) {
            $this->session->set_flashdata('flashError', 'Data do not exist.');
            redirect('report/student_exam_report');
        } else {
            $this->load->view('reports/print_search_exam_subject_mark_data_pdf', $data);
        }
    }

    function student_course_wise_details_stu_info() {
        $type = $this->input->post('type_val');
        $year = $this->input->post('year');

        echo json_encode($this->Report_model->student_course_wise_details_stu_info($type, $year));
    }

    function load_center_list_for_deactivated() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        echo json_encode($this->Report_model->load_center_list_for_deactivated());
    }

    function deactivate_student_list_search() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year'] = $this->input->post('year');


        echo json_encode($this->Report_model->deactivate_student_list_search($data));
    }

    function deactivate_student_list_search_print() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year'] = $_GET['year'];

        $data['deactivate_student_array'] = $this->Report_model->deactivate_student_list_search($data);

        $this->load->view('reports/print_deactivate_student_list_search_pdf', $data);
        $this->load->library('tcpdf/tc', $data);
    }

    function rejected_student_list_search() {
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['year'] = $this->input->post('year');


        echo json_encode($this->Report_model->rejected_student_list_search($data));
    }

    function rejected_student_list_search_print() {
        $access_level = $this->Util_model->check_access_level();
        $ug_level = $access_level[0]['ug_level'];

        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year'] = $_GET['year'];

        $data['rejected_student_array'] = $this->Report_model->rejected_student_list_search($data);

        $this->load->view('reports/print_rejected_student_list_search_pdf', $data);
        $this->load->library('tcpdf/tc', $data);
    }

    function deferement_load_students_who_approved() {

        // $data['study_season_id'] = $this->input->post('study_season_id');
        $data['center_id'] = $this->input->post('center_id');
        $data['course_id'] = $this->input->post('course_id');
        $data['batch_id'] = $this->input->post('batch_id');
        $data['year_no'] = $this->input->post('year_no');
        $data['semester_no'] = $this->input->post('semester_no');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['is_attend'] = $this->input->post('is_attend');
        $data['student_status'] = $this->input->post('student_status');

        echo json_encode($this->Report_model->deferement_load_students_who_approved($data));
    }

    function print_deferement_load_students_who_approved() {
        $data['batch_id'] = $_GET['bat'];
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yea'];
        $data['semester_no'] = $_GET['sem'];
        $data['exam_id'] = $_GET['exm'];
        $data['subject_id'] = $_GET['sub'];
        $data['is_attend'] = $_GET['is_att'];
        $data['student_status'] = $_GET['student_status'];


        $data['deferement_approved_student_array'] = $this->Report_model->deferement_load_students_who_approved($data);

        $this->load->view('reports/print_deferement_load_students_who_approved_report', $data);
        $this->load->library('tcpdf/tc', $data);
    }

    function load_lecturers_for_center() {
        $center_id = $this->input->post('center_id');
        echo json_encode($this->Staff_model->load_lecturers_for_center($center_id));
    }

    function load_subject_pdf() {

        $data['center_id'] = $_GET['cen'];
        $data['lecturer_id'] = $_GET['lec'];


        $data['lecturer_subjects'] = $this->Report_model->load_subject_pdf($data);

        if ($data['lecturer_id'] == 'all') {
            $this->load->view('reports/load_subject_lecturer_pdf', $data);
        } else {
            //$data['lecturer_subjects'] = $this->Report_model->load_subject_pdf($data);

            $this->load->view('reports/load_subject_pdf', $data);
        }
    }

    function search_pdf_subject_lookup() {
        $data['center_id'] = $this->input->post('center_id');
        $data['lecturer_id'] = $this->input->post('lecturer_id');

        echo json_encode($this->Report_model->search_pdf_subject_lookup($data));
    }

    function load_transfer_pdf() {

        $data['tr_center_id'] = $_GET['cen'];
        $data['transfer_students'] = $this->Report_model->load_transfer_pdf($data);
        $this->load->view('reports/load_transfer_pdf', $data);
    }

    function search_pdf_transfer_lookup() {
        $data['tr_center_id'] = $this->input->post('tr_center_id');
        echo json_encode($this->Report_model->search_pdf_transfer_lookup($data));
    }

    function load_pdf_course_detail_print_excel() {
        $data['center_id'] = $_GET['cen'];
        $data['course_id'] = $_GET['cou'];
        $data['year_no'] = $_GET['yr'];
        $data['semester_no'] = $_GET['sem'];
        $data['batch_id'] = $_GET['bat'];
        $data['type_student'] = $_GET['type_student'];
        
        $data['center_name'] = $this->Report_model->get_center_by_id($data['center_id']);

        if ($data['course_id'] == 'all') {
            $data['course_name'] = 'All Courses';
        } else {
            $data['course_name'] = $this->Report_model->get_course_by_id($data['course_id']);
        }

        if ($data['batch_id'] == '' || $data['batch_id'] == null) {
            $data['batch_name'] = 'All';
        } else {
            $data['batch_name'] = $this->Report_model->get_batch_by_id($data['course_id']);
        }
        
//        $data['center_name'] = $this->Report_model->get_center_by_id($data['center_id']);
//
//        if ($data['course_id'] == 'all') {
//            $data['course_name'] = 'All Courses';
//        } else {
//            $data['course_name'] = $this->Report_model->get_course_by_id($data['course_id']);
//        }
//
//        if ($data['batch_id'] == '' || $data['batch_id'] == null) {
//            $data['batch_name'] = 'All';
//        } else {
//            $data['batch_name'] = $this->Report_model->get_batch_by_id($data['course_id']);
//        }


        $data = $this->Report_model->search_students_lookup($data);
        
        
        
        

        
        
        //var_dump($data);
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $table_columns = array("Center Name", "Register Name" , "Student Name", "NIC", "Course", "A/L Results", "O/L Results", "Mahapola");
        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        foreach (range('A', $object->getActiveSheet()->getHighestDataColumn()) as $col) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }
        $from = "A1"; // or any value
        $to = "H1"; // or any value
        $object->getActiveSheet()->getStyle("$from:$to")->getFont()->setBold(true);
        $excel_row = 2;

        foreach ($data as $row) {
            if($row['apply_mahapola'] == 1){
                $ma = 'Applied';
            }else{
                $ma = 'Not applied';
            }
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['br_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['reg_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['first_name']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['nic_no']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row['course_code']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, " ".$row['cas1s']."-".$row['sub1g'].",\r ".$row['cas2s']."-".$row['sub2g'].",\r ".$row['cas3s']."-".$row['sub3g'].",\r ".$row['cas4s']."-".$row['sub4g']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, " Maths - ".$row['olmathg'].",\r English - ".$row['olenglishg']);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $ma);
            
//            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Student_Data.xls"');
        $object_writer->save('php://output');

        //$this->load->view('reports/student_id_card_report_pdf',$data);
    }
    
    function mp_summary_search(){
        $data['mp_summary_year'] = $this->input->post('mp_summary_year');
        
        echo json_encode($this->Report_model->mp_summary_search($data));
    }

}
