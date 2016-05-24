<?php

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
		echo "Inserire comune:\n\n";
		$this->comune=trim(fgets(STDIN));
	}

	private function set_provincia()
	{
		echo "Inserire Provincia:\n\n";
		$this->provincia=trim(fgets(STDIN));
	}



	public function  get_comune ()
 	{
		return $this->comune;
	}

 	public function get_provincia ()
 	{
	 	return $this->provincia;
	}

 	public function get_code ()
 	{
	 	echo $this->code;
	}

	public function check_place ()
	{
		if (!strlen($this->provincia)==2)
		{
			array_push($this->msg_error,'district');
		}

		if (!((ctype_alpha($this->provincia) || ctype_alpha($this->comune))))
		{
			echo "Errore";
		}

		$size=preg_replace('/\s+/', '', $this->comune);

		if (strlen($size)<4)
		{
			echo "Errore";
		}


	}

}
//$c=new place;
?>
