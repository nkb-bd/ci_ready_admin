<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller {

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

        // load the Pages model
        $this->load->model('Pages_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/Pages'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "title");
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

        // summernote
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

        if ($this->input->get('username'))
        {
            $filters['username'] = $this->input->get('username', TRUE);
        }

        if ($this->input->get('first_name'))
        {
            $filters['first_name'] = $this->input->get('first_name', TRUE);
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

                if ($this->input->post('username'))
                {
                    $filter .= "&username=" . $this->input->post('username', TRUE);
                }

                if ($this->input->post('first_name'))
                {
                    $filter .= "&first_name=" . $this->input->post('first_name', TRUE);
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
        $Pages = $this->Pages_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $Pages['total'],
            'per_page'   => $limit
        ));

        // setup page header data
        $this->set_title('Pages');
		$this->set_page_header('Page List');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'page_data'      => $Pages['results'],
            'total'      => $Pages['total'],
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
        $data['content'] = $this->load->view('admin/pages/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }


    /**
     * Add new user
     */
    function add()
    {   

       
     
        // validators
        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('excerpt', 'Excerpt', 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|min_length[2]|max_length[32]|is_unique[pages.slug]alpha_dash');
        $this->form_validation->set_rules('status','Status', 'required|numeric');
        $this->form_validation->set_rules('meta_keywords', 'keywords', 'trim');
        $this->form_validation->set_rules('meta_description', 'Description', 'trim');
        $this->form_validation->set_rules('body', 'Page Body', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            // save the new user
           echo $saved = $this->Pages_model->add($this->input->post(),'');
            if ($saved)
            {
                $this->session->set_flashdata('message','New page '. $this->input->post('title') .' Saved' );
            }
            else
            {
              $this->session->set_flashdata('error','New page '. $this->input->post('title') .' Saving error C#195' );
            }

            // return to list and display message
            redirect($this->_redirect_url);
        }

        // setup page header data
        $this->set_title('Add Page ');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => NULL,
            'password_required' => TRUE
        );

        // load views
        $data['content'] = $this->load->view('admin/Pages/form', $content_data, TRUE);
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
        $user = $this->Pages_model->get_id($id);

        // if empty results, return to list
        if ( ! $user)
        {
            redirect($this->_redirect_url);
        }

        $original_value =  $user['slug'];

        if($this->input->post('slug') != $original_value) {
           $is_unique =  '|is_unique[pages.slug]';
        } else {
           $is_unique =  '';
        }

        // validators
      $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('title', 'Title', 'required|trim|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('excerpt', 'Excerpt', 'required|trim|min_length[2]|max_length[32]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|min_length[2]|max_length[32]|alpha_dash'.$is_unique);
        $this->form_validation->set_rules('status','Status', 'required|numeric');
        $this->form_validation->set_rules('meta_keywords', 'keywords', 'trim');
        $this->form_validation->set_rules('meta_description', 'Description', 'trim');
        $this->form_validation->set_rules('body', 'Page Body', 'required');

        if ($this->form_validation->run() == TRUE)
        {
        
       

            $files = $_FILES;
            $file_name= $this->input->post('username');
            $postData= $this->input->post();

            /*----------  img upload  ----------*/

            if(!empty($files['profile_img']['name'])){



                $img_name=$this->_do_upload($_FILES['profile_img'],'profile_img',$file_name);
                        if($img_name==false){
                            echo 'error#contact adminstrator';
                            exit();
                        }

                $postData['profile_img']=$img_name;
                
            }

            
            $saved = $this->Pages_model->edit($postData,'id');



            if ($saved)
            {
                $this->session->set_flashdata('message',  'Page Updated '.$this->input->post('title'));
            }
            else
            {
                $this->session->set_flashdata('error',  'Page was not Updated '.$this->input->post('title'));
            }

            // return to list and display message
            redirect('admin/pages/edit/'.$id);
        }

        if($this->form_validation->run() == FALSE){
            // $this->session->set_flashdata('error',  'Page was not Updated ' .validation_errors());
            // print_r( validation_errors());
        }

        // setup page header data
        $this->set_title('Edit Page ');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => $user,
            'user_id'           => $id,
            'password_required' => FALSE
        );

        // load views
        $data['content'] = $this->load->view('admin/Pages/form', $content_data, TRUE);
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
            $user = $this->Pages_model->get_id($id);

            if ($user)
            {
                // soft-delete the user
                $delete = $this->Pages_model->delete_page($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', 'Page '  .$user['title'] . ' Deleted');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Can not delete Page '  .$user['title'] . ' ');

                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Pages error not_exist');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Pages error id_required');
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

        if ($this->input->get('username'))
        {
            $filters['username'] = $this->input->get('username', TRUE);
        }

        if ($this->input->get('first_name'))
        {
            $filters['first_name'] = $this->input->get('first_name', TRUE);
        }

        if ($this->input->get('title'))
        {
            $filters['title'] = $this->input->get('title', TRUE);
        }

        // get all Pages
        $Pages = $this->Pages_model->get_all(0, 0, $filters, $sort, $dir);

        if ($Pages['total'] > 0)
        {
            // manipulate the output array
            foreach ($Pages['results'] as $key=>$user)
            {
                unset($Pages['results'][$key]['password']);
                unset($Pages['results'][$key]['deleted']);

                if ($user['status'] == 0)
                {
                    $Pages['results'][$key]['status'] = lang('admin input inactive');
                }
                else
                {
                    $Pages['results'][$key]['status'] = lang('admin input active');
                }
            }

            // export the file
            array_to_csv($Pages['results'], "Pages");
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
     * Make sure username is available
     *
     * @param  string $username
     * @param  string|null $current
     * @return int|boolean
     */
    function _check_space($username, $current)
    {
        if (trim($username) != trim($current) && $this->Pages_model->name_exists($username))
        {
            $this->form_validation->set_message('_check_duplicate', '<strong>***'. $username . '***</strong> already exist');
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
        if (trim($email) != trim($current) && $this->Pages_model->email_exists($email))
        {
            $this->form_validation->set_message('_check_email', sprintf(lang('Pages error email_exists'), $email));
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
  private function _do_upload($file,$file_name,$id){
    echo "<pre>";
    // echo "string";
    echo $file;
    // echo $file_name;
    echo $id;
    $config['upload_path']   = './files/profile/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['overwrite']      = true;
    $config['max_size']      = 30000;
    $config['file_name'] = $id.time();
    $this->load->library('upload', $config);

    $this->upload->initialize($config);

     if (!$this->upload->do_upload($file_name)){

        $data = array('error' => $this->upload->display_errors());
        print_r($data);exit;

          $this->session->set_flashdata('notification_msg', 'Eror try Again!');
          $this->session->set_flashdata('notification_type', 'danger');
          $this->session->set_flashdata('notification_icon', 'fa fa-user');

          $this->session->set_flashdata('message', sprintf("Image Upload Failure ".$data));
          redirect($this->_redirect_url);

    }else{
        $upload_data = $this->upload->data($file_name);
         // $data will contain full inforation
        $path=$this->upload->data('file_path');
        $up_file_name = $this->upload->data('file_name');

        return $up_file_name;
    }

        //saving img to media table


        




    }

}
