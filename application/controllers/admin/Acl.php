<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ACl extends Admin_Controller {

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

       
        $this->load->model('common_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/acl'));
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
          //  load acl
        $this->load->library('permission');
    }


    /**************************************************************************************
     * PUBLIC FUNCTIONS
     **************************************************************************************/


    /**
     * permission  page
     */

    function index(){




        // check permissions
        if (!in_array('acl_view', $this->permissions)){

            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }




        $this->set_title('Role Based Access');

        
        $data     = $this->includes;
        $all_grp  = $this->permission->all_group_list();
        $all_perm = $this->permission->all_permission_list();

        if ($this->session->flashdata('grp_id')){
              $groupID = $this->session->flashdata('grp_id');
        }else{
           
              $groupID  = 1;

        }


        // $all_perm_with_grp = $this->permission->all_permission_data_with_group();

        $grp_permission_list ='';

  
        if (isset($_POST['groupID'])&&isset($_POST['permissionID'])) {

            // check permissions
            if (!in_array('acl_create', $this->permissions)){

                $this->session->set_flashdata('error', 'Permission denied !');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $result = $this->permission->add_permissions($_POST);

            if($result){

                $this->session->set_flashdata('message', 'Success');
                $this->session->set_flashdata('grp_id', $_POST['groupID']);
                redirect($_SERVER['HTTP_REFERER']);
            }else{

                $this->session->set_flashdata('error', 'Error Duplicate!');
                redirect($_SERVER['HTTP_REFERER']);
            }


        }

        if (isset($_POST['view_permission'])) {


            $groupID = $_POST['groupID'];
            $result = $this->permission->all_permission_data_with_group($groupID);

       
            $grp_permission_list = $result;
            


        }
        if (empty($_POST)) {
            
               if ($this->session->flashdata('grp_id')){
                      $groupID = $this->session->flashdata('grp_id');
                }else{
                   
                      $groupID  = 1;

                }

        $grp_permission_list = $this->permission->all_permission_data_with_group($groupID);

        }
              // set content data
        $content_data = array(

            'grp_permission_list' => $grp_permission_list,
            'this_url'            => THIS_URL,
            'cancel_url'          => THIS_URL,
            'all_grp'             => $all_grp,
            'all_perm'            => $all_perm,
            'all_perm_with_grp'   => '',
            'groupID' =>   $groupID
        );

        // load views
        $data['content'] = $this->load->view('admin/acl/acl', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    /**
     * User list page
     */

    function permissions(){

        // check permissions
        if (!in_array('acl_view', $this->permissions)){

            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->set_title('User Access Control');


        $data = $this->includes;

        $all_perm = $this->permission->all_permission_list();




        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'cancel_url'   => THIS_URL,
            'all_perm'   => $all_perm,

        );

     

        // load views
        $data['content'] = $this->load->view('admin/acl/permission', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    function list()
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
    
    function add_permission()
    {   

        // check permissions
        if (!in_array('acl_create', $this->permissions)){

            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $postData = $this->input->post();

        $this->form_validation->set_rules('module', 'Module', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('perm_key', 'Permission ID', 'trim|required|min_length[1]|max_length[50]|alpha_dash');
        if( $this->form_validation->run() == TRUE)
        {      
      
          $data = array();
                    
          $data['permission']  = $postData['info'];
          $data['key']         = $postData['perm_key'];
          $data['module_name'] = $postData['module'];
 
          $save =  $this->permission->new_permission($data);
         
         if($save){

            $this->session->set_flashdata('message', 'Success!');
            redirect( $_SERVER['HTTP_REFERER']);

         }

         $this->session->set_flashdata('error', 'Duplicate Error!');
         redirect( $_SERVER['HTTP_REFERER']);

           
        }else{


            $this->session->set_flashdata('error', validation_errors());
            redirect( $_SERVER['HTTP_REFERER']);
        }

     
       
    } 

    // user group list

    function groups()
    {   

        // check permissions
        if (!in_array('acl_view', $this->permissions)){

            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $this->set_title('User Groups');

        $postData = $this->input->post();

        $this->form_validation->set_rules('name', 'Module', 'trim|required|min_length[1]|max_length[50]');

        if($postData){
            if( $this->form_validation->run() == TRUE)
            {      
              $data = array();
            
              // update
              if(isset($postData['id'])){

                // check permissions
                if (!in_array('acl_update', $this->permissions)){


                    $this->session->set_flashdata('error', 'Permission denied !');
                    redirect($_SERVER['HTTP_REFERER']);
                }


                $data['groupName'] = $postData['name'];
                $data['id']        = $postData['id'];

                $this->db->where('id', $data['id']);

                $save = $this->db->update('permission_groups',$data);

              }else{
               
                // new


                // check permissions
                if (!in_array('acl_create', $this->permissions)){


                    $this->session->set_flashdata('error', 'Permission denied !');
                    redirect($_SERVER['HTTP_REFERER']);
                }

                        
                $data['groupName'] = $postData['name'];
                $save              =  $this->permission->new_group($data);
                
              }

          
             
                if($save){

                    $this->session->set_flashdata('message', 'Success!');
                    redirect( $_SERVER['HTTP_REFERER']);

                }

                $this->session->set_flashdata('error', 'Error!');
                redirect( $_SERVER['HTTP_REFERER']);

               
            }elseif( $this->form_validation->run() != TRUE){


                $this->session->set_flashdata('error', validation_errors());
                redirect( $_SERVER['HTTP_REFERER']);
            }
        }

        $data = $this->includes;
        $all_perm = $this->permission->all_group_list();

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'cancel_url'   => THIS_URL,
            'all_perm'   => $all_perm,

        );

     

        // load views
        $data['content'] = $this->load->view('admin/acl/group', $content_data, TRUE);
        $this->load->view($this->template, $data);

     
       
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

    // set permission active or inactive

    function set_active(){

      // check permissions
      if (!in_array('acl_update', $this->permissions)){

          echo json_encode(false);
          return;

      }
      if ($_POST) {
                

        $data['status'] = $_POST['checked']; 

        $this->db->where('groupID', $_POST['grp_id']);
        $this->db->where('permissionID', $_POST['perm_id']);
        $update = $this->db->update('permission_map',$data);    



        if($update ){

          echo json_encode(true);
          return;

        }else{

          echo json_encode(false);
          return;
        }
        


      }

    }


    /**
     * Delete 
     *
     * @param  int $id
     */
    function delete_group($id=NULL)
    {    

          // check permissions
        if (!in_array('acl_delete', $this->permissions)){

            $this->session->set_flashdata('error', 'Permission denied !');
            redirect($_SERVER['HTTP_REFERER']);
        }
        // make sure we have a numeric id
        if ( ! is_null($id) OR ! is_numeric($id))
        {
            // get user details

            if ($id)
            {   
                // check if there is user  in this groupID

                $result = $this->common_model->get_by_where('user_type',$id,'users');

                if($result){

                    $this->session->set_flashdata('error', 'There is a user in this group. Please remove the user first');
                    redirect( $_SERVER['HTTP_REFERER']);


                }

                $this->db->where('id', $id);
                $delete = $this->db->delete('permission_groups'); 

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
       redirect( $_SERVER['HTTP_REFERER']);
    }



    function del_groups($id)
    {   


        if(!empty($id))
        {
            $all_data = $this->category_model->get_by_id($id, 'permission_groups');


           
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




}