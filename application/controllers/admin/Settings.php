<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
        $this->lang->load('settings');
    }


    /**
     * Settings Editor
     */
    function index()
    {
        // get settings
        $settings = $this->settings_model->get_settings();


        $result = array();
        foreach ($settings as $element) {
            $result[$element['type']][] = $element;
        }


        // form validations
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        foreach ($settings as $setting)
        {
            if ($setting['validation'])
            {
                if ($setting['translate'])
                {
                }
                else
                {
                    // single validation
                    $this->form_validation->set_rules($setting['name'], $setting['label'], $setting['validation']);
                }
            }
        }

        if ($this->form_validation->run() == TRUE)
        {
            $user = $this->session->userdata('logged_in');


            $files = $_FILES ;
            if(!empty($files['logo1'])){

                  $files = $files['logo1'];

       
                    $img_data = array();

                    $img_data['name']= $files['name'];
                    $img_data['type']= $files['type'];
                    $img_data['tmp_name']= $files['tmp_name'];
                    $img_data['error']= $files['error'];
                    $img_data['size']= $files['size'];
                    $img_data['file_ext'] = pathinfo($files['name'],PATHINFO_EXTENSION);
                    $name = 'logo1.'.$img_data['file_ext'];

                $update = 1;
                $upload_image=$this->_do_upload($img_data,$update, $name ); 

              

                if ($upload_image['result']==1)
                {   
                    
                     $_POST['logo1'] = $upload_image['name'];


                }else{
                     $this->session->set_flashdata('error', 'Settings error img  upload failed '.$upload_image['error']);


                }


                
            }
            // save the settings
            $saved = $this->settings_model->save_settings($this->input->post(), $user['id']);

            if ($saved)
            {
                $this->session->set_flashdata('message', lang('admin settings msg save_success'));

                // reload the new settings
                $settings = $this->settings_model->get_settings();
                foreach ($settings as $setting)
                {
                    $this->settings->{$setting['name']} = @unserialize($setting['value']);
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Settings error save failed');
            }

            // reload the page
            redirect('admin/settings');
        }

        // setup page header data
        $this
            ->add_css_theme("summernote.css,summernote-bs2.css,summernote-bs3.css")
            ->add_js_theme("summernote.min.js,selectize.min.js" )
            ->add_js_theme("{$this->settings->theme}_i18n.js", TRUE)
            ->add_js_theme("my_admin.js");

        $this ->add_external_css(
                array(
                    "",
                    "http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css",

                ));
        $data = $this->includes;

        // set content data
        $content_data = array(
            'result'   => $result,
            'cancel_url' => "/admin",
        );

        // load views
        $data['content'] = $this->load->view('admin/settings/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }



   /////////////////
   // /img upload //
   /////////////////

   private function _do_upload($post_image,$update,$original_name='')
    {
            
            $user = $this->session->userdata('logged_in');
    
            $curr_month = date('M_Y');

             if (!is_dir('uploads/logo/'.$curr_month)) {
                 mkdir('./uploads/logo/' . $curr_month, 0777, TRUE);
             }

        
            $file_name = null;

            $this->load->library('upload');


            $upload['max_height'] = 8000;
            $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) .'/uploads/logo/'.$curr_month;
            $upload['allowed_types'] = "gif|jpg|png|jpeg";
            $upload['overwrite'] = true;
            $upload['max_size'] = "30000KB";
            $upload['max_width'] = 8000;
            $upload['quality'] = "100%";

            $files = $_FILES;


           $_FILES['test'] = array();

           $name =$_FILES['test']['name']= $post_image['name'];
           
           $_FILES['test']['type']= $post_image['type'];
           $_FILES['test']['tmp_name']= $post_image['tmp_name'];
           $_FILES['test']['error']= $post_image['error'];
           $_FILES['test']['size']= $post_image['size'];    
           $file_ext = pathinfo($name,PATHINFO_EXTENSION);

           if($original_name!=''){

               $file_name = $upload['file_name'] = $original_name ;

             
           }else{

               $file_name = $upload['file_name'] = time() .'_' .date('d').'.'.$file_ext ;

           }

           $this->upload->initialize($upload);

           $upload_success =$this->upload->do_upload('test');

            if (! $upload_success=$this->upload->do_upload('test')) {
                    
                $errors = $this->upload->display_errors();
                $data = array('result' => 0,'error'=>$errors );
                    return  $data ;
                    exit();
                }

        
                    
           if($upload_success){
            
              
                $img_data['logo1'] ='uploads/logo/'.$curr_month.'/'.$file_name;

           
                $saved = $this->settings_model->save_settings($img_data, $user['id']);
                if(!$saved){
                    
                        $data = array('result' => 0,'error'=>'Database Error!1' );
                        return  $data ;

                    }
                $data = array('result' => 1,'name'=>$img_data['logo1'] );
                return  $data;

            }else{
           
                    return false;

            }

    }

}
