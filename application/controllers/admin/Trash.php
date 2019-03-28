<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Trash extends Admin_Controller {

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

        // load the trash model
        $this->load->model('slider_model');
        $this->load->model('common_model');

        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('admin/trash'));
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


    	

    	if (!empty($_POST))
        {

        	 $tbl_selected= $_POST['tbl'];

             $_SESSION['last_tbl'] = $tbl_selected;


        
        }else if(!empty( $_SESSION['last_tbl'])){

        	$tbl_selected=  $_SESSION['last_tbl'];
        }else{
            $tbl_selected='gallery';
        }



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


        // get list
        $trash =array();
        $trash = $this->common_model->get_by_where('deleted','1', $tbl_selected, '');
        
        if(( !$trash)){
            $total = 0;
             $trash =null;
        	 $this->session->set_flashdata('message', ' No deleted data in '.$tbl_selected);
        	 // redirect(THIS_URL);
        }else{
            $total = count( $trash);
        }
        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}{$filter}",
            'total_rows' =>  $total,
            'per_page'   => $limit
        ));

        // setup page header data
        $this->set_title('Trash');
       

        $data = $this->includes;

        // set content data
        $content_data = array(
            'this_url'   => THIS_URL,
            'page_data'      => $trash,
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
        $data['content'] = $this->load->view('admin/trash/list', $content_data, TRUE);
        $this->load->view($this->template, $data);
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

        // get all trash
        $trash = $this->slider_model->get_all(0, 0, $filters, $sort, $dir);

        if ($trash['total'] > 0)
        {
            // manipulate the output array
            foreach ($trash['results'] as $key=>$user)
            {
                unset($trash['results'][$key]['password']);
                unset($trash['results'][$key]['deleted']);

                if ($user['status'] == 0)
                {
                    $trash['results'][$key]['status'] = lang('admin input inactive');
                }
                else
                {
                    $trash['results'][$key]['status'] = lang('admin input active');
                }
            }

            // export the file
            array_to_csv($trash['results'], "trash");
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


    // restore
    
    function restore_single($tbl, $data)
    {   


        if(!empty($tbl)&&!empty($data))
        {      
            $data =array();
            $data['deleted'] = 0;
            $data['id'] = $data;

            $rest = $this->common_model->edit($tbl,$data,'id');


            
           if($rest){

            $this->session->set_flashdata('success', 'Restored');
            redirect($this->_redirect_url);


           }
        }else{

            $this->session->set_flashdata('danger', 'Error!');
            redirect($this->_redirect_url);
        }

     
       
    }

    function del_single($tbl, $data)
    {   


        if(!empty($tbl)&&!empty($data))
        {
            $all_data = $this->common_model->get_by_id($data, $tbl);


           
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