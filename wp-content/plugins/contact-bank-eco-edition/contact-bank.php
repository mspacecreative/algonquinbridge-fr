<?php
/**
Plugin Name: Contact Bank Eco Edition
Plugin URI: http://tech-banker.com
Description: Build Complex, Powerful Contact Forms in Just Seconds. No Programming Knowledge Required! Yeah, It's Really That Easy.
Author: Tech Banker
Version: 2.2.15
Author URI: http://tech-banker.com
 */
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   D e f i n e     CONSTANTS //////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!defined("CONTACT_DEBUG_MODE"))    define("CONTACT_DEBUG_MODE",  false );
if (!defined("CONTACT_BK_FILE"))       define("CONTACT_BK_FILE",  __FILE__ );
if (!defined("CONTACT_CONTENT_DIR"))      define("CONTACT_CONTENT_DIR", ABSPATH . "wp-content");
if (!defined("CONTACT_CONTENT_URL"))      define("CONTACT_CONTENT_URL", site_url() . "/wp-content");
if (!defined("CONTACT_PLUGIN_DIR"))       define("CONTACT_PLUGIN_DIR", CONTACT_CONTENT_DIR . "/plugins");
if (!defined("CONTACT_PLUGIN_URL"))       define("CONTACT_PLUGIN_URL", CONTACT_CONTENT_URL . "/plugins");
if (!defined("CONTACT_BK_PLUGIN_FILENAME"))  define("CONTACT_BK_PLUGIN_FILENAME",  basename( __FILE__ ) );
if (!defined("CONTACT_BK_PLUGIN_DIRNAME"))   define("CONTACT_BK_PLUGIN_DIRNAME",  plugin_basename(dirname(__FILE__)) );
if (!defined("CONTACT_BK_PLUGIN_DIR")) define("CONTACT_BK_PLUGIN_DIR", CONTACT_PLUGIN_DIR."/".CONTACT_BK_PLUGIN_DIRNAME );
if (!defined("CONTACT_BK_PLUGIN_URL")) define("CONTACT_BK_PLUGIN_URL", site_url()."/wp-content/plugins/".CONTACT_BK_PLUGIN_DIRNAME );
if (!defined("CONTACT_BK_THUMB_URL")) define("CONTACT_BK_THUMB_URL", site_url() . "/wp-content/contact-bank/");
if (!defined("CONTACT_MAIN_DIR")) define("CONTACT_MAIN_DIR", ABSPATH . "wp-content/contact-bank");
if (!defined("CONTACT_MAIN_DIR_EMAIL")) define("CONTACT_MAIN_DIR_EMAIL", CONTACT_CONTENT_DIR . "/contact-bank/");
if (!defined("contact_bank")) define("contact_bank", "contact_bank");

if (!is_dir(CONTACT_MAIN_DIR))
{
	wp_mkdir_p(CONTACT_MAIN_DIR);
}
require_once(CONTACT_BK_PLUGIN_DIR."/plugin-updates/plugin-update-checker.php");
$MyUpdateChecker = new PluginUpdateChecker(
    'http://tech-banker.com/wp-content/plugins/gallery-bank-pro-edition-3.1/lib/update-eco-edition-contact-bank.json',
    __FILE__,
    'contact-bank-eco-edition'
);

// function plugin_uninstall_script_for_contact_bank()
// {
    // include_once CONTACT_BK_PLUGIN_DIR ."/lib/uninstall-script.php";
// }
/* Function Name : plugin_install_script_for_contact_bank
 * Paramters : None
 * Return : None
 * Description : This Function check the version number of the plugin database and performs necessary actions related to the plugin database upgrade.
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */
function plugin_install_script_for_contact_bank()
{
    if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/install-script.php"))
    {
        include_once CONTACT_BK_PLUGIN_DIR ."/lib/install-script.php";
    }
}
/* Function Name : create_global_menus_for_contact_bank
 * Paramters : None
 * Return : None
 * Description : This Function creates menus in the admin menu sidebar and related mention function in each menu are being called.
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */
function create_global_menus_for_contact_bank()
{
	include CONTACT_BK_PLUGIN_DIR . "/lib/include_contact_roles_capabilies.php";
	
	switch($cb_role)
	{
		case "administrator":
			if ($cb_admin_full_control == "0" && $cb_admin_read_control == "1" && $cb_admin_write_control == "0")
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			}
			elseif ($cb_admin_full_control == "0" && ($cb_admin_read_control == "1" || $cb_admin_write_control == "1"))
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
				add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
				add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
			else if ($cb_admin_full_control == "0" && $cb_admin_read_control == "0" && $cb_admin_write_control == "0")
			{
				
			}
			else
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
			    add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
			    add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
			    add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
			    add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
			    add_submenu_page("dashboard", "Global Settings", __("Global Settings", contact_bank), "read", "layout_settings", $contact_activation_status == $contact_api_key ? "layout_settings" : "licensing");
				add_submenu_page("dashboard", "Roles & Capabilities", __("Roles & Capabilities", contact_bank), "read", "roles_capability", $contact_activation_status == $contact_api_key ? "roles_capability" : "licensing");
			    add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
			    //add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			    add_submenu_page("dashboard", "Licensing", __("Licensing", contact_bank), "read", "licensing", "licensing");
			    add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
		break;
		case "editor":
			if ($cb_editor_full_control == "0" && $cb_editor_read_control == "1" && $cb_editor_write_control == "0") 
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			}
			elseif ($cb_editor_full_control == "0" && ($cb_editor_read_control == "1" || $cb_editor_write_control == "1"))
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
				add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
				add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
			else if ($cb_editor_full_control == "0" && $cb_editor_read_control == "0" && $cb_editor_write_control == "0")
			{
				
			}
			else
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
			    add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
			    add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
			    add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
			    add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
			    add_submenu_page("dashboard", "Global Settings", __("Global Settings", contact_bank), "read", "layout_settings", $contact_activation_status == $contact_api_key ? "layout_settings" : "licensing");
				add_submenu_page("dashboard", "Roles & Capabilities", __("Roles & Capabilities", contact_bank), "read", "roles_capability", $contact_activation_status == $contact_api_key ? "roles_capability" : "licensing");
			    add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
			   // add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			    add_submenu_page("dashboard", "Licensing", __("Licensing", contact_bank), "read", "licensing", "licensing");
			    add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
		break;
		case "author":
			if ($cb_author_full_control == "0" && $cb_author_read_control == "1" && $cb_author_write_control == "0") 
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			}
			elseif ($cb_author_full_control == "0" && ($cb_author_read_control == "1" || $cb_author_write_control == "1"))
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
				add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
				add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
			else if ($cb_author_full_control == "0" && $cb_author_read_control == "0" && $cb_author_write_control == "0")
			{
				
			}
			else
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
			    add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
			    add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
			    add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
			    add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
			    add_submenu_page("dashboard", "Global Settings", __("Global Settings", contact_bank), "read", "layout_settings", $contact_activation_status == $contact_api_key ? "layout_settings" : "licensing");
				add_submenu_page("dashboard", "Roles & Capabilities", __("Roles & Capabilities", contact_bank), "read", "roles_capability", $contact_activation_status == $contact_api_key ? "roles_capability" : "licensing");
			    add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
			   // add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			    add_submenu_page("dashboard", "Licensing", __("Licensing", contact_bank), "read", "licensing", "licensing");
			    add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
		break;
		case "contributor":
			if ($cb_contributor_full_control == "0" && $cb_contributor_read_control == "1" && $cb_contributor_write_control == "0")
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			}
			elseif ($cb_contributor_full_control == "0" && ($cb_contributor_read_control == "1" || $cb_contributor_write_control == "1"))
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
				add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
				add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
			else if ($cb_contributor_full_control == "0" && $cb_contributor_read_control == "0" && $cb_contributor_write_control == "0")
			{
				
			}
			else
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
			    add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
			    add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
			    add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
			    add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
			    add_submenu_page("dashboard", "Global Settings", __("Global Settings", contact_bank), "read", "layout_settings", $contact_activation_status == $contact_api_key ? "layout_settings" : "licensing");
				add_submenu_page("dashboard", "Roles & Capabilities", __("Roles & Capabilities", contact_bank), "read", "roles_capability", $contact_activation_status == $contact_api_key ? "roles_capability" : "licensing");
			    add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
			    //add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			    add_submenu_page("dashboard", "Licensing", __("Licensing", contact_bank), "read", "licensing", "licensing");
			    add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
		break;
		case "subscriber":
			if ($cb_subscriber_full_control == "0" && $cb_subscriber_read_control == "1" && $cb_subscriber_write_control == "0")
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			}
			elseif ($cb_subscriber_full_control == "0" && ($cb_subscriber_read_control == "1" || $cb_subscriber_write_control == "1"))
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
				add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
				add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
				add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
				add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
				add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
				//add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
				add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
			else if ($cb_subscriber_full_control == "0" && $cb_subscriber_read_control == "0" && $cb_subscriber_write_control == "0")
			{
				
			}
			else
			{
				add_menu_page("Contact Bank", __("Contact Bank", contact_bank), "read", "dashboard","",CONTACT_BK_PLUGIN_URL . "/assets/images/icon.png");
			    add_submenu_page("dashboard", "Dashboard", __("Dashboard", contact_bank), "read", "dashboard", $contact_activation_status == $contact_api_key ? "dashboard" : "licensing");
			    add_submenu_page("","","", "read", "contact_bank", $contact_activation_status == $contact_api_key ? "contact_bank" : "licensing");
			    add_submenu_page("dashboard", "Form Entries", __("Form Entries", contact_bank), "read", "frontend_data", $contact_activation_status == $contact_api_key ? "frontend_data" : "licensing");
			    add_submenu_page("dashboard", "Email Settings", __("Email Settings", contact_bank), "read", "contact_email", $contact_activation_status == $contact_api_key ? "contact_email" : "licensing");
			    add_submenu_page("dashboard", "Global Settings", __("Global Settings", contact_bank), "read", "layout_settings", $contact_activation_status == $contact_api_key ? "layout_settings" : "licensing");
				add_submenu_page("dashboard", "Roles & Capabilities", __("Roles & Capabilities", contact_bank), "read", "roles_capability", $contact_activation_status == $contact_api_key ? "roles_capability" : "licensing");
			    add_submenu_page("dashboard", "System Status", __("System Status", contact_bank), "read", "system_status", $contact_activation_status == $contact_api_key ? "system_status" : "licensing");
			    //add_submenu_page("dashboard", "Documentation", __("Documentation", contact_bank), "read", "documentation", $contact_activation_status == $contact_api_key ? "documentation" : "licensing");
			    add_submenu_page("dashboard", "Licensing", __("Licensing", contact_bank), "read", "licensing", "licensing");
			    add_submenu_page("","","", "read", "add_contact_email_settings", $contact_activation_status == $contact_api_key ? "add_contact_email_settings" : "licensing");
				add_submenu_page("","","", "read", "form_preview", $contact_activation_status == $contact_api_key ? "form_preview" : "licensing");
			}
		break;
	}
}
/* Function Name : contact_bank
 * Paramters : None
 * Return : None
 * Description : This Function used to linked menu page is requested.
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */
function contact_bank()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_view.php";
    include_once CONTACT_BK_PLUGIN_DIR . "/views/includes_common_after.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function dashboard()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/dashboard.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function edit_contact_view()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_view.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function contact_email()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_email_settings.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function frontend_data()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_frontend_data.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function documentation()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_documentation.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function add_contact_email_settings()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/add_contact_email.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function layout_settings()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_bank_layout_settings.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function roles_capability()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact-bank-roles_capability.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function system_status()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact-bank-system-report.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}

function licensing()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/licensing.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}
function form_preview()
{
    include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_bank_form_preview.php";
    include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
}


function backend_plugin_js_scripts_contact_bank()
{
    wp_enqueue_script("jquery");
    wp_enqueue_script("jquery-ui-sortable");
    wp_enqueue_script("jquery-ui-droppable");
    wp_enqueue_script("jquery-ui-draggable");
    wp_enqueue_script("farbtastic");
    wp_enqueue_script("jquery.dataTables.min", CONTACT_BK_PLUGIN_URL ."/assets/js/jquery.dataTables.min.js");
    wp_enqueue_script("jquery.validate.min", CONTACT_BK_PLUGIN_URL ."/assets/js/jquery.validate.min.js");
    wp_enqueue_script("jquery.Tooltip.js", CONTACT_BK_PLUGIN_URL ."/assets/js/jquery.Tooltip.js");
    wp_enqueue_script("bootstrap.js", CONTACT_BK_PLUGIN_URL ."/assets/js/bootstrap.js");
}
function frontend_plugin_js_scripts_contact_bank()
{
    wp_enqueue_script("jquery");
    wp_enqueue_script("jquery.Tooltip.js", CONTACT_BK_PLUGIN_URL ."/assets/js/jquery.Tooltip.js");
    wp_enqueue_script("jquery.validate.min", CONTACT_BK_PLUGIN_URL ."/assets/js/jquery.validate.min.js");
    wp_enqueue_script("plupload.full.min", CONTACT_BK_PLUGIN_URL ."/assets/js/plupload.full.min.js");

}
function backend_plugin_css_styles_contact_bank()
{
    wp_enqueue_style("farbtastic");
    wp_enqueue_style("stylesheet", CONTACT_BK_PLUGIN_URL ."/assets/css/stylesheet.css");
    wp_enqueue_style("font-awesome", CONTACT_BK_PLUGIN_URL ."/assets/css/font-awesome/css/font-awesome.css");
    wp_enqueue_style("system-message", CONTACT_BK_PLUGIN_URL ."/assets/css/system-message.css");
}
function frontend_plugin_css_styles_contact_bank()
{
    wp_enqueue_style("stylesheet", CONTACT_BK_PLUGIN_URL ."/assets/css/stylesheet.css");
    wp_enqueue_style("system-message", CONTACT_BK_PLUGIN_URL ."/assets/css/system-message.css");
}
if(isset($_REQUEST["action"]))
{
    switch($_REQUEST["action"])
    {
        case "add_contact_form_library":
            add_action( "admin_init", "add_contact_form_library");
            function add_contact_form_library()
            {
                include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_view-class.php";
            }
            break;
        case "frontend_contact_form_library":
            add_action( "admin_init", "frontend_contact_form_library");
            function frontend_contact_form_library()
            {
                include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_frontend-class.php";
            }
            break;
        case "email_contact_form_library":
            add_action( "admin_init", "email_contact_form_library");
            function email_contact_form_library()
            {
                include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_email-class.php";
            }
            break;
        case "email_management_contact_form_library":
            add_action( "admin_init", "email_management_contact_form_library");
            function email_management_contact_form_library()
            {
                include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_email_management.php";
            }
            break;
        case "frontend_data_contact_library":
            add_action( "admin_init", "frontend_data_contact_library");
            function frontend_data_contact_library()
            {
                include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_frontend_data_class.php";
            }
            break;
        case "layout_settings_contact_library":
            add_action( "admin_init", "layout_settings_contact_library");
            function layout_settings_contact_library()
            {
                include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_layout_settings-class.php";
            }
            break;
		case "show_form_control_data_contact_library":
            add_action( "admin_init", "show_form_control_data_contact_library");
            function show_form_control_data_contact_library()
            {
                include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_show_form_control_data-class.php";
            }
            break;
    }
}
/*
 * Description : THESE FUNCTIONS USED FOR REPLACING TABLE NAMES
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */
function contact_bank_contact_form()
{
    global $wpdb;
    return $wpdb->prefix . "cb_contact_form";
}
function contact_bank_dynamic_settings_form()
{
    global $wpdb;
    return $wpdb->prefix . "cb_dynamic_settings";
}
function create_control_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_create_control_form";
}
function frontend_controls_data_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_frontend_data_table";
}
function contact_bank_email_template_admin()
{
    global $wpdb;
    return $wpdb->prefix . "cb_email_template_admin";
}
function contact_bank_frontend_forms_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_frontend_forms_table";
}
function contact_bank_form_settings_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_form_settings_table";
}
function contact_bank_layout_settings_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_layout_settings_table";
}
function contact_bank_licensing()
{
    global $wpdb;
    return $wpdb->prefix . "cb_licensing";
}
function contact_bank_roles_capability()
{
    global $wpdb;
    return $wpdb->prefix . "cb_roles_capability";
}

function contact_bank_short_code($atts)
{
    extract(shortcode_atts(array(
        "form_id" => "",
        "show_title" => "",
    ), $atts));
    return extract_short_code($form_id,$show_title);
}
function extract_short_code($form_id,$show_title)
{
    ob_start();
    require CONTACT_BK_PLUGIN_DIR."/frontend_views/contact_bank_forms.php";
    $contact_bank_output = ob_get_clean();
    wp_reset_query();
    return $contact_bank_output;
}
if (!wp_next_scheduled("ContactBankUpdation"))
{
	wp_schedule_event(time(), "daily", "ContactBankUpdation");
}
add_action("ContactBankUpdation", "contact_bank_updation_check");
function contact_bank_updation_check()
{
	global $wpdb;
	$cb_updation_keys = $wpdb->get_row
	(
	    "SELECT * FROM " . contact_bank_licensing()
	);
	$url = get_option("contact-bank-updation-check-url");
	$response = wp_remote_post($url, array
		(
			"method" => "POST",
			"timeout" => 45,
			"redirection" => 5,
			"httpversion" => "1.0",
			"blocking" => true,
			"headers" => array(),
			"body" => array( "ux_product_key" => "17167", "ux_domain" => $cb_updation_keys->url, "ux_order_id" => $cb_updation_keys->order_id, "ux_api_key"=>$cb_updation_keys->api_key,"param"=>"check_license","action"=>"license_validator")
		)
	);
	if ( is_wp_error( $response ) )
	{
		delete_option("contact-bank-activation");
	}
	else
	{
		$response["body"] == "" ? update_option("contact-bank-activation",$cb_updation_keys->api_key) : delete_option("contact-bank-activation");
	}
}

function add_contact_bank_icon($meta = TRUE)
{
    global $wp_admin_bar;
    if ( !is_user_logged_in() ) { return; }
	include CONTACT_BK_PLUGIN_DIR . "/lib/include_contact_roles_capabilies.php";
	switch ($cb_role) {
		case "administrator":
			if ($cb_admin_full_control == "0" && $cb_admin_read_control == "1" && $cb_admin_write_control == "0")
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
				
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
				 // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
				
			}
			elseif ($cb_admin_full_control == "0" && ($cb_admin_read_control == "1" || $cb_admin_write_control == "1")) 
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			}
			else if ($cb_admin_full_control == "0" && $cb_admin_read_control == "0" && $cb_admin_write_control == "0")
			{
				
			}
			else 
			{
				$wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "form_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=layout_settings",
			        "title" => __( "Global Settings", contact_bank))         /* set the sub-menu name */
			    );	
			     $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "roles_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=roles_capability",
			        "title" => __( "Roles & Capabilities", contact_bank))         /* set the sub-menu name */
			    );
			   
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "licensing_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=licensing",
			        "title" => __( "Licensing", contact_bank))         /* set the sub-menu name */
			    );
			}
		break;
		case "editor":
			if ($cb_editor_full_control == "0" && $cb_editor_read_control == "1" && $cb_editor_write_control == "0")
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
				
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
				 // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
				
			}
			elseif ($cb_editor_full_control == "0" && ($cb_editor_read_control == "1" || $cb_editor_write_control == "1")) 
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			}
			else if ($cb_editor_full_control == "0" && $cb_editor_read_control == "0" && $cb_editor_write_control == "0")
			{
				
			}
			else 
			{
				$wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "form_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=layout_settings",
			        "title" => __( "Global Settings", contact_bank))         /* set the sub-menu name */
			    );	
			     $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "roles_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=roles_capability",
			        "title" => __( "Roles & Capabilities", contact_bank))         /* set the sub-menu name */
			    );
			   
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "licensing_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=licensing",
			        "title" => __( "Licensing", contact_bank))         /* set the sub-menu name */
			    );
			}
		break;
		case "author":
		if ($cb_author_full_control == "0" && $cb_author_read_control == "1" && $cb_author_write_control == "0")
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
				
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
				 // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
				
			}
			elseif ($cb_author_full_control == "0" && ($cb_author_read_control == "1" || $cb_author_write_control == "1")) 
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			}
			else if ($cb_author_full_control == "0" && $cb_author_read_control == "0" && $cb_author_write_control == "0")
			{
				
			}
			else 
			{
				$wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "form_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=layout_settings",
			        "title" => __( "Global Settings", contact_bank))         /* set the sub-menu name */
			    );	
			     $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "roles_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=roles_capability",
			        "title" => __( "Roles & Capabilities", contact_bank))         /* set the sub-menu name */
			    );
			   
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "licensing_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=licensing",
			        "title" => __( "Licensing", contact_bank))         /* set the sub-menu name */
			    );
			}
		break;
		case "contributor":
			if ($cb_contributor_full_control == "0" && $cb_contributor_read_control == "1" && $cb_contributor_write_control == "0")
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
				
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
				 // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			}
			elseif ($cb_contributor_full_control == "0" && ($cb_contributor_read_control == "1" || $cb_contributor_write_control == "1")) 
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			}
			else if ($cb_contributor_full_control == "0" && $cb_contributor_read_control == "0" && $cb_contributor_write_control == "0")
			{
				
			}
			else 
			{
				$wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "form_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=layout_settings",
			        "title" => __( "Global Settings", contact_bank))         /* set the sub-menu name */
			    );	
			     $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "roles_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=roles_capability",
			        "title" => __( "Roles & Capabilities", contact_bank))         /* set the sub-menu name */
			    );
			   
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "licensing_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=licensing",
			        "title" => __( "Licensing", contact_bank))         /* set the sub-menu name */
			    );
			}
		break;
		case "subscriber":
			if ($cb_subscriber_full_control == "0" && $cb_subscriber_read_control == "1" && $cb_subscriber_write_control == "0")
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
				
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
				 // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
				
			}
			elseif ($cb_subscriber_full_control == "0" && ($cb_subscriber_read_control == "1" || $cb_subscriber_write_control == "1")) 
			{
				 $wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
				$wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			}
			else if ($cb_subscriber_full_control == "0" && $cb_subscriber_read_control == "0" && $cb_subscriber_write_control == "0")
			{
				
			}
			else 
			{
				$wp_admin_bar->add_menu( array(
			        "id" => "contact_bank_links",
			        "title" =>  "<img src=\"".CONTACT_BK_PLUGIN_URL."/assets/images/icon.png\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
			        "href" => site_url() ."/wp-admin/admin.php?page=dashboard",
			    ) );
			
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "dashboard_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=dashboard",
			        "title" => __( "Dashboard", contact_bank) )         /* set the sub-menu name */
			    );
			   $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "frontend_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=frontend_data",
			        "title" => __( "Form Entries", contact_bank))         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "email_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
			        "title" => __( "Email Settings", contact_bank) )         /* set the sub-menu name */
			    );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "form_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=layout_settings",
			        "title" => __( "Global Settings", contact_bank))         /* set the sub-menu name */
			    );	
			     $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "roles_settings_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=roles_capability",
			        "title" => __( "Roles & Capabilities", contact_bank))         /* set the sub-menu name */
			    );
			   
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "system_status_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=system_status",
			        "title" => __( "System Status", contact_bank))         /* set the sub-menu name */
			    );
			
			    // $wp_admin_bar->add_menu( array(
			        // "parent" => "contact_bank_links",
			        // "id"     => "documents_data_links",
			        // "href"  => site_url() ."/wp-admin/admin.php?page=documentation",
			        // "title" => __( "Documentation", contact_bank))         /* set the sub-menu name */
			    // );
			    $wp_admin_bar->add_menu( array(
			        "parent" => "contact_bank_links",
			        "id"     => "licensing_data_links",
			        "href"  => site_url() ."/wp-admin/admin.php?page=licensing",
			        "title" => __( "Licensing", contact_bank))         /* set the sub-menu name */
			    );
			}
		break;
			
	}
}
add_action( "media_buttons_context", "add_contact_shortcode_button", 1);
function add_contact_shortcode_button($context) {
    add_thickbox();
    $context .= "<a href=\"#TB_inline?width=300&height=400&inlineId=contact-bank\"  class=\"button thickbox\"  title=\"" . __("Add Contact Bank Form", contact_bank) . "\">
    <span class=\"contact_icon\"></span> Add Contact Bank Form</a>";
    return $context;
}
add_action("admin_footer","add_contact_mce_popup");

function add_contact_mce_popup(){
	?>
	<?php add_thickbox(); ?>
	<div id="contact-bank" style="display:none;">
		<div class="fluid-layout responsive">
			<div style="padding:20px 0 10px 15px;">
			    <h3 class="label-shortcode"><?php _e("Insert Contact Bank Form", contact_bank); ?></h3>
					<span>
						<i><?php _e("Select a form below to add it to your post or page.", contact_bank); ?></i>
					</span>
			</div>
			<div class="layout-span12 responsive" style="padding:15px 15px 0 0;">
				<div class="layout-control-group">
					<label class="custom-layout-label" for="ux_form_name"><?php _e("Form Name", contact_bank); ?> : </label>
					<select id="add_contact_form_id" class="layout-span9">
						<option value="0"><?php _e("Select a Form", contact_bank); ?>  </option>
						<?php
						global $wpdb;
						$forms = $wpdb->get_results
						(
							"SELECT * FROM " .contact_bank_contact_form()
						);
						for($flag = 0;$flag<count($forms);$flag++)
						{
							?>
							<option value="<?php echo intval($forms[$flag]->form_id); ?>"><?php echo esc_html($forms[$flag]->form_name) ?></option>
						<?php
						}
						?>
					</select>
				</div>
				<div class="layout-control-group">
					<label class="custom-layout-label"><?php _e("Show Form Title", contact_bank); ?> : </label>
					<input type="checkbox" checked="checked" name="ux_form_title" id="ux_form_title"/>
				</div>
				<div class="layout-control-group">
					<label class="custom-layout-label"></label>
					<input type="button" class="button-primary" value="<?php _e("Insert Form", contact_bank); ?>"
						onclick="Insert_Contact_Form();"/>&nbsp;&nbsp;&nbsp;
					<a class="button" style="color:#bbb;" href="#"
						onclick="tb_remove(); return false;"><?php _e("Cancel", contact_bank); ?></a>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function Insert_Contact_Form()
		{
			var form_id = jQuery("#add_contact_form_id").val();
			var show_title = jQuery("#ux_form_title").prop("checked");
			if(form_id == 0)
			{
			    alert("<?php _e("Please choose a Form to insert into Shortcode", contact_bank) ?>");
			    return;
			}
			window.send_to_editor("[contact_bank form_id=" + form_id + " show_title=" + show_title +" ]");
		}
	</script>
<?php
}
function contact_bank_enqueue_pointer_script_style()
{

    $enqueue_pointer_script_style = false;
    $dismissed_pointers = explode( ",", get_user_meta( get_current_user_id(), "dismissed_wp_pointers", true ) );

    // Check if our pointer is not among dismissed ones
    if( !in_array( "thsp_contact_bank_pointer", $dismissed_pointers))
    {
        $enqueue_pointer_script_style = true;
        // Add footer scripts using callback function
        add_action( "admin_print_footer_scripts", "thsp_pointer_print_scripts" );
    }
    if( $enqueue_pointer_script_style )
    {
        wp_enqueue_style( "wp-pointer" );
        wp_enqueue_script( "wp-pointer" );
    }
}
add_action( "admin_enqueue_scripts", "contact_bank_enqueue_pointer_script_style" );

function thsp_pointer_print_scripts() {

    $pointer_content  = "<h3>Contact Bank</h3>";
    $pointer_content .= "<p>If you are using Contact Bank for the first time, you can view this <a href=http://www.youtube.com/embed/EcqbsXmPbaI target=_blank>video</a> to setup the Plugin.</p>";
    ?>
    <script type="text/javascript">
        //<![CDATA[
        jQuery(document).ready( function($) {
            $("#toplevel_page_dashboard").pointer({
                content:"<?php echo $pointer_content; ?>",
                position:{
                    edge:   "left", // arrow direction
                    align:  "center" // vertical alignment
                },
                pointerWidth: 350,
                close:function() {
                    $.post(ajaxurl, {
                        pointer: "thsp_contact_bank_pointer", // pointer ID
                        action: "dismiss-wp-pointer"
                    });
                }
            }).pointer("open");
        });
        //]]>
    </script>
<?php
}
function plugin_load_textdomain()
{
    if(function_exists( "load_plugin_textdomain" ))
    {
        load_plugin_textdomain(contact_bank, false, CONTACT_BK_PLUGIN_DIRNAME ."/languages");
    }
}
add_action("plugins_loaded", "plugin_load_textdomain");
$version = get_option("contact-bank-version-number");
if($version != "")
{
	add_action('admin_init', 'plugin_install_script_for_contact_bank');
}
/*************************************************************************************/
add_action("admin_bar_menu", "add_contact_bank_icon",100);
// add_action Hook called for function frontend_plugin_css_scripts_contact_bank
add_action("init","frontend_plugin_css_styles_contact_bank");
// add_action Hook called for function backend_plugin_css_scripts_contact_bank
add_action("admin_init","backend_plugin_css_styles_contact_bank");
// add_action Hook called for function frontend_plugin_js_scripts_contact_bank
add_action("init","frontend_plugin_js_scripts_contact_bank");
// add_action Hook called for function backend_plugin_js_scripts_contact_bank
add_action("admin_init","backend_plugin_js_scripts_contact_bank");
// add_action Hook called for function create_global_menus_for_contact_bank
add_action("admin_menu","create_global_menus_for_contact_bank");
// Activation Hook called for function plugin_install_script_for_contact_bank
register_activation_hook(__FILE__,"plugin_install_script_for_contact_bank");
// add_Shortcode Hook called for function contact_bank_short_code for FrontEnd
add_shortcode("contact_bank", "contact_bank_short_code");
// Uninstall Hook called for function plugin_install_script_for_contact_bank
register_uninstall_hook(__FILE__,"plugin_uninstall_script_for_contact_bank");
add_filter("widget_text", "do_shortcode");
class Contact_Bank_Widget extends WP_Widget
{
    function Contact_Bank_Widget()
    {
        $widget_ops = array("classname" => "Contact_Bank_Widget", "description" => "Uses Contact Form" );
        $this->WP_Widget("Contact_Bank_Widget", "Contact Bank", $widget_ops);
    }
    function form($instance)
    {
        $instance = wp_parse_args((array) $instance, array( "title" => "", "form_id" => "0" ) );
        $title = $instance["title"];
        global $wpdb;
        $form_data = $wpdb->get_results
            (
                "SELECT * FROM " .contact_bank_contact_form()
            );
        ?>
        <p><label for="<?php echo $this->get_field_id("title"); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
        <p><label for="<?php echo $this->get_field_id("form_id"); ?>"><?php _e("Select Form :", contact_bank); ?></label>
            <select size="1" name="<?php echo $this->get_field_name("form_id"); ?>" id="<?php echo $this->get_field_id("form_id"); ?>" class="widefat">
                <option value="0"  ><?php _e("Select Form", contact_bank); ?></option>
                <?php
                if($form_data) {
                    foreach($form_data as $form)
                    {
                        echo "<option value=\"".$form->form_id."\">". stripslashes(html_entity_decode($form->form_name)) . "</option>";
                    }
                }
                ?>
            </select>
        </p>
    <?php
    }
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance["title"] = $new_instance["title"];
        $instance["form_id"] = (int) $new_instance["form_id"];
        return $instance;
    }
    function widget($args, $instance)
    {
        global $wpdb;
        $form_data = $wpdb->get_var
            (
                $wpdb->prepare
                    (
                        "SELECT count(*) FROM " .contact_bank_contact_form() . " WHERE form_id = %d",
                        $instance["form_id"]
                    )
            );

        extract($args, EXTR_SKIP);
        echo $before_widget;
        $title = empty($instance["title"]) ? " " : apply_filters("widget_title", $instance["title"]);
        if($form_data > 0)
        {
            if($instance["form_id"] != 0)
            {
                echo $before_title . $title . $after_title;
                $shortcode_for_contact_bank_form = "[contact_bank form_id=" . $instance["form_id"] . "]";
                echo do_shortcode( $shortcode_for_contact_bank_form );
                echo $after_widget;
            }
        }
    }
}
add_action( "widgets_init", create_function("", "return register_widget(\"Contact_Bank_Widget\");") );
?>