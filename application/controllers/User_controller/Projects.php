<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends Private_Controller {

   /**
     * @var string
     */
    private $_redirect_url;
    public $user_info;

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files

        // load the users model

        $this->load->model('seller/projects_model');
        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('seller/projects'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "id");
        define('DEFAULT_DIR', "asc");
        // if($this->user['user_type']!=2){
        //     redirect();
        // }

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }

        $u_id = $this->user['id'];
        $this->user_info = $this->projects_model->get_by_where('id',$u_id,'users');
        $this->user_info =  $this->user_info[0];
    }

    /**
     * Dashboard
     */
    function index()
    {
        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('title'))
        {
            $filters['title'] = $this->input->get('title', TRUE);
        }

    

        // build filter string
        $filter = "";
        foreach ($filters as $key => $value)
        {
            $filter .= "&{$key}={$value}";
        }

        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");

       
        $u_id = $this->user['id'];
        // get list
        $page_data = $this->projects_model->get_all('projects',$u_id,$limit, $offset, $filters, $sort, $dir);

  

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $page_data['total'],
            'per_page'   => $limit
        ));

        // setup page header data
        $this
            ->set_title("Project List");

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'users'      => $page_data['results'],
            'total'      => $page_data['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir,
            'user_info'   => $this->user_info,
             'project_count'   => $page_data['total'],
        );

        // load views
        $data['content'] = $this->load->view('seller/projects/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    /**
     * view  project
     */
    function view($project_id)
    {   

        // check if able to see project

        $project_detail = $this->projects_model->get_project_by_id($project_id,'projects');


        if($project_detail['posted_by'] != $this->user['id'] ){

            redirect('seller/projects');
        }   

      

        $this->set_title('Projects Detail ');
        $this->set_page_header('Detail');

        $all_projects = $this->common_model->get_by_where('posted_by',$this->user['id'],'projects');
        
        $project_count = 0;
        
        if ($all_projects) {
            
            $project_count = count($all_projects);
        }
        

        $data = $this->includes;


        
        // set content data
        $content_data = array(
            'page_data'   => $project_detail,
             'user_info'   => $this->user_info,
              'project_count'   => $project_count,
        );
       

        // echo "<pre>";

        // print_r($data['user_info']);
        // exit();

        // load views
        $data['content'] = $this->load->view('seller/projects/view', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

     /**
     * New Porject
     */
    function new()
    {
        $this->set_title('Create Project ');
        $this->set_page_header('Create Project');


        $fileData = $_FILES;
     
        $all_projects = $this->common_model->get_by_where('posted_by',$this->user['id'],'projects');
    
        $project_count = 0;
        
        if ($all_projects) {
            
            $project_count = count($all_projects);
        }
        
        $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[4]|max_length[200]|alpha_numeric_spaces');
        $this->form_validation->set_rules('duration', 'Duration', 'required|trim|max_length[100]|alpha_numeric_spaces');

        if ($this->form_validation->run() == TRUE)
        {   

            $upload = $this->_do_upload( $fileData['userfile'] ,'');

             

            if($upload['result']==1){
             
                
                $_POST['file_path']    = $upload['img_data']['path'];
                $_POST['file_name']    = $upload['img_data']['name'];
                $_POST['posted_by']    = $this->user['id'];
                
                $title                 =  $_POST['title'];
                $project_slug          = $this->_create_unique_slug($title ,'projects');
                $_POST['project_slug'] =  $project_slug;
                
                
                $postData              = $this->input->post();
                
                $category              = $this->input->post('category');
                $sub_category          = $this->input->post('sub_category');
                $title                 = $this->input->post('title');

                 $save = $this->projects_model->save_single($postData,'projects');


               
                if($save){

                     // $this->send_project_notification($title,$category,$sub_category);

                     $this->session->set_flashdata('message','Project Posted! Waiting for approval. ');

                     redirect('seller/projects');
                }else{

                     $this->session->set_flashdata('error','Error saving!');

                     redirect('seller/projects');
                }

            }

            $this->session->set_flashdata('message',$upload['error']);

            redirect('seller/projects/new');

            // $save = $this->projects_model->save_single('category',0, 0, '','id', 'asc');

           
        }

        $data = $this->includes;
        $all_category = $this->projects_model->get_by_where('deleted',0, 'category');
        $all_sub_category = $this->projects_model->get_by_where('deleted',0,'sub_category');

     
        
        // set content data
        $content_data = array(
            'all_category'   => $all_category,
            'all_sub_category'   => $all_sub_category,
            
            'cancel_url'        => $this->_redirect_url,
            'user_info'   => $this->user_info,

              'project_count'   => $project_count,
        );




        // load views
        $data['content'] = $this->load->view('seller/projects/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }




     /**
     * New Porject
     */
    function edit($project_id)
    {
        $this->set_title('Create Project ');
        $this->set_page_header('Create Project');

       
        
        $all_projects = $this->common_model->get_by_where('posted_by',$this->user['id'],'projects');
        
        $project_count = 0;
        
        if ($all_projects) {
            
            $project_count = count($all_projects);
        }

        $project_detail = $this->projects_model->get_project_by_id($project_id,'projects');

        
        

        if($project_detail['posted_by'] != $this->user['id'] ){

            redirect('seller/projects');
        }   
        if( empty($project_id) ){

            redirect('seller/projects');
        }   



        $fileData = $_FILES;
        $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[5]|max_length[100]');
     

        if ($this->form_validation->run() == TRUE)
        {       
                // check if new title for new slug
                 if($project_detail['title'] != $_POST['title'] ){

                    $title                 =  $_POST['title'];
                    $project_slug          = $this->_create_unique_slug($title ,'projects');
                    $_POST['project_slug'] =  $project_slug  ;
                } 

                if (!empty($fileData['userfile']['name'])) {


                    if(file_exists($project_detail['file_path'])){

                        unlink($project_detail['file_path']);

                    }

                    $upload = $this->_do_upload( $fileData['userfile'] ,'');

                    if($upload['result']==1){
                 
                        $_POST['file_path'] = $upload['img_data']['path'];
                        $_POST['file_name'] = $upload['img_data']['name'];
                    }else{

                        // duplicate error spliting by full stop.
                       $file_error = explode(".",$upload['error']);
                      
                        // file upload error
                        $this->session->set_flashdata('error',$file_error['0'].' Minimum image size 420 x 220 !');

                        redirect('seller/projects/edit/'.$project_id);
                    }
                }


                $_POST['posted_by'] = $this->user['id'];
                $postData = $this->input->post();



                $update = $this->projects_model->update_single($postData,'projects');
               

                if($update){

                     $this->session->set_flashdata('message','Project Updated!');
                     redirect('seller/projects/edit/'.$project_id);

                }else{

                     $this->session->set_flashdata('error','Error saving!');
                     redirect('seller/projects/edit/'.$project_id);
                    
                }

            

             $this->session->set_flashdata('message',$upload['error']);

            redirect('seller/projects');

            // $save = $this->projects_model->save_single('category',0, 0, '','id', 'asc');

           
        }

        $data = $this->includes;

        $all_category = $this->projects_model->get_by_where('deleted',0, 'category');
        $all_sub_category = $this->projects_model->get_by_where('deleted',0, 'sub_category');
        
        // set content data
        $content_data = array(
            'all_category'   => $all_category,
            'all_sub_category'   => $all_sub_category,
            'page_data'   => $project_detail,
            
            'cancel_url'        => $this->_redirect_url,
            'user_info'   => $this->user_info,
            'project_count'   => $project_count,
        );




        // load views
        $data['content'] = $this->load->view('seller/projects/edit', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }





    public function get_sub_category($category_id)
    {   

        if (empty($category_id)){

            redirect('','refresh');
        }


        $all_sub_category = $this->projects_model->get_by_where('parent_cat_id',$category_id, 'sub_category', '','id', 'asc');
        $html = '';

        if($all_sub_category){
            foreach ($all_sub_category as  $value) {

                            
                $html .= '<option value="'.$value['id'] .'"> '.$value['name'] .'</option>';
                
            }
        }else{

                $html = '<option value="-1">No Sub Category</option>';

            }

       echo json_encode($html);
       return;
    }

    // send new project notification to all user according to user preference
    public function send_project_notification($title,$category,$sub_category){


        echo $title;
        echo $category;
        echo $sub_category;

        if($sub_category > 0){

             $fields = array(
                "sub_cat_id" => $sub_category,
                 "cat_id" => $category
            );
        }else{

              $fields = array(
                    "cat_id" => $category
                );
        }

      

        $users = $this->projects_model->get_users_by_prefrence($fields);

         
        if($users){

            foreach ($users as $value) {
                // echo $value['email'];
                $this->_send_email($value['email'],$value,$title);
            }
        }

        return true;
       

    }

    // send email
    function _send_email($email,$data,$project_title){
        //Load email library
        $this->load->library('email');

        //SMTP & mail configuration
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => $this->config->item('email_smtp_host') ,
            'smtp_port' => $this->config->item('email_port') ,
            'smtp_user' =>  $this->config->item('email_user') ,
            'smtp_pass' =>  $this->config->item('email_pass'),
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent = '<h1>Hello , '.$data['first_name'].' '.$data['last_name'].'  </h1>';
        $htmlContent .= '<strong>New Porject Posted </strong>';
        $htmlContent .= '<h4> Name : '.ucfirst($project_title).'</h4>';
        $htmlContent .= '<h4> category : '.$data['category_name'].'</h4>';
        $htmlContent .= '<p><a href="'.base_url().'"> Go to Site </a> </p>';

        $this->email->to($email);
        $this->email->from('nakib.un@gmail.com',$this->settings->site_name);
        $this->email->subject('New Project notification');
        $this->email->message($htmlContent);

        //Send email

        try{

            $this->email->send();
            return true;
        }
        catch(Exception $e){
                return false;
        }
    }


   /////////////////
   // /file upload //
   /////////////////
   private function _do_upload($file_data,$data)
    {       


    
            $curr_month = date('M_Y');
             if (!is_dir('uploads/project_files/'.$curr_month)) {
                 mkdir('./uploads/project_files/' . $curr_month, 0777, TRUE);
             }
        
            $file_name = null;
            $this->load->library('upload');
            $upload['max_height']    = 8000;
            $upload['upload_path']   = dirname($_SERVER["SCRIPT_FILENAME"]) .'/uploads/project_files/'.$curr_month;
            $upload['allowed_types'] = "gif|jpg|png|jpeg|";
            $upload['overwrite']     = true;
            $upload['max_size']      = "50000KB";
            $upload['max_width']     = 8000;
            $upload['min_width']     = 410;
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
            
                $img_data['path'] ='uploads/project_files/'.$curr_month.'/'.$file_name;
                $img_data['name'] =$file_name;
                

                
                $data = array('result' => 1,'img_data'=>$img_data );

            }else{


                $data = array('result' => 0,'error'=>$this->upload->display_errors() );
                
               
                // exit();
            }

            return  $data;
    }

       // create slug
    public function _create_unique_slug($string, $table)
    {
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params['project_slug'] = $slug;
        if ($this->input->post('id')) {
            $params['id !='] = $this->input->post('id');
        }
        
        while ($this->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params ['project_slug'] = $slug;
            }
        return $slug;
    }


}