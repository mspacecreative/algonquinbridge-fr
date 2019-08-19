<div class="fluid-layout">
	<div class="layout-span12">
		<div class="widget-layout">
			<div class="widget-layout-title">
				<h4><?php _e( "Form Entries", contact_bank ); ?></h4>
			</div>
			<div class="widget-layout-body layout-form">
				<a class="btn btn-info" href="admin.php?page=dashboard"><?php _e("Back to Dashboard", contact_bank);?></a>
				<a class="btn btn-info" id="export" ><?php _e("Export to Excel", contact_bank);?></a>
				<div class="separator-doubled"></div>
				<div class="fluid-layout">
					<div class="layout-span12">
						<div class="widget-layout">
							<div class="widget-layout-title">
								<h4><?php _e( "Form", contact_bank ); ?></h4>
							</div>
							<div class="widget-layout-body" >
								<div class="fluid-layout">
									<div class="layout-control-group">
										<label class="layout-control-label"><?php _e( "Select Form", contact_bank ); ?> :</label>
										<div class="layout-controls">	
											<?php
											global $wpdb;
											$form_data = $wpdb->get_results
											(
												"SELECT * FROM " .contact_bank_contact_form()
											);
											?>
											<select class=" layout-span12" id="select_form" name="select_form" onchange="select_form_id();">
												<option value="0"><?php _e("Select Form",contact_bank); ?></option>
												<?php
												for($flag=0;$flag<count($form_data);$flag++)
												{
													if(isset($_REQUEST["form_id"]) && $_REQUEST["form_id"] == $form_data[$flag]->form_id)
													{
														?>
														<option value="<?php echo $form_data[$flag]->form_id ;?>" selected="selected"><?php echo $form_data[$flag]->form_name ;?></option>
														<?php
													}
													else
													{
														?>
														<option value="<?php echo $form_data[$flag]->form_id ;?>"><?php echo $form_data[$flag]->form_name ;?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div id="ux_frontend_data_postback" style="overflow-x: auto;overflow-y: hidden;padding-bottom: 1%;margin-top:10px;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function()
{
	select_form_id();
	function exportTableToCSV(table, filename) {

		var rows = table.find('tr:has(td)'),
			csv = "";
            tmpColDelim = String.fromCharCode(11),
            tmpRowDelim = String.fromCharCode(0), 
			colDelim = '","',
            rowDelim = '"\r\n"',
				csv = '"' + rows.map(function (i, row) {
            	var row = jQuery(row),
                    cols = row.find('td'); 
				return cols.map(function (j, col) {
                    var col = jQuery(col),
                        text = col.text();

                    return text.replace('"', '""');

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
            	
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',
				csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
		
        jQuery(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }
	jQuery("#export").on('click', function (event) 
    {
		var form_id = jQuery("#select_form").val();
    	if(form_id != 0)
		{
			exportTableToCSV.apply(this, [jQuery('#data-table-frontend'), 'Form Entries.csv']);
		}
		else
		{
			alert("<?php _e( "Please select the Form first.", contact_bank ); ?>");
			return false;
		}
    });
});
function select_form_id()
{
	var form_id = jQuery("#select_form").val();
	if(form_id != 0)
	{
		jQuery.post(ajaxurl, "form_id="+form_id+"&param=frontend_form_data&action=frontend_data_contact_library", function(data)
		{
			if(jQuery('#data-table-frontend').length > 0)
			{
				oTable = jQuery('#data-table-frontend').dataTable();
				oTable.fnDestroy();
				jQuery("#ux_frontend_data_postback").empty();
				
				jQuery("#ux_frontend_data_postback").append(data);
				jQuery(".fluid-layout .table thead th").css('vertical-align','top');
				oTable.fnDraw();
			}
			else
			{
				jQuery("#ux_frontend_data_postback").append(data);
				jQuery(".fluid-layout .table thead th").css('vertical-align','top');
			}
		});
	}
}
function delete_form_entry(record_id,form_id)
{
	var confirm_delete =  confirm("<?php _e( "Are you sure, you want to delete this Form Entry ?", contact_bank ); ?>");
	if(confirm_delete == true)
	{
		jQuery.post(ajaxurl, "record_id="+record_id+"&form_id="+form_id+"&param=delete_frontend_form_data&action=frontend_data_contact_library", function(data)
		{
			window.location.reload();
		});
	}
}
</script>