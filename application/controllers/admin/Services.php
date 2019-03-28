<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends Admin_Controller {

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

        // load the services model
        $this->load->model('service_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/services'));
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

        if ($this->input->get('heading'))
        {
            $filters['heading'] = $this->input->get('heading', TRUE);
        }

        if ($this->input->get('sub_heading'))
        {
            $filters['sub_heading'] = $this->input->get('sub_heading', TRUE);
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

                if ($this->input->post('heading'))
                {
                    $filter .= "&heading=" . $this->input->post('heading', TRUE);
                }

                if ($this->input->post('sub_heading'))
                {
                    $filter .= "&sub_heading=" . $this->input->post('sub_heading', TRUE);
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
        $services = $this->service_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $services['total'],
            'per_page'   => $limit
        ));

        // setup page header data
        $this->set_title('Services');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'page_data'      => $services['results'],
            'total'      => $services['total'],
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
        $data['content'] = $this->load->view('admin/services/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }



     
        
    function add()
    {   
        

        $this->set_title('Add Service');

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

              

                if ($upload_image)
                {   

                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 1,'message' =>'New Service  Added')));


                }
                else
                {
                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>'Service Could Not be added!')));
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
        $data['content'] = $this->load->view('admin/services/form', $content_data, TRUE);
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
        $user = $this->service_model->get_id($id);

        // if empty results, return to list
        if ( ! $user)
        {
            redirect($this->_redirect_url);
        }

		$original_name =  $user['background_img'];
   
        $postData =$this->input->post(NULL, true);
        
        $files =$_FILES;

        if (!empty($postData))
        {
        
       

            $files = $_FILES;
            $postData= $this->input->post();


             $files = $files['images'];
     
            /*----------  img upload  ----------*/

            if(!empty($files['name'])){

            
         
       
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
                    ->set_output(json_encode(array('result' => 1,'message' =>'Service  Updated')));


                }
                else
                {
                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>'Service Could Not Updated')));
                }

                return;
                exit;
                
            }


            
            $saved = $this->service_model->edit($postData,'id');
            if ($saved)
                {   

                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 1,'message' =>' Service  Updated')));


                }
                else
                {
                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>'Image Could Not Upload')));
                }

                return;



      

            // return to list and display message
            redirect('admin/services/edit/'.$id);
        }

     

        // setup page header data
        $this->set_title('Edit Page ');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'page_data'              => $user,
            'user_id'           => $id,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('admin/services/form', $content_data, TRUE);
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
            $user = $this->service_model->get_id($id);

            if ($user)
            {
                // soft-delete the user
                $delete = $this->service_model->delete_page($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', ' Service '  .$user['title'] . ' Deleted');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Can not delete Service '  .$user['title'] . ' ');

                }
            }
            else
            {
                $this->session->set_flashdata('error', 'services error not_exist');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'services error id_required');
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

        if ($this->input->get('heading'))
        {
            $filters['heading'] = $this->input->get('heading', TRUE);
        }

        if ($this->input->get('sub_heading'))
        {
            $filters['sub_heading'] = $this->input->get('sub_heading', TRUE);
        }

        if ($this->input->get('title'))
        {
            $filters['title'] = $this->input->get('title', TRUE);
        }

        // get all services
        $services = $this->service_model->get_all(0, 0, $filters, $sort, $dir);

        if ($services['total'] > 0)
        {
            // manipulate the output array
            foreach ($services['results'] as $key=>$user)
            {
                unset($services['results'][$key]['password']);
                unset($services['results'][$key]['deleted']);

                if ($user['status'] == 0)
                {
                    $services['results'][$key]['status'] = lang('admin input inactive');
                }
                else
                {
                    $services['results'][$key]['status'] = lang('admin input active');
                }
            }

            // export the file
            array_to_csv($services['results'], "services");
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
     * Make sure heading is available
     *
     * @param  string $heading
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_space($heading, $current)
    {
        if (trim($heading) != trim($current) && $this->service_model->name_exists($heading))
        {
            $this->form_validation->set_message('_check_duplicate', '<strong>***'. $heading . '***</strong> already exist');
            return FALSE;
        }
        else
        {
            return $heading;
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
        if (trim($email) != trim($current) && $this->service_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('services error email_exists'), $email));
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

	         if (!is_dir('uploads/'.$curr_month)) {
	             mkdir('./uploads/' . $curr_month, 0777, TRUE);
	         }

	    
	        $file_name = null;

	        $this->load->library('upload');


	        $upload['max_height'] = 3000;
	        $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) .'/uploads/'.$curr_month;
	        $upload['allowed_types'] = "gif|jpg|png|jpeg";
	        $upload['overwrite'] = true;
	        $upload['max_size'] = "30000KB";
	        $upload['max_width'] = 3000;
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

	       $upload_data=  $this->upload->data();
		            
		   if($upload_success){
		   	
		        $img_data['heading']=$data['heading'];
		        $img_data['sub_heading']=$data['sub_heading'];
		        $img_data['path'] ='uploads/'.$curr_month.'/'.$file_name;

		        $img_data['background_img'] =$file_name;
		        $img_data['status']=1;

		        if($update == 1){

			        $img_data['id']=$data['id'];

			        $save = $this->service_model->edit($img_data,'services');


		   		}else{

			        $save = $this->service_model->add($img_data,'services');

		   		}

		        if(!$save){
		        
		            $this->output
		                ->set_content_type('application/json')
		                ->set_output(json_encode(array('result' => 0,'message' =>'DATABASE ERROR !#img607i')));

		             return false;
		        }

		      return true;

		    }else{
	            $this->output
	                    ->set_content_type('application/json')
	                    ->set_output(json_encode(array('result' => 0,'message' => $this->upload->display_errors())));

	                      return false;
	           
	            // exit();
	        }

	}
}