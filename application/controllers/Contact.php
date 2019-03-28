<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Public_Controller {

    /**
     * Constructor
     */
    // this->dynamic_page_menu
    // for dynamiclly created page menu f
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
        $this->load->model('contact_model');



    }

    function index()
    {
            redirect('/');  
    }

    function send(){
          // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[64]');
        $this->form_validation->set_rules('email', "Email", 'required|trim|valid_email|max_length[256]');
        $this->form_validation->set_rules('message', "Message'", 'required|trim|min_length[10]');

        if ($this->form_validation->run() == TRUE)
        {
            // attempt to save and send the message
            $post_data = $this->security->xss_clean($this->input->post());
            //     echo "  <pre>";
            // print_r(    $post_data);
            // exit;
            $saved_and_sent = $this->contact_model->save_and_send_message($post_data, $this->settings);

            if ($saved_and_sent)
            {
                // redirect to home page

                $message=array("result"=>"1","msg"=>"contact msg send_success");
               
               
            }
            else
            {
             
               $message=array("result"=>"0","msg"=>"contact msg failed");
            }
        }else
        {
            $message=array("result"=>"0","msg"=> validation_errors());
           
        }

         echo json_encode($message);
         exit;
    }
    

}
