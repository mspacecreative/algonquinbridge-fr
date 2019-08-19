<?php
global $wpdb;
if(isset($_REQUEST["param"]))
{
	if($_REQUEST["param"] == "frontend_submit_controls")
	{
		$form_id = intval($_REQUEST["form_id"]);
		$fields = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT field_id,column_dynamicId,control_id FROM " .create_control_Table()."  WHERE form_id = %d",
				$form_id
			)
		);
		$wpdb->query
		(
			$wpdb->prepare
			(
				"INSERT INTO " . contact_bank_frontend_forms_Table(). " (form_id) VALUES(%d)",
				$form_id
			)
		);
		echo $form_submit_id = $wpdb->insert_id;
		$wpdb->query
		(
			$wpdb->prepare
			(
				"UPDATE " . contact_bank_frontend_forms_Table(). " SET submit_id = %d WHERE id = %d",
				$form_submit_id,
				$form_submit_id
			)
		);
		for($flag = 0;$flag<count($fields);$flag++)
		{
			$field_id = $fields[$flag]->field_id;
			$dynamicId = $fields[$flag]->column_dynamicId;
			$control_dynamicId = $fields[$flag]->control_id;
			switch($field_id)
			{
				case 1:
					$ux_txt = esc_attr($_REQUEST["ux_txt_control_".$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_txt,
							$form_submit_id
						)
					);
				break;
				case 2:
					$ux_textarea = esc_attr($_REQUEST["ux_textarea_control_".$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_textarea,
							$form_submit_id
						)
					);
				break;
				case 3:
					$ux_email = esc_attr($_REQUEST["ux_txt_email_".$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_email,
							$form_submit_id
						)
					);
				break;
				case 4:
					$ux_dropdown = esc_attr($_REQUEST["ux_select_default_".$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_dropdown,
							$form_submit_id
						)
					);
				break;
				case 5:
					$ux_checkbox = $_REQUEST[$dynamicId."_chk"];
					$checkbox_options = "";
					for($flag1 =0;$flag1<count($ux_checkbox);$flag1++)
					{
						$checkbox_options .= $ux_checkbox[$flag1];
						if($flag1 < count($ux_checkbox)-1)
						{
							$checkbox_options .= "-";
						}
					}
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$checkbox_options,
							$form_submit_id
						)
					);
				break;
				case 6:
					$ux_multiple = esc_attr($_REQUEST[$dynamicId."_rdl"]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_multiple,
							$form_submit_id
						)
					);
				break;
				case 7:
					$ux_txt_number_control = esc_attr($_REQUEST['ux_txt_number_control_'.$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_txt_number_control,
							$form_submit_id
						)
					);
				break;
				case 8:
					$ux_txt_name_control = esc_attr($_REQUEST['ux_txt_name_control_'.$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_txt_name_control,
							$form_submit_id
						)
					);
				break;
				case 9:
						$file_uploaded_path = stripcslashes($_REQUEST['uploaded_files']);
						$wpdb->query
						(
							$wpdb->prepare
							(
								"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
								$form_id,
								$field_id,
								$control_dynamicId,
								"$file_uploaded_path",
								$form_submit_id
							)
						);
				break;
				case 10:
					$ux_txt_phone_control = esc_attr($_REQUEST['ux_txt_phone_control_'.$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_txt_phone_control,
							$form_submit_id
						)
					);
				break;
				case 11:
					$ux_txt_address_control = esc_attr($_REQUEST['ux_txt_address_control_'.$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_txt_address_control,
							$form_submit_id
						)
					);
				break;
				case 12:
					$ux_day = esc_attr($_REQUEST['ux_ddl_select_day_'.$dynamicId]);
					$ux_month = esc_attr($_REQUEST['ux_ddl_select_month_'.$dynamicId]);
					$ux_year = esc_attr($_REQUEST['ux_ddl_select_year_'.$dynamicId]);
					$ux_date = $ux_year."-".$ux_month."-".$ux_day;
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_date,
							$form_submit_id
						)
					);
				break;
				case 13:
					$ux_hour = esc_attr($_REQUEST['ux_ddl_select_hr_12_'.$dynamicId]);
					$ux_minute = esc_attr($_REQUEST['ux_ddl_select_minute_'.$dynamicId]);
					$ux_am_pm = esc_attr($_REQUEST['ux_ddl_select_ampm_'.$dynamicId]);
					$ux_time = $ux_hour."-".$ux_minute."-".$ux_am_pm;
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_time,
							$form_submit_id
						)
					);
				break;
				case 15:
					$ux_password = esc_attr($_REQUEST['ux_txt_password_control_'.$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_password,
							$form_submit_id
						)
					);
				break;
				case 16:
					$ux_txt_url_control = esc_attr($_REQUEST['ux_txt_url_control_'.$dynamicId]);
					$wpdb->query
					(
						$wpdb->prepare
						(
							"INSERT INTO " . frontend_controls_data_Table(). " (form_id,field_id,dynamic_control_id,dynamic_frontend_value,form_submit_id) VALUES(%d,%d,%d,%s,%d)",
							$form_id,
							$field_id,
							$control_dynamicId,
							$ux_txt_url_control,
							$form_submit_id
						)
					);
				break;
			}
		}
		die();
	}
	elseif($_REQUEST["param"] == "frontend_captcha_check")
	{
		if (function_exists("create_captcha_bank_menues"))
		{
			$captcha_code = $_REQUEST["captcha_code"];
			require_once CAPTCHA_BK_PLUGIN_DIR . '/captcha_bank_image.php';
			$captchaBankImage = new captcha_bank_image();
			if ($captchaBankImage->check($captcha_code) == false) 
			{
				echo "The Captcha Code does not match. Please Try Again.";
			}
		}
		die();
	}
}
?>