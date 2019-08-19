<?php
	include CONTACT_BK_PLUGIN_DIR . "/lib/include_contact_roles_capabilies.php";
	$last_form_id = $wpdb->get_var
	(
		"SELECT form_id FROM " .contact_bank_contact_form(). " order by form_id desc limit 1"
	);
	$contact_id = count($last_form_id) == 0 ? 1 : $last_form_id + 1;
?>
<div id="cb_outdated_message" class="message red" style="display: none;"> 
	<span>
		<strong>
			<?php _e("Attention! A new version of Contact Bank is available for download.", contact_bank); ?>
			<?php _e("Click", contact_bank); ?> <a style="text-decoration:underline !important;" href="plugins.php#contact-bank-pro-version"><?php _e("here", contact_bank); ?></a>
			<?php _e("to upgrade your version of Contact Bank.", contact_bank); ?>
	    </strong>
	</span>
</div>
<div class="fluid-layout">
	<div class="layout-span12">
		<div class="widget-layout">
			<div class="widget-layout-title">
				<h4>
					<?php _e("Dashboard - Contact Bank", contact_bank); ?>
				</h4>
			</div>
			<div class="widget-layout-body">
				<?php
				switch ($cb_role) 
				{
					case "administrator":
						if($cb_admin_write_control == "1" && $cb_admin_read_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
						elseif($cb_admin_write_control == "1" || $cb_admin_full_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
					break;
					case "editor":
						if($cb_editor_write_control == "1" && $cb_editor_read_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
						elseif($cb_editor_full_control == "1" || $cb_editor_write_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
					break;
					case "author":
						if($cb_author_read_control == "1" && $cb_author_write_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
						elseif($cb_author_full_control == "1" || $cb_author_write_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
					break;
					case "contributor":
						if($cb_contributor_read_control == "1" && $cb_contributor_write_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
						elseif($cb_contributor_full_control == "1" || $cb_contributor_write_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
					break;
					case "subscriber":
						if($cb_subscriber_read_control == "1" && $cb_subscriber_write_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
						elseif($cb_subscriber_full_control == "1" || $cb_subscriber_write_control == "1")
						{
							?>
							<a class="btn btn-info"
								href="admin.php?page=contact_bank&form_id=<?php echo $contact_id; ?>"><?php _e("Add New Form", contact_bank); ?>
							</a>
							<a class="btn btn-info" href="#"
								onclick="delete_forms();"><?php _e("Delete All Forms", contact_bank); ?>
							</a>
							<a class="btn btn-danger" href="#"
								onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", contact_bank); ?>
							</a>
							<?php
						}
				}
				?>
				<div class="separator-doubled"></div>
				<div class="fluid-layout">
					<div class="layout-span12" style="min-height:600px;">
						<div class="widget-layout">
							<div class="widget-layout-title">
								<h4>
									<?php _e("Form", contact_bank); ?>
								</h4>
							</div>
							<div class="widget-layout-body">
								<table class="table table-striped" id="data-table-form">
									<thead>
									<tr>
										<th style="width: 30%"><?php _e("Form", contact_bank); ?></th>
										<th style="width: 30%"><?php _e("Shortcode", contact_bank); ?></th>
										<th style="width: 10%"><?php _e("Total Controls", contact_bank); ?></th>
										<th style="width: 30%" style="padding-left: 5%;"></th>
									</tr>
									</thead>
									<tbody>
									<?php
									global $wpdb;
									$form_data = $wpdb->get_results
									(
										"SELECT * FROM " . contact_bank_contact_form()
									);
									for ($flag = 0; $flag < count($form_data); $flag++) 
									{
										$total_control = $wpdb->get_var
										(
											$wpdb->prepare
											(
												" SELECT count(" . contact_bank_contact_form() . ".form_id) FROM " . contact_bank_contact_form() . " JOIN ". create_control_Table() . " ON " . create_control_Table() .".form_id = ".contact_bank_contact_form(). 
												".form_id WHERE " . contact_bank_contact_form() . ".form_id = %d",
												$form_data[$flag]->form_id
											)
										);
										?>
										<tr>
											<td>
												<?php echo $form_data[$flag]->form_name; ?>
											</td>
											<td>
												<?php echo "[contact_bank form_id=" . $form_data[$flag]->form_id . " show_title=true ]"; ?>
											</td>
											<td>
												<?php echo $total_control;?>
											</td>
											<td>
												<?php
												switch ($cb_role) 
												{
													case "administrator":
														if($cb_admin_full_control == "0" && $cb_admin_read_control == "1" && $cb_admin_write_control == "0")
														{
															?>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<?php
														}
														else if($cb_admin_full_control == "0" && ($cb_admin_read_control == "1" || $cb_admin_write_control == "1"))
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
														else
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=layout_settings&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Global Settings", contact_bank) ?>">
																<i class="icon-wrench"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
													break;
													case "editor":
														if($cb_editor_full_control == "0" && $cb_editor_read_control == "1" && $cb_editor_write_control == "0")
														{
															?>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<?php
														}
														else if($cb_editor_full_control == "0" && ($cb_editor_read_control == "1" || $cb_editor_write_control == "1"))
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
														else
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=layout_settings&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Global Settings", contact_bank) ?>">
																<i class="icon-wrench"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
													break;
													case "author":
														if($cb_author_full_control == "0" && $cb_author_read_control == "1" && $cb_author_write_control == "0")
														{
															?>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<?php
														}
														else if($cb_author_full_control == "0" && ($cb_author_read_control == "1" || $cb_author_write_control == "1"))
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
														else
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=layout_settings&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Global Settings", contact_bank) ?>">
																<i class="icon-wrench"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
													break;
													case "contributor":
														if($cb_contributor_full_control == "0" && $cb_contributor_read_control == "1" && $cb_contributor_write_control == "0")
														{
															?>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<?php
														}
														else if($cb_contributor_full_control == "0" && ($cb_contributor_read_control == "1" || $cb_contributor_write_control == "1"))
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
														else
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=layout_settings&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Global Settings", contact_bank) ?>">
																<i class="icon-wrench"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
													break;
													case "subscriber":
														if($cb_subscriber_full_control == "0" && $cb_subscriber_read_control == "1" && $cb_subscriber_write_control == "0")
														{
															?>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<?php
														}
														else if($cb_subscriber_full_control == "0" && ($cb_subscriber_read_control == "1" || $cb_subscriber_write_control == "1"))
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
														else
														{
															?>
															<a href="admin.php?page=contact_bank&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Edit Form", contact_bank) ?>">
																<i class="icon-pencil"></i>
															</a>
															<a href="admin.php?page=layout_settings&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Global Settings", contact_bank) ?>">
																<i class="icon-wrench"></i>
															</a>
															<a href="admin.php?page=contact_email&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Email Settings", contact_bank) ?>">
																<i class="icon-envelope"></i>
															</a>
															<a href="admin.php?page=frontend_data&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Entries", contact_bank) ?>">
																<i class="icon-tasks"></i>
															</a>
															<a href="admin.php?page=form_preview&form_id=<?php echo $form_data[$flag]->form_id; ?>"
																class="btn hovertip"
																data-original-title="<?php _e("Form Preview", contact_bank) ?>">
																<i class="icon-eye-open"></i>
															</a>
															<a herf="#"
																onclick="delete_form(<?php echo $form_data[$flag]->form_id; ?>);"
																class="btn hovertip"
																data-original-title="<?php _e("Delete Form", contact_bank) ?>">
																<i class="icon-trash"></i>
															</a>
															<?php
														}
													break;
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	jQuery(".hovertip").tooltip();
	oTable = jQuery("#data-table-form").dataTable
	({
		"bJQueryUI": false,
		"bAutoWidth": true,
		"sPaginationType": "full_numbers",
		"sDom": "<\"datatable-header\"fl>t<\"datatable-footer\"ip>",
		"oLanguage": {
		"sLengthMenu": "<span>Show entries:</span> _MENU_"
		},
		"aaSorting": [
			[ 0, "asc" ]
		],
		"aoColumnDefs": [
			{ "bSortable": false, "aTargets": [2] }
		]
	});
	<?php
		switch($cb_role)
		{
			case "administrator":
				if($cb_admin_full_control == "1")
				{
					?>
						get_cb_plugin_update();
					<?php
				}
			break;
			case "editor":
				if($cb_editor_full_control == "1")
				{
					?>
					get_cb_plugin_update();
				<?php
				}
			break;
			case "author":
				if($cb_author_full_control == "1")
				{
					?>
					get_cb_plugin_update();
				<?php
				}
			break;
			case "contributor":
				if($cb_contributor_full_control == "1")
				{
					?>
					get_cb_plugin_update();
					<?php
				}
			break;
			case "subscriber":
				if($cb_subscriber_full_control == "1")
				{
					?>
					get_cb_plugin_update();
					<?php
				}
			break;
		}
	?>
	function get_cb_plugin_update()
	{
		jQuery.post("http://tech-banker.com/wp-admin/admin-ajax.php?param=contact_bank_check_update&action=license_validator", function (data)
		{
			
			<?php
			$checkCBVersion = get_option("contact-bank-version-number");
			?>
			if(jQuery.trim(data) != "<?php echo $checkCBVersion;?>")
			{
				jQuery("#cb_outdated_message").css("display","block");
			}
		});
	}
	function delete_form(form_Id) {
		var check_str = confirm("<?php _e( "Are you sure, you want to delete this Form?", contact_bank ); ?>");
		if (check_str == true)
		{
			jQuery.post(ajaxurl, "id=" + form_Id + "&param=delete_form&action=add_contact_form_library", function (data)
			{
				location.reload();
			});
		}
	}
	function delete_forms() {
		var checkstr = confirm("<?php _e( "Are you sure, you want to delete all Forms?", contact_bank ); ?>");
		if (checkstr == true) 
		{
			jQuery.post(ajaxurl, "param=delete_forms&action=add_contact_form_library", function (data) {
			location.reload();
			});
		}
	}
	function restore_factory_settings() {
		var r = confirm("<?php _e( "Are you sure you want to Restore Factory Settings?", contact_bank ); ?>");
		if (r == true) 
		{
			jQuery.post(ajaxurl, "&param=restore_factory_settings&action=add_contact_form_library", function (data) {
			location.reload();
			});
		}
	}
</script>