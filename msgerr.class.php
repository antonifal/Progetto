<?php

class error
{
	private $errtab=array
		(
			"day"=>"Il giorno inserito non e' corretto \n",
			"month"=>"Il mese inserito non e' corretto \n",
			"year"=>"L'anno inserito non e' corretto \n",
			"name"=>"Il nome deve essere piu' di un carattere \n",
			"name2"=>"Il nome non deve contenere numeri \n",
			"surname"=>"Il cognome deve essere piu' di un carattere \n",
			"surname2"=>"Il cognome non deve contenere numeri \n",
			"sex"=>"Il sesso deve essere un carattere, M per maschile o F per femminile \n",
			"sex2"=>"Il sesso deve essere M per maschile o F per femminile, altri caratteri non ammessi \n",
			"town"=>"Il comune deve essere almeno 3 caratteri \n",
			"town2"=>"Il comune non deve contenere numeri \n",
			"town3"=>"Il comune inserito non esiste \n",
			"district"=>"La provincia deve essere di due caratteri \n",
			"district2"=>"La provincia non deve contenere numeri \n",
			"district3"=>"la provincia inserita non esiste \n"
		);


	public function __construct($msg_error)
		{
			$this->get_err_msg($msg_error);
		}

	public function get_err_msg($msg_error)
		{
			for($i=0;$i<count($msg_error);$i++)
			{
				echo $this->errtab[$msg_error[$i]];
			}
			//return $this->errmsg;
		}

}



?>
