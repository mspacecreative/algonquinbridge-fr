<?php
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
	if(isset($_REQUEST["param"]))
	{
		if($_REQUEST["param"] == "submit_form_settings")
		{
            $form_id = intval($_REQUEST["form_id"]);
			$settings = array();
			$settings["label_setting_font_family"] = isset($_REQUEST["ux_ddl_font_family"]) ? esc_attr($_REQUEST["ux_ddl_font_family"]): "inherit"; 
			$settings["label_setting_font_color"] = isset($_REQUEST["ux_clr_font_color"]) ? esc_attr($_REQUEST["ux_clr_font_color"]): "#000000"; 
			$settings["label_setting_font_style"] = isset($_REQUEST["ux_ddl_font_style"]) ? esc_attr($_REQUEST["ux_ddl_font_style"]): "normal";
			$settings["label_setting_font_size"] = isset($_REQUEST["ux_txt_font_size"]) ? esc_attr($_REQUEST["ux_txt_font_size"]): "16";
			$settings["label_setting_font_align_left"] = isset($_REQUEST["ux_rdl_font_align"]) ? intval($_REQUEST["ux_rdl_font_align"]): "0";
			$settings["label_setting_label_position"] = isset($_REQUEST["ux_ddl_label_position"]) ? esc_attr($_REQUEST["ux_ddl_label_position"]): "top";
			$settings["label_setting_field_size"] = isset($_REQUEST["ux_ddl_field_size"]) ? esc_attr($_REQUEST["ux_ddl_field_size"]): "11";
			$settings["label_setting_field_align"] = isset($_REQUEST["ux_ddl_field_align"]) ? esc_attr($_REQUEST["ux_ddl_field_align"]): "left";
			$settings["label_setting_hide_label"] = isset($_REQUEST["ux_chk_hide_label"]) ? esc_attr($_REQUEST["ux_chk_hide_label"]): "0";
			$settings["label_setting_text_direction"] = isset($_REQUEST["ux_ddl_direction"]) ? esc_attr($_REQUEST["ux_ddl_direction"]): "inherit";
			
			$settings["input_field_font_family"] = isset($_REQUEST["ux_ddl_font_family_input_field"]) ? esc_attr($_REQUEST["ux_ddl_font_family_input_field"]): "inherit";
			$settings["input_field_font_color"] = isset($_REQUEST["ux_clr_text_color_input_field"]) ? esc_attr($_REQUEST["ux_clr_text_color_input_field"]): "#000000";
			$settings["input_field_font_style"] = isset($_REQUEST["ux_ddl_font_style_input_field"]) ? esc_attr($_REQUEST["ux_ddl_font_style_input_field"]): "normal";
			$settings["input_field_font_size"] = isset($_REQUEST["ux_txt_font_size_input_field"]) ? esc_attr($_REQUEST["ux_txt_font_size_input_field"]): "14";
			$settings["input_field_border_radius"] = isset($_REQUEST["ux_txt_border_radius_input_field"]) ? esc_attr($_REQUEST["ux_txt_border_radius_input_field"]): "0";
			$settings["input_field_border_color"] = isset($_REQUEST["ux_clr_border_color_input_field"]) ? esc_attr($_REQUEST["ux_clr_border_color_input_field"]): "#e5e5e5";
			$settings["input_field_border_size"] = isset($_REQUEST["ux_txt_border_size_input_field"]) ? esc_attr($_REQUEST["ux_txt_border_size_input_field"]): "1";
			$settings["input_field_border_style"] = isset($_REQUEST["ux_ddl_border_style_input_field"]) ? esc_attr($_REQUEST["ux_ddl_border_style_input_field"]): "solid";
			$settings["input_field_clr_bg_color"] = isset($_REQUEST["ux_clr_bg_color_input_field"]) ? esc_attr($_REQUEST["ux_clr_bg_color_input_field"]): "#ffffff";
			$settings["input_field_rdl_multiple_row"] = isset($_REQUEST["ux_rdl_radio_button"]) ? intval($_REQUEST["ux_rdl_radio_button"]): "1";
			$settings["input_field_rdl_text_align"] = isset($_REQUEST["ux_rdl_font_align_input_field"]) ? intval($_REQUEST["ux_rdl_font_align_input_field"]): "0";
			$settings["input_field_text_direction"] = isset($_REQUEST["ux_ddl_input_field_direction"]) ? esc_attr($_REQUEST["ux_ddl_input_field_direction"]): "inherit";
			$settings["input_field_input_size"] = isset($_REQUEST["ux_input_size_input_field"]) ? esc_attr($_REQUEST["ux_input_size_input_field"]): "layout-span6";
			
			$settings["submit_button_font_family"] = isset($_REQUEST["ux_ddl_font_family_submit_button"]) ? esc_attr($_REQUEST["ux_ddl_font_family_submit_button"]): "inherit";
			$settings["submit_button_text"] = isset($_REQUEST["ux_txt_text_submit_button"]) ? esc_attr($_REQUEST["ux_txt_text_submit_button"]): "Save ";
			$settings["submit_button_font_style"] = isset($_REQUEST["ux_ddl_font_style_submit_button"]) ? esc_attr($_REQUEST["ux_ddl_font_style_submit_button"]): "normal";
			$settings["submit_button_font_size"] = isset($_REQUEST["ux_ddl_font_size_submit_button"]) ? esc_attr($_REQUEST["ux_ddl_font_size_submit_button"]): "12";
			$settings["submit_button_button_width"] = isset($_REQUEST["ux_txt_button_width_submit_button"]) ? esc_attr($_REQUEST["ux_txt_button_width_submit_button"]): "100";
			$settings["submit_button_bg_color"] = isset($_REQUEST["ux_clr_bg_color_submit_button"]) ? esc_attr($_REQUEST["ux_clr_bg_color_submit_button"]): "#24890d";
			$settings["submit_button_hover_bg_color"] = isset($_REQUEST["ux_clr_hover_bg_color_submit_button"]) ? esc_attr($_REQUEST["ux_clr_hover_bg_color_submit_button"]): "#3dd41a";
			$settings["submit_button_text_color"] = isset($_REQUEST["ux_clr_text_color_submit_button"]) ? esc_attr($_REQUEST["ux_clr_text_color_submit_button"]): "#ffffff";
			$settings["submit_button_border_color"] = isset($_REQUEST["ux_clr_border_color_submit_button"]) ? esc_attr($_REQUEST["ux_clr_border_color_submit_button"]): "#000000";
			$settings["submit_button_border_size"] = isset($_REQUEST["ux_clr_border_size_submit_button"]) ? esc_attr($_REQUEST["ux_clr_border_size_submit_button"]): "0";
			$settings["submit_button_border_radius"] = isset($_REQUEST["ux_txt_border_radius_submit_button"]) ? esc_attr($_REQUEST["ux_txt_border_radius_submit_button"]): "0";
			$settings["submit_button_rdl_text_align"] = isset($_REQUEST["ux_rdl_font_align_submit_button"]) ? intval($_REQUEST["ux_rdl_font_align_submit_button"]): "0";
			$settings["submit_button_text_direction"] = isset($_REQUEST["ux_ddl_submit_button_direction"]) ? esc_attr($_REQUEST["ux_ddl_submit_button_direction"]): "inherit";
			
			$settings["success_msg_font_family"] = isset($_REQUEST["ux_ddl_font_family_success_msg"]) ? esc_attr($_REQUEST["ux_ddl_font_family_success_msg"]): "inherit";
			$settings["success_msg_font_size"] = isset($_REQUEST["ux_ddl_font_size_success_msg"]) ? esc_attr($_REQUEST["ux_ddl_font_size_success_msg"]): "12";
			$settings["success_msg_bg_color"] = isset($_REQUEST["ux_clr_bg_color_success_msg"]) ? esc_attr($_REQUEST["ux_clr_bg_color_success_msg"]): "#e5ffd5";
			$settings["success_msg_border_color"] = isset($_REQUEST["ux_clr_border_color_success_msg"]) ? esc_attr($_REQUEST["ux_clr_border_color_success_msg"]): "#e5ffd5";
			$settings["success_msg_text_color"] = isset($_REQUEST["ux_clr_text_color_success_msg"]) ? esc_attr($_REQUEST["ux_clr_text_color_success_msg"]): "#6aa500";
			$settings["success_msg_rdl_text_align"] = isset($_REQUEST["ux_rdl_font_align_success_msg"]) ? intval($_REQUEST["ux_rdl_font_align_success_msg"]): "0";
			$settings["success_msg_text_direction"] = isset($_REQUEST["ux_ddl_success_msg_direction"]) ? esc_attr($_REQUEST["ux_ddl_success_msg_direction"]): "inherit";
			
			$settings["error_msg_font_family"] = isset($_REQUEST["ux_ddl_font_family_error_msg"]) ? esc_attr($_REQUEST["ux_ddl_font_family_error_msg"]): "inherit";
			$settings["error_msg_font_size"] = isset($_REQUEST["ux_ddl_font_size_error_msg"]) ? esc_attr($_REQUEST["ux_ddl_font_size_error_msg"]): "12";
			$settings["error_msg_bg_color"] = isset($_REQUEST["ux_clr_bg_color_error_msg"]) ? esc_attr($_REQUEST["ux_clr_bg_color_error_msg"]): "#ffcaca";
			$settings["error_msg_border_color"] = isset($_REQUEST["ux_clr_border_color_error_msg"]) ? esc_attr($_REQUEST["ux_clr_border_color_error_msg"]): "#ffcaca";
			$settings["error_msg_text_color"] = isset($_REQUEST["ux_clr_text_color_error_msg"]) ? esc_attr($_REQUEST["ux_clr_text_color_error_msg"]): "#ff2c38";
			$settings["error_msg_rdl_text_align"] = isset($_REQUEST["ux_rdl_font_align_error_msg"]) ? intval($_REQUEST["ux_rdl_font_align_error_msg"]): "0";
			$settings["error_msg_text_direction"] = isset($_REQUEST["ux_ddl_error_msg_direction"]) ? esc_attr($_REQUEST["ux_ddl_error_msg_direction"]): "inherit";
			
            $sql = "";
            foreach ($settings as $val => $keyInner)
            {
                $sql .= ' WHEN `form_settings_key` = "'.($val).'" THEN "'.($keyInner).'"';
            }
            $wpdb->query
            (
                $wpdb->prepare
                    (
                        "UPDATE " . contact_bank_layout_settings_Table() . " SET `form_settings_value` = CASE ".$sql . " END where form_id = %d ",
                        $form_id
                    )
            );
			die();
		}
		else if($_REQUEST["param"] == "restore_global_setting")
		{
			$form_id = intval($_REQUEST["form_id"]);
            $wpdb->get_results
			(
				$wpdb->prepare
				(
					"DELETE FROM " .contact_bank_layout_settings_Table()." WHERE form_id = %d",
					$form_id
				)
            );
		$settings = array();
        $settings["label_setting_font_family"] = "inherit";
        $settings["label_setting_font_color"] = "#000000";
        $settings["label_setting_font_style"] =  "normal";
        $settings["label_setting_font_size"] = "16";
        $settings["label_setting_font_align_left"] =  "0";
        $settings["label_setting_label_position"] =  "top";
        $settings["label_setting_field_size"] = "11";
        $settings["label_setting_field_align"] = "left";
        $settings["label_setting_hide_label"] = "0";
		$settings["label_setting_text_direction"] = "inherit";

        $settings["input_field_font_family"] = "inherit";
        $settings["input_field_font_color"] = "#000000";
        $settings["input_field_font_style"] = "normal";
        $settings["input_field_font_size"] = "14";
        $settings["input_field_border_radius"] = "0";
        $settings["input_field_border_color"] = "#e5e5e5";
        $settings["input_field_border_size"] = "1";
        $settings["input_field_border_style"] = "solid";
        $settings["input_field_clr_bg_color"] = "#ffffff";
        $settings["input_field_rdl_multiple_row"] = "1";
		$settings["input_field_rdl_text_align"] = "0";
		$settings["input_field_text_direction"] = "inherit";
		$settings["input_field_input_size"] = "layout-span6";

		$settings["submit_button_font_family"] = "inherit";
        $settings["submit_button_text"] = "Save ";
        $settings["submit_button_font_style"] = "normal";
        $settings["submit_button_font_size"] = "12";
        $settings["submit_button_button_width"] = "100";
        $settings["submit_button_bg_color"] =  "#24890d";
        $settings["submit_button_hover_bg_color"] = "#3dd41a";
        $settings["submit_button_text_color"] =  "#ffffff";
        $settings["submit_button_border_color"] = "#000000";
        $settings["submit_button_border_size"] = "0";
        $settings["submit_button_border_radius"] = "0";
		$settings["submit_button_rdl_text_align"] = "0";
		$settings["submit_button_text_direction"] = "inherit";

        $settings["success_msg_font_family"] = "inherit";
        $settings["success_msg_font_size"] = "12";
        $settings["success_msg_bg_color"] = "#e5ffd5";
        $settings["success_msg_border_color"] =  "#e5ffd5";
        $settings["success_msg_text_color"] =  "#6aa500";
		$settings["success_msg_rdl_text_align"] = "0";
		$settings["success_msg_text_direction"] = "inherit";

        $settings["error_msg_font_family"] =  "inherit";
        $settings["error_msg_font_size"] = "12";
        $settings["error_msg_bg_color"] = "#ffcaca";
        $settings["error_msg_border_color"] = "#ffcaca";
        $settings["error_msg_text_color"] = "#ff2c38";
		$settings["error_msg_rdl_text_align"] = "0";
		$settings["error_msg_text_direction"] = "inherit";

        foreach($settings as $key => $value)
        {
                $sql[] = '('.$form_id.',"'.($key).'", "'.($value).'")';
        }
        $wpdb->query
        (
            "INSERT INTO " . contact_bank_layout_settings_Table() . "(form_id,form_settings_key,form_settings_value) VALUES ".implode(',', $sql)
        );
			die();
		}
		else if($_REQUEST["param"] == "fetch_control_values")
		{
			$form_id = intval($_REQUEST["form_id"]);
            $layout_settings = array();
			$form_settings_controls = $wpdb->get_results
			(
				$wpdb->prepare
				(
					"SELECT form_settings_key,form_settings_value FROM " .contact_bank_layout_settings_Table()." WHERE form_id = %d order by id ASC",
					$form_id
				)
            );
            for($flag = 0; $flag<count($form_settings_controls);$flag++)
            {
                $layout_settings[$form_settings_controls[$flag]->form_settings_key] = $form_settings_controls[$flag]->form_settings_value;
            }
			echo json_encode($layout_settings);
			die();
		}
		else if($_REQUEST["param"] == "submit_roles_setting")
		{
			$settings = array();
			$settings["admin_full_control"] = isset($_REQUEST["ux_full_control_to_admin"]) ? esc_attr($_REQUEST["ux_full_control_to_admin"]): "0";
			$settings["admin_read_control"] = isset($_REQUEST["ux_read_control_to_admin"]) ? esc_attr($_REQUEST["ux_read_control_to_admin"]): "0";
			$settings["admin_write_control"] = isset($_REQUEST["ux_write_control_to_admin"]) ? esc_attr($_REQUEST["ux_write_control_to_admin"]): "0";
			$settings["editor_full_control"] = isset($_REQUEST["ux_full_control_to_editor"]) ? esc_attr($_REQUEST["ux_full_control_to_editor"]): "0";
			$settings["editor_read_control"] = isset($_REQUEST["ux_read_control_to_editor"]) ? esc_attr($_REQUEST["ux_read_control_to_editor"]): "0";
			$settings["editor_write_control"] = isset($_REQUEST["ux_write_control_to_editor"]) ? esc_attr($_REQUEST["ux_write_control_to_editor"]): "0";
			$settings["author_full_control"] = isset($_REQUEST["ux_full_control_to_author"]) ? esc_attr($_REQUEST["ux_full_control_to_author"]): "0";
			$settings["author_read_control"] = isset($_REQUEST["ux_read_control_to_author"]) ? esc_attr($_REQUEST["ux_read_control_to_author"]): "0";
			$settings["author_write_control"] = isset($_REQUEST["ux_write_control_to_author"]) ? esc_attr($_REQUEST["ux_write_control_to_author"]): "0";
			$settings["contributor_full_control"] = isset($_REQUEST["ux_full_control_to_contributor"]) ? esc_attr($_REQUEST["ux_full_control_to_contributor"]): "0";
			$settings["contributor_read_control"] = isset($_REQUEST["ux_read_control_to_contributor"]) ? esc_attr($_REQUEST["ux_read_control_to_contributor"]): "0";
			$settings["contributor_write_control"] = isset($_REQUEST["ux_write_control_to_contributor"]) ? esc_attr($_REQUEST["ux_write_control_to_contributor"]): "0";
			$settings["subscriber_full_control"] = isset($_REQUEST["ux_full_control_to_subscriber"]) ? esc_attr($_REQUEST["ux_full_control_to_subscriber"]): "0";
			$settings["subscriber_read_control"] = isset($_REQUEST["ux_read_control_to_subscriber"]) ? esc_attr($_REQUEST["ux_read_control_to_subscriber"]): "0";
			$settings["subscriber_write_control"] = isset($_REQUEST["ux_write_control_to_subscriber"]) ? esc_attr($_REQUEST["ux_write_control_to_subscriber"]): "0";
			$sql = "";
	        foreach ($settings as $val => $keyInner)
	        {
	            $sql .= ' WHEN `roles_capability_key` = "'.($val).'" THEN "'.($keyInner).'"';
	        }
	        $wpdb->query
	        (
	            $wpdb->prepare
	            (
	                "UPDATE " . contact_bank_roles_capability() . " SET `roles_capability_value` = CASE ".$sql ." END ",""
	                
	            )
	        );	
			
		die();	
	}
	}
	
}
	