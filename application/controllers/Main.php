<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Main extends CI_Controller
{
	public function __construct(){parent::__construct();}
	public function index(){render('index');}
    public function tips(){render('tips');}
    public function about(){render('about');}
}
