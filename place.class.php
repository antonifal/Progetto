<?php
require_once('read_data.class.php');
require_once('connection.class.php');
class place
{
	private $comune;
	private $provincia;
	private $code;
	private $msg_error=array();
	public function __construct()
	{
		$this->set_comune();
		$this->set_provincia();
		$this->check_place() ;
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
	private function check_place ()
	{
		$data_obj=new connection;
		$data_obj->connect();
		$data_obj->send_query("SELECT * FROM codici","codicefiscale");
		$data=$data_obj->get_resource_array();
		$data_obj->disconnect();

		$town=str_replace(" ","",$this->comune);
		if (strlen($this->comune)<3)
		{
			array_push($this->msg_error,'town');
		}
		if(!ctype_alpha($town))
		{
			array_push($this->msg_error,'town2');
		}
		if (strlen($this->provincia)!=2)
		{
			array_push($this->msg_error,'district');
		}
		if(!ctype_alpha($this->provincia))
		{
			array_push($this->msg_error,'district2');
		}
	//	$data=new read_data('codici_comuni_italiani.txt');
		$district_found=false;
		$town_found=false;
		$indx_district=1;
		$indx_town=0;
		//for($i=0;$i<count($data->get_resource());$i++)
		for($i=0;$i<count($data);$i++)
		{
			//$res=explode(';',$data->get_resource()[$i]);
			$res=explode(';',$data[$i]);
			//print_r($res[0]);
		//	exit;
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
				//$i=count($data->get_resource());
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
//$c=new place;
?>
