
<div class="white_content" id="setting_controls_postback">
</div>
<div class="black_overlay"></div>
<script type="text/javascript">
var array_form_settings = [];
var field_dynamic_id = [];
var array_delete_form_controls = [];
 var form_id = "<?php echo $form_id;?>";
jQuery(document).ready(function()
{
	jQuery(".hovertip").tooltip();
	jQuery(window).resize(function()
	{
		var windowHeight =  window.innerHeight - 200;
		var windowWidth =  window.innerWidth - 200;
		var lightboxHeight = jQuery("#setting_controls_postback").height();
		var lightboxWidth = jQuery("#setting_controls_postback").width();
		var proposedTop =  (window.innerHeight - lightboxHeight - 40) / 2 ;
		var proposedLeft =  (window.innerWidth - lightboxWidth - 40) / 2 ;
		jQuery("#setting_controls_postback").css("top",proposedTop + "px");
		jQuery("#setting_controls_postback").css("left",proposedLeft + "px");
	});

	jQuery("#left_block").sortable
	({
		opacity: 0.6,
		cursor: "move",
		update: function()
		{

			var field_dynamic_id = [];
			var order = jQuery("#left_block").sortable("toArray");
			for(var flag=0;flag<order.length;flag++)
			{
				var field_order_str = order[flag].split("div_");
				field_dynamic_id.push(field_order_str[1].split("_")[0]);
			}
			jQuery.post(ajaxurl,"form_id="+form_id+"&field_dynamic_id="+JSON.stringify(field_dynamic_id)+"&param=form_fields_sorting_order&action=add_contact_form_library", function(data)
			{
			});
		}
	});
show_url_control();
});
function enter_admin_label(dynamicId)
{
	var ux_label = jQuery("#ux_label_text_"+dynamicId).val();
	jQuery("#ux_admin_label_"+dynamicId).val(ux_label);
}
function white_space(e)
{
	var regex = new RegExp("^[0-9a-zA-Z-.~`^_!@\b#$%&*()+={}\| ]+$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str))
	{
		return true;
	}
	e.preventDefault();
	return false;
}
function OnlyNumbers_phone(e)
{
	var regex = new RegExp("^[0-9- /+\b]*$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) 
	{
		return true;
	}
	e.preventDefault();
	return false;
}
function OnlyNumbers(e)
{
	var regex = new RegExp("^[0-9 .\b]*$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) 
	{
		return true;
	}
	e.preventDefault();
	return false;
}
function allow_file_ext_upload(e)
{
	var regex = new RegExp("^[a-zA-Z;]*$");
	var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
	if (regex.test(str)) 
	{
		return true;
	}
	e.preventDefault();
	return false;
}
function delete_textbox(dynamicId,control_type,control_id)
{
	array_delete_form_controls.push(control_id);
	jQuery("#div_"+dynamicId+"_"+control_type).remove();
}
function add_settings(dynamicId,field_type)
{
	jQuery.post(ajaxurl, "form_id="+form_id+"&dynamicId="+dynamicId+"&field_type="+field_type+"&param=add_settings_div&action=add_contact_form_library", function(data)
	{
		jQuery("#setting_controls_postback").html(data);
		show_Popup();
	});
}
function show_Popup()
{
	jQuery(".black_overlay").css("display","block");
	jQuery(".white_content").css("display","block");
	var windowHeight =  window.innerHeight - 200;
	var windowWidth =  window.innerWidth - 200;
	var anchor = jQuery("<a class=\"closeButtonLightbox\" onclick=\"CloseLightbox();\"></a>");
	jQuery("#setting_controls_postback").append(anchor);
	var lightboxHeight = jQuery("#setting_controls_postback").height();
	var lightboxWidth = jQuery("#setting_controls_postback").width();
	var proposedTop =  (window.innerHeight - lightboxHeight - 40) / 2 ;
	var proposedLeft =  (window.innerWidth - lightboxWidth - 40) / 2 ;
	jQuery("#setting_controls_postback").css("top",proposedTop + "px");
	jQuery("#setting_controls_postback").css("left",proposedLeft + "px");
	jQuery("#setting_controls_postback").fadeIn(200);
}
function CloseLightbox()
{
	jQuery("#setting_controls_postback").css("display","none");
	jQuery(".black_overlay").css("display","none");
	jQuery("#fade").fadeOut(200);
}
function show_url_control()
{
	if(jQuery("#ux_rdl_page").prop("checked") == true)
	{
		jQuery("#div_url").hide();
		jQuery("#div_page").show();
	}
	else
	{
		jQuery("#div_page").hide();
		jQuery("#div_url").show();
	}
}
function create_control(control_type,dynamicId,type)
{
    dynamicId = typeof dynamicId !== "undefined" ? dynamicId : Math.floor((Math.random()*100000)+1);
    
	switch(parseInt(control_type))
	{
		case 1:
			jQuery("#div_1_1").clone(false).attr("id","div_"+dynamicId+"_1").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_1").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_1").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("id","ux_txt_textbox_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("name","ux_txt_textbox_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",1)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_1").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_text_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",1,"+data+");");
				});
			}
			else
			{
				
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
                    jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                jQuery("#ux_txt_textbox_control_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                	jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
	           });
			}
			break;
		case 2:
			jQuery("#div_2_2").clone(false).attr("id","div_"+dynamicId+"_2").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_2").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_2").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("textarea[type=\"textarea\"]").attr("id","ux_textarea_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("textarea[type=\"textarea\"]").attr("name","ux_textarea_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",2)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_2").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_textarea_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",2,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                jQuery("#ux_textarea_control_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
			}
			break;
        case 3:
            jQuery("#div_3_3").clone(false).attr("id","div_"+dynamicId+"_3").appendTo("#left_block");
            jQuery("#div_"+dynamicId+"_3").children("label").attr("id","control_label_"+dynamicId);
            jQuery("#div_"+dynamicId+"_3").children("div").attr("id","show_tooltip"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("input[type=\"text\"]").attr("id","ux_txt_email_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("input[type=\"text\"]").attr("name","ux_txt_email_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",3)");
            jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
            jQuery("#div_"+dynamicId+"_3").attr("style","display:block");
            jQuery(".hovertip").tooltip({placement: "left"});
            if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_email_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",3,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                jQuery("#ux_txt_email_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
	                var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
			}
            break;
        case 4:
            jQuery("#div_4_4").clone(false).attr("id","div_"+dynamicId+"_4").appendTo("#left_block");
            jQuery("#div_"+dynamicId+"_4").children("label").attr("id","control_label_"+dynamicId);
            jQuery("#div_"+dynamicId+"_4").children("div").attr("id","show_tooltip"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("select[type=\"select\"]").attr("id","ux_ddl_select_control"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("select[type=\"select\"]").attr("name","ux_ddl_select_control"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",4)");
            jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
            jQuery("#div_"+dynamicId+"_4").attr("style","display:block");
            jQuery(".hovertip").tooltip({placement: "left"});
            if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_drop_down_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",4,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
	                var bind_data_list =  bind_data[dynamicId].cb_dropdown_option_id;
	                for(var flag = 0; flag<bind_data_list.length;flag++)
				    {
				        jQuery("#ux_ddl_select_control"+dynamicId).append("<option value=\""+bind_data_list[flag]+"\">"+bind_data[dynamicId].cb_dropdown_option_val[flag]+"</option>");
				    }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
			}
            break;
        case 5:
            jQuery("#div_5_5").clone(false).attr("id","div_"+dynamicId+"_5").appendTo("#left_block");
            jQuery("#div_"+dynamicId+"_5").children("label").attr("id","control_label_"+dynamicId);
            jQuery("#div_"+dynamicId+"_5").children("div").attr("id","post_back_checkbox_"+dynamicId);
            jQuery("#post_back_checkbox_"+dynamicId).children("div").attr("id","show_tooltip"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("input[type=\"checkbox\"]").attr("id","ux_chk_checkbox_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("input[type=\"checkbox\"]").attr("name","ux_chk_checkbox_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("span").attr("id","add_chk_options_here_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",5)");
            jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
            jQuery("#div_"+dynamicId+"_5").attr("style","display:block");
            jQuery(".hovertip").tooltip({placement: "left"});
            if(typeof type == "undefined")
            {
                jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_check_box_control&action=add_contact_form_library", function(data)
                {
                	jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",5,"+data+");");
                });
            }
            else
            {
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#post_back_checkbox_"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
	                var bind_chk_list =  bind_data[dynamicId].cb_checkbox_option_id;
	                for(var flag = 0; flag<bind_chk_list.length;flag++)
				    {
				    	jQuery("#ux_chk_checkbox_control_"+dynamicId).hide();
                		jQuery("#add_chk_options_here_"+dynamicId).append("<span id=\"input_id_"+bind_chk_list[flag]+"\"><input id=\"ux_chk_checkbox_control_"+bind_chk_list[flag]+"\" name=\"ux_chk_checkbox_control_"+bind_chk_list[flag]+"\" type=\"checkbox\"/><label class=\"rdl\">"+bind_data[dynamicId].cb_checkbox_option_val[flag]+"</label></span>");
				    }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
            }
		break;
        case 6:
            jQuery("#div_6_6").clone(false).attr("id","div_"+dynamicId+"_6").appendTo("#left_block");
            jQuery("#div_"+dynamicId+"_6").children("label").attr("id","control_label_"+dynamicId);
            jQuery("#div_"+dynamicId+"_6").children("div").attr("id","post_back_radio_button_"+dynamicId);
            jQuery("#post_back_radio_button_"+dynamicId).children("div").attr("id","show_tooltip"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("input[type=\"radio\"]").attr("id","ux_radio_button_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("input[type=\"radio\"]").attr("name","ux_radio_button_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId ).children("span").attr("id","add_radio_options_here_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",6)");
            jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
            jQuery("#div_"+dynamicId+"_6").attr("style","display:block");
            jQuery(".hovertip").tooltip({placement: "left"});
            if(typeof type == "undefined")
            {
                jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_multiple_control&action=add_contact_form_library", function(data)
                {
                	jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",6,"+data+");");
                });
            }
            else
            {
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#post_back_radio_button_"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
	                var bind_rdl_list =  bind_data[dynamicId].cb_radio_option_id;
	                for(var flag = 0; flag<bind_rdl_list.length;flag++)
				    {
				    	jQuery("#ux_radio_button_control_"+dynamicId).hide();
                		jQuery("#add_radio_options_here_"+dynamicId).append("<span id=\"input_id_"+bind_rdl_list[flag]+"\"><input id=\"ux_radio_button_control_"+bind_rdl_list[flag]+"\" name=\"ux_radio"+dynamicId+"\" type=\"radio\"/><label class=\"rdl\">"+bind_data[dynamicId].cb_radio_option_val[flag]+"</label></span>");
                		if(flag == 0)
				    	{
				    		jQuery("#ux_radio_button_control_"+bind_rdl_list[flag]).attr("checked","checked");
				    	}
				    }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
            }
            break;
		case 7:
			jQuery("#div_7_7").clone(false).attr("id","div_"+dynamicId+"_7").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_7").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_7").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("id","ux_txt_number_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("name","ux_txt_number_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",7)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_7").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_number_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",7,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                jQuery("#ux_txt_number_control_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
			}
			break;
		case 8:
			jQuery("#div_8_8").clone(false).attr("id","div_"+dynamicId+"_8").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_8").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_8").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("id","ux_txt_name_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("name","ux_txt_name_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",8)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_8").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_name_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",8,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                jQuery("#ux_txt_name_control_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
	                var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
			}
			break;
		case 9:
				if(jQuery("#hidden_file_upload_count").val() == "1")
				{
					alert("<?php _e( "Only One File Uploader can be used on a Form.", contact_bank ); ?>");
				}
				else
				{
					var oldId_file_upload = jQuery(".file_upload").attr("id");
					jQuery("#"+oldId_file_upload).appendTo("#left_block");
					jQuery("#"+oldId_file_upload).attr("style","display:block;");
					jQuery("#"+oldId_file_upload).attr("id","div_"+dynamicId+"_9");
					jQuery("#div_"+dynamicId+"_9").children("label.layout-control-label").attr("id","control_label_"+dynamicId);
					jQuery("#div_"+dynamicId+"_9").children("div").attr("id","show_tooltip"+dynamicId);
					jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
					jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",9)");
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
					jQuery("#show_tooltip"+dynamicId).children("label.hovertip").attr("id","tip"+dynamicId);
					jQuery("#show_tooltip"+dynamicId).children("label").children("span").attr("id","txt_description_"+dynamicId);
					jQuery("#div_"+dynamicId+"_9").attr("style","display:block");
					jQuery(".hovertip").tooltip({placement: "left"});
					if(typeof type == "undefined")
					{
						jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_file_upload_control&action=add_contact_form_library", function(data)
						{
							jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",9,"+data+");");
						});
					}
					else
					{
						jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
						{
							var bind_data = JSON.parse(data);
							jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
							jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
							jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
							var control_id = bind_data[dynamicId].control_id;
							jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
						});
					}
					jQuery("#hidden_file_upload_count").val("1");
				}
		break;
		case 10:
			jQuery("#div_10_10").clone(false).attr("id","div_"+dynamicId+"_10").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_10").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_10").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("id","ux_txt_phone_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("name","ux_txt_phone_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",10)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_10").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_phone_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",10,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                jQuery("#ux_txt_phone_control_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");

				});
			}
			break;
		case 11:
			jQuery("#div_11_11").clone(false).attr("id","div_"+dynamicId+"_11").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_11").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_11").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("textarea[type=\"textarea\"]").attr("id","ux_address_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("textarea[type=\"textarea\"]").attr("name","ux_address_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",11)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_11").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_address_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",11,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
					jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
					jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
					jQuery("#ux_address_control_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
					if(bind_data[dynamicId].cb_control_required == "1")
					{
						jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
				
			}
			break;
        case 12:
            jQuery("#div_12_12").clone(false).attr("id","div_"+dynamicId+"_12").appendTo("#left_block");
            jQuery("#div_"+dynamicId+"_12").children("label.layout-control-label").attr("id","control_label_"+dynamicId);
            jQuery("#div_"+dynamicId+"_12").children("div").attr("id","show_tooltip"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"day\"]").attr("id","ux_ddl_select_day_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"day\"]").attr("name","ux_ddl_select_day_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"month\"]").attr("id","ux_ddl_select_month_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"month\"]").attr("name","ux_ddl_select_month_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"month\"]").attr("onchange","current_year_leap_check("+dynamicId+")");
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"year\"]").attr("id","ux_ddl_select_year_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"year\"]").attr("name","ux_ddl_select_year_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"year\"]").attr("onchange","current_year_leap_check("+dynamicId+")");
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",12)");
            jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
            jQuery("#div_"+dynamicId+"_12").attr("style","display:block");
            jQuery(".hovertip").tooltip({placement: "left"});
            jQuery("#ux_ddl_select_day_"+dynamicId).val((new Date).getDate());
            jQuery("#ux_ddl_select_month_"+dynamicId).val((new Date).getMonth()+1);
            jQuery("#ux_ddl_select_year_"+dynamicId).val((new Date).getFullYear());
            if(typeof type == "undefined")
            {
                jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_date_control&action=add_contact_form_library", function(data)
                {
                	jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",12,"+data+");");
                });
            }
            else
            {
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                	jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
					}
					var control_id = bind_data[dynamicId].control_id;
					
						jQuery("#ux_ddl_select_year_"+dynamicId).children("option:not(:first)").remove();
						var start_year = bind_data[dynamicId].cb_start_year == "" ? 1900 : bind_data[dynamicId].cb_start_year;
						var end_year = bind_data[dynamicId].cb_end_year == "" ? 2100 : bind_data[dynamicId].cb_end_year;
						for(var year = start_year; year<=end_year;year++)
						{
							jQuery("#ux_ddl_select_year_"+dynamicId).append("<option value=\""+year+"\">"+year+"</option>");
						}
						jQuery("#ux_ddl_select_day_"+dynamicId).val(bind_data[dynamicId].cb_default_value_day == "" ? "" : parseInt(bind_data[dynamicId].cb_default_value_day));
						jQuery("#ux_ddl_select_month_"+dynamicId).val(bind_data[dynamicId].cb_default_value_month == "" ? "" : parseInt(bind_data[dynamicId].cb_default_value_month));
						jQuery("#ux_ddl_select_year_"+dynamicId).val(bind_data[dynamicId].cb_default_value_year);
						current_year_leap_check(dynamicId);
						
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
			}
            break;
        case 13:
            jQuery("#div_13_13").clone(false).attr("id","div_"+dynamicId+"_13").appendTo("#left_block");
            jQuery("#div_"+dynamicId+"_13").children("label.layout-control-label").attr("id","control_label_"+dynamicId);
            jQuery("#div_"+dynamicId+"_13").children("div").attr("id","show_tooltip"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"hour12\"]").attr("id","ux_ddl_select_hr_12_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"hour12\"]").attr("name","ux_ddl_select_hr_12_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"minute\"]").attr("id","ux_ddl_select_minute_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"minute\"]").attr("name","ux_ddl_select_minute_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"am\"]").attr("id","ux_ddl_select_ampm_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("select[type=\"am\"]").attr("name","ux_ddl_select_ampm_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",13)");
            jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
            jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
            jQuery("#div_"+dynamicId+"_13").attr("style","display:block");
            jQuery(".hovertip").tooltip({placement: "left"});
            if(typeof type == "undefined")
            {
                jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_time_control&action=add_contact_form_library", function(data)
                {
                	jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",13,"+data+");");
                });
            }
            else
            {
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
					jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
					jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
					if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
	                
			     	var hour_format = bind_data[dynamicId].cb_hour_format;
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
					var minute_format = parseInt(bind_data[dynamicId].cb_time_format);
					jQuery("#ux_ddl_select_minute_"+dynamicId).children("option:not(:first)").remove();
					for(var flag = 0; flag<60;flag = flag +minute_format)
					{
						jQuery("#ux_ddl_select_minute_"+dynamicId).append("<option value=\""+flag+"\">"  +  (flag < 10 ? "0" + flag : flag) + "</option>");
					}
					jQuery("#ux_ddl_select_hr_12_"+dynamicId).val(bind_data[dynamicId].cb_hours == "" ? "" :  parseInt(bind_data[dynamicId].cb_hours));
					jQuery("#ux_ddl_select_minute_"+dynamicId).val(bind_data[dynamicId].cb_minutes == "" ? "" : parseInt(bind_data[dynamicId].cb_minutes));
					jQuery("#ux_ddl_select_ampm_"+dynamicId).val(bind_data[dynamicId].cb_am_pm);
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
				
            }
			break;
		case 15:
			jQuery("#div_15_15").clone(false).attr("id","div_"+dynamicId+"_15").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_15").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_15").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"password\"]").attr("id","ux_txt_password_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"password\"]").attr("name","ux_txt_password_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",15)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_15").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_password_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",15,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
	                var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
				
			}
			break;
		case 16:
			jQuery("#div_16_16").clone(false).attr("id","div_"+dynamicId+"_16").appendTo("#left_block");
			jQuery("#div_"+dynamicId+"_16").children("label").attr("id","control_label_"+dynamicId);
			jQuery("#div_"+dynamicId+"_16").children("div").attr("id","show_tooltip"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("id","ux_txt_url_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId ).children("input[type=\"text\"]").attr("name","ux_txt_url_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("id","add_setting_control_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("a.btn").attr("onclick","add_settings("+dynamicId+",16)");
			jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
			jQuery("#show_tooltip"+dynamicId).children("span").attr("id","txt_description_"+dynamicId);
			jQuery("#div_"+dynamicId+"_16").attr("style","display:block");
			jQuery(".hovertip").tooltip({placement: "left"});
			if(typeof type == "undefined")
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_url_control&action=add_contact_form_library", function(data)
				{
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",16,"+data+");");
				});
			}
			else
			{
				jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
				{
					var bind_data = JSON.parse(data);
					jQuery("#control_label_"+dynamicId).html(bind_data[dynamicId].cb_label_value+" :");
	                jQuery("#txt_description_"+dynamicId).html(bind_data[dynamicId].cb_description);
	                jQuery("#show_tooltip"+dynamicId).attr("data-original-title",bind_data[dynamicId].cb_tooltip_txt);
	                jQuery("#ux_txt_url_control_"+dynamicId).attr("placeholder",bind_data[dynamicId].cb_default_txt_val);
	                if(bind_data[dynamicId].cb_control_required == "1")
	                {
	                    jQuery("#control_label_"+dynamicId).append("<span class=\"error\">*</span>");
	                }
					var control_id = bind_data[dynamicId].control_id;
					jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
				});
				
			}
			break;
			case 17:
			if(jQuery("#hidden_captcha_count").val() == "1")
			{
				alert("<?php _e( "Only One Captcha can be used on a Form.", contact_bank ); ?>");
			}
			else
			{
				jQuery("#div_17_17").clone(false).attr("id","div_"+dynamicId+"_17").appendTo("#left_block");
				jQuery("#div_"+dynamicId+"_17").children("div").attr("id","show_tooltip"+dynamicId);
				jQuery("#div_"+dynamicId+"_17").children("label").attr("id","control_label_"+dynamicId);
				jQuery("#show_tooltip"+dynamicId).children("#anchor_del_").attr("id","anchor_del_"+dynamicId);
				jQuery("#Refresh img").css("display","none");
				jQuery("#div_"+dynamicId+"_17").attr("style","display:block");
				if(typeof type == "undefined")
				{
					jQuery.post(ajaxurl,"form_id="+form_id+"&ux_hd_textbox_dynamic_id="+dynamicId+"&event=add&param=save_captcha_control&action=add_contact_form_library", function(data)
					{
						jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+",17,"+data+");");
					});
				}
				else
				{
					jQuery.post(ajaxurl,"form_id="+form_id+"&dynamicId="+dynamicId+"&control_type="+control_type+"&param=bind_text_control&action=show_form_control_data_contact_library", function(data)
					{
						var bind_data = JSON.parse(data);
						var control_id = bind_data[dynamicId].control_id;
						jQuery("#show_tooltip"+dynamicId).children("#anchor_del_"+dynamicId).attr("onclick","delete_textbox("+dynamicId+","+control_type+","+control_id+");");
					});
				}
				jQuery("#hidden_captcha_count").val("1")
			}
			break;
	}
}
<?php
$form_data = $wpdb->get_results
(
	$wpdb->prepare
	(
		"SELECT * FROM " .create_control_Table(). " where form_id= %d order by sorting_order asc",
		$form_id
	)
);
for($flag = 0; $flag < count($form_data);$flag++)
{
	?>
		create_control(<?php echo $form_data[$flag]->field_id;?>,<?php echo $form_data[$flag]->column_dynamicId;?>,"edit");
	<?php
}
?>
function prevent_paste(control_id)
{
	jQuery("#"+control_id).live("paste",function(e)
	{
		e.preventDefault();
	});
}
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
</script>