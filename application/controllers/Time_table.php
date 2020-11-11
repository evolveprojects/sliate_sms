<?php
class Time_table extends CI_Controller {
 
function __construct() {
    parent::__construct();
    $this->load->model('timetable_model');
}

function index() {
    // $data['courses'] = $this->timetable_model->load_courses();
    $data['main_content'] = 'lecture_timetable_view';
    $data['title'] = 'Lecture Time table';
    $this->load->view('includes/template', $data);
}

function load_years()
{
	echo json_encode($this->timetable_model->load_years());
}

function load_semester()
{
	echo json_encode($this->timetable_model->load_semester());
}

function savetimetbl()
{
	echo json_encode($this->timetable_model->savetimetbl());
}

function load_timetable_data()
{
	echo json_encode($this->timetable_model->load_timetable_data());
}

function load_lectureslist()
{
	echo json_encode($this->timetable_model->load_lectureslist());
}

function load_subjects()
{
	echo json_encode($this->timetable_model->load_subjects());
}
	
function load_halls()
{
	echo json_encode($this->timetable_model->load_halls());
}

function load_lecturers()
{
	echo json_encode($this->timetable_model->load_lecturers());
}

function save_lecture()
{
	echo json_encode($this->timetable_model->save_lecture());
}

function load_finalized_timetables()
{
	echo json_encode($this->timetable_model->load_finalized_timetables());
}

function verify_timetable()
{
	echo json_encode($this->timetable_model->verify_timetable());
}

function confirm_timetable()
{
	echo json_encode($this->timetable_model->confirm_timetable());
}

function load_lecture_timeslot()
{
	echo json_encode($this->timetable_model->load_lecture_timeslot());
}

function delete_lecture()
{
	echo json_encode($this->timetable_model->delete_lecture());
}

function assign_timetable_view() 
{
    $data['courses'] = $this->timetable_model->load_courses();
    $data['main_content'] = 'timetable_assign_view';
    $data['title'] = 'Lecture Time table';
    $this->load->view('includes/template', $data);
}

function assign_time_table()
{
	$save = $this->timetable_model->assign_time_table();

	if($save)
	{
		$this->session->set_flashdata('flashSuccess', 'Time Table assigned successfully');
	}
	else
	{
		$this->session->set_flashdata('flashError', 'Failed to assign Time Table');
	}

	redirect('time_table/assign_timetable_view');
}

function get_startdate()
{
	echo json_encode($this->timetable_model->get_startdate());
}

function load_assined_timetables()
{
	echo json_encode($this->timetable_model->load_assined_timetables());
}

function load_courses_list()
{
	echo json_encode($this->timetable_model->load_courses_list());
}
}