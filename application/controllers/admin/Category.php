<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller {

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

       
        // load the category model
        // $this->load->model('slider_model');
        $this->load->model('category_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/category'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "cat1.sort_order");
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


    	

    
        $tbl_selected='category';



        // get parameters
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;

        // get filters
        $filters = array();

        if ($this->input->get('heading'))
        {
            $filters['name'] = $this->input->get('heading', TRUE);
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


        // get list
        $category =array();
        $category = $this->category_model->get_all_category('category',$limit, $offset, $filters, $sort, $dir);

      
        
        if(( !$category)){
            $total = 0;
             $category =null;
        	 $this->session->set_flashdata('message', ' No deleted data in '.$tbl_selected);
        	 // redirect(THIS_URL);
        }else{
            $total =$category['total'];
        }
        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' =>  $total,
            'per_page'   => $limit
        ));

        // setup page header data
        $this->set_title('category');
       

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'page_data'      => $category['results'],
            'total'      =>  $total,
            'filters'    => $filters,
            'filter'     => $filter,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir,
            'tbl_selected'  => $tbl_selected
        );

     

        // load views
        $data['content'] = $this->load->view('admin/category/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }




    /**************************************************************************************
     * PRIVATE VALIDATION CALLBACK FUNCTIONS
     **************************************************************************************/


    // add new
    
    function add()
    {   

        
        // check permissions
        if (!in_array('category_create', $this->permissions)){


            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }
       
        $postData = $this->input->post();

        if(!empty($postData))
        {      
      
          $data = array();
          $fileData = $_FILES;

          // file upload

          $upload = $this->_do_upload( $fileData['image'] ,'');

            if($upload['result']==1){
             

                $data['file_path'] = $upload['img_data']['path'];
                $data['file_name'] = $upload['img_data']['name'];

            }else{

                $this->session->set_flashdata('message', $upload['error']);
                redirect($this->_redirect_url);

            }
          
          $data['name']  = $postData['name'];
          $data['price'] = $postData['price'];
          $data['sort_order'] = $postData['sort'];
          $data['parent_category'] = $postData['parent_category'];
          $data['slug']  = $this->create_unique_slug($data['name'],'category');
 

          $save = $this->category_model->save_single($data,'category');
          $this->session->set_flashdata('message', 'Success!');
          redirect($this->_redirect_url);

           
        }else{

            $this->session->set_flashdata('danger', 'Error!');
            redirect($this->_redirect_url);
        }

     
       
    }
    // add new
    
    function edit($id)
    {   

        if (  is_null($id))
        {
            $this->session->set_flashdata('danger', 'Error!');
            redirect($this->_redirect_url);
        }

        $postData = $this->input->post();

        if(!empty($postData))
        {      
         

          $data = array();

          $data['name'] = $postData['name'];
          $data['id']   = $id;
          $data['price'] = $postData['price'];
          $data['parent_category'] = $postData['parent_category'];
          $data['sort_order'] = $postData['sort'];
          

          $data['slug'] = $this->create_unique_slug($data['name'],'category');


          $save = $this->category_model->update_single($data,'category');

          $this->session->set_flashdata('message', 'Updated!');
          redirect($this->_redirect_url);

           
        }else{

            $this->session->set_flashdata('danger', 'Error!');
            redirect($this->_redirect_url);
        }

     
       
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
            $user = $this->category_model->get_by_id($id,'category');

            if ($user)
            {
                // soft-delete the user
                $delete = $this->category_model->soft_delete($id,'category');

                if ($delete)
                {
                    $this->session->set_flashdata('message','Deleted');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Error');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Invalid');
            }
        }
        else
        {
            $this->session->set_flashdata('error', 'Id required');
        }

        // return to list and display message
        redirect($this->_redirect_url);
    }



    // create slug
    public function create_unique_slug($string, $table)
    {
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params['slug'] = $slug;
        if ($this->input->post('id')) {
            $params['id !='] = $this->input->post('id');
        }
        
        while ($this->db->where($params)->get($table)->num_rows()) {
            if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
            }
            $params ['slug'] = $slug;
            }
        return $slug;
    }
    function del_single($tbl, $data)
    {   


        if(!empty($tbl)&&!empty($data))
        {
            $all_data = $this->category_model->get_by_id($data, $tbl);


           
            $this->db->where('id', $data);



            $del = $this->db->delete($tbl); 

              if(($all_data['path'])){

                    if(file_exists($all_data['path'])){
                        
                        unlink($all_data['path']);
                    }

            }

           if($del){

            $this->session->set_flashdata('success', 'Deleted');
            redirect($this->_redirect_url);

            exit;

           }
        }else{

            $this->session->set_flashdata('danger', 'Error!');
            redirect($this->_redirect_url);
            exit;
        }

     
       
    }


   /////////////////
   // /file upload //
   /////////////////
   private function _do_upload($file_data,$data)
    {
       
    
            $curr_month = date('M_Y');
             if (!is_dir('uploads/category/'.$curr_month)) {
                 mkdir('./uploads/category/' . $curr_month, 0777, TRUE);
             }
        
            $file_name = null;
            $this->load->library('upload');
            $upload['max_height']    = 8000;
            $upload['upload_path']   = dirname($_SERVER["SCRIPT_FILENAME"]) .'/uploads/category/'.$curr_month;
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
                    exit;
                }
        
                    
           if($upload_success){
            
                $img_data['path'] ='uploads/category/'.$curr_month.'/'.$file_name;
                $img_data['name'] =$file_name;
                

                
                $data = array('result' => 1,'img_data'=>$img_data );

            }else{


                $data = array('result' => 0,'error'=>$this->upload->display_errors() );
                
               
                // exit();
            }

            return  $data;
    }




}