<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/jquery.maskedinput-1.3.min.js" type="text/javascript"></script>

<form id="frmfileupload" method="post" action="<?php echo $script_name ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action" value="<?php echo $action ?>"/>
	<!-- body part start-->
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top"><table cellpadding="0" cellspacing="3" width="95%" align="center">
					<tr>
						<td valign="middle" align="center"><div class="err_msg" ><?php echo $errors_0; ?></div>
							<!--some message goes here--></td>
					</tr>
					<tr>
						<td align="center" valign="middle"><table cellspacing="2" cellpadding="2" border="0" width="100%">
								<tbody>
									<tr>
										<td align="right" width="30%" class="grayyes"><b>Title:</b></td>
										<td align="left" class="grayno"><input type="text" class="input required" id="txttitle" maxlength="256" size="50"  name="txttitle" />
											&nbsp;* </td>
									</tr>
									<tr>
										<td align="right" width="30%" class="grayyes"><b>Upload File(s):</b></td>
										<td align="left" class="grayno"><input type="file" class="input required" id="file_upload" name="file_upload" style="height: auto !important;" />
											&nbsp;* </td>
									</tr>
								</tbody>
							</table></td>
					</tr>
						</tbody>
					
				</table></td>
		</tr>
		<tr>
			<td align="center">
			<img id="file_loader" style="display: none; margin-right: 110px;" src="../images/ajax-loader.gif">
			<input class="hide_btn" id="save" value="Save" title="Click here to edit this content block" type="submit" alt="Click here to edit this content block" />
				<input class="hide_btn" type="button" value="Cancel" onclick="location.href='<?php echo $script_name ?>'" title="Go Back to Home" alt="Go Back to Home"/></td>
		</tr>
	</table>
	<!-- body part ends-->
</form>
<script language="javascript">

$(function() {
    $('#frmfileupload').validate({
        rules: {
            txttitle: {
                required: true
            },
			file_upload: {
				required : true
			}
			
        },
        messages: {
            txttitle: {
                required: "Please enter a title."
            },
			file_upload: {
				required : "Please select a file."
			}
        },
		submitHandler: function(form) {
		  $(".hide_btn" ).hide();
		  $("#file_loader").css("display","block");
		  form.submit();
		}
    });
});


</script>
<style type="text/css">
	.err_msg { color: rgb(255, 0, 0);
    float: none;
    padding-left: 0.5em;
    vertical-align: top;}
    label { width: 10em; float: left; }
    label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
</style>
