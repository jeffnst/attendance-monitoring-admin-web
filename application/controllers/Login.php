<?php

defined('BASEPATH') or exit('no direct script allowed');

class Login extends CI_Controller
{

        function __construct()
        {
                parent::__construct();
                if ($this->session->userdata('validated'))
                {
                        redirect('Dashboard');
                }
        }

        public function index($msg = NULL)
        {
                $this->load->helper('form');
                $this->load->view('login', array(
                    'msg' => $msg,
                ));
        }

        public function validate()
        {
                // Load the model
                $this->load->model('Admin_Model');
                // Validate the user can login
                $result = $this->Admin_Model->validate();
                // Now we verify the result
                //i use this because === means if same datatype else string error meesage if failed.
                if ($result === TRUE)
                {
                        redirect('', 'refresh');
                }
                else
                {
                        // If user did not validate, then show them login page again
                        $msg = '<span style="color:red">' . $result . '</span>';
                        $this->index($msg);
                }
        }

}
