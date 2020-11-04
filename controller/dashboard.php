<?php

/**
 * 
 */
class Dashboard extends Controller
{	
	
	function __construct()
	{
		parent::__construct();	
	}

	function index(){
		$this->_view->render("dashboard");
	}
}