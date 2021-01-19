<?php
    class Util extends CI_Controller{
        
        function util() {
            parent::__construct();
            $this->load->model('Year_model');
            $this->load->model('Util_model');
            $this->load->model('Staff_model');
            $this->load->helper('url');
            $this->load->helper('file');
            $this->load->helper('download');
            $this->load->library('zip');
        }
        
        
//        function dbbackup(){
//            $this->load->dbutil();
//            $db_format=array(
//                'format'=>'zip',
//                'filename'=>'SLIATE_Backup_'.date('Y-m-d-H-i-s').'.sql'
//                );
//
//            $backup=& $this->dbutil->backup($db_format);
//
//            $dbname='SLIATE_Backup_on_'.date('Y-m-d-H-i-s').'.zip';
//            $save='/uploads/db_backup/'.$dbname;
//
//            //$this->load->helper('download');
//            $this->load->helper('file');
//            write_file($save,$backup);
//
//            $this->load->helper('download');
//            force_download($dbname,$backup);
//        }
        
        function dbbackup(){
            ini_set('memory_limit', '1024M');
            $this->load->dbutil();
            $db_format=array(
                'format'=>'zip',
                'filename'=>'SLIATE_SMS_Backup_'.date('Y-m-d-H-i-s').'.sql'
                );

            $backup= $this->dbutil->backup($db_format);

            $dbname='SLIATE_SMS_Backup_on_'.date('Y-m-d-H-i-s').'.zip';
            $save='/uploads/db_backup/'.$dbname;

            //$this->load->helper('download');
            $this->load->helper('file');
            write_file($save,$backup);

            $this->load->helper('download');
            force_download($dbname,$backup);
            $this->logger->systemlog('DB Backup', 'Success', 'DB backup Downloaded.', date("Y-m-d H:i:s", now()), array('db_name'=>$dbname, 'path'=>$save));
        }
        
 }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

