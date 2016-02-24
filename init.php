<?php
    //phpinfo();
    /* Start the session */
    session_start();
	
    header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');
    

    /* Project path settings */
    define( 'APPLICATION_PATH', dirname( __FILE__ ) );
    define( 'APPLICATION_UPLOAD', str_replace("\\","/",APPLICATION_PATH)."/uploads/");	

    $include_paths = array(
        APPLICATION_PATH . '/includes/',
        APPLICATION_PATH . '/includes/phpmailer/',
        get_include_path()
    );

    set_include_path( implode( PATH_SEPARATOR, $include_paths ) );

    /* autoloading classes */
    function __autoload( $classname )
    {
        include( $classname . '.php' );
    }
    //////////////////////////////////////////////////////

    /* Disable Warning and Notice */
    error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
   
?>