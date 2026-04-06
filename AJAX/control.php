<?php
include('model.php');

class control extends model
{
	function __construct()
	{
		session_start();
		model::__construct();
		$page_url = $_SERVER['PATH_INFO'];  //http://localhost/shruti/tops/AJAX/control.php
		switch($page_url)
		{
			case '/index':
				$country_arr = $this->select('country');
				if(isset($_REQUEST['submit']))
				{
					$name = $_REQUEST['name'];
					$cid = $_REQUEST['cid'];
					$sid = $_REQUEST['sid'];
					$city_id = $_REQUEST['city_id'];

					$data = array("name"=>$name,"country_id"=>$cid,"state_id"=>$sid,"city_id"=>$city_id);
					$res = $this->insert('registration',$data);
					
					if($res)
					{
						echo "<script>alert('Register Success')</script>";
					}
					
				}

				include_once('form_get_country.php');
				break;

			case '/statedata':
				if(isset($_REQUEST['btn']))
				{
					$cid = $_REQUEST['btn'];
					$where = array("country_id"=>$cid);
					$state_arr = $this->select_where('state',$where);
					
					echo '<option value="">-------Select State----</option>';
					
					foreach($state_arr as $r)
					{
						
						echo "<option value='{$r->id}'>{$r->state_name}</option>";
						
					}
				}
				break;

			case '/citydata':
				if(isset($_REQUEST['btn']))
				{
					$sid = $_REQUEST['btn'];
					$where = array("state_id"=>$sid);
					$city_arr = $this->select_where('city',$where);
					?>
					<option>----Select City----</option>
					<?php
					foreach($city_arr as $r)
					{
						?>
						<option value="<?php echo $r->city_id; ?>">
							<?php echo $r->city_name; ?>
						</option>
						<?php
					}
				}
				break;
		} 
	} 
} 
$obj = new control;
?>
