<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends Private_Controller {

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

        // load the users model

        $this->load->model('buyer/projects_model');
        $this->load->model('common_model');
        // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('buyer/projects'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "id");
        define('DEFAULT_DIR', "asc");
        if($this->user['user_type']!=3){
            redirect();
        }

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

       
       
        // get list

        $total = 0;
        $final_list = '';
        $prefrence_list = $this->common_model->get_user_preference( $this->user['id']);

        if($prefrence_list){
             $total = count($prefrence_list);
        }



      
        $page_data = $this->projects_model->get_all_buyer_projects('projects',$prefrence_list,$limit, $offset, $filters, $sort, $dir);

        

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
            'dir'        => $dir
        );

        // load views
        $data['content'] = $this->load->view('buyer/projects/list', $content_data, TRUE);
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

        $data = $this->includes;


        
        // set content data
        $content_data = array(
            'page_data'   => $project_detail,
            'total_user'   => '',
            'total_gallery'   => 0,
            'total_slider'   =>0,
            'main_menu'   => '',
            'login_logs'  => '',
            'login_attempts'  => '',
        );


        // echo "<pre>";

        // print_r($content_data);
        // exit();

        // load views
        $data['content'] = $this->load->view('seller/projects/view', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

    /**
     * Dashboard
     */
    function project_posted_by_buyer()
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




}