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
	private $person_ok=false;

	private $msg_error=array();


	public function __construct()
	{
		$this->set_name();
		$this->set_surname();
		$this->set_sex();
		$this->set_date();
		$this->set_place();
		$this->check_info();

		if($this->person_ok==false)
		{
			$this->set_default();
		}

		$this->set_cf();
		$this->get_cf();

	}

	private function set_name()
	{
		echo "\nInserire il vostro nome: ";
		$this->name=strtoupper(trim(fgets(STDIN)));
	}

	private function set_surname()
	{
		echo "\n\nInserire il vostro cognome: ";
		$this->surname=strtoupper(trim(fgets(STDIN)));
	}

	private function set_sex()
	{
		echo "\n\nInserire il vostro sesso: ";
		$this->sex=strtoupper(trim(fgets(STDIN)));
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
	}

	private function set_place()
	{
		$place=new place;
		$this->town=$place->get_comune();
		$this->district=$place->get_provincia();
		$this->placecode=$place->get_placecode();
		for($i=0;$i<count($place->get_msg_error());$i++)
		{
			array_push($this->msg_error,$place->get_msg_error()[$i]);
		}
	}

	private function set_default()
	{
		$this->name="MARIO";
		$this->surname="ROSSI";
		$this->sex="M";
	}

	private function set_cf()
	{

		$codefis=new codefis
		(
			$this->name,
			$this->surname,
			$this->sex,
			$this->birthday,
			$this->birthmonth,
			$this->birthyear,
			$this->placecode
		);

		$this->cf=$codefis->get_cf();
	}


	public function get_name()
	{
		return $this->name;
	}

	public function get_surname()
	{
		return $this->surname;
	}

	public function get_sex()
	{
		return $this->sex;
	}

	public function get_birth_day()
	{
		return $this->birthday;
	}

	public function get_birth_month()
	{
		return $this->birthmonth;
	}

	public function get_birth_year()
	{
		return $this->birthyear;
	}

	public function get_town()
	{
		return $this->town;
	}

	public function get_district()
	{
		return $this->district;
	}

	public function get_cf()
	{
		echo "\n\nIl codice fiscale risulta ---> $this->cf \n\n";
		return $this->cf;
	}

	private function check_info()
	{
		$n=true;
		$n2=true;
		$sn=true;
		$sn1=true;
		$sx=true;
		$sx2=true;

		if(strlen($this->name)<2)
		{
			$n=false;
		  array_push($this->msg_error,'name');
		}
		if(ctype_alpha($this->name)!=TRUE)
		{
			$n2=false;
			array_push($this->msg_error,'name2');
		}
		if(strlen($this->surname)<2)
		{
			$sn=false;
			array_push($this->msg_error,'surname');
		}
		if(ctype_alpha($this->surname)!=TRUE)
		{
			$sn=false;
			array_push($this->msg_error,'surname2');
		}
		if(strlen($this->sex)!=1)
		{
			$sx=false;
			array_push($this->msg_error,'sex');
		}
		if($this->sex!='M' && $this->sex!='F')
		{
			$sx2=false;
			array_push($this->msg_error,'sex2');
		}
	//	print_r($this->msg_error);
		new msgerr($this->msg_error);

		if ($n and $n2 and $sn and $sn1 and $sx and $sx2)
		{
			$this->person_ok=true;
		}

	}

}


$p=new person();

?>
