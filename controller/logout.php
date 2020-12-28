<?php

/**
 * 
 */
class Logout extends Controller
{	
	
	function __construct()
	{
		parent::__construct();	
	}

	function index(){
		Session::init();
		Session::destroy();
		$this->_view->render("home");
	}
}
