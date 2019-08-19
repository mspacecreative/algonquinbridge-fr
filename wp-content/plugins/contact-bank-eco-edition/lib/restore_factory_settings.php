<?php
global $wpdb;
require_once(ABSPATH . "wp-admin/includes/upgrade.php");
include CONTACT_BK_PLUGIN_DIR . "/lib/include_contact_roles_capabilies.php";
	switch($cb_role)
	{
		case "administrator":
			$cb_user_role_permission = "manage_options";
		break;
		case "editor":
			$cb_user_role_permission = "publish_pages";
		break;
		case "author":
			$cb_user_role_permission = "publish_posts";
		break;
		case "contributor":
			$cb_user_role_permission = "edit_posts";
		break;
		case "subscriber":
			$cb_user_role_permission = "read";
		break;
	}
if (!current_user_can($cb_user_role_permission))
{
	return;
}
else
{
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_contact_form() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_contact_form();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . create_control_Table() . '"')) != 0)
    {
		$sql = "DROP TABLE " .create_control_Table();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_dynamic_settings_form() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_dynamic_settings_form();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_email_template_admin() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_email_template_admin();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . frontend_controls_data_Table() . '"')) != 0)
    {
		$sql = "DROP TABLE " .frontend_controls_data_Table();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_frontend_forms_Table() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_frontend_forms_Table();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_form_settings_Table() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_form_settings_Table();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_layout_settings_Table() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_layout_settings_Table();
		$wpdb->query($sql);
	}
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_licensing() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_licensing();
		$wpdb->query($sql);
	}
	
	if (count($wpdb->get_var('SHOW TABLES LIKE "' . contact_bank_roles_capability() . '"')) != 0)
    {
		$sql = "DROP TABLE " .contact_bank_roles_capability();
		$wpdb->query($sql);
	}
	
	delete_option("contact-bank-version-number");
	
	include_once CONTACT_BK_PLUGIN_DIR ."/lib/install-script.php";
}
?>