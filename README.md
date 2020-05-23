# wordpress custom login or Woocommerce custom login form with Ajax

<p>Login form template `tpl-login.php`</p>
<pre>
	<code>
		&lt;?php
		/*
		* template name: tpl-login
		*/
		get_header();
		?&gt;
		&lt;form id=&quot;login-Form-box&quot; class=&quot;woocommerce-form woocommerce-form-login login&quot; method=&quot;post&quot;&gt;
			&lt;div class=&quot;row&quot;&gt;
				&lt;div class=&quot;auth-content&quot;&gt;&lt;/div&gt;
				&lt;div class=&quot;col-12&quot;&gt;
					&lt;div class=&quot;form-group&quot;&gt;
						&lt;label for=&quot;emailID&quot; class=&quot;sr-only&quot;&gt;Email id&lt;/label&gt;
						&lt;input type=&quot;email&quot; class=&quot;form-control&quot; placeholder=&quot;Email id&quot; id=&quot;emailID&quot; name=&quot;log&quot; required=&quot;required&quot; data-val=&quot;&quot;&gt;
					&lt;/div&gt;
				&lt;/div&gt;
				&lt;div class=&quot;col-12&quot;&gt;
					&lt;div class=&quot;form-group&quot;&gt;
						&lt;label for=&quot;password&quot; class=&quot;sr-only&quot;&gt;Password&lt;/label&gt;
						&lt;input type=&quot;password&quot; class=&quot;form-control&quot; placeholder=&quot;Password&quot; id=&quot;password&quot; name=&quot;pwd&quot; required=&quot;required&quot; data-val=&quot;&quot;&gt;
					&lt;/div&gt;
				&lt;/div&gt;		
				&lt;div class=&quot;col-12 text-center&quot;&gt;
					&lt;div class=&quot;form-group&quot;&gt;
						&lt;input type=&quot;hidden&quot; name=&quot;url&quot; value=&quot;&quot; id=&quot;urlRedirect&quot;&gt;
						&lt;button type=&quot;submit&quot; class=&quot;btn btn-primary&quot; title=&quot;Login&quot;&gt;Login&lt;/button&gt;
					&lt;/div&gt;
				&lt;/div&gt;
			&lt;/div&gt;
		&lt;/form&gt;
		&lt;?php
		get_footer();
		?&gt;
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