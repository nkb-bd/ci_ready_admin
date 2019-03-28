<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends Admin_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->load->model('images_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/images'));
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

        $this->add_js_theme(array('moment.js','daterangepicker.js'));
        $this->add_external_css(array('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css'));
        $this->add_css_theme(array('daterangepicker.css'));


    }


    /**
     * images Editor
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
        $Pages = $this->images_model->get_all($limit, $offset, $filters, $sort, $dir);

        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' => $Pages['total'],
            'per_page'   => $limit
        ));

        // setup page header data
        $this->set_title('Images');
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

      
        $data['content'] = $this->load->view('admin/images/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    /**
     * view
     */
    function list()
    {
        // get settings

        // form validations
        $listData =$this->images_model->get_all('images');
        $imgData =$this->images_model->get_all('images_images');
        $album =$this->images_model->get_all('images');


        // setup page header data
		$this
			->add_js_theme('summernote.min.js,notify.js,fileinput.js')
			->add_js_theme('settings_i18n.js', TRUE)
			->set_title('images List');

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
        $data['content'] = $this->load->view('admin/images/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function add()
    {   
        

        $this->set_title('Add Images');

        $postData =$this->input->post(NULL, true);
        
        $files =$_FILES;

        if (!empty($files))
        {   

           $total_file =  count($_FILES['images']['name']);
            // echo "<br>";
            $files = $files['images'];
            
            $notes='';
            $notes= $this->input->post('notes');
          
            if (!empty($files))
            {   

                for($i=0;$i<$total_file;$i++){
                    $img_data = array();

                    $img_data['name']= $files['name'][$i];
                    $img_data['type']= $files['type'][$i];
                    $img_data['tmp_name']= $files['tmp_name'][$i];
                    $img_data['error']= $files['error'][$i];
                    $img_data['size']= $files['size'][$i];
                    $img_data['file_ext'] = pathinfo($files['name'][$i],PATHINFO_EXTENSION);
                  

                    $upload_image=$this->_do_upload($img_data,$notes); 


                }


                

            
                // saved
              

                if ($upload_image)
                {   

                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 1,'message' =>'New Image(s) Uploaded')));


                    // $this->session->set_flashdata('message', 'New Images Uploaded');
                }
                else
                {
                     $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>'New Image(s) Could Not Upload')));
                }

                return;

                // return to list and display message
             
               
            }

            // setup page header data

                $data = $this->includes;

                // set content data
                $content_data = array(
                    'settings'   => 'test',
                    'cancel_url' => "/admin",
                );
                $this->session->set_flashdata('error', sprintf("try again!#gal01"));
                redirect('admin/images');


                // // load views
                // $data['content'] = $this->load->view('admin/images/form', $content_data, TRUE);
                // $this->load->view($this->template, $data);
        }

        $data = $this->includes;

        // set content data
        $content_data = array(
            'cancel_url'        => $this->_redirect_url,
            'user'              => NULL,
            'password_required' => TRUE
        );
      
        // load views
        $data['content'] = $this->load->view('admin/images/form', $content_data, TRUE);
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
        $user = $this->images_model->get_id($id,'images');

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

       

            
            $saved = $this->images_model->edit($postData,'id');



            if ($saved)
            {
                $this->session->set_flashdata('message',  'Page Updated '.$this->input->post('title'));
            }
            else
            {
                $this->session->set_flashdata('error',  'Page was not Updated '.$this->input->post('title'));
            }

            // return to list and display message
            redirect('admin/images/edit/'.$id);
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
        $data['content'] = $this->load->view('admin/images/form', $content_data, TRUE);
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
            $user = $this->images_model->get_id($id);

            if ($user)
            {
                // soft-delete the user
                $delete = $this->images_model->delete_page($id);

                if ($delete)
                {
                    $this->session->set_flashdata('message', 'image '  .$user['name'] . ' Deleted');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Can not delete images '  .$user['name'] . ' ');

                }
            }
            else
            {
                $this->session->set_flashdata('error', 'images error not_exist');
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
           
        );          




        $insert= $this->images_model->update_single('albums',$data,'id');

            if ($insert)
            {
                $this->session->set_flashdata('message', sprintf("Portfolio Updated"));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf("Something went wrong!#portl01up"));
            }

            // return to list and display message
            redirect('admin/images/list');
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
        );       


        $insert= $this->images_model->update_single('items',$data,'id');

            if ($insert)
            {
                $this->session->set_flashdata('message', sprintf("Image Updated"));
            }
            else
            {
                $this->session->set_flashdata('error', sprintf("Something went wrong!#imgl01gal"));
            }

            // return to list and display message
            redirect('admin/images/list');
        }

    }

    private function _do_upload($post_image,$notes)
    {
       
    
        $curr_month = date('M_Y');

         if (!is_dir('uploads/'.$curr_month)) {
             mkdir('./uploads/' . $curr_month, 0777, TRUE);
         }

    
        $file_name = null;

        $this->load->library('upload');

        // $upload = $this->upload->do_upload();


                $upload['max_height'] = 3000;
                $upload['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) .'/uploads/'.$curr_month;
                $upload['allowed_types'] = "gif|jpg|png|jpeg";
                $upload['overwrite'] = true;
                $upload['max_size'] = "30000KB";
                $upload['max_width'] = 3000;
                $upload['quality'] = "100%";
                // $upload['file_name'] = uniqid() .'_' .date('d').'.'.$post_image['file_ext'] ;

                $files = $_FILES;


               $_FILES['test'] = array();

               $name =$_FILES['test']['name']= $post_image['name'];
               $_FILES['test']['type']= $post_image['type'];
               $_FILES['test']['tmp_name']= $post_image['tmp_name'];
               $_FILES['test']['error']= $post_image['error'];
               $_FILES['test']['size']= $post_image['size'];    

               $file_ext = pathinfo($name,PATHINFO_EXTENSION);

               $upload['file_name'] = time() .'_' .date('d').'.'.$file_ext ;

               $this->upload->initialize($upload);
               $upload_success =$this->upload->do_upload('test');

               

                $upload_data=  $this->upload->data();
                // print_r( $this->upload->display_errors());
                




           if ($upload_success) {

               if (!is_dir('uploads/'.$curr_month.'/thumbnail')) {
                     mkdir('./uploads/'. $curr_month.'/thumbnail', 0777, TRUE);
                 }

            $upload_data = $this->upload->data();

            $file_name = $upload_data['file_name'];


            //thumbnail creation
            $image_config["image_library"] = "gd2";
            $image_config["source_image"] = $upload_data["file_path"] . "/" . $file_name;
            $image_config['create_thumb'] = TRUE;
            $image_config['maintain_ratio'] = TRUE;


            $image_config['thumb_marker'] = "";

            $image_config['new_image'] = $upload_data["file_path"]. "/thumbnail/" . $file_name;
            $image_config['quality'] = "90%";
            $image_config['width'] = 450;
            $image_config['height'] = 380;
            $dim = (intval($upload_data["image_width"]) / intval($upload_data["image_height"])) - ($image_config['width'] / $image_config['height']);
            $image_config['master_dim'] = ($dim > 0) ? "height" : "width";

            $this->load->library('image_lib');
            $this->image_lib->initialize($image_config);

            if (!$this->image_lib->resize()) { 
                //Resize image
                echo "string";
            }
        }

        if($upload_success){

        $img_data['path'] ='uploads/'.$curr_month.'/'.$file_name;
        $img_data['name'] =$file_name;
        $img_data['status']=1;
        $img_data['notes']=$notes;

        $save = $this->images_model->add($img_data,'images');
            if(!$save){

                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>'DATABASE ERROR !#img607i')));

                 return false;
            }

          return true;
            // exit;
        }else{

            $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('result' => 0,'message' =>'DATABASE ERROR !#img607i')));

                      return false;
           
            // exit();
        }



        // $this->load->library('upload', $config);

        // if ( ! $this->upload->do_upload('pro_img'))
        // {
        //      return   $error = array('error' => $this->upload->display_errors());

        //        // $this->load->view('upload_form', $error);
        // }
        // else
        // {
        //        return $data = array('upload_data' => $this->upload->data());

        //        // $this->load->view('upload_success', $data);
        // }
    }


}
