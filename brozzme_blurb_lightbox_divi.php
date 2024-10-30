<?php

/*
Plugin Name: Brozzme Blurb Lightbox Module in Divi
Plugin URI: https://brozzme.com/
Description: Add the module Lightbox Blurb to Divi builder that makes image lighbox for blurb.
Version: 1.0
Author: Benoti
Author URI: https://brozzme.com

*/

class brozzme_blurb_lightbox_Module{

    public function __construct()
    {
        $this->basename			 = plugin_basename( __FILE__ );
        $this->directory_path    = plugin_dir_path( __FILE__ );
        $this->directory_url	 = plugins_url( dirname( $this->basename ) );

        $this->plugin_text_domain = 'brozzme-lightbox-blurb';

        $this->_define_constants();
        $this->_init();
      
        global $pagenow;

        $is_admin = is_admin();
        $action_hook = $is_admin ? 'wp_loaded' : 'wp';
        $required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
        $specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
        $is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
        $is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
        $is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import'];
        $is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];

        if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
            add_action($action_hook, array($this, 'Lightbox_Blurb_Modules'), 9789);
        }
        
        $debug = true;
        $old_version = '0.6';
        $current_version = '1.0';
        $slug = 'et_pb_lightbox_blurb';
        $version_option_name = 'brozzme_blurb_lightbox_version';

        if (is_admin()) {

            if ($old_version != $current_version) {
                $updated = true;
                update_option($version_option_name, $current_version); // Update the stored version number
            } else {
                $upgraded = true;
            }

        // Clear module from cache if necessary

            if ($debug or $upgraded) {
                add_action('admin_head', array($this, 'remove_from_local_storage'));
            }
        }
    }

    public function _define_constants(){
        defined('B7ELBD_TEXT_DOMAIN') or define('B7ELBD_TEXT_DOMAIN', $this->plugin_text_domain);
    }

    public function _plugin_action_links($links) {

        $links[] = '<a href="https://brozzme.com" target="_blank">More plugins by Brozzme</a>';

        return $links;
    }
    /**
     * for debugging or update only
     */
    public function remove_from_local_storage() {
        global $slug;
        echo "<script>localStorage.removeItem('et_pb_templates_".esc_attr($slug)."');</script>";
    }

    public function Lightbox_Blurb_Modules(){
        if(class_exists("ET_Builder_Module")){
             include($this->directory_path . 'includes/brozzme_blurb_lightbox_module.php');

        }

        wp_enqueue_style('brozzme-lightbox-blurb', $this->directory_url .'/css/brozzme_lightbox_blurb.css');
    }
    /**
     * Load Lightbox Blurb Module in page builder
     */
    public function _setup_lightbox_blurb_module() {
        if ( class_exists('ET_Builder_Module_Blurb')) {
            include_once $this->directory_path . 'includes/brozzme_blurb_lightbox_module.php';
            $blurb_module = new blurb_lightbox_ET_Builder();
            add_shortcode( 'et_pb_lightbox_blurb', array($blurb_module, '_shortcode_callback') );
        }
    }
    public function _init() {

        load_plugin_textdomain( $this->plugin_text_domain, false, dirname( $this->basename ) . '/languages' );

        add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, '_plugin_action_links' ) );


    }


}

new brozzme_blurb_lightbox_Module();