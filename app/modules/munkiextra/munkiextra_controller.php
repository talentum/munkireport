<?php 

/**
 * munkiextra status module class
 *
 * @package munkireport
 * @author
 **/
class munkiextra_controller extends Module_controller
{
	
	/*** Protect methods with auth! ****/
	function __construct()
	{
		// Store module path
		$this->module_path = dirname(__FILE__);
	}

	/**
	 * Default method
	 *
	 * @author Björn Nilsson
	 **/
	function index()
	{
		echo "You've loaded the munkiextra module!";
	}

	
} // END class default_module