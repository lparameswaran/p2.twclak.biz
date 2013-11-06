<?php

class index_controller extends base_controller {
    
    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    public function __construct() {
        parent::__construct();
    } 
        
    /*-------------------------------------------------------------------------------------------------
    Accessed via http://localhost/index/index/
    -------------------------------------------------------------------------------------------------*/
    public function index() {
        
        # Any method that loads a view will commonly start with this
        # First, set the content of the template with a view file

        $this->template->content = View::instance('v_index_index');
            
        # Now set the <title> tag
        $this->template->title = 'Welcome to ' . APP_NAME . " microblogging";
    
        # CSS/JS includes
            
        $client_files = Array(
                              "ui_theme"   => "/css/ui/themes/base/jquery-ui.css",
                              "main_theme" => "/css/main.css",
                              "mainjs"     => "/js/jquery-2.0.3.min.js",
                              "uijs"       => "/js/ui/ui/jquery-ui.js");
        $this->template->client_files_head = Utils::load_client_files($client_files);
            
        $client_files_head_script = "$(function() { $( '#menu' ).tabs(); });";
        $this->template->client_files_head_script = $client_files_head_script;

        # Now Mark global JS/CSS files as included
        $this->template->included = 1;

        /*
          $client_files_body = Array("");
          $this->template->client_files_body = Utils::load_client_files($client_files_body);   
        */
                                           
        # Render the view
        echo $this->template;

    } # End of method
    
    
} # End of class
?>
