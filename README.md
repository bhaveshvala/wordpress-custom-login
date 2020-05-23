# wordpress custom login or Woocommerce custom login form with Ajax

<p>Login form template `tpl-login.php`</p>
<pre>
	<code>
<?php
/*
* template name: tpl-login
*/
get_header();
?>
<form id="login-Form-box" class="woocommerce-form woocommerce-form-login login" method="post">
	<div class="row">
		<div class="auth-content"></div>
		<div class="col-12">
			<div class="form-group">
				<label for="emailID" class="sr-only">Email id</label>
				<input type="email" class="form-control" placeholder="Email id" id="emailID" name="log" required="required" data-val="">
			</div>
		</div>
		<div class="col-12">
			<div class="form-group">
				<label for="password" class="sr-only">Password</label>
				<input type="password" class="form-control" placeholder="Password" id="password" name="pwd" required="required" data-val="">
			</div>
		</div>		
		<div class="col-12 text-center">
			<div class="form-group">
				<input type="hidden" name="url" value="" id="urlRedirect">
				<button type="submit" class="btn btn-primary" title="Login">Login</button>
			</div>
		</div>
	</div>
</form>
<?php
get_footer();	
	</code>
</pre>
<hr>
<p>`function.php`</p>
<pre>
	<code>
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
* Ajax for login action hook
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
?>
	</code>
</pre>	