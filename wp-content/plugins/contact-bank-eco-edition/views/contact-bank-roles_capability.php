<?php
include CONTACT_BK_PLUGIN_DIR . "/lib/include_contact_roles_capabilies.php";
?>
<form id="ux_frm_roles_settings" class="layout-form">
	<div class="fluid-layout">
		<div class="layout-span12">
			<div class="widget-layout">
				<div class="widget-layout-title">
					<h4><?php _e( "Roles & Capabilities", contact_bank ); ?></h4>
				</div>
				<div class="widget-layout-body">
					<a class="btn btn-info" href="admin.php?page=dashboard"><?php _e("Back to Dashboard", contact_bank);?></a>
					<input  class="btn btn-info layout-span1" type="submit" id="submit_button" name="submit_button" style="float: right;"  value="<?php _e("Save", contact_bank); ?>" />
					<div class="separator-doubled"></div>
					<div id="form_success_message" class="message green" style="display: none;">
						<span>
							<strong><?php _e("Roles and Capabilities Saved. Kindly wait for the redirect.", contact_bank); ?></strong>
						</span>
					</div>
					<div class="fluid-layout">
						<div class="layout-span12">
							<div class="widget-layout">
						        <div class="widget-layout-title">
						            <h4><?php _e("Roles & Capabilities", contact_bank); ?></h4>
										<span class="tools">
											<a data-target="#capabilities_settings" data-toggle="collapse">
		                                        <i class="icon-chevron-down"></i>
		                                    </a>
										</span>
						        </div>
			        			<div id="capabilities_settings" class="collapse in">
						            <div class="widget-layout-body">
						                <div class="layout-control-group">
						                    <label class="layout-control-label"><?php _e("Privileges for Admin", contact_bank); ?> : </label>
						                    <div class="layout-controls-radio">
						                        <input type="checkbox" id="ux_full_control_to_admin" onclick="disable_admin_checkbox(this);"
						                               name="ux_full_control_to_admin" value="1"/><label
						                            style="vertical-align: baseline;"><?php _e("Full Control", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_read_control_to_admin" name="ux_read_control_to_admin" value="1"
						                               style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Read", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_write_control_to_admin" name="ux_write_control_to_admin" value="1"
						                               style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Write", contact_bank); ?></label>
						                    </div>
						                </div>
						            </div>
						            <div class="widget-layout-body">
						                <div class="layout-control-group">
						                    <label class="layout-control-label"><?php _e("Privileges for Editor", contact_bank); ?> : </label>
						                    <div class="layout-controls-radio">
						                        <input type="checkbox" id="ux_full_control_to_editor" onclick="disable_admin_checkbox(this);"
						                               name="ux_full_control_to_editor" value="1"/><label
						                            style="vertical-align: baseline;"><?php _e("Full Control", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_read_control_to_editor" name="ux_read_control_to_editor" value="1"
						                               style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Read", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_write_control_to_editor" name="ux_write_control_to_editor"
						                               value="1" style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Write", contact_bank); ?></label>
						                    </div>
						                </div>
						            </div>
						            <div class="widget-layout-body">
						                <div class="layout-control-group">
						                    <label class="layout-control-label"><?php _e("Privileges for Author", contact_bank); ?> : </label>
						                    <div class="layout-controls-radio">
						                        <input type="checkbox" id="ux_full_control_to_author" onclick="disable_admin_checkbox(this);"
						                               name="ux_full_control_to_author" value="1"/><label
						                            style="vertical-align: baseline;"><?php _e("Full Control", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_read_control_to_author" name="ux_read_control_to_author" value="1"
						                               style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Read", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_write_control_to_author" name="ux_write_control_to_author"
						                               value="1" style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Write", contact_bank); ?></label>
						                    </div>
						                </div>
						            </div>
						            <div class="widget-layout-body">
						                <div class="layout-control-group">
						                    <label class="layout-control-label"><?php _e("Privileges for Contributor", contact_bank); ?>
						                        : </label>
						                    <div class="layout-controls-radio">
						                        <input type="checkbox" id="ux_full_control_to_contributor"
						                               onclick="disable_admin_checkbox(this);" name="ux_full_control_to_contributor" value="1"/><label
						                            style="vertical-align: baseline;"><?php _e("Full Control", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_read_control_to_contributor" name="ux_read_control_to_contributor"
						                               value="1" style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Read", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_write_control_to_contributor"
						                               name="ux_write_control_to_contributor" value="1" style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Write", contact_bank); ?></label>
						                    </div>
						                </div>
						            </div>
						            <div class="widget-layout-body">
						                <div class="layout-control-group">
						                    <label class="layout-control-label"><?php _e("Privileges for Subscriber", contact_bank); ?>
						                        : </label>
						                    <div class="layout-controls-radio">
						                        <input type="checkbox" id="ux_full_control_to_subscriber"
						                               onclick="disable_admin_checkbox(this);" name="ux_full_control_to_subscriber"
						                               value="1"/><label
						                            style="vertical-align: baseline;"><?php _e("Full Control", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_read_control_to_subscriber" name="ux_read_control_to_subscriber"
						                               value="1" style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Read", contact_bank); ?></label>
						                        <input type="checkbox" id="ux_write_control_to_subscriber" name="ux_write_control_to_subscriber"
						                               value="1" style="margin-left: 10px;"/><label
						                            style="vertical-align: baseline;"><?php _e("Write", contact_bank); ?></label>
						                    </div>
						                </div>
						            </div>
						        </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
jQuery("#ux_frm_roles_settings").validate
({
	submitHandler: function(form)
	{
		jQuery("#form_success_message").css("display","block");
		jQuery("body,html").animate({
		scrollTop: jQuery("body,html").position().top}, "slow");
		jQuery.post(ajaxurl, jQuery(form).serialize() +"&param=submit_roles_setting&action=layout_settings_contact_library", function(data)
		{
			setTimeout(function()
			{
				jQuery("#form_success_message").css("display","none");
				window.location.href = "admin.php?page=dashboard";
			}, 2000);
		});
	}
});
jQuery(document).ready(function () {
	<?php
        if($cb_admin_full_control == 1)
        {
            ?>
		        jQuery("#ux_full_control_to_admin").prop("checked", "checked");
		        jQuery("#ux_read_control_to_admin").prop("checked", "checked");
		        jQuery("#ux_read_control_to_admin").attr("disabled", "disabled");
		        jQuery("#ux_write_control_to_admin").prop("checked", "checked");
		        jQuery("#ux_write_control_to_admin").attr("disabled", "disabled");
		        <?php
    	}
		else 
		{
			?>
		       
		        jQuery("#ux_read_control_to_admin").removeAttr("checked");
		        jQuery("#ux_read_control_to_admin").removeAttr("disabled");
		        jQuery("#ux_write_control_to_admin").removeAttr("checked");
		        jQuery("#ux_write_control_to_admin").removeAttr("disabled");
		        <?php
		}
	    if($cb_admin_read_control == 1)
	    {
	        ?>
	        jQuery("#ux_read_control_to_admin").prop("checked", "checked");
	        <?php
	    }
	    if($cb_admin_write_control == 1)
	    {
	        ?>
	        jQuery("#ux_write_control_to_admin").prop("checked", "checked");
	        <?php
	    }
	    if($cb_editor_full_control == 1)
	    {
	        ?>
	        jQuery("#ux_full_control_to_editor").prop("checked", "checked");
	        jQuery("#ux_read_control_to_editor").prop("checked", "checked");
	        jQuery("#ux_read_control_to_editor").attr("disabled", "disabled");
	        jQuery("#ux_write_control_to_editor").prop("checked", "checked");
	        jQuery("#ux_write_control_to_editor").attr("disabled", "disabled");
	        <?php
	    }
	    if($cb_editor_read_control == 1)
	    {
	        ?>
	        jQuery("#ux_read_control_to_editor").prop("checked", "checked");
	        <?php
	    }
	    if($cb_editor_write_control == 1)
	    {
	        ?>
	        jQuery("#ux_write_control_to_editor").prop("checked", "checked");
	        <?php
	    }
	    if($cb_author_full_control == 1)
	    {
	        ?>
	        jQuery("#ux_full_control_to_author").prop("checked", "checked");
	        jQuery("#ux_read_control_to_author").prop("checked", "checked");
	        jQuery("#ux_read_control_to_author").attr("disabled", "disabled");
	        jQuery("#ux_write_control_to_author").prop("checked", "checked");
	        jQuery("#ux_write_control_to_author").attr("disabled", "disabled");
	        <?php
	    }
	    if($cb_author_read_control == 1)
	    {
	        ?>
	        jQuery("#ux_read_control_to_author").prop("checked", "checked");
	        <?php
	    }
	    if($cb_author_write_control == 1)
	    {
	        ?>
	        jQuery("#ux_write_control_to_author").prop("checked", "checked");
	        <?php
	    }
	    if($cb_contributor_full_control == 1)
	    {
	        ?>
	        jQuery("#ux_full_control_to_contributor").prop("checked", "checked");
	        jQuery("#ux_read_control_to_contributor").prop("checked", "checked");
	        jQuery("#ux_read_control_to_contributor").attr("disabled", "disabled");
	        jQuery("#ux_write_control_to_contributor").prop("checked", "checked");
	        jQuery("#ux_write_control_to_contributor").attr("disabled", "disabled");
	        <?php
	    }
	    if($cb_contributor_read_control == 1)
	    {
	        ?>
	        jQuery("#ux_read_control_to_contributor").prop("checked", "checked");
	        <?php
	    }
	    if($cb_contributor_write_control == 1)
	    {
	        ?>
	        jQuery("#ux_write_control_to_contributor").prop("checked", "checked");
	        <?php
	    }
	    if($cb_subscriber_full_control == 1)
	    {
	        ?>
	        jQuery("#ux_full_control_to_subscriber").prop("checked", "checked");
	        jQuery("#ux_read_control_to_subscriber").prop("checked", "checked");
	        jQuery("#ux_read_control_to_subscriber").attr("disabled", "disabled");
	        jQuery("#ux_write_control_to_subscriber").prop("checked", "checked");
	        jQuery("#ux_write_control_to_subscriber").attr("disabled", "disabled");
	        <?php
	    }
	    if($cb_subscriber_read_control == 1)
	    {
	        ?>
	        jQuery("#ux_read_control_to_subscriber").prop("checked", "checked");
	        <?php
	    }
	    if($cb_subscriber_write_control == 1)
	    {
	        ?>
	        jQuery("#ux_write_control_to_subscriber").prop("checked", "checked");
	        <?php
	    }
	    ?>
	 });
	 function disable_admin_checkbox(control) {
        var controlId = jQuery(control).attr("id");
        var full_control = "";
        switch (controlId) {
            case "ux_full_control_to_admin":

                full_control = jQuery("#ux_full_control_to_admin").prop("checked");
                if (full_control == true) {
                    jQuery("#ux_read_control_to_admin").prop("checked", "checked");
                    jQuery("#ux_read_control_to_admin").attr("disabled", "disabled");
                    jQuery("#ux_write_control_to_admin").prop("checked", "checked");
                    jQuery("#ux_write_control_to_admin").attr("disabled", "disabled");
                }
                else {
                    jQuery("#ux_read_control_to_admin").prop("checked", false);
                    jQuery("#ux_read_control_to_admin").removeAttr("disabled", "disabled");
                    jQuery("#ux_write_control_to_admin").prop("checked", false);
                    jQuery("#ux_write_control_to_admin").removeAttr("disabled", "disabled");
                }

                break;
            case "ux_full_control_to_editor":

                full_control = jQuery("#ux_full_control_to_editor").prop("checked");
                if (full_control == true) {
                    jQuery("#ux_read_control_to_editor").prop("checked", "checked");
                    jQuery("#ux_read_control_to_editor").attr("disabled", "disabled");
                    jQuery("#ux_write_control_to_editor").prop("checked", "checked");
                    jQuery("#ux_write_control_to_editor").attr("disabled", "disabled");
                }
                else {
                    jQuery("#ux_read_control_to_editor").prop("checked", false);
                    jQuery("#ux_read_control_to_editor").removeAttr("disabled", "disabled");
                    jQuery("#ux_write_control_to_editor").prop("checked", false);
                    jQuery("#ux_write_control_to_editor").removeAttr("disabled", "disabled");
                }

                break;
            case "ux_full_control_to_author":

                full_control = jQuery("#ux_full_control_to_author").prop("checked");
                if (full_control == true) {
                    jQuery("#ux_read_control_to_author").prop("checked", "checked");
                    jQuery("#ux_read_control_to_author").attr("disabled", "disabled");
                    jQuery("#ux_write_control_to_author").prop("checked", "checked");
                    jQuery("#ux_write_control_to_author").attr("disabled", "disabled");
                }
                else {
                    jQuery("#ux_read_control_to_author").prop("checked", false);
                    jQuery("#ux_read_control_to_author").removeAttr("disabled", "disabled");
                    jQuery("#ux_write_control_to_author").prop("checked", false);
                    jQuery("#ux_write_control_to_author").removeAttr("disabled", "disabled");
                }

                break;
            case "ux_full_control_to_contributor":

                full_control = jQuery("#ux_full_control_to_contributor").prop("checked");
                if (full_control == true) {
                    jQuery("#ux_read_control_to_contributor").prop("checked", "checked");
                    jQuery("#ux_read_control_to_contributor").attr("disabled", "disabled");
                    jQuery("#ux_write_control_to_contributor").prop("checked", "checked");
                    jQuery("#ux_write_control_to_contributor").attr("disabled", "disabled");
                }
                else {
                    jQuery("#ux_read_control_to_contributor").prop("checked", false);
                    jQuery("#ux_read_control_to_contributor").removeAttr("disabled", "disabled");
                    jQuery("#ux_write_control_to_contributor").prop("checked", false);
                    jQuery("#ux_write_control_to_contributor").removeAttr("disabled", "disabled");
                }

                break;
            case "ux_full_control_to_subscriber":

                full_control = jQuery("#ux_full_control_to_subscriber").prop("checked");
                if (full_control == true) {
                    jQuery("#ux_read_control_to_subscriber").prop("checked", "checked");
                    jQuery("#ux_read_control_to_subscriber").attr("disabled", "disabled");
                    jQuery("#ux_write_control_to_subscriber").prop("checked", "checked");
                    jQuery("#ux_write_control_to_subscriber").attr("disabled", "disabled");
                }
                else {
                    jQuery("#ux_read_control_to_subscriber").prop("checked", false);
                    jQuery("#ux_read_control_to_subscriber").removeAttr("disabled", "disabled");
                    jQuery("#ux_write_control_to_subscriber").prop("checked", false);
                    jQuery("#ux_write_control_to_subscriber").removeAttr("disabled", "disabled");
                }

                break;
        }
    }
</script>