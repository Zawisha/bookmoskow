<?
class Business_ru_api_webhook_lib
{
	private $app_id = '';
	private $secret = '';

	public function __construct($app_id, $secret)
	{
		$this->app_id = $app_id;
		$this->secret = $secret;
	}

	public function authenticate()
	{
		$params = [];

		if(isset($_REQUEST['app_id'])){
			$params['app_id'] = $_REQUEST['app_id'];
			if($params['app_id'] != $this->app_id)
				return false;
		}

		if(isset($_REQUEST['model']))
			$params['model'] = $_REQUEST['model'];

		if(isset($_REQUEST['action']))
			$params['action'] = $_REQUEST['action'];
			
		if(isset($_REQUEST['changes']))
			$params['changes'] = $_REQUEST['changes'];

		if(isset($_REQUEST['data']))
			$params['data'] = $_REQUEST['data'];


		if(!isset($_REQUEST['app_psw']))
			return false;

		if(MD5($this->secret.http_build_query($params)) != $_REQUEST['app_psw'])
			return false;

		return true;
	}
}