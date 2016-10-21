<?php defined('BASEPATH') OR exit('No direct script access allowed');

final class SecurityHook
{
	public function checkSession()
	{
		//Don't eval anything if it's a CLI or Cron Job.
		if(FALSE === is_cli())
		{
			$CI   = &get_instance();
			$ctrl = $CI->router->fetch_class();
			$meth = $CI->router->fetch_method();

			$urls       = "{$ctrl}/{$meth}";
			$isLoggedIn = $CI->aauth->is_loggedin();

			$exemptedUrls = array
			(
				'Auth/login',
				'Auth/requestPasswordReset',
				'Auth/resetPasswordSent',
				'Auth/passwordChanged'
			);

			if(FALSE === $isLoggedIn && !in_array($urls, $exemptedUrls))
			{
				redirect(site_url('login'));
			}
		}
	}
}