<?php
	$form_settings = array();
	$control_id = $wpdb->get_var
	(
		$wpdb->prepare
		(
			"SELECT control_id FROM " .create_control_Table(). " where form_id= %d and field_id = %d and column_dynamicId = %d",
			$form_id,
			$field_type,
			$dynamicId
		)
	);
	if(count($control_id) != 0)
	{
		$form_data = $wpdb->get_results
		(
			$wpdb->prepare
			(
				"SELECT * FROM " .contact_bank_dynamic_settings_form(). " where dynamicId= %d",
				$control_id
			)
		);
		$form_settings[$dynamicId]["dynamic_id"] = $dynamicId;
		$form_settings[$dynamicId]["control_type"] = "1";
		for($flag = 0; $flag<count($form_data);$flag++)
		{
			$form_settings[$dynamicId][$form_data[$flag]->dynamic_settings_key] = $form_data[$flag]->dynamic_settings_value;
		}
	}
?>
<form id="ux_frm_time_control" action="#" method="post" class="layout-form">
	<div class="fluid-layout">
		<div class="layout-span12">
			<div class="widget-layout">
				<div class="widget-layout-title">
					<h4><?php _e( "Time", contact_bank ); ?></h4>
				</div>
				<div class="widget-layout-body">
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Label", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<input type="text" class="layout-span12" onkeyup="enter_admin_label(<?php echo $dynamicId; ?>);" 
							value="<?php echo isset($form_settings[$dynamicId]["cb_label_value"])  ? $form_settings[$dynamicId]["cb_label_value"] :  _e( "Time", contact_bank ); ?>" 
							id="ux_label_text_<?php echo $dynamicId; ?>" placeholder="<?php _e( "Enter Label", contact_bank ); ?>" name="ux_label_text_<?php echo $dynamicId; ?>" />
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e("Description", contact_bank); ?> :</label>
						<div class="layout-controls">
							<textarea class="layout-span12" id="ux_description_control_<?php echo $dynamicId; ?>" 
								placeholder="<?php _e( "Enter Description", contact_bank ); ?>" 
								name="ux_description_control_<?php echo $dynamicId; ?>" ><?php echo isset($form_settings[$dynamicId]["cb_description"]) ? $form_settings[$dynamicId]["cb_description"] : ""; ?></textarea>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Required", contact_bank ); ?> :</label>
						<div class="layout-controls" style="margin-top:7px;">
							<?php
							if(isset($form_settings[$dynamicId]["cb_control_required"]))
							{
								if($form_settings[$dynamicId]["cb_control_required"] == "1")
								{
								?>
									<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>" 
										name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" checked="checked" />
									<label style="vertical-align: text-bottom;">
										<?php _e( "Required", contact_bank ); ?>
									</label>
									<input type="radio" id="ux_required_<?php echo $dynamicId; ?>" 
										name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0"/>
									<label style="vertical-align: text-bottom;">
										<?php _e( "Not Required", contact_bank ); ?>
									</label>
								<?php
								}
								else if($form_settings[$dynamicId]["cb_control_required"] == "0")
								{
									?>
									<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>" 
										name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" />
									<label style="vertical-align: text-bottom;">
									    <?php _e( "Required", contact_bank ); ?>
									</label>
									<input type="radio" id="ux_required_<?php echo $dynamicId; ?>" 
										name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0" checked="checked" />
									<label style="vertical-align: text-bottom;">
										<?php _e( "Not Required", contact_bank ); ?>
									</label>
								<?php
								}
							}
							else
							{
								?>
								<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>" 
									name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" />
								<label style="vertical-align: text-bottom;">
									<?php _e( "Required", contact_bank ); ?>
								</label>
								<input type="radio" id="ux_required_<?php echo $dynamicId; ?>" 
									name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0" checked="checked" />
								<label style="vertical-align: text-bottom;">
									<?php _e( "Not Required", contact_bank ); ?>
								</label>
								<?php
							}
							?>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e("Tooltip Text", contact_bank); ?> :</label>
						<div class="layout-controls">
							<input type="text" class="layout-span12" id="ux_tooltip_control_<?php echo $dynamicId; ?>" 
								placeholder="<?php _e( "Enter Tooltip", contact_bank ); ?>"  
								name="ux_tooltip_control_<?php echo $dynamicId; ?>" 
								value="<?php echo isset($form_settings[$dynamicId]["cb_tooltip_txt"]) ? $form_settings[$dynamicId]["cb_tooltip_txt"] : ""; ?>" />
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Admin Label", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<input type="text" class="layout-span12" name="ux_admin_label_<?php echo $dynamicId; ?>"
								value="<?php echo isset($form_settings[$dynamicId]["cb_admin_label"])  ? $form_settings[$dynamicId]["cb_admin_label"] :  _e( "Untitled", contact_bank ); ?>" 
								id="ux_admin_label_<?php echo $dynamicId; ?>" placeholder="<?php _e( "Enter Admin Label", contact_bank ); ?>" />
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Do not show in the email", contact_bank ); ?> :</label>
						<div class="layout-controls"  style="margin-top: 10px;">
							<?php
							if(isset($form_settings[$dynamicId]["cb_show_email"]))
							{
								if($form_settings[$dynamicId]["cb_show_email"] == "1")
								{
								?>
									<input type="checkbox" checked="checked"  id="ux_show_email_<?php echo $dynamicId; ?>"
										name="ux_show_email_<?php echo $dynamicId; ?>" value="1">
								<?php
								}
								else
								{
								?>
									<input type="checkbox" id="ux_show_email_<?php echo $dynamicId; ?>" 
										name="ux_show_email_<?php echo $dynamicId; ?>" value="0">
								<?php
								}
							}
							else
							{
								?>
								<input type="checkbox" id="ux_show_email_<?php echo $dynamicId; ?>" 
									name="ux_show_email_<?php echo $dynamicId; ?>" value="0">
							<?php
							}
							?>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Hour Format", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<select class="layout-span12" id="ux_drop_hour_time_<?php echo $dynamicId; ?>" name="ux_drop_hour_time_<?php echo $dynamicId; ?>" onchange="change_hour_format();">
								<option  value="12" selected="selected">12 Hours</option>
								<option value="24">24 Hours</option>
							</select>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Minute Format", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<select class="layout-span12" id="ux_minute_format_<?php echo $dynamicId; ?>" name="ux_minute_format_<?php echo $dynamicId; ?>" onchange="change_minute_format();">
								<option value="1" selected="selected">1</option>
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="15">15</option>
								<option value="20">20</option>
								<option value="30">30</option>
							</select>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Default Value", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<select  class="layout-span4"  id="ux_default_hours_12_<?php echo $dynamicId; ?>" name="ux_default_hours_12_<?php echo $dynamicId; ?>">
								<option selected="selected" value=""><?php _e("Hour", contact_bank); ?></option>
							</select>
							<select class="layout-span4" id="ux_default_minute_<?php echo $dynamicId; ?>" name="ux_default_minute_<?php echo $dynamicId; ?>">
								<option selected="selected" value=""><?php _e("Minute", contact_bank); ?></option>
							</select>
							<select class="layout-span4" id="ux_default_am_<?php echo $dynamicId; ?>" name="ux_default_am_<?php echo $dynamicId; ?>">
								<option value="0" selected="selected">AM</option>
								<option value="1">PM</option>
							</select>
						</div>
					</div>
					<input type="hidden" id="ux_hd_textbox_dynamic_id" name="ux_hd_textbox_dynamic_id" value="<?php echo $dynamicId; ?>"/>
				</div>
			</div>
			<div class="layout-control-group">
				<input type="submit" class="btn btn-info layout-span3" value="<?php _e( "Save Settings", contact_bank ); ?>" />
			</div>
		</div>
	</div>
</form>
<a class="closeButtonLightbox" onclick="CloseLightbox();"></a>
<script type="text/javascript">
	jQuery(".hovertip").tooltip({placement: "left"});
	var dynamicId = "<?php echo $dynamicId; ?>";
	var controlId = "<?php echo $control_id; ?>";
	var form_id = "<?php echo $form_id;?>";
	jQuery(document).ready(function()
	{
		<?php
		{
			?>
			jQuery("#ux_drop_hour_time_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_hour_format"];?>");
			<?php
			if($form_settings[$dynamicId]["cb_hours"] == "12")
			{
				?>
				jQuery("#ux_default_am_"+dynamicId).show();
				<?php
			}
			else
			{
				?>
				jQuery("#ux_default_am_"+dynamicId).hide();
				<?php
			}
		}
		if(isset($form_settings[$dynamicId]["cb_time_format"]))
		{
			?>
			jQuery("#ux_minute_format_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_time_format"];?>");
			<?php
		}
		?>
		change_hour_format();
		change_minute_format();
		<?php
		if(isset($form_settings[$dynamicId]["cb_hours"]))
		{
			?>
			jQuery("#ux_default_hours_12_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_hours"] == "" ? "" : intval($form_settings[$dynamicId]["cb_hours"]);?>");
			<?php
		}
		if(isset($form_settings[$dynamicId]["cb_minutes"]))
		{
			?>
			jQuery("#ux_default_minute_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_minutes"] == "" ? "" : intval($form_settings[$dynamicId]["cb_minutes"]);?>");
			<?php
		}
		if(isset($form_settings[$dynamicId]["cb_am_pm"]))
		{
			?>
			jQuery("#ux_default_am_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_am_pm"];?>");
			<?php
		}
		if(isset($form_settings[$dynamicId]["cb_time_format"]))
		{
			?>
			jQuery("#ux_minute_format_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_time_format"];?>");
			<?php
		}
	?>
	});
	jQuery("#ux_frm_time_control").validate
	({
		submitHandler: function(form)
		{
			jQuery.post(ajaxurl, jQuery(form).serialize() + "&controlId="+controlId+"&form_id="+form_id+"&form_settings="+JSON.stringify(<?php echo json_encode($form_settings) ?>)+"&event=update&param=save_time_control&action=add_contact_form_library", function(data)
			{
				jQuery("#control_label_"+dynamicId).html(jQuery("#ux_label_text_"+dynamicId).val()+" :");
				jQuery("#txt_description_"+dynamicId).html(jQuery("#ux_description_control_"+dynamicId).val());
				jQuery("#tooltip_txt_hidden_value_"+dynamicId).val(jQuery("#ux_tooltip_control_"+dynamicId).val());
				jQuery("#show_tooltip"+dynamicId).attr("data-original-title",jQuery("#ux_tooltip_control_"+dynamicId).val());
				var hour_format = jQuery("#ux_drop_hour_time_"+dynamicId).val();
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
				jQuery("#ux_ddl_select_hr_12_"+dynamicId).val(jQuery("#ux_default_hours_12_"+dynamicId).val());
				var minute_format = parseInt(jQuery("#ux_minute_format_"+dynamicId).val());
				jQuery("#ux_ddl_select_minute_"+dynamicId).children("option:not(:first)").remove();
				for(var flag = 0; flag<60;flag = flag +minute_format)
				{
					jQuery("#ux_ddl_select_minute_"+dynamicId).append("<option value=\""+flag+"\">"  +  (flag < 10 ? "0" + flag : flag) + "</option>");
				}
				jQuery("#ux_ddl_select_minute_"+dynamicId).val(jQuery("#ux_default_minute_"+dynamicId).val());
				jQuery("#ux_ddl_select_ampm_"+dynamicId).val(jQuery("#ux_default_am_"+dynamicId).val());
				if(jQuery("#ux_required_control_"+dynamicId).prop("checked") == true)
				{
					jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
				}
				CloseLightbox();
			});
		}
	});
	function change_hour_format()
	{
		var hour_format = jQuery("#ux_drop_hour_time_"+dynamicId).val();
		jQuery("#ux_default_hours_12_"+dynamicId).children("option:not(:first)").remove();
		if(hour_format == "12")
		{
			for(var flag = 1; flag<=12;flag++)
			{
				jQuery("#ux_default_hours_12_"+dynamicId).append("<option value=\""+flag+"\">" +  (flag < 10 ? "0" + flag : flag) + "</option>");
			}
			jQuery("#ux_default_am_"+dynamicId).show();
		}
		else
		{
			for(var flag = 0; flag<24;flag++)
			{
				jQuery("#ux_default_hours_12_"+dynamicId).append("<option value=\""+flag+"\">"+  (flag < 10 ? "0" + flag : flag) + "</option>");
			}
			jQuery("#ux_default_am_"+dynamicId).hide();
		}
	}
	function change_minute_format()
	{
		var minute_format = parseInt(jQuery("#ux_minute_format_"+dynamicId).val());
		jQuery("#ux_default_minute_"+dynamicId).children("option:not(:first)").remove();
		for(var flag = 0; flag<60;flag = flag +minute_format)
		{
			jQuery("#ux_default_minute_"+dynamicId).append("<option value=\""+flag+"\">"  +  (flag < 10 ? "0" + flag : flag) + "</option>");
		}
	}
</script>