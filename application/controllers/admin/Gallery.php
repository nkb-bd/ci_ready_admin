<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends Admin_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('gallery_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/gallery'));
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


    /**
     * gallery Editor
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
        $Pages = $this->gallery_model->get_all($limit, $offset, $filters, $sort, $dir);

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
        $data['content'] = $this->load->view('admin/gallery/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    /**
     * view
     */
    function list()
    {
        // get settings

        // form validations
        $listData =$this->gallery_model->get_all('gallery');
        $imgData =$this->gallery_model->get_all('gallery_images');
        $album =$this->gallery_model->get_all('gallery');


        // setup page header data
		$this
			->add_js_theme('summernote.min.js,notify.js,fileinput.js')
			->add_js_theme('settings_i18n.js', TRUE)
			->set_title('Gallery List');

        $data = $this->includes;

        // set content data
        $content_data = array(
            'settings'   => 'test',
            'all_data'   => $listData['results'],
            'total_album'   => $listData['total'],
            'img_data'   => $imgData['results'],
            'total_img'   => $imgData['total'],
            'album_data'   => $album['results'],
            'album_total'   => $album['results'],
            'cancel_url' => "/admin",
        );

        // load views
        $data['content'] = $this->load->view('admin/gallery/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function add()
    {   
     
        $postData =$this->input->post(NULL, true);


        $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|min_length[2]|max_length[32]|alpha_dash|is_unique[pages.slug]');
        $this->form_validation->set_rules('status','Status', 'required|numeric');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        if ($this->form_validation->run() == TRUE)
        {
         
            // validators
            $this->form_validation->set_error_delimiters($this->config->item('error_delimeter_left'), $this->config->item('error_delimeter_right'));
        
            $this->form_validation->set_rules('name', 'Name Required ', 'required');
          
            if ($this->form_validation->run() == TRUE)
            {
                // save the new user
                $saved = $this->gallery_model->add($this->input->post(),'gallery');

                if ($saved)
                {
                    $this->session->set_flashdata('message', 'New Portfolio Created');
                }
                else
                {
                    $this->session->set_flashdata('error', sprintf("Something went wrong!#gal01"));
                }

                // return to list and display message
               redirect('admin/gallery/edit/'.$id);
               
            }

            // setup page header data
                $this->set_title('Gallery');

                $data = $this->includes;

                // set content data
                $content_data = array(
                    'settings'   => 'test',
                    'cancel_url' => "/admin",
                );
                    $this->session->set_flashdata('error', sprintf("try again!#gal01"));
                redirect('admin/gallery');


                // load views
                $data['content'] = $this->load->view('admin/gallery/form', $content_data, TRUE);
                $this->load->view($this->template, $data);
        }

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => NULL,
            'password_required' => TRUE
        );

        // load views
        $data['content'] = $this->load->view('admin/gallery/form', $content_data, TRUE);
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
        $user = $this->gallery_model->get_id($id,'gallery');

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
        $this->form_validation->set_rules('name', 'Name', 'required|trim|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('slug', 'Slug', 'required|trim|min_length[2]|max_length[32]|alpha_dash'.$is_unique);
        $this->form_validation->set_rules('status','Status', 'required|numeric');
        $this->form_validation->set_rules('description', 'Description', 'trim');

        if ($this->form_validation->run() == TRUE)
        {
        
       

            $files = $_FILES;
            $postData= $this->input->post();

       

            
            $saved = $this->gallery_model->edit($postData,'id');



            if ($saved)
            {
                $this->session->set_flashdata('message',  'Page Updated '.$this->input->post('title'));
            }
            else
            {
                $this->session->set_flashdata('error',  'Page was not Updated '.$this->input->post('title'));
            }

            // return to list and display message
            redirect('admin/gallery/edit/'.$id);
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
        $data['content'] = $this->load->view('admin/gallery/form', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

        /**
     * Delete a user
     *
     * @param  int $id
     */
    function delete($id=NULL)
    {
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get user details
            $user = $this->gallery_model->get_id($id);

            if ($user)
            {
                // soft-delete the user
                $delete = $this->gallery_model->delete_page($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', 'Gallery '  .$user['title'] . ' Deleted');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Can not delete Gallery '  .$user['title'] . ' ');

                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Gallery error not_exist');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Pages error id_required');
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }

    // update album info
    public function update_album() {


        $postData =$this->input->post(NULL, true);
        $id = $this->input->post();

        if(array_key_exists("album_name", $postData)){

          
          if($_POST['album_slider']=='1'){

            // reset previous slider
            // $res = $this->db->query("UPDATE albums SET use_as_slider='0' WHERE 1");
           
            
            $_POST['album_slider']=1;
          }
    
          if($_POST['album_random']=='1'){

            // reset previous random clicks slection

            // $this->db->query("UPDATE albums SET use_as_random = 0 WHERE 1");

            $_POST['album_random']=1;
          }
        

          $data = array(
            'album_name' => $_POST['album_name'],
            'album_info' => $_POST['info'],
            'id' => $_POST['album_id'],
            'cover_img' =>$_POST['cover_name'],
            'use_as_slider' =>$_POST['album_slider'],
            'use_as_random' =>$_POST['album_random'],
            'active' =>$_POST['album_active'],
            'location' =>$_POST['album_loc'],
            'camera' =>$_POST['album_cam']
           
        );          // print_r($data);exit();




        $insert= $this->gallery_model->update_single('albums',$data,'id');

            if ($insert)
            {
                $this->session->set_flashdata('message', sprintf("Portfolio Updated"));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf("Something went wrong!#portl01up"));
            }

            // return to list and display message
            redirect('admin/gallery/list');
        }

    }

    // update img info
    public function update_img() {


        $postData =$this->input->post(NULL, true);
        $id = $this->input->post();

        if(array_key_exists("title", $postData)){


          $data = array(
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'id' => $_POST['id'],
             'album' =>$_POST['album_id'],
             'created' =>date('Y-m-d'),
              'sort_order' =>$_POST['sort']
        );          // print_r($data);exit();


        $insert= $this->gallery_model->update_single('items',$data,'id');

            if ($insert)
            {
                $this->session->set_flashdata('message', sprintf("Image Updated"));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf("Something went wrong!#imgl01gal"));
            }

            // return to list and display message
            redirect('admin/gallery/list');
        }

    }
}
