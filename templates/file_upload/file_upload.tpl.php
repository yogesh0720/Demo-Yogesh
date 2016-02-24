<form action="<?php echo $script_name ?>" method="post">
<!-- Body Content Start !-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-left: 15px; padding-right: 15px;" >
    <tr>
      <td>
        <img id="imgAdd" align="absmiddle" src="images/add-new.gif" onclick="location.href='<?php echo $script_name ?>?action=add'" style="border-width: 0px; height: 18px; cursor: pointer;" />
               
        <input type="image" id="ibtndelete"  align="absmiddle" style="border-width: 0px;" src="images/delete.gif" onclick="return checkids();"  />
        <input type="hidden" id="IDsToDlete" name="IDsToDlete" />
        
        <input type="hidden" id="action" name="action" />
      </td>
      <td align="right" valign="top" >
        <div id="Panel1"> Search: <?php echo $cmbsrch ?>
          <input type="text" name="txtSearchKeyword" id="txtSearchKeyword" class="input" value="" onkeypress="return check(event)" />
		  <input type="image" border="0" class="searchimg" align="absmiddle" style="border-width: 0px;" src="images/search.gif" onclick="return doSearch()" />
		  <!--<a onclick="doSearch()">Search</a>-->
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div class="actionmessage"></div>
        <!-- grid section -->
        <div id="pagerb" class="scroll" style="text-align: center;"> </div>
        <table id="bigset" class="scroll" cellpadding="0" cellspacing="0" width="100%"> 
        </table>
        <script src="js/jqgrid/customgrid/file_upload.js" type="text/javascript"> </script>
        <!-- grid section end-->
      </td>
    </tr>
</table>
</form>
<!-- Image POPUP Div CSS, JavaScript, HTML Code  Start-->
		<style type="text/css">
		.click-priview{
			cursor:pointer;
		}
		.click-download{
			cursor:pointer;
		}
		.container {width: 960px; margin: 0 auto; overflow: hidden;}
		
		#content {	float: left; width: 100%;}
		
		.post { margin: 0 auto; padding-bottom: 50px; float: left; width: 960px; }
		
		.btn-sign {
			width:460px;
			margin-bottom:20px;
			margin:0 auto;
			padding:20px;
			border-radius:5px;
			background: -moz-linear-gradient(center top, #00c6ff, #018eb6);
			background: -webkit-gradient(linear, left top, left bottom, from(#00c6ff), to(#018eb6));
			background:  -o-linear-gradient(top, #00c6ff, #018eb6);
			filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#00c6ff', EndColorStr='#018eb6');
			text-align:center;
			font-size:36px;
			color:#fff;
			text-transform:uppercase;
		}
		
		.btn-sign a { color:#fff; text-shadow:0 1px 2px #161616; }
		
		#mask {
			display: none;
			/*background:#777777;*/
			position: fixed; 
			left: 0; 
			top: 0; 
			z-index: 10;
			width: 100%; 
			height: 100%;
			z-index: 999;
			background:url(images/bgpopup.png) repeat;
			
		}
		
		.priview-popup{
			display:none;
			background: gray;
			padding: 10px; 	
			border: 10px solid #FFF;
			float: left;
			font-size: 1.2em;
			position: fixed;
			top: 18%; left: 21%;
			z-index: 99999;
			height:550px;
			width:800px;
			/* box-shadow: 0px 0px 20px #999; */
			/*-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
			/*-webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
			border-radius:3px 3px 3px 3px;
			-moz-border-radius: 3px; /* Firefox */
			-webkit-border-radius: 3px; /* Safari, Chrome */
			
		}
		
		img.btn_close {
			float: right; 
			margin: -35px -35px 0 0;
		}
		
		fieldset { 
			border:none; 
		}
		
		form.signin .textbox label { 
			display:block; 
			padding-bottom:7px; 
		}
		
		form.signin .textbox span { 
			display:block;
		}
		
		form.signin p, form.signin span { 
			color:#999; 
			font-size:11px; 
			line-height:18px;
		} 
		
		form.signin .textbox input { 
			background:#666666; 
			border-bottom:1px solid #333;
			border-left:1px solid #000;
			border-right:1px solid #333;
			border-top:1px solid #000;
			color:#fff; 
			border-radius: 3px 3px 3px 3px;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			font:13px Arial, Helvetica, sans-serif;
			padding:6px 6px 4px;
			width:200px;
		}
		
		form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
		form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }
		
		
		/*#imagecontent img{
			max-height:600px;
			max-width:600px;
		}*/
		
		</style>

		<!-- Onclick EVent jQuery Code write in category_image.js -->
        
        <div id="priview-box" class="priview-popup">
			<div id="priview-loading" class="" style="display: block; top: 250px; text-align: center; position: absolute; margin-left: 375px;">
						<img  style="" src="../images/loader1.gif" height="50px" width="50px">
			</div>
        	<a href="#" class="close" style="border:0px solid;"><img style="border:0px;" src="images/fancy_close.png" class="btn_close" title="Close Window" alt="Close" /></a>
			<div id="imagecontent"></div>
		</div>
    	<!--<script src="js/popup-jquery.js" ></script>-->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.js"></script> -->		
<!-- Image POPUP Div CSS, JavaScript, HTML Code  End-->
        



<script>
    function check(ev) {
        if (ev.keyCode == 13) {
            doSearch();
            return false;
        }
    }
    function doSearch() {
        var searchby = document.getElementById("cmbSearchField").value;
		var searchval = "";
		var val = document.getElementById("txtSearchKeyword").value;
		searchval = val.replace(/ & /gi,"~");
		
		
        //alert("<?php echo $script_name ?>?action=grid&searchby=" + searchby + "&searchval=" + searchval);
		
		 $("#bigset").setGridParam({ url: "<?php echo $script_name ?>?action=grid&searchby=" + searchby + "&searchval=" + searchval, page: 1 }).trigger("reloadGrid");

		return false;
    }
    
	function checkids() {
		
        var s;
		
        s = jQuery("#bigset").getGridParam('selarrrow');
        if (s == "") {
            alert("No record selected.");
            return false;
        }else if(s == 0) {
			alert("There is no data to delete.")
			return false;
		}else {
            document.getElementById("IDsToDlete").value = s;
            document.getElementById("action").value = "delete";
            if (confirm("Are you sure to delete selected record(s)?")) {
                return true;
            }
            else {
                return false;
            }
        }
    }	
</script>