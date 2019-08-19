<?php
global $wpdb;
if(isset($_REQUEST["param"]))
{
	if($_REQUEST["param"] == "email_management")
	{
		$form_id = intval($_REQUEST["form_id"]);
		$form_submit_id = intval($_REQUEST["submit_id"]);
		$file_uploaded_path_admin = "";
		$email_content = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT * FROM " .contact_bank_email_template_admin()."  WHERE form_id = %d ",
				$form_id
			)
		);
		$frontend_control_value = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT * FROM  " . contact_bank_frontend_forms_Table(). " JOIN  " . frontend_controls_data_Table(). " ON " . contact_bank_frontend_forms_Table(). ".submit_id = " . frontend_controls_data_Table(). ".form_submit_id  WHERE " . contact_bank_frontend_forms_Table(). ".submit_id = %d",
				$form_submit_id
			)
		);
		for($flag=0;$flag<count($email_content); $flag++)
		{
			$email_to = $email_content[$flag]->email_to;
			$email_from = stripslashes($email_content[$flag]->email_from);
			$messageTxt = stripcslashes($email_content[$flag]->body_content);
			$email_subject = stripslashes($email_content[$flag]->subject);
			$email_from_name = stripslashes(htmlspecialchars_decode($email_content[$flag]->from_name, ENT_QUOTES));
			$email_reply_to = $email_content[$flag]->reply_to;
			$email_cc = $email_content[$flag]->cc;
			$email_bcc = $email_content[$flag]->bcc;
			for($flag1=0;$flag1<count($frontend_control_value);$flag1++)
			{
				
				$dynamicId = $frontend_control_value[$flag1]->dynamic_control_id;
				$email_to = str_replace("[control_".$dynamicId."]",$frontend_control_value[$flag1]->dynamic_frontend_value, $email_to);
				$email_from = str_replace("[control_".$dynamicId."]",$frontend_control_value[$flag1]->dynamic_frontend_value, $email_from);
				$email_subject = str_replace("[control_".$dynamicId."]",$frontend_control_value[$flag1]->dynamic_frontend_value, $email_subject);
				$email_from_name = str_replace("[control_".$dynamicId."]",$frontend_control_value[$flag1]->dynamic_frontend_value, $email_from_name);
				$email_reply_to = str_replace("[control_".$dynamicId."]",$frontend_control_value[$flag1]->dynamic_frontend_value, $email_reply_to);
				$email_cc  = str_replace("[control_".$dynamicId."]",$frontend_control_value[$flag1]->dynamic_frontend_value, $email_cc);
				$email_bcc = str_replace("[control_".$dynamicId."]",$frontend_control_value[$flag1]->dynamic_frontend_value, $email_bcc);
				if($frontend_control_value[$flag1]->field_Id == 5)
				{
					$chk_options =  str_replace("-",", ", $frontend_control_value[$flag1]->dynamic_frontend_value);
					$messageTxt = str_replace("[control_".$dynamicId."]",$chk_options, $messageTxt);
				}
				else if($frontend_control_value[$flag1]->field_Id == 9) 
				{
					$cb_show_email = $wpdb->get_var
					(
						$wpdb->prepare
						(
							"SELECT dynamic_settings_value FROM " .contact_bank_dynamic_settings_form()."  WHERE dynamicId = %d AND dynamic_settings_key = %s",
							$frontend_control_value[$flag1]->dynamic_control_id,
							"cb_show_email"
						)
					);
					if($cb_show_email == "0")
					{
						$file_path_data = $frontend_control_value[$flag1]->dynamic_frontend_value;
						$file_uploaded_path_admin = explode(",", $file_path_data);
						for($flag2=0;$flag2 < count($file_uploaded_path_admin); $flag2++)
						{
							$file_uploaded_path_admin[$flag2] = CONTACT_MAIN_DIR_EMAIL.$file_uploaded_path_admin[$flag2];
						}
					}
				}
				else if($frontend_control_value[$flag1]->field_Id == 12)
				{
					$date_format = $wpdb->get_var
					(
						$wpdb->prepare
						(
							"SELECT dynamic_settings_value FROM " .contact_bank_dynamic_settings_form()."  WHERE dynamicId = %d AND dynamic_settings_key = %s",
							$frontend_control_value[$flag1]->dynamic_control_id,
							"cb_date_format"
						)
					);
					if($date_format == "0")
					{
						$frontend_control =  date("F d, Y", strtotime($frontend_control_value[$flag1]->dynamic_frontend_value));
					}
					else if($date_format == "1")
					{
						$frontend_control =  date("Y/m/d", strtotime($frontend_control_value[$flag1]->dynamic_frontend_value));
					} 
					else if($date_format == "2")
					{
						$frontend_control = date("m/d/Y", strtotime($frontend_control_value[$flag1]->dynamic_frontend_value));
					} 
					else if($date_format == "3")
					{
						$frontend_control =  date("d/m/Y", strtotime($frontend_control_value[$flag1]->dynamic_frontend_value));
					}
					$messageTxt = str_replace("[control_".$dynamicId."]",$frontend_control, $messageTxt);
				}
				else if($frontend_control_value[$flag1]->field_Id == 13) 
				{
					$hour_format = $wpdb->get_var
					(
						$wpdb->prepare
						(
							"SELECT dynamic_settings_value FROM " .contact_bank_dynamic_settings_form()."  WHERE dynamicId = %d AND dynamic_settings_key = %s",
							$frontend_control_value[$flag1]->dynamic_control_id,
							"cb_hour_format"
						)
					);
					if($hour_format == "12")
					{
						$time_content = explode("-", $frontend_control_value[$flag1]->dynamic_frontend_value);
						$time_content[0] = ($time_content[0] != "")?$time_content[0]:"0";
						$time_content[1] = ($time_content[1] != "")?$time_content[1]:"0";
						if(intval($time_content[2])== 0)
						{
							$AM = "AM";
						}
						else
						{
							$AM = "PM";
						}
						if(intval($time_content[1]) < 10)
						{
							$time_final = $time_content[0].":"."0".$time_content[1]." ".$AM;
						}
						else 
						{
							$time_final = $time_content[0].":".$time_content[1]." ".$AM;
						}
						$messageTxt = str_replace("[control_".$dynamicId."]",$time_final, $messageTxt);
					}
					else 
					{
						$time_content = explode("-", $frontend_control_value[$flag1]->dynamic_frontend_value);
						if(intval($time_content[1]) < 10)
						{
							$time_final = $time_content[0].":"."0".$time_content[1];
						}
						else 
						{
							$time_final = $time_content[0].":".$time_content[1];
						}
						$messageTxt = str_replace("[control_".$dynamicId."]",$time_final, $messageTxt) ;
					}
				}
				else 
				{
					$messageTxt = str_replace("[control_".$dynamicId."]",stripslashes($frontend_control_value[$flag1]->dynamic_frontend_value), $messageTxt);
				}
			}
			$headers = "";
			$headers .= "Content-Type: text/html; charset= utf-8". "\r\n";
			if($email_from_name != "" && $email_from != "")
			{
				$headers .= "From: " .$email_from_name. " <". $email_from . ">" ."\r\n";
			}
			if($email_reply_to != "")
			{
				$headers .= "Reply-To: ".$email_reply_to."\r\n";
			}
			if($email_cc != "")
			{
				$headers .= "Cc: " .$email_cc. "\r\n";
			}			
			if($email_bcc != "")
			{
				$headers .= "Bcc: " .$email_bcc."\r\n";
			}				 
			if($file_uploaded_path_admin == "")
			{
				wp_mail($email_to, $email_subject, $messageTxt, $headers);
			}
			else
			{
				wp_mail($email_to, $email_subject, $messageTxt, $headers, $file_uploaded_path_admin);
			}
		}
	die();
	}
}
?>