<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head id="Head1">
<title><?php echo $page_title ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/general.css" rel="stylesheet" type="text/css" />
<!--<script src="js/common.js" type="text/javascript"></script>-->
<link href="css/tabcontent.css" rel="stylesheet" type="text/css" />
<link href="css/tabcontent.css" rel="stylesheet" type="text/css" />
<!--<script type="text/javascript" src="js/tabcontent.js"></script>-->
<!-- jquery configuration section starts from here -->

<?php  
	//echo $_SERVER['REQUEST_URI'];
	if($_SERVER['REQUEST_URI']=='/admin/manage_notifications.php?action=add' || strpos($_SERVER['REQUEST_URI'], 'action=edit') > 1) {
?>
		<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
		<!--<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>-->
<?php	
	}else if($_SERVER['REQUEST_URI']=='/admin/manage_notifications.php') {
?>
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="js/jquery-ui-1.10.2.custom.min.js" type="text/javascript"></script>
		<!--<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>-->
<?PHP
	}else{ ?>
<script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>

<?php } ?>


<!--<script src="JqueryFiles/jquery.layout.js" type="text/javascript"></script>-->
<script src="js/jqgrid/i18n/grid.locale-en.js" type="text/javascript"></script>
<script src="js/jqgrid/jquery.jqGrid.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lib/nicEdit/nicEdit.js"></script> 
<!--<script src="JqueryFiles/jquery.tablednd.js" type="text/javascript"></script>-->
<!--<script src="JqueryFiles/jquery.contextmenu.js" type="text/javascript"></script>-->


<!--<link rel="stylesheet" type="text/css" media="screen" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" />-->
<link rel="stylesheet" type="text/css" media="screen" href="css/smoothness/jquery-ui-1.7.1.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/jqgrid/ui.jqgrid.css" />
<!-- jquery configuration section ends here -->
</head>
<body>
<!--<form id="form1" action="" method="post">-->

  <div id="container">
    <div id="logo">
        <a href="index.php">
            <img title="mediaconnect360" alt="mediaconnect360" src="/images/mediaconnect360-logo.jpg" border="0" />
        </a>
        <div id="welcomemessage"> 
            Welcome <strong><?php echo $_SESSION['smdb_admin_loginname'] ?></strong>
        </div>
    </div>
    
    <div id="tab-navigation">
        <span class="leftcurve">&nbsp;</span><span class="rightcurve">&nbsp;</span> <a id="ctl00_tabSummary" href="index.php">Home</a>
    </div>
    
    <div id="headerright">
        <div class="headerleftcurve">&nbsp;</div>
        <div class="headerrightcurve">&nbsp;</div>
        <div id="topnav">
        <?php if( $_SESSION['smdb_admin_loginname'] == "admin" ){?>
        	<a href="index.php">Home</a>
            &nbsp;|&nbsp; <a href="admin_manageusers.php">Manage Users</a>
            &nbsp;|&nbsp; <a href="events_usage.php">Usage Tracking</a>
        <?php }	else { ?>
            <a href="index.php">Home</a>
        <?php }	?>
         &nbsp;|&nbsp; <a href="logout.php">Logout</a>    
        </div>
    </div>
    
    <div id="main">
        <div id="content">
