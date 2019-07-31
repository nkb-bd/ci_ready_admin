<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Class all other classes extend
 */
class MY_Controller extends CI_Controller {

/**
     * Common data
     */
    public $user;
    public $settings;
    public $languages;
    public $includes;
    public $current_uri;
    public $theme;
    public $template;
    public $error;
    public $dynamic_pages;


    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();

        // get settings
        $settings = $this->settings_model->get_settings();
        $this->settings = new stdClass();
        foreach ($settings as $setting)
        {
            $this->settings->{$setting['name']} = (@unserialize($setting['value']) !== FALSE) ? unserialize($setting['value']) : $setting['value'];
        }
        $this->settings->site_version   = $this->config->item('site_version');
        // $this->settings->themes_folder  = $this->config->item('themes_folder');
        $this->settings->themes_folder  = 'assets/themes';
        $this->settings->captcha_folder = $this->config->item('captcha_folder');

        // get current uri
        $this->current_uri = "/" . uri_string();

        // set the time zone
        $timezones = $this->config->item('timezones');
        if (function_exists('date_default_timezone_set'))
        {
            // date_default_timezone_set($timezones[$this->settings->timezones]);
        }

        // get current user
        $this->user = $this->session->userdata('logged_in');

       

        // get languages
        $this->languages = get_languages();


        // set language according to this priority:
        //   1) First, check session
        //   2) If session not set, use the users language
        //   3) Finally, if no user, use the configured languauge
        if ($this->session->language)
        {
            // language selected from nav
            $this->config->set_item('language', $this->session->language);
        }
        elseif ($this->user['language'])
        {
            // user's saved language
            $this->config->set_item('language', $this->user['language']);
        }
        else
        {
            // default language
            $this->config->set_item('language', $this->config->item('language'));
        }

        // save selected language to session
        $this->session->language = $this->config->item('language');

        // load the core language file
        $this->lang->load('core');

        // set global header data - can be merged with or overwritten in controllers
        $this
            ->add_external_css(
                array(
                ))

            ->add_external_js(
                array(
                    ""
                ));       

        // enable the profiler?
        $this->output->enable_profiler($this->config->item('profiler'));
    }


    /*
     *
     * --------------------------------------
     * @author  Lukman Nakib
     * @since   Version 3.1.0
     * @access  public
     * @param   mixed
     * @param   string, default = NULL
     * @return  chained object
     */
    function add_external_css($css_files, $path=NULL)
    {
        // make sure that $this->includes has array value
        if ( ! is_array($this->includes))
        {
            $this->includes = array();
        }

        // if $css_files is string, then convert into array
        $css_files = is_array($css_files) ? $css_files : explode(",", $css_files);

        foreach ($css_files as $css)
        {
            // remove white space if any
            $css = trim($css);

            // go to next when passing empty space
            if (empty($css)) continue;

            // using sha1($css) as a key to prevent duplicate css to be included
            $this->includes['css_files'][sha1($css)] = is_null($path) ? $css : $path . $css;
        }

        return $this;
    }


    /**
     -----------
     * @author  Lukman Nakib
     * @since   Version 3.1.0
     * @access  public
     * @param   mixed
     * @param   string, default = NULL
     * @return  chained object
     */
    function add_external_js($js_files, $path=NULL)
    {
        // make sure that $this->includes has array value
        if ( ! is_array($this->includes))
        {
            $this->includes = array();
        }

        // if $js_files is string, then convert into array
        $js_files = is_array($js_files) ? $js_files : explode(",", $js_files);

        foreach ($js_files as $js)
        {
            // remove white space if any
            $js = trim($js);

            // go to next when passing empty space
            if (empty($js)) continue;

            // using sha1($css) as a key to prevent duplicate css to be included
            $this->includes['js_files'][sha1($js)] = is_null($path) ? $js : $path . $js;
        }

        return $this;
    }


    /**
     * --------------------------------------
     * @author  Lukman Nakib
     * @since   Version 3.0.5
     * @access  public
     * @param   mixed
     * @return  chained object
     */
    function add_css_theme($css_files)
    {
        // make sure that $this->includes has array value
        if ( ! is_array($this->includes))
        {
            $this->includes = array();
        }

        // if $css_files is string, then convert into array
        $css_files = is_array($css_files) ? $css_files : explode(",", $css_files);

        foreach ($css_files as $css)
        {
            // remove white space if any
            $css = trim($css);

            // go to next when passing empty space
            if (empty($css)) continue;

            // using sha1($css) as a key to prevent duplicate css to be included
            $this->includes['css_files'][sha1($css)] = base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/css/{$css}");
        }

        return $this;
    }


    /**
     * Add JS from Active Theme Folder
     * --------------------------------------
     * @author  Lukman Nakib
     * @since   Version 3.0.5
     * @access  public
     * @param   mixed
     * @param   boolean
     * @return  chained object
     */
    function add_js_theme($js_files, $is_i18n=FALSE)
    {
        // if ($is_i18n)
        // {
        //     return $this->add_jsi18n_theme($js_files);
        // }

        // make sure that $this->includes has array value
        if ( ! is_array($this->includes))
        {
            $this->includes = array();
        }

        // if $css_files is string, then convert into array
        $js_files = is_array($js_files) ? $js_files : explode(",", $js_files);

        foreach ($js_files as $js)
        {
            // remove white space if any
            $js = trim($js);

            // go to next when passing empty space
            if (empty($js)) continue;

            // using sha1($js) as a key to prevent duplicate js to be included
            $this->includes['js_files'][sha1($js)] = base_url("/{$this->settings->themes_folder}/{$this->settings->theme}/js/{$js}");
        }

        return $this;
    }





    /* Set Page Title
     * --------------------------------------
     * @author  Lukman Nakib
     * @since   Version 3.0.5
     * @access  public
     * @param   string
     * @return  chained object
     */
    function set_title($page_title)
    {
        $this->includes['page_title'] = $page_title;

        /* check wether page_header has been set or has a value
        * if not, then set page_title as page_header
        */
        $this->includes['page_header'] = isset($this->includes['page_header']) ? $this->includes['page_header'] : $page_title;
        return $this;
    }


    /* Set Page Header
     * sometime, we want to have page header different from page title
     * so, use this function
     * --------------------------------------s
     * @author  Lukman Nakib
     * @since   Version 3.0.5
     * @access  public
     * @param   string
     * @return  chained object
     */
    function set_page_header($page_header)
    {
        $this->includes['page_header'] = $page_header;
        return $this;
    }


    /* Set Template
     * sometime, we want to use different template for different page
     * for example, 404 template, login template, full-width template, sidebar template, etc.
     * so, use this function
     * ----------------p----------------------
     * @author  Lukman Nakib
     * @since   Version 3.1.0
     * @access  public
     * @param   string, template file name
     * @return  chained object
     */
    function set_template($template_file="template.php")
    {
        // make sure that $template_file has .php extension
        $template_file = substr($template_file, -4) == '.php' ? $template_file : ($template_file . ".php");

        $this->template = "../../assets/themes/{$template_file}";
    }
	
}

// public controoler start
/**
 * Base Public Class - used for all public pages
 */
class Public_Controller extends MY_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();


        if (!empty( $this->settings->template)) {

            $this->settings->theme =  $this->settings->template;
               
        }else{

            $this->settings->theme = strtolower($this->config->item('public_theme'));
        }

        // set up global header data
        $this->add_css_theme("public.css");
        // ->add_js_theme("{$this->settings->theme}_i18n.js", TRUE);

        // declare public template
        $this->template = "../../assets/themes/public/template.php";
        
    }


}



require_once APPPATH ."core/Admin_Controller.php";
require_once APPPATH ."core/Private_Controller.php";