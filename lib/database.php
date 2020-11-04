<?php

/**
 * 
 */
class Database extends PDO
{
	
	function __construct()
	{
		//parent::__construct("mysql:host=sql201.0fees.us;dbname=0fe_23763878_review;","0fe_23763878","RheaS0ftd3v");
		parent::__construct("mysql:host=localhost;dbname=review;","root","");
	}
}