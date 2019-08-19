<?php

global $wpdb;
$licensing = $wpdb->get_row
(
	"SELECT * FROM " . contact_bank_licensing()
);
?>
<form id="contact_bank_licensing" class="layout-form" method="post">
	<div class="fluid-layout">
		<div class="layout-span12">
			<div class="message green" id="contact_licensing_success_message" style="display: none;margin-bottom: 10px;">
				<span>
					<strong id="cb_licensing_success_message"></strong>
				</span>
			</div>
			<div class="message red" id="contact_error_licensing_message" style="display: none;margin-bottom: 10px;">
				<span>
					<strong id="cb_licensing_error_message"></strong>
				</span>
            </div>
			<div class="widget-layout">
				<div class="widget-layout-title">
					<h4><?php _e("Contact-Bank Licensing", contact_bank); ?></h4>
					<span class="tools">
						<a data-target="#licensing_div" data-toggle="collapse">
							<i class="icon-chevron-down"></i>
						</a>
					</span>
				</div>
                <div id="licensing_div" class="collapse in">
                    <div class="widget-layout-body">
                        <div class="layout-control-group">
                            <label class="layout-control-label">Version :</label>

                            <div class="layout-controls">
                                <label class="layout-control-label"
                                       id="ux_version"><?php echo $licensing->version; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="widget-layout-body">
                        <div class="layout-control-group">
                            <label class="layout-control-label">Type :</label>

                            <div class="layout-controls">
                                <label class="layout-control-label" id="ux_type"><?php echo $licensing->type; ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="widget-layout-body">
                        <div class="layout-control-group">
                            <label class="layout-control-label">URL :</label>

                            <div class="layout-controls">
                                <input type="text" class="layout-span12" readonly="readonly" name="ux_site_url"
                                       id="ux_site_url" value="<?php echo $licensing->url; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="widget-layout-body">
                        <div class="layout-control-group">
                            <label class="layout-control-label">API Key :<span class="error">*</span></label>
							
                            <div class="layout-controls">
                                <input type="text" class="layout-span12" name="ux_api_key" id="ux_api_key"
                                       value="<?php echo $licensing->api_key; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="widget-layout-body">
                        <div class="layout-control-group">
                            <label class="layout-control-label">Order ID :<span class="error">*</span></label>
							
                            <div class="layout-controls">
                                <input type="text" class="layout-span12" name="ux_order_id" id="ux_order_id"
                                       value="<?php echo $licensing->order_id; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="widget-layout-body">
                        <div class="layout-control-group">
                            <div class="layout-controls">
                                <button type="submit" class="btn btn-info"><?php _e("Update", contact_bank); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    jQuery("#contact_bank_licensing").validate
    ({
        rules: {
            ux_api_key: 
            {
                required: true
			},
            ux_order_id: 
            {
                required: true
			}
        },
        submitHandler: function (form) 
        {
        	var cb_domain_url = "<?php echo site_url();?>";
            jQuery.post("http://tech-banker.com/wp-admin/admin-ajax.php", jQuery(form).serialize() +
                "&ux_product_key=17167&ux_domain="+cb_domain_url+"&param=license&action=license_validator", function (data) {
               if(data == "")
               {
               		jQuery("#contact_error_licensing_message").css("display", "none");
               		jQuery("#cb_licensing_success_message").html("<?php _e("Success! Settings have been updated.", contact_bank); ?>");
               		jQuery("#contact_licensing_success_message").css("display", "block");
               		jQuery.post(ajaxurl, jQuery(form).serialize() +
		                "&param=update_licensing_settings&action=add_contact_form_library", function () {
		                jQuery("#contact_licensing_success_message").css("display", "block");
		                setTimeout(function () 
		                {
		                        jQuery("#contact_licensing_success_message").css("display", "none");
		                        window.location.href = "admin.php?page=dashboard";
		                },2000);
					});
               }
               else
               {
               		jQuery("#contact_licensing_success_message").css("display", "none");
               		jQuery("#cb_licensing_error_message").html(data);
               		jQuery("#contact_error_licensing_message").css("display", "block");
               		
               }
        });
       }
   });
    
</script>