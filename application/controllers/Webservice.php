<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webservice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> helper('url');
        $this -> load -> database();
        $this -> load -> library('form_validation');
        $this -> load -> model('Login_model');
        $this -> load -> model('Url_model');
    }

    public function Get_all_business()
        {
            $all_business = $this->Url_model->get_all_business_model();
//            print_r($all_business);
            if($all_business)
            {
                $raw_data=array('status'=>'true',
                                 "message"=>"data send",
                                "data"=>$all_business
                                );
            }
            else
            {
                $raw_data=array('status'=>'false',
                    "message"=>"data not send",
                    "data"=>""
                );

            }
            echo json_encode($raw_data);
        }

     public function  get_all_url_by_business_api()
     {
         $id=$this->input->post('id');
         $all_urls=$this->Url_model->get_all_url_by_business_model($id);
         //echo  json_encode($all_urls[0]);
         $data=array();
         if($all_urls) {
             $data['id'] = $all_urls[0]->id;
             $data['businesstype'] = $all_urls[0]->businesstype;
             $data['urls'] = array();
             $url_array = explode(',', $all_urls[0]->url);
             foreach ($url_array as $value) {
                 array_push($data['urls'], $value);
             }
         }
             if ($data) {
                 $raw_data = array('status' => 'true',
                     "message" => "data send",
                     "data" => $data
                 );
             } else {
                 $raw_data = array('status' => 'false',
                     "message" => "data not send",
                     "data" => ""
                 );

             }
             echo json_encode($raw_data);
             // echo json_encode($data);

     }
}