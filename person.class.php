<?php
require_once('msgerr.class.php');
require_once('date.class.php');
require_once('place.class.php');
require_once('codefis.class.php');

class person
{

	private $name;
	private $surname;
	private $sex;
	private $birthday;
	private $birthmonth;
	private $birthyear;
	private $town;
	private $district;
	private $placecode;
	private $cf;

	private $msg_error=array();


	public function __construct()
	{
		$this->set_name();
		$this->set_surname();
		$this->set_sex();
		$this->set_date();
		$this->set_place();
		$this->set_cf();
		$this->check_info();
		$this->get_name();
		$this->get_surname();
		$this->get_sex();
		$this->get_birth_day();
		$this->get_birth_month();
		$this->get_birth_year();
		$this->get_town();
		$this->get_district();
		$this->get_cf();
	}

	private function set_name()
	{
		echo "\nInserire il vostro nome: \n\n";
		$this->name=trim(fgets(STDIN));
	}

	private function set_surname()
	{
		echo "Inserire il vostro cognome: \n\n";
		$this->surname=trim(fgets(STDIN));
	}

	private function set_sex()
	{
		echo "Inserire il vostro sesso: \n\n";
		$this->sex=trim(fgets(STDIN));
	}

	private function set_date()
	{
		$date=new date;
		$this->birthday=$date->get_day();
		$this->birthmonth=$date->get_month();
		$this->birthyear=$date->get_year();

		for($i=0;$i<count($date->get_msg_error());$i++)
		{
			array_push($this->msg_error,$date->get_msg_error()[$i]);
		}
		//$this->msg_error=$date->get_msg_error();
	}

	private function set_place()
	{
		$place=new place;
		$this->town=$place->get_comune();
		$this->district=$place->get_provincia();
		$this->placecode=get_placecode();
		for($i=0;$i<count($place->get_msg_error());$i++)
		{
			array_push($this->msg_error,$place->get_msg_error()[$i]);
		}
	}

	private function set_cf()
	{
		new codefis($this->get_name(),$this->get_surname(),$this->get_sex(),
					$this->get_birth_day(),$this->get_birth_month(),
					$this->get_birth_year(),$this->placecode);
		$this->cf=$codefis->get_cf();
	}


	public function get_name()
	{
		echo $this->name;
	}

	public function get_surname()
	{
		echo $this->surname;
	}

	public function get_sex()
	{
		echo $this->sex;
	}

	public function get_birth_day()
	{
		echo $this->birthday;
	}

	public function get_birth_month()
	{
		echo $this->birthmonth;
	}

	public function get_birth_year()
	{
		echo $this->birthyear;
	}

	public function get_town()
	{
		echo $this->town;
	}

	public function get_district()
	{
		echo $this->district;
	}

	public function get_cf()
	{
		echo $this->cf;
	}

	private function check_info()
	{
		if(strlen($this->name)<2)
		{
		  array_push($this->msg_error,'name');
		}
		if(ctype_alpha($this->name)!=TRUE)
		{
			array_push($this->msg_error,'name2');
		}
		if(strlen($this->surname)<2)
		{
			array_push($this->msg_error,'surname');
		}
		if(ctype_alpha($this->surname)!=TRUE)
		{
			array_push($this->msg_error,'surname2');
		}
		if(strlen($this->sex)!=1)
		{
			array_push($this->msg_error,'sex');
		}
		if($this->sex!='M' && $this->sex!='F')
		{
			array_push($this->msg_error,'sex2');
		}
	//	print_r($this->msg_error);
		new msgerr($this->msg_error);

	}

}


$p=new person();

?>
