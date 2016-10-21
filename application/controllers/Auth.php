<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Auth extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
    }

    public function registration($state)
    {
        vars(array('state' => $state));
        render('auth/register_cmpl');
    }

    public function register()
    {
        if('post' === method())
        {
            extract(post());
            $b = $this->aauth->create_user($email, $password);
            if(TRUE === $b)
            {
                $uId = $this->aauth->get_user_id($email);
                $this->aauth->send_verification($uId);
                redirect(site_url('Auth/registration/success'));
            }
            else
            {
                error(array('Error registering. Please try again.'));
                render('auth/register');
            }
        }
        else
        {
            render('auth/register');
        }
    }

	public function login()
    {
        if('post' === method())
        {
            extract(post());
            $b = $this->aauth->login($email, $password, TRUE);
            if(TRUE === $b)
            {
                redirect(site_url());
            }
            else
            {
                error(array('Error logging in. Please try again.'));
                render('auth/login');
            }
        }
        else
        {
            render('auth/login');
        }
    }

    public function logout()
    {
        $this->aauth->logout();
    }
}
