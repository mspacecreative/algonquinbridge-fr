<?php
global $wpdb;
$form_id = $_REQUEST['form_id'];
$control_settings_array = array();
$form_settings_array = array();
$layout_settings_array = array();
$form_name = $wpdb->get_var
(
	$wpdb->prepare
	(
		"SELECT form_name FROM " .contact_bank_contact_form()." WHERE form_id = %d",
		$form_id
	)
);
$form_fields = $wpdb->get_results
(
	$wpdb->prepare
	(
		"SELECT control_id,column_dynamicId,field_id,sorting_order FROM " .create_control_Table()." WHERE form_id = %d ORDER BY sorting_order asc",
		$form_id
	)
);
for($flag=0;$flag<count($form_fields);$flag++)
{
	$control_settings = $wpdb->get_results
	(
		$wpdb->prepare
		(
			"SELECT * FROM " .contact_bank_dynamic_settings_form()." WHERE dynamicId  = %d",
			$form_fields[$flag]->control_id
		)
	);
	for($flag1=0;$flag1<count($control_settings);$flag1++)
	{
		$column_dynamicId = $form_fields[$flag]->column_dynamicId;
		$control_settings_array[$column_dynamicId][$control_settings[$flag1]->dynamic_settings_key] = $control_settings[$flag1]->dynamic_settings_value;
	}
}

$form_settings = $wpdb->get_results
(
	$wpdb->prepare
	(
		"SELECT form_message_key,form_message_value FROM " .contact_bank_form_settings_Table()." WHERE form_id = %d",
		$form_id
	)
);
for($flag2=0;$flag2<count($form_settings);$flag2++)
{
	$form_settings_array[$form_id][$form_settings[$flag2]->form_message_key] = $form_settings[$flag2]->form_message_value;
}

$forms_layout_settings = $wpdb->get_results
(
	$wpdb->prepare
	(
		"SELECT form_settings_key,form_settings_value FROM " .contact_bank_layout_settings_Table()." WHERE form_id = %d",
		$form_id
	)
);
for($flag3=0;$flag3<count($forms_layout_settings);$flag3++)
{
	$layout_settings_array[$form_id][$forms_layout_settings[$flag3]->form_settings_key] = $forms_layout_settings[$flag3]->form_settings_value;
}

$forms_email_settings = $wpdb->get_row
(
	$wpdb->prepare
	(
		"SELECT * FROM " .contact_bank_email_template_admin()." WHERE form_id = %d",
		$form_id
	)
);
?>
<style type="text/css">

    .main_container_form
    {
        display: inline-block !important;
        width: 100% !important;
    }
    .cb_form_wrapper
    {
        overflow: inherit;
        margin: 10px 0;
        max-width: 98%
    }
	.label_control
    {
        font-family: <?php echo $layout_settings_array[$form_id]["label_setting_font_family"]; ?> !important;
        color: <?php echo $layout_settings_array[$form_id]["label_setting_font_color"]; ?> !important;
        <?php
            if($layout_settings_array[$form_id]["label_setting_font_style"] == "italic")
            {
        ?>
                font-style: <?php echo $layout_settings_array[$form_id]["label_setting_font_style"]; ?> !important;
        <?php
            }
            else
            {
        ?>
                font-weight: <?php echo $layout_settings_array[$form_id]["label_setting_font_style"]; ?> !important;
        <?php
            }
			if($layout_settings_array[$form_id]["label_setting_label_position"] == "top")
            {
            	?>
            	float: none !important;
            	text-align: <?php echo $layout_settings_array[$form_id]["label_setting_font_align_left"] == "0" ? "left" : "right"; ?> !important;
            	<?php
			}
			else if($layout_settings_array[$form_id]["label_setting_label_position"] == "right")
			{
				?>
				text-align: right !important;
				<?php
			}
			else 
			{
				?>
            	text-align: <?php echo $layout_settings_array[$form_id]["label_setting_font_align_left"] == "0" ? "left" : "right"; ?> !important;
            	<?php
			}
        ?>
        font-size: <?php echo $layout_settings_array[$form_id]["label_setting_font_size"] . "px"; ?> !important;
        
        display: <?php echo $layout_settings_array[$form_id]["label_setting_hide_label"] == "0" ? "inline-block" : "none"; ?> !important;
        direction: <?php echo $layout_settings_array[$form_id]["label_setting_text_direction"]; ?> !important;
    }
    .input_control
	{
		
		font-family: <?php echo $layout_settings_array[$form_id]["input_field_font_family"]; ?> !important;
		color: <?php echo $layout_settings_array[$form_id]["input_field_font_color"]; ?> !important;
		<?php
			if($layout_settings_array[$form_id]["input_field_font_style"] == "italic")
			{
		?>
				font-style: <?php echo $layout_settings_array[$form_id]["input_field_font_style"]; ?> !important;
		<?php
			}
			else
			{
		?>
				font-weight: <?php echo $layout_settings_array[$form_id]["input_field_font_style"]; ?> !important;
		<?php
			}
		?>
		background-color: <?php echo $layout_settings_array[$form_id]["input_field_clr_bg_color"]; ?> !important;
		font-size: <?php echo $layout_settings_array[$form_id]["input_field_font_size"] . "px"; ?> !important;
		border: <?php echo $layout_settings_array[$form_id]["input_field_border_size"] . "px ".$layout_settings_array[$form_id]["input_field_border_style"].$layout_settings_array[$form_id]["input_field_border_color"]; ?>  !important;
		border-radius: <?php echo $layout_settings_array[$form_id]["input_field_border_radius"] . "px"; ?> !important;
		-moz-border-radius: <?php echo $layout_settings_array[$form_id]["input_field_border_radius"] . "px"; ?> !important;
		-webkit-border-radius: <?php echo $layout_settings_array[$form_id]["input_field_border_radius"] . "px"; ?> !important;
		-khtml-border-radius: <?php echo $layout_settings_array[$form_id]["input_field_border_radius"] . "px"; ?> !important;
		-o-border-radius: <?php echo $layout_settings_array[$form_id]["input_field_border_radius"] . "px"; ?> !important;
		text-align: <?php echo $layout_settings_array[$form_id]["input_field_rdl_text_align"] == "0" ? "left" : "right"; ?> !important;
		direction: <?php echo $layout_settings_array[$form_id]["input_field_text_direction"]; ?> !important;
	}
	.layout_according_label_position
	{
		<?php
		if($layout_settings_array[$form_id]["label_setting_label_position"] == "top")
        {
        	?>
        	margin-left: 0px !important;
        	<?php
		}
		
		?>
	}
	.field_description
	{
		font-family: <?php echo $layout_settings_array[$form_id]["label_setting_font_family"]; ?> !important;
		font-style: italic !important;
		color: <?php echo $layout_settings_array[$form_id]["label_setting_font_color"]; ?> !important;
		<?php
			if($layout_settings_array[$form_id]["label_setting_font_style"] == "italic")
			{
		?>
			font-style: <?php echo $layout_settings_array[$form_id]["label_setting_font_style"]; ?> !important;
        <?php
			}
 			else
			{
		?>
			font-weight: <?php echo $layout_settings_array[$form_id]["label_setting_font_style"]; ?> !important;
		<?php
			}
		?>
		font-size: <?php echo $layout_settings_array[$form_id]["label_setting_field_size"] . "px"; ?> !important;
		text-align: <?php echo $layout_settings_array[$form_id]["label_setting_field_align"]; ?> !important; 
	}
	.btn_submit
	{
		<?php
			if($layout_settings_array[$form_id]["submit_button_font_style"] == "italic")
			{
		?>
			font-style: <?php echo $layout_settings_array[$form_id]["submit_button_font_style"]; ?> !important;
        <?php
			}
 			else
			{
		?>
			font-weight: <?php echo $layout_settings_array[$form_id]["submit_button_font_style"]; ?> !important;
		<?php
			}
		?>
		font-family: <?php echo $layout_settings_array[$form_id]["submit_button_font_family"]; ?> !important;
		font-size: <?php echo $layout_settings_array[$form_id]["submit_button_font_size"] . "px"; ?> !important;
		width: <?php echo $layout_settings_array[$form_id]["submit_button_button_width"] . "px"; ?> !important;
		background-color: <?php echo $layout_settings_array[$form_id]["submit_button_bg_color"]; ?> !important;
		color: <?php echo $layout_settings_array[$form_id]["submit_button_text_color"]; ?> !important;
		border: <?php echo $layout_settings_array[$form_id]["submit_button_border_size"] . "px Solid".$layout_settings_array[$form_id]["submit_button_border_color"]; ?>  !important;
		border-radius: <?php echo $layout_settings_array[$form_id]["submit_button_border_radius"] . "px"; ?> !important;
		-moz-border-radius: <?php echo $layout_settings_array[$form_id]["submit_button_border_radius"] . "px"; ?> !important;
		-webkit-border-radius: <?php echo $layout_settings_array[$form_id]["submit_button_border_radius"] . "px"; ?> !important;
		-khtml-border-radius: <?php echo $layout_settings_array[$form_id]["submit_button_border_radius"] . "px"; ?> !important;
		-o-border-radius: <?php echo $layout_settings_array[$form_id]["submit_button_border_radius"] . "px"; ?> !important;
		text-align: <?php echo $layout_settings_array[$form_id]["submit_button_rdl_text_align"] == "0" ? "left" : "right"; ?> !important;
		direction: <?php echo $layout_settings_array[$form_id]["submit_button_text_direction"]; ?> !important;
	}
	.btn_submit:hover
	{
		background-color: <?php echo $layout_settings_array[$form_id]["submit_button_hover_bg_color"]; ?> !important;
	}
	.success_message
	{
		
		background-color: <?php echo $layout_settings_array[$form_id]["success_msg_bg_color"]; ?> !important;
		border: <?php echo "2px Solid ".$layout_settings_array[$form_id]["success_msg_border_color"]; ?>  !important;
		color: <?php echo $layout_settings_array[$form_id]["success_msg_text_color"]; ?> !important;
		text-align: <?php echo $layout_settings_array[$form_id]["success_msg_rdl_text_align"] == "0" ? "left" : "right"; ?> !important;
		direction: <?php echo $layout_settings_array[$form_id]["success_msg_text_direction"]; ?> !important;
		background: url(<?php echo CONTACT_BK_PLUGIN_URL."/assets/images/icons/icon-succes.png"?>) no-repeat 1px 8px #EBF9E2;
	}
	.sucess_message_text
	{
		font-family: <?php echo $layout_settings_array[$form_id]["success_msg_font_family"]; ?> !important;
		font-size: <?php echo $layout_settings_array[$form_id]["success_msg_font_size"] . "px"; ?> !important;
	}
	label.error_field
	{
		font-family: <?php echo $layout_settings_array[$form_id]["error_msg_font_family"]; ?> !important;
		font-size: <?php echo $layout_settings_array[$form_id]["error_msg_font_size"] . "px"; ?> !important;
		background-color: <?php echo $layout_settings_array[$form_id]["error_msg_bg_color"]; ?> !important;
		border: <?php echo "2px Solid ".$layout_settings_array[$form_id]["error_msg_border_color"]; ?>  !important;
		color: <?php echo $layout_settings_array[$form_id]["error_msg_text_color"]; ?> !important;
		text-align: <?php echo $layout_settings_array[$form_id]["error_msg_rdl_text_align"] == "0" ? "left" : "right"; ?> !important;
		direction: <?php echo $layout_settings_array[$form_id]["error_msg_text_direction"]; ?> !important;
		<?php
		if($layout_settings_array[$form_id]["label_setting_label_position"] == "left")
		{
			?>
				margin-left: 10px;
			<?php
		}
		else if($layout_settings_array[$form_id]["label_setting_label_position"] == "right")
		{
			?>
				margin-right: 10px;
			<?php
		}
		?>
	}
</style>
<div class="cb_form_wrapper" id="cb_form_wrapper_<?php echo $form_id; ?>">
    <form id="ux_frm_front_end_form" method="post" action="#" class="layout-form">
    	<div class="fluid-layout">
			<div class="layout-span12">
				<div class="widget-layout">
					<div class="widget-layout-title">
						<h4><?php _e( "Form Preview", contact_bank ); ?></h4>
					</div>
					<div class="widget-layout-body">
					<a class="btn btn-info" href="admin.php?page=dashboard"><?php _e("Back to Dashboard", contact_bank);?></a>
						<div class="separator-doubled"></div>
						<div id="form_success_message_frontend" class="message success_message" style="display: none;margin-bottom: 10px;">
							<span class="sucess_message_text" >
								<strong><?php echo $form_settings_array[$form_id]["success_message"]; ?></strong>
							</span>
						</div>
						<div class="fluid-layout">
							<div class="layout-span12">
								<div class="widget-layout">
									<div class="widget-layout-title">
										<h4><?php echo $form_name ;?></h4>
									</div>
							  		<div style="margin-left: 15px;" class="layout-control-group">
							  			<span class="<?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>"><?php echo $form_settings_array[$form_id]["form_description"]; ?></span>
							  		</div>
									<?php
						                for($flag=0;$flag<count($form_fields);$flag++)
						                {
						                	if($form_fields[$flag]->field_id != 17)
											{
													?>
						                	<div class="widget-layout-body">
							                	<div class="layout-control-group">
					                        		<label class="label_control layout-control-label">
					                        			<?php
							                            echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_label_value"] . " :";
							                            if($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_control_required"] == "1")
							                            {
							                                ?>
							                                <span class="error">*</span>
							                            <?php
							                            }
							                            ?>
							                             </label>
						                             <?php
											}
											else {
												?>
						                	<div class="widget-layout-body">
							                	<div class="layout-control-group">
					                        		
						                             <?php
											}
						                
								                   switch($form_fields[$flag]->field_id)
								                    {
								                        
															case 1:
								                            ?>
								                             <div class="layout-controls layout_according_label_position">
									                            <input class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>"
									                                   type="text"  id="ux_txt_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
									                                   name="ux_txt_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
									                                   data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
									                                   placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>"
									                                   data-alpha="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_alpha_filter"];?>"
									                                   data-alpha_num="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_ux_checkbox_alpha_num_filter"];?>"
									                                   data-digit="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_digit_filter"];?>"
									                                   data-strip="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_strip_tag_filter"];?>"
									                                   data-trim="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_trim_filter"];?>"
									                                   onkeypress="impliment_filters(event,this.id,<?php echo $form_fields[$flag]->column_dynamicId; ?>);"
									                                   onfocus="prevent_paste(this.id);"/>
									                                   <br/>
									                                   <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>
									                         </div>
										                    <?php
								                        break;
								                        case 2:
															?>
															<div class="layout-controls layout_according_label_position">
								                            <textarea class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>" id="ux_textarea_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
								                                      placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>" name="ux_textarea_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
								                                      onfocus="prevent_paste(this.id);" 
								                                      data-alpha="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_alpha_filter"];?>"
									                                  data-alpha_num="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_ux_checkbox_alpha_num_filter"];?>"
									                                  data-digit="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_digit_filter"];?>"
									                                  data-strip="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_strip_tag_filter"];?>"
									                                  data-trim="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_trim_filter"];?>"
									                                  onkeypress="impliment_filters(event,this.id,<?php echo $form_fields[$flag]->column_dynamicId; ?>);"
								                                      data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"></textarea>
								                                      <br/>
									                                  <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>
									                           </div>
															<?php
														break;
														case 3:
																?>
																<div class="layout-controls layout_according_label_position">
										                            <input class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>"
										                                   type="text"  id="ux_txt_email_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   name="ux_txt_email_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
										                                   placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>"
										                                   onfocus="prevent_paste(this.id);"/>
										                                 <br/>
									                                   <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>
									                           </div>
																<?php				
														break;
														case 4:
															$ddl_values = unserialize($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_dropdown_option_val"]);
				                            				$ddl_ids = unserialize($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_dropdown_option_id"]);
															?>
															
								                          	 <div class="layout-controls layout_according_label_position">
								                             <select class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>" type="select" id="ux_select_default_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
								                                    data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
								                                    name="ux_select_default_<?php echo $form_fields[$flag]->column_dynamicId; ?>">
								                                <option value=""><?php _e("Select Option", contact_bank); ?></option>
								                                <?php
								                                foreach($ddl_ids as $key => $value )
								                                {
								                                    ?>
								                                    <option value="<?php echo $ddl_values[$key]; ?>"><?php echo $ddl_values[$key]; ?></option>
								                                <?php
								                                }
																?>
								                            </select>
								                            </div>
															<?php
														break;
														case 5:
															$chk_values = unserialize($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_option_val"]);
								                            $chk_ids = unserialize($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_option_id"]);
								                            if(count($chk_ids) > 0)
															{
																?>
																<div class="layout-controls layout_according_label_position">
																<?php
																foreach($chk_ids as $key => $value )
									                            {
																	?>
																		
											                                <input type="checkbox" class="hovertip" id="ux_chk_control_<?php echo $value; ?>"
											                                data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
											                                       name="<?php echo $form_fields[$flag]->column_dynamicId; ?>_chk[]"
											                                       value ="<?php echo $chk_values[$key]; ?>" />
											                                <label style="margin:0px;vertical-align: middle;" id="chk_id_<?php echo $value; ?>">
											                                    <?php echo $chk_values[$key]; ?>
											                                </label>
											                           
																	<?php
																}
																?>
																</div>
																<?php
															}
															else 
															{
																?>
																<div class="layout-controls layout_according_label_position">
																	<input type="checkbox" id="ux_chk_control_" />
																</div>
																<?php
															}
														break;
														case 6:
															$rdl_values = unserialize($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_radio_option_val"]);
						                        			$rdl_ids = unserialize($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_radio_option_id"]);
															if(count($rdl_ids) > 0)
															{
																?>
																<div class="layout-controls layout_according_label_position">
																<?php
																foreach($rdl_ids as $key => $value )
									                            {
									                            	if($layout_settings_array[$form_id]["input_field_rdl_multiple_row"] == "0")
																	{
																		?>
											                                <input type="radio" class="hovertip" id="ux_rdl_control_<?php echo $value; ?>"
											                                       name="<?php echo $form_fields[$flag]->column_dynamicId; ?>_rdl"
											                                       data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
											                                       value ="<?php echo $rdl_values[$key]; ?>" />
											                                <label style="margin:0px;vertical-align: middle;" id="rdl_id_<?php echo $value; ?>">
											                                    <?php echo $rdl_values[$key]; ?>
											                                </label><br>
										                               <?php
																	}
																	else
																	{
																		?>
																		 
											                                <input  type="radio" class="hovertip" id="ux_rdl_control_<?php echo $value; ?>"
											                                       name="<?php echo $form_fields[$flag]->column_dynamicId; ?>_rdl"
											                                       data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
											                                       value ="<?php echo $rdl_values[$key]; ?>" />
											                                <label style="margin:0px;vertical-align: middle;" id="rdl_id_<?php echo $value; ?>">
											                                    <?php echo $rdl_values[$key]; ?>
											                                </label>
											                              
											                              
											                            <?php
																	}
																}
																?>
																</div>
																<?php
															}
															else 
															{
																?>
																<div class="layout-controls layout_according_label_position">
																	<input type="radio" id="ux_rdl_control_" />
																</div>
																<?php
															}
															
														break;
														case 7:
																?>
																<div class="layout-controls layout_according_label_position">
										                            <input class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>" 
										                                   type="text"  id="ux_txt_number_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   name="ux_txt_number_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
										                                   placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>"
										                                   onfocus="prevent_paste(this.id);"/>
										                        <br/>
									                            <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 8:
																?>
																<div class="layout-controls layout_according_label_position">
										                            <input class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>"
										                                   type="text"  id="ux_txt_name_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   name="ux_txt_name_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
										                                   placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>"
										                                   onfocus="prevent_paste(this.id);"/>
										                         <br/>
									                            <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 9:
																?>
																
																
																<div class="layout-controls layout_according_label_position" id="container">
																	<input type="button" id="pickfiles" value="Upload Files" class="btn btn-info" />
						                        				 <br/>
						                        				<span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        <div id="filelist"></div>
										                        </div>
																<?php
														break;
														case 10:
																?>
																<div class="layout-controls layout_according_label_position">
									                             <input class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>"
									                                   type="text"  id="ux_txt_phone_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
									                                   name="ux_txt_phone_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
									                                   data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
									                                   placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>"
									                                   onfocus="prevent_paste(this.id);"/>
								                                  <br/>
									                            <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 11:
																?>
																<div class="layout-controls layout_according_label_position">
									                            	<textarea class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>" id="ux_txt_address_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
									                                      placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>" name="ux_txt_address_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
									                                      onfocus="prevent_paste(this.id);" data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"></textarea>
									                            <br/>
									                            <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 12:
																?>
																<div class="layout-controls layout_according_label_position">
										                            <select class="hovertip input_control layout-span2" id="ux_ddl_select_day_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                            	data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>" 
										                            	name="ux_ddl_select_day_<?php echo $form_fields[$flag]->column_dynamicId; ?>">
										                                <option value="" selected="selected"><?php _e( "Day", contact_bank ); ?></option>
																		<?php
																		for ($flagDay = 1; $flagDay <= 31; $flagDay++)
																		{
																			if ($flagDay < 10)
																			{
																			
																				if($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_value_day"] == $flagDay)
																				{
																				?>
																					<option selected="selected" value="<?php echo $flagDay; ?>">0<?php echo $flagDay; ?></option>
																				<?php
																					continue;
																				}
																				?>
																				<option value="<?php echo $flagDay; ?>">0<?php echo $flagDay; ?></option>
																				<?php
																			}
																			else
																			{
																				if($control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_value_day"] == $flagDay)
																				{
																					?>
																					<option selected="selected" value="<?php echo $flagDay; ?>"><?php echo $flagDay; ?></option>
																					<?php
																					continue;
																				}
																				?>
																				<option value=<?php echo $flagDay; ?>><?php echo $flagDay; ?></option>
																			<?php
																			}
																		}
																		?>
																	</select>
										                            <select class="hovertip input_control layout-span3" id="ux_ddl_select_month_<?php echo $form_fields[$flag]->column_dynamicId; ?>" 
										                            	name="ux_ddl_select_month_<?php echo $form_fields[$flag]->column_dynamicId; ?>" onchange="current_year_leap_check(<?php echo $form_fields[$flag]->column_dynamicId; ?>);">
										                                <option value=""><?php _e("Select Month", contact_bank); ?></option>
										                                <option value="1">January</option>
																		<option value="2">February</option>
																		<option value="3">March</option>
																		<option value="4">April</option>
																		<option value="5">May</option>
																		<option value="6">June</option>
																		<option value="7">July</option>
																		<option value="8">August</option>
																		<option value="9">September</option>
																		<option value="10">October</option>
																		<option value="11">November</option>
																		<option value="12">December</option>
										                            </select>
										                            <select class="hovertip input_control layout-span2" id="ux_ddl_select_year_<?php echo $form_fields[$flag]->column_dynamicId; ?>" 
										                            	name="ux_ddl_select_year_<?php echo $form_fields[$flag]->column_dynamicId; ?>" onchange="current_year_leap_check(<?php echo $form_fields[$flag]->column_dynamicId; ?>);">
										                                <option value="" selected="selected"><?php _e( "Year", contact_bank ); ?></option>
										                            </select>
										                           <br/>
									                            <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 13:
																?>
																<div class="layout-controls layout_according_label_position">
										                            <select class="hovertip input_control layout-span3" type="hour12"  id="ux_ddl_select_hr_12_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                            	data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>" 
										                            	name="ux_ddl_select_hr_12_<?php echo $form_fields[$flag]->column_dynamicId; ?>">
										                                <option selected="selected" value=""><?php _e("Hour", contact_bank); ?></option>
										                            </select>
										                            <select class="hovertip input_control layout-span3" type="minute" id="ux_ddl_select_minute_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                            	 name="ux_ddl_select_minute_<?php echo $form_fields[$flag]->column_dynamicId; ?>">
										                                <option selected="selected" value=""><?php _e("Minute", contact_bank); ?></option>
										                            </select>
										                            <select class="hovertip input_control layout-span2" type="am" id="ux_ddl_select_ampm_<?php echo $form_fields[$flag]->column_dynamicId; ?>" 
										                            	name="ux_ddl_select_ampm_<?php echo $form_fields[$flag]->column_dynamicId; ?>">
										                                <option value="0" selected="selected">AM</option>
																		<option value="1">PM</option>
										                            </select>
										                             <br/>
									                            <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 15:
																?>
																<div class="layout-controls layout_according_label_position">
										                            <input class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>" 
										                                   type="password"  id="ux_txt_password_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   name="ux_txt_password_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                                   data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
										                                   data-alpha="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_alpha_filter"];?>"
											                               data-alpha_num="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_ux_checkbox_alpha_num_filter"];?>"
											                               data-digit="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_digit_filter"];?>"
											                               data-strip="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_strip_tag_filter"];?>"
											                               data-trim="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_checkbox_trim_filter"];?>"
											                               onkeypress="impliment_filters(event,this.id,<?php echo $form_fields[$flag]->column_dynamicId; ?>);"
										                                   onfocus="prevent_paste(this.id);"/>
										                                  <br/>
									                            		  <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 16:
																?>
																<div class="layout-controls layout_according_label_position">
										                            <input class="hovertip input_control <?php echo $layout_settings_array[$form_id]["input_field_input_size"]; ?>" 
										                               type="text"  id="ux_txt_url_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                               name="ux_txt_url_control_<?php echo $form_fields[$flag]->column_dynamicId; ?>"
										                               data-original-title="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_tooltip_txt"]; ?>"
										                               placeholder="<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_txt_val"];?>" 
										                               /><label style="display: none" id="ux_txt_url_control_error_msg"  class="error_field">Please enter a valid URL.</label>
										                          <br/>
									                            <span class="field_description" id="txt_description_"><?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_description"]; ?></span>          
										                        </div>
																<?php
														break;
														case 17:
															if (function_exists("create_captcha_bank_menues"))
															{
															?>
																<input type="hidden" id="captcha_exist_id" name="captcha_exist_id" value="17" />
																<div class="layout-controls layout_according_label_position">
																<?php
																	echo captcha_bank_form();
																?>
																</div>
															<?php
															}
														break;
								                    }
								                    ?>
								       			</div>
											</div>
						                   <?php
						                }
										?>
								</div>
							</div>
						</div>
					</div>
				</div>
		     </div>
		</div>
    </form>
</div>
<script type="text/javascript">
jQuery(".hovertip").tooltip({placement: "left"});
jQuery(document).ready(function()
{
	 <?php
	$file_size = "";
	$file_extensions = "";
    for($flag=0;$flag<count($form_fields);$flag++)
    {
		switch($form_fields[$flag]->field_id)
        {
			case 9:
				$file_size .=  $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_maximum_file_allowed"];
				$file_extensions .=  $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_allow_file_ext_upload"];
			break;
			case 12:
				?>
					jQuery("#ux_default_year_type_"+<?php echo $form_fields[$flag]->column_dynamicId;?>).children("option:not(:first)").remove();
					var start_year = "<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_start_year"];?>";
					var end_year = "<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_end_year"];?>";
					for(var year = start_year; year<=end_year;year++)
					{
						jQuery("#ux_ddl_select_year_"+<?php echo $form_fields[$flag]->column_dynamicId;?>).append("<option value=\""+year+"\">"+year+"</option>");
					}
					var year =  jQuery("#ux_ddl_select_year_"+<?php echo $form_fields[$flag]->column_dynamicId;?>).val(<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_value_year"];?>);
					var month = jQuery("#ux_ddl_select_month_"+<?php echo $form_fields[$flag]->column_dynamicId;?>).val(<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_default_value_month"];?>);
				<?php
			break;
			case 13:
				?>
					var dynamicId = "<?php echo $form_fields[$flag]->column_dynamicId;?>";
					var hour_format = "<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_hour_format"];?>";
					jQuery("#ux_ddl_select_hr_12_"+dynamicId).children("option:not(:first)").remove();
					if(hour_format == "12")
					{
						for(var flag = 1; flag<=12;flag++)
						{
							jQuery("#ux_ddl_select_hr_12_"+dynamicId).append("<option value=\""+flag+"\">" +  (flag < 10 ? "0" + flag : flag) + "</option>");
						}
						jQuery("#ux_ddl_select_ampm_"+dynamicId).show();
					}
					else
					{
						for(var flag = 0; flag<24;flag++)
						{
							jQuery("#ux_ddl_select_hr_12_"+dynamicId).append("<option value=\""+flag+"\">"+  (flag < 10 ? "0" + flag : flag) + "</option>");
						}
						jQuery("#ux_ddl_select_ampm_"+dynamicId).hide();
					}
					var minute_format = "<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_time_format"];?>";
					jQuery("#ux_ddl_select_minute_"+dynamicId).children("option:not(:first)").remove();
					for(var flag_min = 0; flag_min<60;flag_min = parseInt(flag_min) + parseInt(minute_format))
					{
						jQuery("#ux_ddl_select_minute_"+dynamicId).append("<option value=\""+flag_min+"\">"  +  (flag_min < 10 ? "0" + flag_min : flag_min) + "</option>");
					}
					jQuery("#ux_ddl_select_hr_12_"+dynamicId).val("<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_hours"];?>");
					jQuery("#ux_ddl_select_minute_"+dynamicId).val("<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_minutes"];?>");
					jQuery("#ux_ddl_select_ampm_"+dynamicId).val("<?php echo $control_settings_array[$form_fields[$flag]->column_dynamicId]["cb_am_pm"];?>");
				<?php
			break;
		}
	}
	?>
});
function current_year_leap_check(dynamicId)
{
	var year =  jQuery("#ux_ddl_select_year_"+dynamicId).val();
	var month = jQuery("#ux_ddl_select_month_"+dynamicId).val();
	if(month == 2)
	{
		if((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0))
		{
			if(jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=\"29\"]").length == 0)
			{
			    jQuery("#ux_ddl_select_day_"+dynamicId).append("<option value=\"29\">29</option>");
			}
			jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=30]").remove();
			jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=31]").remove();
		}
		else
		{
			jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=29]").remove();
			jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=30]").remove();
			jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=31]").remove();
		}
	}
	else if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12)
	{
		if(jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=\"29\"]").length == 0)
		{
			jQuery("#ux_ddl_select_day_"+dynamicId).append("<option value=\"29\">29</option>");
		}
		if(jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=\"30\"]").length == 0)
		{
			jQuery("#ux_ddl_select_day_"+dynamicId).append("<option value=\"30\">30</option>");
		}
		if(jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=\"31\"]").length == 0)
		{
			jQuery("#ux_ddl_select_day_"+dynamicId).append("<option value=\"31\">31</option>");
		}
	}
	else if(month == 4 || month == 6 || month == 9 || month == 11)
	{
		if(jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=\"29\"]").length == 0)
		{
			jQuery("#ux_ddl_select_day_"+dynamicId).append("<option value=\"29\">29</option>");
		}
		if(jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=\"30\"]").length == 0)
		{
			jQuery("#ux_ddl_select_day_"+dynamicId).append("<option value=\"30\">30</option>");
		}
		if(jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=\"31\"]").length != 0)
		{
			jQuery("#ux_ddl_select_day_"+dynamicId+ " option[value=31]").remove();
		}
	}
}
function prevent_paste(control_id)
{
	jQuery("#"+control_id).live("paste",function(e)
	{
		e.preventDefault();
	});
}
function impliment_filters(e,control,dynamicId)
{
	var alpha_filter = jQuery("#"+control).attr("data-alpha");
	var alpha_num_filter = jQuery("#"+control).attr("data-alpha_num");
	var digit_filter = jQuery("#"+control).attr("data-digit");
	var strip_filter = jQuery("#"+control).attr("data-strip");
	var trim_filter = jQuery("#"+control).attr("data-trim");
	var reg_exp = "";
	if(alpha_filter == 1)
	{
		reg_exp += "a-zA-Z";
	}
	if(alpha_num_filter == 1)
	{
		reg_exp += "a-zA-Z0-9";
	}
	if(digit_filter == 1)
	{
		reg_exp += "0-9 .";
	}
	if(reg_exp != "")
	{
		var regex = new RegExp("^["+reg_exp+"\b]*$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) 
		{
			return true;
		}
		e.preventDefault();
		return false;
	}
	if(strip_filter == 1)
	{
		var regex = new RegExp("^[<>/\b]+$");
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) 
		{
			e.preventDefault();
			return false;
		}
		return true;
	}
	if(trim_filter == 1)
	{
		jQuery("#"+control).val(jQuery("#"+control).val().replace(/ +(?= )/g,''));
	}
}
</script>