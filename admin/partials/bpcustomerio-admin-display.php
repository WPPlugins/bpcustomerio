<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.multidots.com
 * @since      1.0.0
 *
 * @package    Bpcustomerio
 * @subpackage Bpcustomerio/admin/partials
 */
class Bpcustomerio_Admin_Display {

	public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_settings_menu'));
    }
	
public static function add_settings_menu(){
  		 add_menu_page('BP Customer IO', 'BP Customer IO', 'manage_options', 'bpcustomerio', array(__CLASS__,'bpcustomeriogeneral_setting'));
	}
 
	public static function bpcustomeriogeneral_setting_fields(){ 
		
			global $wpdb;  
			$current_user = wp_get_current_user();
			if (!get_option('abc_plugin_notice_shown')) {
			 echo '<div id="abc_dialog" title="Basic dialog"><p>Subscribe for latest plugin update and get notified when we update our plugin and launch new products for free! </p> <p><input type="text" id="txt_user_sub_abc" class="regular-text" name="txt_user_sub_abc" value="'.$current_user->user_email.'"></p></div>';
			}
			
	    $fields[] = array(
			'title' => __('Analytics for BuddyPress by Customer.io', 'bpcustomerio'),
			'type' => 'title',
			'id' => 'general_options_setting'
		);
		$fields[] = array(
			'title' => __('Enable Option', 'bpcustomerio'),
			'id' => 'bpcustomerio_enable',
			'type' => 'checkbox',
			'label' => __('Enable Option', 'bpcustomerio'),
			'default' => 'no',
			'class'=>'regular-text',
		);
		$fields[] = array(
			'title' => __('Enable Profile Not Completed Event', 'bpcustomerio'),
			'id' => 'bpcustomerio_pnce',
			'type' => 'checkbox',
			'label' => __('Enable Option', 'bpcustomerio'),
			'default' => 'no',
			'class'=>'regular-text',
		);
		
		$fields[] = array(
			'title' => __('Site ID', 'bpcustomerio'),
			'id' => 'bpcustomerio_site_id',
			'type' => 'text',
			'label' => __('Enter Site ID', 'bpcustomerio'),
			'default' => '',
			'class'=>'regular-text',
		);

		$fields[] = array(
			'title' => __('API Key', 'bpcustomerio'),
			'id' => 'bpcustomerio_appid',
			'type' => 'text',
			'label' => __('Enter API Key', 'bpcustomerio'),
			'default' => '',
			'class'=>'regular-text',
		);
		
		
		
			

		$fields[] = array('type' => 'sectionend', 'id' => 'general_options_setting');
		return $fields;
	}
	
	public static function bpcustomeriogeneral_setting() {
		$genral_setting_fields = self::bpcustomeriogeneral_setting_fields();
		$Html_output = new Bpcustomerio_Html_output();
		$Html_output->save_fields($genral_setting_fields);
		if (isset($_POST['bpcustomerio_intigration'])):
            ?>
            <div id="setting-error-settings_updated" class="updated settings-error"> 
                <p><?php echo '<strong>' . __('Settings were saved successfully.', 'bpcustomerio') . '</strong>'; ?></p></div>

            <?php
            endif;

        if( !in_array( 'buddypress/bp-loader.php',apply_filters('active_plugins',get_option('active_plugins')))) {?>  
               
                <div class="error"><p><?php echo '<strong>' . __('Buddypress needs to be activated.', 'bpcustomerio') . '</strong>'; ?></p> </div>  
		<?php }else {?>
        <div class="div_general_settings">
        <div class="div_log_settings">
	        <form id="bpcustomerio_integration_form_general" enctype="multipart/form-data" action="" method="post">
	            <?php $Html_output->init($genral_setting_fields); ?>
	            <p class="submit">
	                <input type="submit" name="bpcustomerio_intigration" class="button-primary" value="<?php esc_attr_e('Save Settings', 'Option'); ?>" />
	            </p>
	        </form>
        </div><?php 

		}
	}
	
}
Bpcustomerio_Admin_Display::init();