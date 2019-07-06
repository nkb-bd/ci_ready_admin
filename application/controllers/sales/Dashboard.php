<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Private_Controller {


   
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files

        $this->load->model('common_model');
         $this->load->model('users_model');

        $this->load->model('buyer/projects_model');

    
        if (  $this->user['user_type']!=3) {
          redirect();
        }
    }


    /**
     * buyer Dashboard
     */
    function index()
    { 
        $this->set_title('Admin ');
        $this->set_page_header('Dashboard');

        $data = $this->includes;
        
        $approved = 1;
        // set content data
        $content_data = array(
            'total_page'   => 0,
            'all_projects' => $this->get_user_project($approved,10)
        );

        
    
        // load views
        $data['content'] = $this->load->view('buyer/dashboard', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    /**
     * set prefrence ajax and view
     */
    function set_preference()
    {      

        if (   !empty($_POST) ) {


            $data['u_id']       = $this->user['id'];
            $data['cat_id']     = $_POST['cat_id'];
            $data['sub_cat_id'] = $_POST['sub_cat_id'];
            $data['created']    = now();

            

            $prefrence_list = $this->common_model->get_user_preference(  $data['u_id']);

            $total =  count($prefrence_list);
          

            if ($total>=5) {

                $return_data['msg'] = "Maximum 5 can be selected!";
                $return_data['type'] = "info";
                
                echo json_encode($return_data);

                return;
            }

            $duplicate_pref = $this->common_model->check_user_preference($data['u_id'] ,$data['u_id'],$data['cat_id'],$data['sub_cat_id'] );

            if($duplicate_pref){

                $return_data['msg'] = "Already exists";
                $return_data['type'] = "info";
                
                echo json_encode($return_data);

                return;
            }

            $save           = $this->common_model->save_single($data,'category_prefrence');

            $html = '<li class="list-group-item row">
                      <div class="col-md-6">Category</div>
                      <div class="col-md-6">Sub Category</div>
                  </li>';
            foreach ($prefrence_list as $value) {
               $html .= ' <li class="list-group-item row">
                      <div class="col-md-6">'.$value['cat_name'].'</div>
                      <div class="col-md-6">'.$value['sub_category']. '<a href="'.base_url().'buyer/dashboard/'.$value['id'].'" class="btn btn-sm pull-right">Delete</a></div>
                  </li>';
            }

            if ($save) {

                $data['msg']  = "Saved";
                $data['type'] = "success";
                $data['html'] = $html;
                
                echo json_encode($data);
                return;

            }

        }

        $this->set_title('Buyer ');
        $this->set_page_header('My Preference');

        $data = $this->includes;
        
        $all_category           = $this->common_model->get_all('category',0, 0, '','id', 'asc');
        $all_sub_category       = $this->common_model->get_all('sub_category',0, 0, '','id', 'asc');
        
        // set content data
        $content_data = array(
            'all_category'       => $all_category['results'],
            'all_sub_category'   => $all_sub_category['results'],
        );


    
        // load views
        $data['content'] = $this->load->view('buyer/projects/preference', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    public function get_preference(){



            $prefrence_list = $this->common_model->get_user_preference( $this->user['id']);

            $html = '<li class="list-group-item row">
                      <div class="col-md-6"><strong>Category</strong></div>
                      <div class="col-md-6"><strong>Sub Category</strong></div>
                  </li>';

            foreach ($prefrence_list as $value) {
               $html .= ' <li class="list-group-item row">
                      <div  class=""> <strong> Category </strong>: '.$value['cat_name'].'</div>
                      <div class="">  <strong>Sub Category  </strong>: '.$value['sub_category'].'<a href="'.base_url().'buyer/dashboard/delete_preference/'.$value['id'].'" class="btn pull-right btn-danger btn-sm">  <i class="fa fa-trash"></i> </a></div>
                  </li>';
            }

            if ($prefrence_list) {

              
                $data['html'] = $html;
                
                echo json_encode($data);
                return;

            }
    }


    public function delete_preference($prefrence_id){



            $prefrence_data = $this->common_model->get_by_id( $prefrence_id,'category_prefrence');

            // check if its the same user

            if($prefrence_data['u_id']!=$this->user['id']){

                redirect('buyer/dashboard/set_preference');
            }

            $delete = $this->common_model->del_single('category_prefrence',$prefrence_id);

            if ($delete) {

                
                $this->session->set_flashdata('message', 'Deleted !');    
                redirect('buyer/dashboard/set_preference');

            }
    }

    
    public function get_user_project($approved,$limit=0){



           // return $final_list;

           $prefrence_list = $this->common_model->get_user_preference( $this->user['id']);

           $page_data = $this->projects_model->get_all_buyer_projects('projects',$prefrence_list, 10, 0, '', 'id', "desc");

           return $page_data['results'];
            

    }



    public function profile()
    {   
        $u_id = $this->user['id'];
        $user_info = $this->common_model->get_by_where('id',$u_id,'users');

        $user = $user_info[0];
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]|max_length[30]|callback__check_username[' . $user['username'] . ']');
        $this->form_validation->set_rules('first_name', 'First name', 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('last_name', 'Last name', 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('email', lang('users input email'), 'required|trim|max_length[128]|valid_email|callback__check_email[' . $user['email'] . ']');
        // $this->form_validation->set_rules('language', lang('users input language'), 'required|trim');
        if (isset($_POST['password'])) {
           $this->form_validation->set_rules('password', 'Password', 'min_length[5]|matches[password_repeat]');
           $this->form_validation->set_rules('password_repeat', 'Password confirm', 'matches[password]');
       
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
            $data['lang']       = $this->input->post('lang');



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
        $data['content'] = $this->load->view('buyer/profile', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }


    public function test(){
          

          $userName = "01711429264";
          $passWord = "294a6eb963";
           
          $this->load->library("nusoap_library");
           // require_once(APPPATH.'libraries/nusoap/nusoap'.EXT); //includes nuso
          $soapClient =  new nusoap_client("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl", 'wsdl');
           
           
          //OneToOne
           
          $paramArray = array(
              'userName'=>$userName,
              'userPassword'=>$passWord, 
              'mobileNumber'=> "01715928113", 
              'smsText'=>"Single SMS Send from CodeIgniter Test", 
              'type'=>"TEXT",
          );
          echo "before calling method";
          $value = $soapClient->call("OneToOne", $paramArray);            
          echo 'output is '; print_r($value);
           
           
          // One to Many 
           
          // $paramArray = array(
          //     'userName'=>$userName,
          //     'userPassword'=>$passWord, 
          //     'messageText'=>"Bulk SMS Send from CodeIgniter Test", 
          //     'numberList'=> "01811444729,01833168163",               
          //     'smsType'=>"TEXT",
          //     'maskName'=> "DemoMask", 
          //     'campaignName'=>'',
          // );

          // echo "before calling method";
          // $value = $soapClient->call("OneToMany", $paramArray);           
          // echo 'output is '; print_r($value);
    }


    public function txtlocal(){
      // Authorisation details.
      $username = "gmsdev2@gmswebdesign.co.uk";
      $hash = "3005b41b7012f893adb572a10c4f9a3733adcc29666c7de7c515eeedc275cc11";

      // Config variables. Consult http://api.txtlocal.com/docs for more info.
      $test = "0";

      // Data for text message. This is the text message data.
      $sender = "API Test"; // This is who the message appears to be from.
      $numbers = "44777000000"; // A single number or a comma-seperated list of numbers
      $message = "This is a test message from the PHP API script.";
      // 612 chars or less
      // A single number or a comma-seperated list of numbers
      $message = urlencode($message);
      $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
      $ch = curl_init('http://api.txtlocal.com/send/?');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      echo $result = curl_exec($ch); // This is the result from the API
      curl_close($ch);
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


}