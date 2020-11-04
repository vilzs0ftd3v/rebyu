<?php

/**
 * 
 */
class Settings extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->_view->js = array('home/js/default.js');
	}

	function index(){
		$this->_view->render("settings");

	}

	
}