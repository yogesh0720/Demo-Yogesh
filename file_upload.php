<?php
    // include init file
    require_once( '../init.php' );
	
    if( isset( $_REQUEST['action'] ) ){
        $action = $_REQUEST['action'];
	}
    if( isset( $_REQUEST['e'] ) )
        $e = $_REQUEST['e'];

    // name of this file
    $script_name = basename( __FILE__ );

	 // create an instance of the model
    $file_upload = new class_file_upload( $script_name );	
	 // test
	if( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
        // get rid of the special characters       
		switch( $action )
		{ 			
			case 'add' :
			
				if(isset($_FILES) && !empty($_FILES)){
					$errors= array();
					$file_name = $_FILES['file_upload']['name'];
					$file_size =$_FILES['file_upload']['size'];
					$file_tmp =$_FILES['file_upload']['tmp_name'];
					$file_type=$_FILES['file_upload']['type'];
					$file_ext=strtolower(end(explode('.',$_FILES['file_upload']['name'])));
					$mime_types = array(						
						'pdf' => 	'application/pdf',
						'txt' => 	'text/plain',
						'doc' => 	'application/msword',
						'docx' => 	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
						'csv' => 	'application/vnd.ms-excel',
						'xls' => 	'application/vnd.ms-excel',
						'xlsx' => 	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
						'ppt' => 	'application/vnd.ms-powerpoint',
						'pptx' => 	'application/vnd.ms-powerpoint',
						'jpg' => 	'image/jpeg',
						'jpeg' => 	'image/jpeg',						
						'gif' => 	'image/gif',
						'png' => 	'image/png'
					);					
					if (!array_key_exists($file_ext, $mime_types)) {
						$errors[]="Selected file type not allowed, Please select from the following file extensions: pdf, txt, doc, docx, csv, xls, xlsx, ppt, pptx, jpg, jpeg, gif, png file.";
					}					
					
					
					$targetPath = rtrim("../uploads/admin/important_files", "/");
					
					if (!file_exists($targetPath)) {
						mkdir($targetPath);
					}
					//create custom image name
					$target_file_name = strtolower($_FILES['file_upload']['name'].'.'.pathinfo($_FILES['file_upload']['name'],PATHINFO_EXTENSION));
					$target_file_name = str_replace("&" , "-", $target_file_name); 				
					$ext = end(explode(".", $target_file_name));
					$filename = str_replace("." . $ext, "", $target_file_name);
					$filename = preg_replace('#[^\w()/.%\-&]#', "", $filename);
					$filename = str_replace('%20', "_", $filename);
					$targetFile = $targetPath . '/' . $filename . ".$ext";
					if (file_exists($targetFile)) {//checking if image exists
						$exists = true;
					} else {
						$exists = false;
					}
					$count = 0;
					while ($exists) {//loop untill image not found for new name
						$count++;					
						$new_filename = $filename . "_$count"; // new name for image
						
						$targetFile = $targetPath . '/' . $new_filename . "." . $ext;
						if (!file_exists($targetFile)) {
							$exists = false;
							//$filename = array();
							$filename = $new_filename;
						}
					}
					$title = "";
					$title = $_POST['txttitle'];
					if(empty($errors)==true){
						move_uploaded_file($file_tmp,$targetFile);						
						if(!empty($title) && !empty($filename) && !empty($ext))
							$paramsArray = array(
								$title,
								$filename.'.'.$ext,
								$ext,
								'7001'
							);
							$result = $file_upload->insert( $paramsArray );
							class_common::header_redirect( $script_name );	
							//echo $result;
						//echo "Success";
					}else{
						//print_r($errors);
						$errors_0 = $errors[0];						
					}
				}
				break;
					
			case 'delete' :
				$paramsArray = array(
					$_POST['IDsToDlete']
				);				
				$result = $file_upload->delete( $paramsArray );
				class_common::header_redirect( $script_name );
				break;	
			
		}
	}
	
	
	if( $action == "add" || $action == "grid" )
	{	
		 if ( $action == "add" )
		 {
			
		 }
		 else if( $action == "grid" )
		 {
			$file_upload->searchby = ($_REQUEST["searchby"] == "") ? "" : $_REQUEST["searchby"];
            $file_upload->searchval = ($_REQUEST["searchval"] == "") ? "" : $_REQUEST["searchval"];
            $file_upload->page = $_REQUEST["page"];
            $file_upload->limit = $_REQUEST["rows"];
            $file_upload->sidx = ($_REQUEST["sidx"] == "") ? "hotelname" : $_REQUEST["sidx"];
            $file_upload->sord = ($_REQUEST["sord"] == "") ? "asc" : $_REQUEST["sord"];
            
			header("Content-Type: text/xml;charset=ISO-8859-1");

            echo $file_upload->select();

            exit;
		 }
        
		// page title
		$page_title = ucfirst($action).' File Upload';
	
		// breadcrumb
		$breadcrumb = '<a href="clientlist.php">Home</a>&nbsp;>&nbsp;File Upload';
		
		// page title
		$page_title = 'File Upload';
	
		/* include templates */
		include_once( 'templates/helpers/header.tpl.php' );
		include_once( 'templates/helpers/leftpanel.tpl.php' );       
		include_once( 'templates/file_upload/ae-file_upload.tpl.php' );
		include_once( 'templates/helpers/footer.tpl.php' );
		
	}
	else
	{	
		// page title
		$page_title = ucfirst($action).' File Upload';
	
		// breadcrumb
		$breadcrumb = '<a href="clientlist.php">Home</a>&nbsp;>&nbsp;File Upload';
		
		// page title
		$page_title = 'File Upload';
		
		 /* search fields combo */
        $itemsarr = array( 'title' => 'Title', 'file_type' => 'Type' , 'file_name' => 'File Name' );
        $cmbsrch = class_common::getSearchDropdown( $itemsarr, 'cmbSearchField', '', 'input', '' );
	
		/* include templates */
		include_once( 'templates/helpers/header.tpl.php' );
		include_once( 'templates/helpers/leftpanel.tpl.php' );       
		include_once( 'templates/file_upload/file_upload.tpl.php' );
		include_once( 'templates/helpers/footer.tpl.php' );
	}
	
	

?>