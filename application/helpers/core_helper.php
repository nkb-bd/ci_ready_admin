<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Outputs an array in a user-readable JSON format
 *
 * @param array $array
 */
if ( ! function_exists('display_json'))
{
    function display_json($array)
    {
        $data = json_indent($array);

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo $data;
    }
}

/**
 * Convert a date to a user-friendly  date
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('my_date'))
{
   function my_date($date, $format = 'd M Y') {
       


        if (!empty($date)){
         
          return date($format, strtotime($date));

        }


    }
}
/**
 * limit text
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('limit_text'))
{
 function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
}

if ( ! function_exists('encrypt_decrypt'))
{
       


function encrypt_decrypt($action, $string)
 {
     /* =================================================
      * ENCRYPTION-DECRYPTION
      * =================================================
      * ENCRYPTION: encrypt_decrypt('encrypt', $string);
      * DECRYPTION: encrypt_decrypt('decrypt', $string) ;
      */
     $output = false;
     $encrypt_method = "AES-256-CBC";
     $secret_key = 'WS-SERVICE-KEY';
     $secret_iv = 'WS-SERVICE-VALUE';
     // hash
     $key = hash('sha256', $secret_key);
     // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
     $iv = substr(hash('sha256', $secret_iv), 0, 16);
     if ($action == 'encrypt') {
         $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
     } else {
         if ($action == 'decrypt') {
             $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
         }
     }
     return $output;


    }
}



/**
 * get balance
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('get_balance'))
{
   function get_balance($id) {
       


        if (!empty($id)){

            $CI =& get_instance();

            $CI->db->select("balance");
            $CI->db->from("users");
            $CI->db->where("id",$id);
           
            
            $query =  $CI->db->get();



            if ($query->num_rows() >= 1){ 
                $result =  $query->row_array(); 
                return $result['balance']; 
            }
            return false;

         

        }


    }
}
/**
 * get balance
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('get_notification'))
{
   function get_notification($user_id) {
       

        $id = $user_id;
        if (!empty($id)){

            $CI =& get_instance();

            $CI->db->select("id,msg_from");
            $CI->db->from("messages");
            $CI->db->where("msg_to",$id);
            $CI->db->where("msg_from !=",$id);
            $CI->db->where("is_read",0);
           
            
            $query =  $CI->db->get();



            if ($query->num_rows() >= 1){ 
                 
                return  $query->row_array(); 
            }
            return false;

         

        }


    }
}
/**
 * get balance
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('get_project_identifier'))
{
   function get_project_identifier() {
       


       $name = "Lead";

       return $name;
    }
}
/**
 * get balance
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('get_currency'))
{
   function get_currency() {
       

            $pound = '<i class="fa fa-gbp" style="font-size: 15px;"></i>';
            return $pound;


    }
}
/**
 * get balance
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('get_user_info'))
{
   function get_user_info($id) {
       


        if (!empty($id)){

            $CI =& get_instance();

            $CI->db->select("*");
            $CI->db->from("users");
            $CI->db->where("id",$id);
           
            
            $query =  $CI->db->get();



            if ($query->num_rows() == 1){ 
                $result =  $query->row_array(); 
                return $result; 
            }
            return false;

         

        }


    }
}
/**
 * get USER PAYMENT STATUS
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('get_user_payment_status'))
{
   function get_user_payment_status($id) {
       
        if (!empty($id)) {

            
        // user payment staus from database
            $CI =& get_instance();

            $CI->db->select("payment_method");
            $CI->db->from("users");
            $CI->db->where("id",$id);
           
            
            $query =  $CI->db->get();



            if ($query->num_rows() >= 1){ 
                $result =  $query->row_array(); 
                
                return $result['payment_method']; 
            }
            return false;
            # code...
        }


    }
}

/**
 * Convert a data to a user-friendly  elapsed time
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('time_elapsed_string'))
{
   function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
}


/**
 * Convert an array to a user-readable JSON string
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('json_indent'))
{
    function json_indent($array=array())
    {
        // make sure array is provided
        if (empty($array))
            return NULL;

        //Encode the string
        $json = json_encode($array);

        $result        = '';
        $pos           = 0;
        $str_len       = strlen($json);
        $indent_str    = '  ';
        $new_line      = "\n";
        $prev_char     = '';
        $out_of_quotes = true;

        for ($i = 0; $i <= $str_len; $i++)
        {
            // grab the next character in the string
            $char = substr($json, $i, 1);

            // are we inside a quoted string?
            if ($char == '"' && $prev_char != '\\')
            {
                $out_of_quotes = !$out_of_quotes;
            }
            // if this character is the end of an element, output a new line and indent the next line
            elseif (($char == '}' OR $char == ']') && $out_of_quotes)
            {
                $result .= $new_line;
                $pos--;

                for ($j = 0; $j < $pos; $j++)
                {
                    $result .= $indent_str;
                }
            }

            // add the character to the result string
            $result .= $char;

            // if the last character was the beginning of an element, output a new line and indent the next line
            if (($char == ',' OR $char == '{' OR $char == '[') && $out_of_quotes)
            {
                $result .= $new_line;

                if ($char == '{' OR $char == '[')
                {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++)
                {
                    $result .= $indent_str;
                }
            }

            $prev_char = $char;
        }

        // return result
        return $result . $new_line;
    }
}


/**
 * Save data to a CSV file
 *
 * @param array $array
 * @param string $filename
 * @return bool
 */
if ( ! function_exists('array_to_csv'))
{
    function array_to_csv($array=array(), $filename="export.csv")
    {
        $CI = get_instance();

        // disable the profiler otherwise header errors will occur
        $CI->output->enable_profiler(FALSE);

        if ( ! empty($array))
        {
            // ensure proper file extension is used
            if ( ! substr(strrchr($filename, '.csv'), 1))
            {
                $filename .= '.csv';
            }

            try
            {
                // set the headers for file download
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                header("Content-type: text/csv");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename={$filename}");

                $output = @fopen('php://output', 'w');

                // used to determine header row
                $header_displayed = FALSE;

                foreach ($array as $row)
                {
                    if ( ! $header_displayed)
                    {
                        // use the array keys as the header row
                        fputcsv($output, array_keys($row));
                        $header_displayed = TRUE;
                    }

                    // clean the data
                    $allowed = '/[^a-zA-Z0-9_ %\|\[\]\.\(\)%&-]/s';
                    foreach ($row as $key => $value)
                    {
                        $row[$key] = preg_replace($allowed, '', $value);
                    }

                    // insert the data
                    fputcsv($output, $row);
                }

                fclose($output);

            }
            catch (Exception $e) {}
        }

        exit;
    }
}


/**
 * Generates a random password
 *
 * @return string
 */
if ( ! function_exists('generate_random_password'))
{
    function generate_random_password()
    {
        $characters = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alpha_length = strlen($characters) - 1;

        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, $alpha_length);
            $pass[] = $characters[$n];
        }

        return implode($pass);
    }
}


/**
 * Retrieves list of language folders
 *
 * @return array
 */
if ( ! function_exists('get_languages'))
{
    function get_languages()
    {
        $CI = get_instance();

        if ($CI->session->languages)
        {
            return $CI->session->languages;
        }

        $CI->load->helper('directory');

        $language_directories = directory_map(APPPATH . '/language/', 1);
        if ( ! $language_directories)
        {
            $language_directories = directory_map(BASEPATH . '/language/', 1);
        }

        $languages = array();
        foreach ($language_directories as $language)
        {
            if (substr($language, -1) == "/" || substr($language, -1) == "\\")
            {
                $languages[substr($language, 0, -1)] = ucwords(str_replace(array('-', '_'), ' ', substr($language, 0, -1)));
            }
        }

        $CI->session->languages = $languages;

        return $languages;
    }
}


/**
 * Sort a multi-dimensional array
 *
 * @param array $arr - the array to sort
 * @param string $col - the key to base the sorting on
 * @param string $dir - SORT_ASC or SORT_DESC
 */
if ( ! function_exists('array_sort_by_column'))
{
    function array_sort_by_column(&$arr, $col, $dir=SORT_ASC)
    {
        $sort_col = array();
        foreach ($arr as $key=>$row)
        {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }
}

    /**
     * Get Filenames by Extension
     *
     * Reads the specified directory and builds an array containing the filenames.  
     * Any sub-folders contained within the specified path are read as well.
     *
     * @access  public
     * @param   string  path to source
     * @param   array   array of file types to include in results
     * @param   bool    whether to include the path as part of the filename
     * @param   bool    internal variable to determine recursion status - do not use in calls
     * @return  array
     */ 
if ( ! function_exists('get_filenames_by_extension'))
{
   

    function get_filenames_by_extension($source_dir, $extensions, $include_path = FALSE, $_recursion = FALSE)
    {
        static $_filedata = array();
                
        if ($fp = @opendir($source_dir))
        {
            // reset the array and make sure $source_dir has a trailing slash on the initial call
            if ($_recursion === FALSE)
            {
                $_filedata = array();
                $source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
            }
            
            while (FALSE !== ($file = readdir($fp)))
            {
                if (@is_dir($source_dir.$file) && strncmp($file, '.', 1) !== 0)
                {
                     get_filenames_by_extension($source_dir.$file.DIRECTORY_SEPARATOR, $extensions, $include_path, TRUE);
                }
                elseif (strncmp($file, '.', 1) !== 0)
                {
                    // if this is an allowed file extension, add it to the array
                    if(in_array(pathinfo($file, PATHINFO_EXTENSION), $extensions))
                    {
                        $_filedata[] = ($include_path == TRUE) ? $source_dir.$file : $file;
                    }                   
                }
            }
            return $_filedata;
        }
        else
        {
            return FALSE;
        }
    }
}
