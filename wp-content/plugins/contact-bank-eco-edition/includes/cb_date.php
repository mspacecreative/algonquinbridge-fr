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
<form id="ux_frm_date_control" action="#" method="post" class="layout-form">
	<div class="fluid-layout">
		<div class="layout-span12">
			<div class="widget-layout">
				<div class="widget-layout-title">
					<h4><?php _e( "Date", contact_bank ); ?></h4>
				</div>
				<div class="widget-layout-body">
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Label", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<input onkeyup="enter_admin_label(<?php echo $dynamicId; ?>);" value="<?php echo isset($form_settings[$dynamicId]["cb_label_value"])  ? $form_settings[$dynamicId]["cb_label_value"] :  _e( "Date", contact_bank ); ?>" type="text" class="layout-span12" id="ux_label_text_<?php echo $dynamicId; ?>" placeholder="<?php _e( "Enter Label", contact_bank ); ?>"  name="ux_label_text_<?php echo $dynamicId; ?>"/>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e("Description", contact_bank); ?> :</label>
						<div class="layout-controls">
							<textarea class="layout-span12" id="ux_description_control_<?php echo $dynamicId; ?>"  placeholder="<?php _e( "Enter Description", contact_bank ); ?>"  name="ux_description_control_<?php echo $dynamicId; ?>"><?php echo isset($form_settings[$dynamicId]["cb_description"]) ? $form_settings[$dynamicId]["cb_description"] : ""; ?></textarea>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Required", contact_bank ); ?> :</label>
						<div class="layout-controls" style="margin-top: 7px;">
							<?php
								if(isset($form_settings[$dynamicId]["cb_control_required"]))
								{
									if($form_settings[$dynamicId]["cb_control_required"] == "1")
									{
									?>
										<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>" name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" checked="checked" />
										<label style="vertical-align: text-bottom;">
										    <?php _e( "Required", contact_bank ); ?>
										</label>
										<input type="radio" id="ux_required_<?php echo $dynamicId; ?>" name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0"/>
										<label style="vertical-align: text-bottom;">
										    <?php _e( "Not Required", contact_bank ); ?>
										</label>
									<?php
									}
									else if($form_settings[$dynamicId]["cb_control_required"] == "0")
									{
										?>
										<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>" name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" />
										<label style="vertical-align: text-bottom;">
											<?php _e( "Required", contact_bank ); ?>
										</label>
										<input type="radio" id="ux_required_<?php echo $dynamicId; ?>" name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0" checked="checked" />
										<label style="vertical-align: text-bottom;">
											<?php _e( "Not Required", contact_bank ); ?>
										</label>
									<?php
									}
								}
								else
								{
									?>
									<input type="radio" id="ux_required_control_<?php echo $dynamicId; ?>" name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="1" />
									<label style="vertical-align: text-bottom;">
										<?php _e( "Required", contact_bank ); ?>
									</label>
									<input type="radio" id="ux_required_<?php echo $dynamicId; ?>" name="ux_required_control_radio_<?php echo $dynamicId; ?>" value="0" checked="checked" />
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
							<input type="text" class="layout-span12" id="ux_tooltip_control_<?php echo $dynamicId; ?>"  placeholder="<?php _e( "Enter Tooltip", contact_bank ); ?>" name="ux_tooltip_control_<?php echo $dynamicId; ?>" value="<?php echo isset($form_settings[$dynamicId]["cb_tooltip_txt"]) ? $form_settings[$dynamicId]["cb_tooltip_txt"] : ""; ?>"/>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Admin Label", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<input type="text" class="layout-span12" id="ux_admin_label_<?php echo $dynamicId; ?>"  placeholder="<?php _e( "Enter Admin Label", contact_bank ); ?>" name="ux_admin_label_<?php echo $dynamicId; ?>" value="<?php echo isset($form_settings[$dynamicId]["cb_admin_label"])  ? $form_settings[$dynamicId]["cb_admin_label"] :  _e( "Date", contact_bank ); ?>"/>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Do not show in the email", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<?php
								if(isset($form_settings[$dynamicId]["cb_show_email"]))
								{
									if($form_settings[$dynamicId]["cb_show_email"] == "1")
									{
									?>
									    <input type="checkbox" checked="checked"  id="ux_show_email_<?php echo $dynamicId; ?>" name="ux_show_email_<?php echo $dynamicId; ?>" style="margin-top: 10px;" value="1">
									<?php
									}
									else
									{
									?>
									    <input type="checkbox" id="ux_show_email_<?php echo $dynamicId; ?>" name="ux_show_email_<?php echo $dynamicId; ?>" style="margin-top: 10px;" value="0">
									<?php
									}
								}
								else
								{
									?>
									<input type="checkbox" id="ux_show_email_<?php echo $dynamicId; ?>" name="ux_show_email_<?php echo $dynamicId; ?>" style="margin-top: 10px;" value="0">
								<?php
								}
							?>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Start Year", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<input type="text" value="<?php echo isset($form_settings[$dynamicId]["cb_start_year"])  ? $form_settings[$dynamicId]["cb_start_year"] :  "1900"; ?>" onkeypress="return OnlyNumbers(event)" maxlength="4" class="layout-span12"  placeholder="<?php _e( "Enter Start Year", contact_bank ); ?>"  onblur="bind_date_controls();" id="ux_start_year_label_<?php echo $dynamicId; ?>" name="ux_start_year_label_<?php echo $dynamicId; ?>"/>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "End Year", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<input type="text" value="<?php echo isset($form_settings[$dynamicId]["cb_end_year"])  ? $form_settings[$dynamicId]["cb_end_year"] :  "2100"; ?>"  onkeypress="return OnlyNumbers(event)" maxlength="4" class="layout-span12"  id="ux_last_year_label_<?php echo $dynamicId; ?>" placeholder="<?php _e( "Enter End Year ", contact_bank ); ?>" onblur="bind_date_controls();" name="ux_last_year_label_<?php echo $dynamicId; ?>"/>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Default Value", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<select class="layout-span4"  name="ux_default_day_type_<?php echo $dynamicId; ?>" id="ux_default_day_type_<?php echo $dynamicId; ?>">
								<option value="" selected="selected"><?php _e( "Day", contact_bank ); ?></option>
								<?php
									for ($flag = 1; $flag <= 31; $flag++)
									{
										if ($flag < 10)
										{
											if(isset($form_settings[$dynamicId]["cb_default_value_day"]))
											{
												if($form_settings[$dynamicId]["cb_default_value_day"] == $flag)
												{
												?>
													<option selected="selected" value="<?php echo $flag; ?>">0<?php echo $flag; ?></option>
												<?php
													continue;
												}
											}
											?>
											<option value="<?php echo $flag; ?>">0<?php echo $flag; ?></option>
											<?php
										}
										else
										{
											if(isset($form_settings[$dynamicId]["cb_default_value_day"]))
											{
												if($form_settings[$dynamicId]["cb_default_value_day"] == $flag)
												{
													?>
													<option selected="selected" value="<?php echo $flag; ?>"><?php echo $flag; ?></option>
													<?php
													continue;
												}
											}
											?>
											<option value=<?php echo $flag; ?>><?php echo $flag; ?></option>
										<?php
										}
									}
									?>
							</select>
							<label id="day_<?php echo $dynamicId; ?>"></label>
							<select class="layout-span4"  name="ux_default_month_type_<?php echo $dynamicId; ?>" onchange="current_year_leap_check();" id="ux_default_month_type_<?php echo $dynamicId; ?>">
								<option value=""><?php _e("Month", contact_bank); ?></option>
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
							<select class="layout-span4"  name="ux_default_year_type_<?php echo $dynamicId; ?>" id="ux_default_year_type_<?php echo $dynamicId; ?>" onchange="current_year_leap_check();" >
								<option value="" selected="selected"><?php _e( "Year", contact_bank ); ?></option>
							</select>
						</div>
					</div>
					<div class="layout-control-group">
						<label class="layout-control-label"><?php _e( "Date Format", contact_bank ); ?> :</label>
						<div class="layout-controls">
							<select class="layout-span12" name="uxDefaultDateFormat_<?php echo $dynamicId; ?>" class="style required" id="uxDefaultDateFormat_<?php echo $dynamicId; ?>" >
								<?php
								$date = date("j"); 
								$monthName = date("F");
								$monthNumeric = date("m");
								$year = date("Y");
								?>	
								<option value="0" selected="selected"><?php echo  $monthName ." ".$date.",  ".$year; ?></option>
								<option value="1" ><?php echo  $year ."/".$monthNumeric."/".$date; ?></option>
								<option value="2"><?php echo  $monthNumeric ."/".$date."/".$year; ?></option>
								<option value="3"><?php echo $date ."/".$monthNumeric."/".$year;  ?></option>
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
		bind_date_controls();
		<?php
		if(isset($form_settings[$dynamicId]["cb_default_value_month"]))
		{
			?>
			jQuery("#ux_default_month_type_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_default_value_month"];?>");
			<?php
		}
		if(isset($form_settings[$dynamicId]["cb_default_value_year"]))
		{
			?>
				jQuery("#ux_default_year_type_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_default_value_year"];?>");
			<?php
		}
		if(isset($form_settings[$dynamicId]["cb_date_format"]))
		{
			?>
				jQuery("#uxDefaultDateFormat_"+dynamicId).val("<?php echo $form_settings[$dynamicId]["cb_date_format"];?>");
			<?php
		}
		?>
	});
	jQuery("#ux_frm_date_control").validate
	({
		submitHandler: function(form)
		{
			jQuery.post(ajaxurl, jQuery(form).serialize() + "&controlId="+controlId+"&form_id="+form_id+"&form_settings="+JSON.stringify(<?php echo json_encode($form_settings) ?>)+"&event=update&param=save_date_control&action=add_contact_form_library", function(data)
			{
				jQuery("#control_label_"+dynamicId).html(jQuery("#ux_label_text_"+dynamicId).val()+" :");
				jQuery("#txt_description_"+dynamicId).html(jQuery("#ux_description_control_"+dynamicId).val());
				jQuery("#show_tooltip"+dynamicId).attr("data-original-title",jQuery("#ux_tooltip_control_"+dynamicId).val());
				if(jQuery("#ux_required_control_"+dynamicId).prop("checked") == true)
				{
					jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
				}
				jQuery("#ux_ddl_select_year_"+dynamicId).children("option:not(:first)").remove();
				var start_year = jQuery("#ux_start_year_label_"+dynamicId).val() == "" ? 1900 : jQuery("#ux_start_year_label_"+dynamicId).val();
				var end_year = jQuery("#ux_last_year_label_"+dynamicId).val() == "" ? 2100 : jQuery("#ux_last_year_label_"+dynamicId).val();
				for(var year = start_year; year<=end_year;year++)
				{
				    jQuery("#ux_ddl_select_year_"+dynamicId).append("<option value=\""+year+"\">"+year+"</option>");
				}
				jQuery("#ux_ddl_select_year_"+dynamicId).val(jQuery("#ux_default_year_type_"+dynamicId).val());
				jQuery("#ux_ddl_select_day_"+dynamicId).val(jQuery("#ux_default_day_type_"+dynamicId).val());
				jQuery("#ux_ddl_select_month_"+dynamicId).val(jQuery("#ux_default_month_type_"+dynamicId).val());
				CloseLightbox();
			});
		}
	});
	function bind_date_controls()
	{
		jQuery("#ux_default_year_type_"+dynamicId).children("option:not(:first)").remove();
		var start_year = jQuery("#ux_start_year_label_"+dynamicId).val() == "" ? 1900 : jQuery("#ux_start_year_label_"+dynamicId).val();
		var end_year = jQuery("#ux_last_year_label_"+dynamicId).val() == "" ? 2100 : jQuery("#ux_last_year_label_"+dynamicId).val();
		for(var year = start_year; year<=end_year;year++)
		{
		    jQuery("#ux_default_year_type_"+dynamicId).append("<option value=\""+year+"\">"+year+"</option>");
		    jQuery("#ux_default_year_type_"+dynamicId+" option:nth(1)").attr("selected", "selected");
		}
	}
	function current_year_leap_check()
	{
		var year =  jQuery("#ux_default_year_type_"+dynamicId).val();
		var month = jQuery("#ux_default_month_type_"+dynamicId).val();
		if(month == 2)
		{
			if((year % 4 == 0) && (year % 100 != 0) || (year % 400 == 0))
			{
				if(jQuery("#ux_default_day_type_"+dynamicId+ " option[value=\"29\"]").length == 0)
				{
				    jQuery("#ux_default_day_type_"+dynamicId).append("<option value=\"29\">29</option>");
				}
				jQuery("#ux_default_day_type_"+dynamicId+ " option[value=30]").remove();
				jQuery("#ux_default_day_type_"+dynamicId+ " option[value=31]").remove();
			}
			else
			{
				jQuery("#ux_default_day_type_"+dynamicId+ " option[value=29]").remove();
				jQuery("#ux_default_day_type_"+dynamicId+ " option[value=30]").remove();
				jQuery("#ux_default_day_type_"+dynamicId+ " option[value=31]").remove();
			}
		}
		else if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12)
		{
			if(jQuery("#ux_default_day_type_"+dynamicId+ " option[value=\"29\"]").length == 0)
			{
				jQuery("#ux_default_day_type_"+dynamicId).append("<option value=\"29\">29</option>");
			}
			if(jQuery("#ux_default_day_type_"+dynamicId+ " option[value=\"30\"]").length == 0)
			{
				jQuery("#ux_default_day_type_"+dynamicId).append("<option value=\"30\">30</option>");
			}
			if(jQuery("#ux_default_day_type_"+dynamicId+ " option[value=\"31\"]").length == 0)
			{
				jQuery("#ux_default_day_type_"+dynamicId).append("<option value=\"31\">31</option>");
			}
		}
		else if(month == 4 || month == 6 || month == 9 || month == 11)
		{
			if(jQuery("#ux_default_day_type_"+dynamicId+ " option[value=\"29\"]").length == 0)
			{
				jQuery("#ux_default_day_type_"+dynamicId).append("<option value=\"29\">29</option>");
			}
			if(jQuery("#ux_default_day_type_"+dynamicId+ " option[value=\"30\"]").length == 0)
			{
				jQuery("#ux_default_day_type_"+dynamicId).append("<option value=\"30\">30</option>");
			}
			if(jQuery("#ux_default_day_type_"+dynamicId+ " option[value=\"31\"]").length != 0)
			{
				jQuery("#ux_default_day_type_"+dynamicId+ " option[value=31]").remove();
			}
		}
	}
</script>