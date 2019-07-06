<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Private_Controller {


  
    public $user_info;
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();


        // load the language files
         $this->load->model('users_model');
        $this->load->model('common_model');
         $this->lang->load('users');
        if (  $this->user['user_type']!=2) {
          redirect();
        }

        $u_id = $this->user['id'];
        $this->user_info = $this->common_model->get_by_where('id',$u_id,'users');
        $this->user_info =  $this->user_info[0];
    }


    /**
     * Dashboard
     */
    function index()
    {
        $this->set_title('Admin ');
        $this->set_page_header('Dashboard');

        


        $data = $this->includes;
         // echo '<pre>'; print_r($data);
         // exit;

        $u_id = $this->user['id'];
        $limit = 10;
        $all_projects = $this->common_model->get_by_where('posted_by',$u_id,'projects','id','desc',$limit);

        $project_count = 0;
        
        if ($all_projects) {
            
            $project_count = count($all_projects);
        }
        

        // set content data
        $content_data = array(
            'all_projects'   => $all_projects,
            'project_count'   => $project_count,
            'total_page'   => 0,
            'total_user'   => '',
            'total_gallery'   => 0,
            'total_slider'   =>0,
            'main_menu'   => '',
            'login_logs'  => '',
            'login_attempts'  => '',
             'user_info'   => $this->user_info,
          
        );
        

        // print_r($content_data);
        // exit();

        // load views
        $data['content'] = $this->load->view('seller/dashboard', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }





    public function profile()
    {   
        $u_id = $this->user['id'];
        $user_info = $this->common_model->get_by_where('id',$u_id,'users');

        $user = $user_info[0];
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', lang('users input username'), 'required|trim|min_length[5]|max_length[30]|callback__check_username[' . $user['username'] . ']');
        $this->form_validation->set_rules('first_name', lang('users input first_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', lang('users input last_name'), 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email[' . $user['email'] . ']');
        // $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        if (isset($_POST['password'])) {
           $this->form_validation->set_rules('password', lang('users input password'), 'min_length[5]|matches[password_repeat]');
           $this->form_validation->set_rules('password_repeat', lang('users input password_repeat'), 'matches[password]');
       
        }
         $this->form_validation->set_rules('profile_img', lang('users input '), '');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim|max_length[13]|min_length[11]');

        if ($this->form_validation->run() == TRUE)
        {


            $fileData = $_FILES;


           
            if($fileData){

              if(($fileData['profile_img']['name']!='')){


                // del previos file
                $prev_file = base_url().'uploads/profile/'.$user_info[0]['profile_img'];
                if (file_exists( 'uploads/profile/'.$user_info[0]['profile_img'])) {

                   unlink('uploads/profile/'.$user_info[0]['profile_img']);
                }

                 $upload = $this->_do_upload( $fileData['profile_img'] ,'');

                 if($upload['result']==1){

                    $data['profile_img']         = $upload['img_data']['name'];
                 }else{


                     $this->session->set_flashdata('error', $data['error']   );

                     redirect($_SERVER['HTTP_REFERER']);
                 }

              }else{
                
              }
            }
            
            $data['id']         = $u_id;
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name']  = $this->input->post('last_name');
            $data['username']   = $this->input->post('username');
            $data['email']      = $this->input->post('email');
            $data['country']    = $this->input->post('country');
            $data['address']    = $this->input->post('address');
            $data['mobile']     = $this->input->post('mobile');
            $data['gender']     = $this->input->post('gender');
            $data['lat']        = $this->input->post('lat');
            $data['lang']        = $this->input->post('lang');


            $update = $this->common_model->update_single($data,'users');
            
            if($update){

                     $this->session->set_flashdata('message','Updated !'   );

                     redirect($_SERVER['HTTP_REFERER']);

            }else{
                    $this->session->set_flashdata('error', 'Error'   );

                    redirect($_SERVER['HTTP_REFERER']);
            }

        }

      
        
        $all_projects = $this->common_model->get_by_where('posted_by',$u_id,'projects');
       
        
        
        $project_count = 0;
        
        if ($all_projects) {
            
            $project_count = count($all_projects);
        }

              // set content data
        $content_data = array(
            'all_projects'   => $all_projects,
            'project_count'   => $project_count,
            'user_info'   => $user_info[0],
          
        );



        $data = $this->includes;
        $data['content'] = $this->load->view('seller/profile', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }


    /////////////////
   // /file upload //
   /////////////////
   private function _do_upload($file_data,$data)
    {
       
    
            $curr_month = date('M_Y');
             if (!is_dir('uploads/profile/')) {
                 mkdir('./uploads/profile/', 0777, TRUE);
             }
        
            $file_name = null;
            $this->load->library('upload');
            $upload['max_height']    = 8000;
            $upload['upload_path']   = dirname($_SERVER["SCRIPT_FILENAME"]) .'/uploads/profile/';
            $upload['allowed_types'] = "gif|jpg|png|jpeg|";
            $upload['overwrite']     = true;
            $upload['max_size']      = "50000KB";
            $upload['max_width']     = 8000;
            $upload['quality']       = "100%";
            $files = $_FILES;

           $_FILES['test'] = array();
           $name =$_FILES['test']['name']= $file_data['name'];
           
           $_FILES['test']['type']= $file_data['type'];
           $_FILES['test']['tmp_name']= $file_data['tmp_name'];
           $_FILES['test']['error']= $file_data['error'];
           $_FILES['test']['size']= $file_data['size'];    
           $file_ext = pathinfo($name,PATHINFO_EXTENSION);
           

           $file_name = $upload['file_name'] = time() .'_' .date('d').'.'.$file_ext ;
           $this->upload->initialize($upload);
           $upload_success =$this->upload->do_upload('test');
            if (! $upload_success=$this->upload->do_upload('test')) {
                    
                $errors = $this->upload->display_errors();
                $data = array('result' => 0,'error'=>$this->upload->display_errors() );
                    return  $data ;
                }
        
                    
           if($upload_success){
            
                $img_data['path'] ='uploads/profile/'.$file_name;
                $img_data['name'] =$file_name;
                

                
                $data = array('result' => 1,'img_data'=>$img_data );

            }else{


                $data = array('result' => 0,'error'=>$this->upload->display_errors() );
                
               
                // exit();
            }

            return  $data;
    }

        /**
     * Make sure username is available
     *
     * @param  string $username
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_username($username, $current)
    {
        if (trim($username) != trim($current) && $this->users_model->username_exists($username))
        {
            $this->form_validation->set_message('_check_username', sprintf(lang('users error username_exists'), $username));
            return FALSE;
        }
        else
        {
            return $username;
        }
    }

        /**
     * Make sure email is available
     *
     * @param  string $email
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_email($email, $current)
    {
        if (trim($email) != trim($current) && $this->users_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('users error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }
}