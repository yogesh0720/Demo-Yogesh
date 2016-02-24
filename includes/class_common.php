<?php

/**
 * Description of class_common_functions
 *
 * @author Yogesh  
 */
class class_common {

    /*
	* Author: Yogesh Nayi
	* Description: Get the database configration from application setup file
	*/
    public static function getSettings($settingsParameter) {
        // parse ini file
        $config = parse_ini_file(APPLICATION_PATH . '/' . "application.ini", true);
        $config = $config[$settingsParameter];

        return $config;
    }
	
	/*
	* Author: Yogesh Nayi
	* Description: file redirection fuction
	*/
    public static function header_redirect($url) {
        if (headers_sent()) {
            echo "<script>location.href='" . $url . "'</script>";
        } else {
            header("location:" . $url);
        }
		die;
    }
}
//end of class.
?>