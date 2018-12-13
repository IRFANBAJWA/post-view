<?php
/**
 * Plugin Name: User visting Record
 * Plugin URI:  #
 * Description: Show user detail who redirect to cloud and whos not
 * Version: 1.0.0
 * Author: Irfan Manzoor Bajwa
 * Author URI: #
 * License: A short license name. Example: GPL2
 */
if(!class_exists('memberfilter'))
{
    class memberfilter
    {
	public $plugin_url;
        /**
         * Construct
         */
        public function __construct()
        {
            require plugin_dir_path( __FILE__ ). 'inc/user_visit.php';
            add_action('admin_enqueue_scripts', array(&$this, 'defaultfiles_plugin_enqueue'));
            add_action( 'admin_menu', array( &$this, 'load_to_member_menu' ));
            add_action('admin_enqueue_scripts',  array( &$this, 'themeslug_enqueue_script' ));
            add_action('admin_enqueue_scripts', array( &$this, 'my_theme_enqueue_styles' ));
            add_action('wp_enqueue_scripts', array( &$this, 'forntjs' ));
         
           // add_action( 'wp_ajax_nopriv_vister_user', array( &$this, 'vister_user'));
           // add_action( 'wp_ajax_vister_user',  array( &$this, 'vister_user' ));
         
            add_filter('the_content', array( &$this, 'yourprefix_add_to_content'));
        }
        public static function plugin_url(){
                return plugin_dir_url( __FILE__ );

        }
        /**
         * Activate the plugin
         */
        public static function activate()
        {	
            add_option( 'memberfilter_plugin', 'installed' );
        } 
        /**
         * Deactivate the plugin
         */     
        static function deactivate()
        {
            delete_option( 'memberfilter_plugin');
        } 
         /**
         * Include Default Scripts and styles
         */  
        public function defaultfiles_plugin_enqueue()
        {
            wp_enqueue_script('jquery');

        }
        public function load_to_member_menu() {
            add_menu_page(
                'User History',
                'User History',
                'manage_options',
                'members-listes.php',
                array($this, 'plugin_setup_page') );
    }
    public function plugin_setup_page() {
		include_once( 'members-listes.php' );
    }
    function themeslug_enqueue_script() {
        wp_enqueue_script('my-js', plugin_dir_url( __FILE__ ) . '/jquery-ui.js');
        
        wp_enqueue_script('tabel-js', plugin_dir_url( __FILE__ ) . '/table2CSV.js');
    }
    function my_theme_enqueue_styles() {
       // wp_enqueue_style('js-style-ui', get_stylesheet_directory_uri() . '/jquery-ui.min.css');
    }
    public function forntjs()
    {
        wp_enqueue_script('custom-js', plugin_dir_url( __FILE__ ) . 'custom.js');
        wp_enqueue_script('ajax-script', plugin_dir_url(__FILE__) . 'js/ajax-auth-script.js', array('jquery'), $this->version, true);
        wp_enqueue_script('validate', plugin_dir_url(__FILE__) . 'js/jquery.validate.js', array('jquery'), $this->version, true);
        wp_localize_script('ajax-script', 'ajax_auth_object', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'redirecturl' => 'https://cloud.scorm.com/sc/InvitationConfirmEmail?publicInvitationId=50060c2a-c216-4314-860b-2e8b40e07fd5',
            'loadingmessage' => __('Sending user info, please wait...')
        ));
         //get user ip
         if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
         {
         $ip=$_SERVER['HTTP_CLIENT_IP'];
         }
         elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
         {
         $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
         }
         else
         {
         $ip=$_SERVER['REMOTE_ADDR'];
         }
        wp_localize_script('custom-js', 'ajax_user_object', array(
            'user_ip' => $ip,
            'cookies_ip' => $_COOKIE['userip'],
            'redirecturl' => 'https://cloud.scorm.com/sc/InvitationConfirmEmail?publicInvitationId=50060c2a-c216-4314-860b-2e8b40e07fd5',
        ));
    }
    function yourprefix_add_to_content( $content ) {

        if( is_single() && ! empty( $GLOBALS['post'] ) ) {
    
            if ( $GLOBALS['post']->ID == get_the_ID() ) {
                $postid = $GLOBALS['post']->ID;
                $content .= 'Your new content here'.$GLOBALS['post']->ID;
                
                $this->vister_user($postid);
            }
    
        }
    
        return $content;
    }
    

    public function vister_user($postid){
     
        global $wpdb;
        $table_name = $wpdb->prefix . "post_view";
        $post_id = $postid; 
        //get user ip
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
        $ip=$_SERVER['REMOTE_ADDR'];
        }
        $replicate = $wpdb->get_results( $wpdb->prepare(
            "SELECT * FROM `$table_name` WHERE postid = %d  AND userip = '". $ip."'", $post_id
        ) );
        $count = count($replicate);
        if($count === 0){
        $success = $wpdb->insert($table_name, array(
            "v_date" => date('Y-m-d H:m:s'),
            "postid" => $post_id,
            "view" => 1,
            "userip" => $ip
        ));
         }
        if($success){
              echo "done!";
            } else {
                echo "Nott done!";
            }
       
      }

 
    } // End Class
}

if(class_exists('memberfilter'))
{
    // instantiate the plugin class
	$memberfilter = new memberfilter();
	require plugin_dir_path( __FILE__ ). 'inc/db.php';
    register_activation_hook( __FILE__, 'user_record_table' );
    register_deactivation_hook(__FILE__, array('memberfilter', 'deactivate'));

}