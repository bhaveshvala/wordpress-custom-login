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