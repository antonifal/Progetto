<?php
require_once('connection.class.php');

class place
{
	private $comune;
	private $provincia;
	private $code;
	private $place_ok=false;
	private $msg_error=array();

	public function __construct()
	{
		$this->set_comune();
		$this->set_provincia();
		$this->check_place();

		if($this->place_ok==false)
			$this->set_default();

	}

	private function set_comune ()
	{
		echo "\n\nInserire comune: ";
		$this->comune=trim(fgets(STDIN));
	}

	private function set_provincia()
	{
		echo "\n\nInserire Provincia: ";
		$this->provincia=trim(fgets(STDIN));
	}

	private function set_default()
	{
		$this->comune="Roma";
		$this->provincia="RM";
		$this->code="H501";
	}

	private function check_place ()
	{
		$data_obj=new connection;
		$data_obj->connect();
		$data_obj->send_query("SELECT * FROM codici","codicefiscale");
		$data=$data_obj->get_resource_array();
		$data_obj->disconnect();

		$town=str_replace(" ","",$this->comune);

		$t=true;
		$t1=true;
		$d=true;
		$d1=true;

		if (strlen($town)<3)
		{
			$t=false;
			array_push($this->msg_error,'town');
		}
		if(!ctype_alpha($town))
		{
			$t1=false;
			array_push($this->msg_error,'town2');
		}
		if (strlen($this->provincia)!=2)
		{
			$d=false;
			array_push($this->msg_error,'district');
		}
		if(!ctype_alpha($this->provincia))
		{
			$d1=false;
			array_push($this->msg_error,'district2');
		}

		$district_found=false;
		$town_found=false;
		$indx_district=1;
		$indx_town=0;

		for($i=0;$i<count($data);$i++)
		{

			$res=explode(';',$data[$i]);

			if($res[1]==strtoupper($this->comune))
			{
				$town_found=true;
				$indx_town=$i;
			}
			if(trim($res[2])==strtoupper($this->provincia))
			{
				$district_found=true;
				$indx_district=$i;
			}
			if($town_found==true and $district_found==true and $indx_district==$indx_town)
			{
				$i=count($data);
				$this->code=$res[0];
			}
		}
		if($town_found==false)
		{
			array_push($this->msg_error,'town3');
		}
		if($district_found==false)
		{
			array_push($this->msg_error,'district3');
		}

		if($town_found and $district_found and $t and $t1 and $d and $d1)
		{
			$this->place_ok=true;
		}

	}

	public function get_comune()
 	{
		return $this->comune;
	}

 	public function get_provincia()
 	{
	 	return $this->provincia;
	}

	public function get_placecode()
	{
		return $this->code;
	}

	public function get_msg_error()
	{
		return $this->msg_error;
	}

}

?>
