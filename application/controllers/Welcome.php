<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Public_Controller {

    /**
     * Constructor
     */
    // this->dynamic_page_menu
    // for dynamiclly created page menu f
    function __construct()
    {
        parent::__construct();

        // load the language file
        $this->lang->load('welcome');
        $this->load->model('common_model');

      


    }


    /**
	 * Default
     */
	function index()
	{  


        
        $data = $this->includes;


        
        $all_category           = $this->common_model->get_all('category',8, 0, '','sort_order', 'asc');
        
        // set content data
        $content_data = array(
            'all_category'       => $all_category['results'],
        );
        

       
        // load views
        $data['content'] = $this->load->view('home', $content_data, TRUE);
		$this->load->view($this->template, $data);



	}


    // all category list

    public function all_category (){


        $data = $this->includes;


        
        $all_category           = $this->common_model->get_all('category',0, 0, '','id', 'asc');
        $all_sub_category       = $this->common_model->get_all('sub_category',0, 0, '','id', 'asc');
        
        // set content data
        $content_data = array(
            'all_category'       => $all_category['results'],
            'all_sub_category'   => $all_sub_category['results'],
        );
        

       
        // load views
        $data['content'] = $this->load->view('public/all_category', $content_data, TRUE);
        $this->load->view($this->template, $data);



    }


    // view project by category

    public function category_single_view($slug='')
    {
        
        if(empty($slug)){

                redirect();
        }
        $data = $this->includes;


        
        $category_id     = $this->common_model->get_by_where('slug',$slug, 'category', '','id', 'asc');

         

        $all_sub_category_under_this_category = $this->common_model->get_by_where('parent_cat_id',$category_id[0]['id'], 'sub_category', '','id', 'asc');



        $all_category           = $this->common_model->get_all('category',8, 0, '','id', 'asc');
        $all_sub_category       = $this->common_model->get_all('sub_category',0, 0, '','id', 'asc');

        $approved = 1;
        $all_project       = $this->common_model->get_project_category_by_slug($slug, $approved);

        $total = 0;
        if($all_project){

                $total = count($all_project);

        }
        
        
        // set content data
        $content_data = array(
             'all_category'     => $all_category['results'],
             'all_sub_category' => $all_sub_category_under_this_category,
             'all_project'      =>  $all_project,
             'search'           =>  $category_id[0]['name'],
             'total'            =>  $total,
             'page'             => 'category'
        );
        

       
        // load views
        $data['content'] = $this->load->view('public/job_list', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }


    // view project by category

    public function sub_category_single_view($sub_category_id,$category_id)
    {
      

        if(empty($sub_category_id)||empty($category_id)){

                redirect();
        }

        $data = $this->includes;


        

         // sub_category_id is category id mistakley done

        $all_sub_category_under_this_category = $this->common_model->get_by_where('parent_cat_id',$sub_category_id, 'sub_category', '','id', 'asc');


        $category_info = $this->common_model->get_by_where('id',$sub_category_id, 'category', '','id', 'asc');
        $sub_category_info = $this->common_model->get_by_where('id',$category_id, 'sub_category', '','id', 'asc');



        $all_category           = $this->common_model->get_all('category',8, 0, '','id', 'asc');
        $all_sub_category       = $this->common_model->get_all('sub_category',0, 0, '','id', 'asc');

        $fields = array(

            'category'     => $category_id,
            'sub_category' => $sub_category_id
        );

        $approved = 1;
        $all_project       = $this->common_model->get_project_by_category_sub_cat($sub_category_id,$category_id , $approved);
        
      

        $total = 0;
        if($all_project){

                $total = count($all_project);

        }
        
        
        // set content data
        $content_data = array(
            'all_category'       => $all_category['results'],
            'all_sub_category'   => $all_sub_category_under_this_category,
            'all_project'   =>  $all_project,
            'search'   =>  $category_info[0]['name'] .' and ' . $sub_category_info[0]['name'],
            'total'   =>  $total,
             'page'  => 'category'
        );
        

       
        // load views
        $data['content'] = $this->load->view('public/job_list', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }

    // main search project by name or category

    public function search()
    {


   
        if ( !$_GET['query']&&!$_GET['category']&&empty($_GET['lat'])&&empty($_GET['location']) ) {

            redirect();

        }else{

          $search = $this->input->get('query');

        }

        

        $data = $this->includes;


        $loc = $_GET['location'];



        $total = 0;
        $all_category           = $this->common_model->get_all('category',0, 0, '','id', 'asc');
        $all_sub_category       = $this->common_model->get_all('sub_category',0, 0, '','id', 'asc');

        $approved = 1;

        if(!empty($_GET['category'])){

            // if searched with category

           $category_id =    $_GET['category'];
           $all_project       = $this->common_model->get_project_by_category_search($search,  $category_id, $approved);

            // echo $this->db->last_query();
                // exit;

        }else{
             // if searched with out category
            // check if search with lat and lang

             if (isset($_GET['lat'])&&!empty($_GET['lat'])) {

               
               $lat  = $_GET['lat'];
               $lang = $_GET['lang'];
               $km   = (isset($_GET['radius'])? $_GET['radius'] : 5);
               
               $all_project       = $this->common_model->get_project_by_search_lat_lang($search,$loc,$km,$lat,$lang,$approved );


                
                
             }else{

                $all_project       = $this->common_model->get_project_by_search($search,$approved,$loc);

               
             }
           

            // check if search with lat and lang

        }

       


        if($all_project){

                $total = count($all_project);

        }
        // set content data
        $content_data = array(
            'all_category'       => $all_category['results'],
            'all_sub_category'   => $all_sub_category['results'],
            'all_project'   =>  $all_project,
            'search'   =>  $search,
            'total'   =>  $total,
             'page'  => 'search'
        );
        

       
        // load views
        $data['content'] = $this->load->view('public/job_list', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }

    // browse job page

    public function browse_jobs()
    {

          // set constants
        define('REFERRER', "referrer");
        define('THIS_URL', base_url('browse_jobs'));
        define('DEFAULT_LIMIT', $this->settings->per_page_limit);
        define('DEFAULT_OFFSET', 0);
        define('DEFAULT_SORT', "projects.id");
        define('DEFAULT_DIR', "desc");

         // use the url in session (if available) to return to the previous filter/sorted/paginated list
        if ($this->session->userdata(REFERRER))
        {
            $this->_redirect_url = $this->session->userdata(REFERRER);
        }
        else
        {
            $this->_redirect_url = THIS_URL;
        }


        // pagination
        $limit  = $this->input->get('limit')  ? $this->input->get('limit', TRUE)  : DEFAULT_LIMIT;
        $offset = $this->input->get('offset') ? $this->input->get('offset', TRUE) : DEFAULT_OFFSET;
        $sort   = $this->input->get('sort')   ? $this->input->get('sort', TRUE)   : DEFAULT_SORT;
        $dir    = $this->input->get('dir')    ? $this->input->get('dir', TRUE)    : DEFAULT_DIR;
   



        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}");

       
        $u_id = $this->user['id'];

        // get list

  
        $data = $this->includes;


        $total = 0;
        $all_category           = $this->common_model->get_all('category',0, 0, '','id', 'asc');
        $all_sub_category       = $this->common_model->get_all('sub_category',0, 0, '','id', 'asc');


        $approved = 1;
    
        // $all_project       = $this->common_model->get_latest_projects_with_pagination($limit,$approved);


        // save the current url to session for returning
        $this->session->set_userdata(REFERRER, THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}&offset={$offset}");

       
        $u_id = $this->user['id'];

        // get list
        $page_data = $this->common_model->get_latest_projects_with_pagination('projects',$limit, $offset,  $sort, $dir,$approved);

       

  
        // build pagination
        $this->pagination->initialize(array(
            'base_url'   => THIS_URL . "?sort={$sort}&dir={$dir}&limit={$limit}",
            'total_rows' => $page_data['total'],
            'per_page'   => $limit
        ));

        // set content data
        $content_data = array(
            'all_category'       => $all_category['results'],
            'all_sub_category'   => $all_sub_category['results'],
            'all_project'   => $page_data['results'],
            'search'   =>  'Browse Jobs',
            'total'   => $page_data['total'],
            'page'  => 'search',
            'this_url'   => THIS_URL,
            'pagination' => $this->pagination->create_links(),
            'limit'      => $limit,
            'offset'     => $offset,
            'sort'       => $sort,
            'dir'        => $dir
        );
        

       
        // load views
        $data['content'] = $this->load->view('public/job_list', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }

   // browse job page

    public function _view_job($slug='')
    {

        $logged_in_user = $this->session->userdata('logged_in');

        $type = $logged_in_user['user_type'];
        if (!empty($type))
        {
            $this->session->set_flashdata('error', 'Please register first!');
            redirect();
        }

        if ( empty($slug)) {
            redirect();
        }

        $limit        = 20;
        $approved     = 1;
        $msg          = '';
        $project_data = $this->common_model->get_project_by_slug_single($slug,$approved);
        

        // check user balance with admin selecte price for lead sub category
        //first get admin slected price

        $sub_category_data = $this->common_model->get_by_id( $project_data['sub_cat_id'],'sub_category');
        
        $price             = $sub_category_data['price'];

        //2nd check user balance
        $user_balance = get_balance($this->user['id']);

        if($user_balance < $price){

            $this->session->set_flashdata('error', 'Not Enough Balance !');
            redirect('browse_jobs');
        }else{

            $user_balance_update['balance'] = $user_balance-$price;
            $user_balance_update['id']      = $this->user['id'];
            $update_balance                 = true;
            $update_balance                 = $this->common_model->update_single( $user_balance_update,'users');



            // insert to payment history
            
            $payment_data['amount']           =  $price;
            $payment_data['payer_id']         =  $this->user['id']; 
            $payment_data['project_id']       =  -1; 
            $payment_data['transaction_type'] =  'Recharge';

            $success = $this->common_model->save_single($payment_data,'payment_history');
            


            if($update_balance&&$success){
                $msg ="Lead price has been succefully deducted from your balance ! ";
            }else{
                 $msg ="Error! ";
            }

        }
       

       

        $data = $this->includes;


        $total = 0;
        $all_category           = $this->common_model->get_all('category',0, 0, '','id', 'asc');
        $all_sub_category       = $this->common_model->get_all('sub_category',0, 0, '','id', 'asc');


        
    
       
        

            
        // set content data
        $content_data = array(
            'all_category'       => $all_category['results'],
            'all_sub_category'   => $all_sub_category['results'],
            'project_data'   =>  $project_data,
            'search'   =>  'Browse Jobs',
            'total'   =>  $total,
            'msg'   =>  $msg,
            'page'  => 'search'
        );
        

       
        // load views
        $data['content'] = $this->load->view('public/job_single', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }


    // static pages
    public function how_it_works(){


      

        $data = $this->includes;


        // set content data
        $content_data = array(
           
        );
        

       
        // load views
        $data['content'] = $this->load->view('public/howitworks', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }


    public function about_us(){


      

        $data = $this->includes;


        // set content data
        $content_data = array(
           
        );
             
        // load views
        $data['content'] = $this->load->view('public/about_us', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }


    public function terms(){


      

        $data = $this->includes;


        // set content data
        $content_data = array(
           
        );
             
        // load views
        $data['content'] = $this->load->view('public/terms', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }

    public function mailchimp(){
         $email        = 'johndoe@rudrastyh.com';
         $status       = 'subscribed'; // "subscribed" or "unsubscribed" or "cleaned" or "pending"
         $list_id      =  $this->config->item('mailchimp_list_id'); // where to get it read above
         $api_key      =  $this->config->item('mailchimp_api_key'); // where to get it read above
         $merge_fields = array('FNAME' => 'Misha','LNAME' => 'Rudrastyh');
         
        // mailchimp_subscriber_status($email, $status, $list_id, $api_key, $merge_fields );

        $result = json_decode($this->rudr_mailchimp_subscriber_status($_POST['email'], 'subscribed', $list_id, $api_key, array() ));
       
        if( $result->status == 400 ){

            // foreach( $result->errors as $error ) {
            //     echo '<p>Error: ' . $error->message . '</p>';
            // }

                echo 'Error: ' . $result->detail ;

        } elseif( $result->status == 'subscribed' ){

            echo 'Thank you, . You have subscribed successfully';

        }
        die;

    }
    function rudr_mailchimp_subscriber_status($email, $status, $list_id, $api_key) {
            $data = array(
                'apikey' => $api_key,
                'email_address' => $email,
                'status' => $status
            );
            $mch_api = curl_init(); // initialize cURL connection
 
            curl_setopt($mch_api, CURLOPT_URL, 'https://' . substr($api_key, strpos($api_key, '-') + 1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
            curl_setopt($mch_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic ' . base64_encode('user:' . $api_key)));
            curl_setopt($mch_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
            curl_setopt($mch_api, CURLOPT_RETURNTRANSFER, true); // return the API response
            curl_setopt($mch_api, CURLOPT_CUSTOMREQUEST, 'PUT'); // method PUT
            curl_setopt($mch_api, CURLOPT_TIMEOUT, 10);
            curl_setopt($mch_api, CURLOPT_POST, true);
            curl_setopt($mch_api, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($mch_api, CURLOPT_POSTFIELDS, json_encode($data)); // send data in json
 
            $result = curl_exec($mch_api);
            return $result;
        }

    function error_page(){


        $data = $this->includes;


        // set content data
        $content_data = array(
           
        );
             
        // load views
        $data['content'] = $this->load->view('public/error_page', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }



}
