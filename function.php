<?php
/*
* wp_enqueue_scripts hook
*/
function en_scripts(){
	/*
	* This is Validator JS for validation fields
	*/
	wp_enqueue_script( 'validator-js', 'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js', array( 'jquery' ), rand(0, 999), true  );

	/*
	* This is out custom js file load here
	*/
	wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), rand(0, 999), true );

	/*
	* This is localize js for php value pass on custon js (Object)
	*/
	wp_localize_script( 'custom-script', 'screenReaderText', array(
		'aJaxAdmin'   => admin_url('admin-ajax.php'),
		'site_url' => site_url()
	) );

}
add_action( 'wp_enqueue_scripts', 'en_scripts' );





/*
* Ajax for login check action hook
*/
add_action('wp_ajax_check_login', 'check_login' );
add_action('wp_ajax_nopriv_check_login', 'check_login');

function check_login() {
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$user = get_user_by( 'login', $username );
	if ( $user && wp_check_password($password, $user->user_pass, $user->ID) ) {
	    echo "1";
	} else {
	    echo "0";
	}
	exit;
}
/*
* Ajax for login success action hook
*/
add_action('wp_ajax_success_login', 'success_login' );
add_action('wp_ajax_nopriv_success_login', 'success_login');
function success_login() {
	if($_POST) {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$remember = "true";
		$login_data = array();
		$login_data['user_login'] = $username;
		$login_data['user_password'] = $password;
		$login_data['remember'] = $remember;
		$user_verify = wp_signon( $login_data, false );
		exit;
	}
}