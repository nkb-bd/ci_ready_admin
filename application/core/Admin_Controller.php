<?php 


// Super admin controller
class Admin_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // must be logged in
        if ( $this->user['is_admin']!=1)
        {       
            if (current_url() != base_url())
            {
                //store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }

            redirect('login');
        }

        
        // load the admin language file
        $this->lang->load('admin');
        $this->load->library('permission');
        $this->load->helper('button_helper');


        // prepare theme name
        $this->settings->theme = strtolower($this->config->item('admin_theme'));

        // set up global header data
        // $this->add_css_theme("{$this->settings->theme}.css, summernote-bs3.css")
        //     ->add_js_theme("summernote.min.js,selectize.min.js" )
           
         // 
         $this->add_css_theme(array(
                                    "style.css",
                                    "widget.css",
                                    ));

        $this->add_js_theme(array("my-js.js"));

        // declare admin template
        $this->template = "../../assets/themes/admin/template.php";

        // get permissions and show error if they don't have any permissions at all
        if (!$this->permissions = $this->permission->get_user_permissions($this->user['user_type']))
        {   

            $this->session->set_flashdata('error', 'You do not have any permissions');
            redirect('login');
        }

       

    }

}

