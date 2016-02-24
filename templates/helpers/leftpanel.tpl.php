<?php
// for dhx support team
$calling_script = basename( $_SERVER['SCRIPT_NAME'] );
if( $_SESSION['smdb_admin_loginname'] == "dhxdhx" && $calling_script != "manageevents.php"){
    class_common::header_redirect("manageevents.php");
}
// end of for dhx support team

//for admin Event Management users
else if( $_SESSION['smdb_admin_roleid'] != "4401" && $_SESSION['smdb_admin_roleid']=="4411") {
	if($calling_script == "pendingeventslist.php" || $calling_script == "mywork.php"){		
	}else{
		class_common::header_redirect("pendingeventslist.php");
	}
}
//end of for admin user's management 

//for admin user's management 
else if( $_SESSION['smdb_admin_loginname'] != "admin" && $calling_script == "admin_manageusers.php"){
	class_common::header_redirect("clientlist.php");
}
//end of for admin user's management 
?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <tr>
        <td valign="top">
            <div id="sidebar">

                <div class="leftnav">
                <?php if($_SESSION['smdb_admin_roleid'] != "4411") {?>
                    <div class="leftnav_head">Main Links</div>
                    <div class="nav">
                        <?php
                            if( $_SESSION['smdb_admin_loginname'] == "dhxdhx" ) // for dhx support team
                            {
                        ?>
                            <span>
                                <a href="manageevents.php">Manage Events</a>
                            </span>
                        <?php
                            } // end of for dhx support team
                            else if ($_SERVER['HTTP_HOST'] != 'eventsetup.milestoneinternet.com')
                            {
                        ?>
                            <span>
                                <a href="clientlist.php">Manage Client</a>
                            </span>
                            <span>
                                <a href="managebrands.php">Manage Hotel Brands</a>
                            </span>
                            <span>
                                <a href="manageusers.php">Manage Users</a>
                            </span>
                            <span>
                                <a href="managecategory.php">Manage Category</a>
                            </span>
                            <span>
                                <a href="category_image.php">Category Images</a>
                            </span>
                            <span>
                                <a href="managelocation.php">Manage Venue</a>
                            </span>
                            <span>
								<a href="manageevents.php">Manage Events</a>
                            </span>
                            <span>
                                <a href="import-events.php">Import Events</a>
                            </span>
                            <span>
                                <a href="managepreferences.php">Manage Preferences</a>
                            </span>
                            <span>
                                <a href="import-tasks.php">Import Tasks</a>
                            </span>
                            <span>
                                <a href="eviesays.php">Eviesays Events</a>
                            </span>
                            <span>
                                <a href="myevents-admin.php" title="Only For India Team">My Events*</a>
                            </span>
                            <span>
                                <a href="event_moderation.php">Event Moderation</a>
                            </span>
                            <span>
                                <a href="auto_login.php">Auto Login</a>
                            </span>
                           <span>
                                <a href="country_master.php">Country Master</a>
                            </span>
                             <span>
                                <a href="state_master.php">State Master</a>
                            </span>
                           <span>
                                <a href="city.php">City Master</a>
                            </span>
                             <span>
                                <a href="zipcode.php">Zipcode Master</a>
                            </span>
                             <span>
                                <a href="scheduledlist.php">Scheduled List</a>
                            </span>
							 <span>
                                <a href="usage_tracking.php">Usage</a>
                            </span>
                            <span style="display: none;">
                                <a href="managecodes.php">Manage Codes</a>
                            </span>
                            <span style="display: none;">
                                <a href="database_call_log.php">Database Log</a>
                            </span>
                            <span>
                                <a href="customers-list-report.php">Customers Report</a>
                            </span>
							<span>
                                <a href="users-list-report.php">Users Report</a>
                            </span>
                            <span>
                                <a href="customerreports.php" title="Scheduled Message Report">Scheduled Message Report</a>
                            </span>
                            <span>
                                <a href="api_token_expire.php">API Tokens Expired</a>
                            </span>
							<span>
								<a href="error_log.php">Error Log</a>
							</span>

                        <?php
                            }
                            else
                            {
                        ?>
                                <span>
                                    <a href="clientlist.php">Manage Clients</a>
                                </span>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="endnav">&nbsp;</div>
                </div>                 
            	<?php
				if( $_SESSION['smdb_admin_loginname'] != "dhxdhx" ) // for dhx support team
                    {  ?>
                 <!--System Notifications code start-->	
                <div class="leftnav">
					<div class="leftnav_head">System Notifications</div>
						<div class="nav">
							<span >
							   <a href="manage_notifications.php">Manage Notifications</a>
							</span>
                                    <span class="leftnav_link_hide">
							<a href="javascript:;">Notification Tracking</a>
							</span>
						</div>
					<div class="endnav">&nbsp;</div>
				</div>
                <!--System Notifications code start-->
                      <?php	}	?>
                  <?php	}	?>
                                
            	<?php
				if( $_SESSION['smdb_admin_loginname'] != "dhxdhx" ) // for dhx support team
 				{
				?>
                 
                 
                <!--Event Management code start-->
                 <div class="leftnav">
					<div class="leftnav_head">Event Management</div>
						<div class="nav">
                         <?php
							if( $_SESSION['smdb_admin_roleid'] == "4411" ) // for content writer admin users 
							{
							?> 
							<span>
							<a href="pendingeventslist.php">Pending Events</a>
							</span>
							<span>
							<a href="mywork.php">My Work</a>
							</span>
                        <?php } 
						else if( $_SESSION['smdb_admin_roleid'] == "4401" ){ // for moderation
						?>
							<span >
							<a href="eventsourceslist.php">Sources &amp; Upload</a>
							</span>                             
							<span>
							<a href="pendingeventslist.php">Pending Events</a>
							</span>
							<span>
							<a href="mywork.php">My Work</a>
							</span>
							<span>
							<a href="moderation.php">Moderation</a>
							</span>
                      <?php } ?>        
						</div>
					<div class="endnav">&nbsp;</div>
				</div>
                 <!--Event Management code end-->
                 
                <?php if($_SESSION['smdb_admin_roleid'] != "4411") {?> 
            	<div class="leftnav">
					<div class="leftnav_head">Support</div>
						<div class="nav">
							<span >
							<a href="faqs.php">FAQs</a>
							</span>
							<span>
							<a href="training_webinars.php">Training Webinars</a>
							</span>
							<span class="leftnav_link_hide">
							<a href="#">Newsletters</a>
							</span>
							<span>
							<a href="manual_release_notes.php">Manual &amp Release Notes</a>
							</span>
							<span >
							<a href="file_upload.php">File Upload</a>
							</span>
						</div>
					<div class="endnav">&nbsp;</div>
				</div>
                <?php } ?>
                 <?php } ?>
            </div>
        </td>
        <td width="100%" valign="top">
            <div id="subcontent">
                <div class="breadcrumbs"><?php echo $breadcrumb ?></div>
                <div id="contentblock">