<?php 

namespace App\Core;

class Request
{

	public static function uri()
	{

		$dir = dirname($_SERVER['PHP_SELF']);
		
		return substr(
			parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), strlen($dir) + 1
		);

	}

	public static function method() 
    {
        if (isset($_POST['_method'])) {
            return $_POST['_method'];
        }
        
        return $_SERVER['REQUEST_METHOD'];
    }

}