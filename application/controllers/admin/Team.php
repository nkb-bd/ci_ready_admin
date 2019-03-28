<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends Admin_Controller {

    /**
     * @var string
     */
    private $_redirect_url;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // load the language files
         $this->lang->load('users');

        // load the team model
        $this->load->model('team_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/team'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "id");
        define('DEFAULT_DIR', "asc");

        // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * User list page
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

        if ($this->input->get('name'))
        {
            $filters['name'] = $this->input->get('name', TRUE);
        }

        if ($this->input->get('url'))
        {
            $filters['url'] = $this->input->get('url', TRUE);
        }

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

        // are filters being submitted?
        if ($this->input->post())
        {
            if ($this->input->post('clear'))
            {
                // reset button clicked
                redirect(THIS_URL);
            }
            else
            {
                // apply the filter(s)
                $filter = "";

                if ($this->input->post('name'))
                {
                    $filter .= "&name=" . $this->input->post('name', TRUE);
                }

                if ($this->input->post('url'))
                {
                    $filter .= "&url=" . $this->input->post('url', TRUE);
                }

                if ($this->input->post('title'))
                {
                    $filter .= "&title=" . $this->input->post('title', TRUE);
                }

                // redirect using new filter(s)
                redirect(THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}{$filter}");
            }
        }

        // get list
        $team = $this->team_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $team['total'],
            'per_page'   => $limit
        ));

        // setup page header data
        $this->set_title('team');
        $this->set_page_header('Page List');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'page_data'      => $team['results'],
            'total'      => $team['total'],
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );

        // echo "<pre>";

        // print_r($data);
        // exit();

        // load views
        $data['content'] = $this->load->view('admin/team/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }



     
        
    function add()
    {   
        

        $this->set_title('Add team');

        $postData =$this->input->post(NULL, true);
        
        $files =$_FILES;

        if (!empty($files))
        {   

            $files = $files['images'];
            
         
       
                    $img_data = array();

                    $img_data['name']= $files['name'];
                    $img_data['type']= $files['type'];
                    $img_data['tmp_name']= $files['tmp_name'];
                    $img_data['error']= $files['error'];
                    $img_data['size']= $files['size'];
                    $img_data['file_ext'] = pathinfo($files['name'],PATHINFO_EXTENSION);
                  
                    $update = 0;
                    $upload_image=$this->_do_upload($img_data,$postData,$update,''); 

                    
                  
                if ($upload_image['result']==1)
                {   

                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 1,'message' =>'New team  Added','img'=>$upload_image['name'])));


                }
                else
                {
                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>$upload_image['error'])));
                }

                return;

             
         
        }

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => NULL,
            'password_required' => TRUE
        );
      
        // load views
        $data['content'] = $this->load->view('admin/team/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    

    }


    /**
     * Edit 
     *
     * @param  int $id
     */
    function edit($id=NULL)
    {
        // make sure we have a numeric id
        if (is_null($id) OR ! is_numeric($id))
        {
            redirect($this->_redirect_url);
        }

        // get the data
        $user = $this->team_model->get_id($id);

        // if empty results, return to list
        if ( ! $user)
        {
            redirect($this->_redirect_url);
        }

        $original_name =  $user['img'];
   
        $postData =$this->input->post(NULL, true);
        
        $files =$_FILES;

        if (!empty($postData))
        {
         
       

            $files = $_FILES;
            $postData= $this->input->post();


             $files = $files['images'];
     
            /*----------  img upload  ----------*/

            if(!empty($files['name'])){
                   // del prev file
                    if(($user['path'])){

                        if(file_exists($user['path'])){
                            
                            unlink($user['path']);
                        }

                    }

            
         
       
                    $img_data = array();

                    $img_data['name']= $files['name'];
                    $img_data['type']= $files['type'];
                    $img_data['tmp_name']= $files['tmp_name'];
                    $img_data['error']= $files['error'];
                    $img_data['size']= $files['size'];
                    $img_data['file_ext'] = pathinfo($files['name'],PATHINFO_EXTENSION);

                $update = 1;
                $upload_image=$this->_do_upload($img_data,$postData,$update,$original_name ); 

              

                if ($upload_image)
                {   

                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 1,'message' =>'team  Updated')));


                }
                else
                {
                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>'Image Could Not Updated')));
                }

                return;
                exit;
                
            }


            
            $saved = $this->team_model->edit($postData,'id');
            if ($saved)
                {   

                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 1,'message' =>' team  Updated')));


                }
                else
                {
                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>$this->upload->display_errors())));
                }

                return;



      

            // return to list and display message
            redirect('admin/team/edit/'.$id);
        }

     

        // setup page header data
        $this->set_title('Edit team ');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'page_data'              => $user,
            'user_id'           => $id,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('admin/team/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Delete 
     *
     * @param  int $id
     */
    function delete($id=NULL)
    {
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get user details
            $user = $this->team_model->get_id($id);

            if ($user)
            {
                // soft-delete the user
                $delete = $this->team_model->delete_page($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', ' team '  .$user['title'] . ' Deleted');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Can not delete team '  .$user['title'] . ' ');

                }
            }
            else
            {
                $this->session->set_flashdata('error', 'team error not_exist');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'team error id_required');
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }


    /**
     * Export list to CSV
     */
    function export()
    {
        // get parameters
        $sort = $this->input->get('sort') ? $this->input->get('sort', TRUE) : DEFAULT_SORT;
        $dir  = $this->input->get('dir')  ? $this->input->get('dir', TRUE)  : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('name'))
        {
            $filters['name'] = $this->input->get('name', TRUE);
        }

        if ($this->input->get('url'))
        {
            $filters['url'] = $this->input->get('url', TRUE);
        }

        if ($this->input->get('title'))
        {
            $filters['title'] = $this->input->get('title', TRUE);
        }

        // get all team
        $team = $this->team_model->get_all(0, 0, $filters, $sort, $dir);

        if ($team['total'] > 0)
        {
            // manipulate the output array
            foreach ($team['results'] as $key=>$user)
            {
                unset($team['results'][$key]['password']);
                unset($team['results'][$key]['deleted']);

                if ($user['status'] == 0)
                {
                    $team['results'][$key]['status'] = lang('admin input inactive');
                }
                else
                {
                    $team['results'][$key]['status'] = lang('admin input active');
                }
            }

            // export the file
            array_to_csv($team['results'], "team");
        }
        else
        {
            // nothing to export
            $this->session->set_flashdata('error', lang('core error no_results'));
            redirect($this->_redirect_url);
        }

        exit;
    }


    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


    /**
     * Make sure name is available
     *
     * @param  string $name
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_space($name, $current)
    {
        if (trim($name) != trim($current) && $this->team_model->name_exists($name))
        {
            $this->form_validation->set_message('_check_duplicate', '<strong>***'. $name . '***</strong> already exist');
            return FALSE;
        }
        else
        {
            return $name;
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
        if (trim($email) != trim($current) && $this->team_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('team error email_exists'), $email));
            return FALSE;
        }
        else
        {
            return $email;
        }
    }

    

   /////////////////
   // /img upload //
   /////////////////

   private function _do_upload($post_image,$data,$update,$original_name='')
    {
       
    
            $curr_month = date('M_Y');

             if (!is_dir('uploads/team/'.$curr_month)) {
                 mkdir('./uploads/team/' . $curr_month, 0777, TRUE);
             }

        
            $file_name = null;

            $this->load->library('upload');


            $upload['max_height'] = 8000;
            $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) .'/uploads/team/'.$curr_month;
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


          $file_name = $upload['file_name'] = time() .'_' .date('d').'.'.$file_ext ;

           

           $this->upload->initialize($upload);
           $upload_success =$this->upload->do_upload('test');

            if (! $upload_success=$this->upload->do_upload('test')) {
                    
                $errors = $this->upload->display_errors();
                $data = array('result' => 0,'error'=>$errors );
                    return  $data ;
                    exit();
                    // flashMsg($errors);
                }

        
                    
           if($upload_success){
            
                $img_data['name']=$data['name'];
                $img_data['twitter_link']=$data['twitter_link'];
                $img_data['fb_link']=$data['fb_link'];
                $img_data['designation']=$data['designation'];
                $img_data['path'] ='uploads/team/'.$curr_month.'/'.$file_name;

                $img_data['img'] =$file_name;
                $img_data['status']=1;

                if($update == 1){

                    $img_data['id']=$data['id'];

                    $save = $this->team_model->edit($img_data,'team');


                }else{

                    $save = $this->team_model->add($img_data,'team');

                }

                if(!$save){
                
                    $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0,'message' =>'DATABASE ERROR !#img607i')));

                     return false;
                }
                
              $data = array('result' => 1,'name'=>$img_data['path'] );
              return  $data;

            }else{
                $this->output
                        ->set_content_type('application/json')
                        ->set_output(json_encode(array('result' => 0,'message' => $this->upload->display_errors())));

                      

                          return false;
               
                // exit();
            }

    }
}