<?php
global $current_user, $wpdb;
$cb_role = $wpdb->prefix . "capabilities";
$current_user->role = array_keys($current_user->$cb_role);
$cb_role = $current_user->role[0];
	
$contact_api_key = $wpdb->get_var
(
    $wpdb->prepare
    (
        "SELECT api_key FROM " . contact_bank_licensing()." WHERE licensing_id = %d",
        1
    )
);
$roles_capabilities = $wpdb->get_results
(
   "SELECT * FROM " . contact_bank_roles_capability() 
);
if (count($roles_capabilities) != 0) {
	$setting_keys = array();
    for ($flag = 0; $flag < count($roles_capabilities); $flag++) {
        array_push($setting_keys, $roles_capabilities[$flag]->roles_capability_key);
    }
	$index = array_search("admin_full_control", $setting_keys);
    $cb_admin_full_control = intval($roles_capabilities[$index]->roles_capability_value);

    $index = array_search("admin_read_control", $setting_keys);
    $cb_admin_read_control = intval($roles_capabilities[$index]->roles_capability_value);

    $index = array_search("admin_write_control", $setting_keys);
    $cb_admin_write_control = intval($roles_capabilities[$index]->roles_capability_value);

    $index = array_search("editor_full_control", $setting_keys);
    $cb_editor_full_control = doubleval($roles_capabilities[$index]->roles_capability_value);

    $index = array_search("editor_read_control", $setting_keys);
    $cb_editor_read_control = intval($roles_capabilities[$index]->roles_capability_value);

    $index = array_search("editor_write_control", $setting_keys);
    $cb_editor_write_control = intval($roles_capabilities[$index]->roles_capability_value);

	$contact_bank_activation_status = get_option("contact-bank-activation");
	$contact_activation_status = ($contact_bank_activation_status == "" ? "404" : $contact_bank_activation_status);
	//$contact_activation_status = "admin";

    $index = array_search("author_full_control", $setting_keys);
    $cb_author_full_control = $roles_capabilities[$index]->roles_capability_value;

    $index = array_search("author_read_control", $setting_keys);
    $cb_author_read_control = intval($roles_capabilities[$index]->roles_capability_value);

    $index = array_search("author_write_control", $setting_keys);
    $cb_author_write_control = $roles_capabilities[$index]->roles_capability_value;

    $index = array_search("contributor_full_control", $setting_keys);
    $cb_contributor_full_control = $roles_capabilities[$index]->roles_capability_value;
	
	$index = array_search("contributor_read_control", $setting_keys);
    $cb_contributor_read_control = $roles_capabilities[$index]->roles_capability_value;
	
	$index = array_search("contributor_write_control", $setting_keys);
    $cb_contributor_write_control = $roles_capabilities[$index]->roles_capability_value;
	
	$index = array_search("subscriber_full_control", $setting_keys);
    $cb_subscriber_full_control = $roles_capabilities[$index]->roles_capability_value;
	
	$index = array_search("subscriber_read_control", $setting_keys);
    $cb_subscriber_read_control = $roles_capabilities[$index]->roles_capability_value;
	
	$index = array_search("subscriber_write_control", $setting_keys);
    $cb_subscriber_write_control = $roles_capabilities[$index]->roles_capability_value;
}
?>