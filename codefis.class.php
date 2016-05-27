<?php
require_once('connection.class.php');

class codefis
{

private $name_char;
private $surname_char;
private $birthday_char;
private $birthmonth_char;
private $birthyear_char;
private $cf_partial;
private $cf;
public $tabmonth;
public $tabpari;
public $tabdisp;
public $tabfinal;


public function __construct($name,$surname,$sex,$birthday,$birthmonth,$birthyear,$placecode)
		{
			$tab=new connection;
			$tab->connect();
			$tab->send_query("SELECT * FROM mesi","codicefiscale");

			$tabmonth=$tab->get_resource_assoc_array();

			$tab->send_query("SELECT * FROM tabellaA","codicefiscale");
			$data=$tab->get_resource_array();
			for ($i=0;$i<count($data);$i++)
			{
				$tb=explode(";",$data[$i]);
				$tabpari[$tb[0]]=$tb[1];
			}

			$tab->send_query("SELECT * FROM tabellaB","codicefiscale");
			$data=$tab->get_resource_array();
			for ($i=0;$i<count($data);$i++)
			{
				$tb=explode(";",$data[$i]);
				$tabdisp[$tb[0]]=$tb[1];
			}

			$tab->send_query("SELECT * FROM tabellaC ORDER BY codifica","codicefiscale");
			$data=$tab->get_resource_array();

			for ($i=0;$i<count($data);$i++)
			{
				$tb=explode(";",$data[$i]);
				$tabfinal[$i]=$tb[1];
			}
      $tab->disconnect();
			
			$name_char=$this->elab_name($name);
			$surname_char=$this->elab_surname($surname);
			if($sex=='F')
			{
				$birthday_char=$birthday+40;
			}
			else
			{
				$birthday_char=$birthday;
			}
			$birthmonth_char=$this->elab_month($birthmonth,$tabmonth);
			$birthyear_char=$this->elab_year($birthyear);
			$cf_partial=array($surname_char,$name_char,$birthyear_char,$birthmonth_char,$birthday_char,$placecode);
			$cf_partial=implode($cf_partial);

			$cf_partial=$this->control_char($cf_partial,$tabpari,$tabdisp,$tabfinal);
			$this->set_cf($cf_partial);
		}


private function set_cf($data)
		{
			$this->cf=$data;
		}



public function get_cf()
		{
			return $this->cf;
		}



private function elab_year($data)
		{
			$data=trim($data);
			$len=strlen($data);

			if ($len==4)
			{
				$temp=str_split($data,2);
				$data=$temp[1];
			}
			elseif ($len==2)
			{
				$temp=str_split($data,2);
				$data=$temp[0];
			}

			return $data;
		}




private function elab_month($birthmonth,$tabmonth)
		{
  			$data=$tabmonth[$birthmonth];
  			return $data;
		}




private function elab_surname($data)
		{
			$temp=str_split($data,1);
			$voc=$con=array();
			for ($x=0; $x<=strlen($data)-1;$x++)
			{
				if ($temp[$x]=='A' or $temp[$x]=='E' or $temp[$x]=='I' or $temp[$x]=='O' or $temp[$x]=='U')
				{
					$voc[$x]=$temp[$x];
				}
				else
				{
					$con[$x]=$temp[$x];
		 		}
			}
			$voc=array_values($voc);
			$con=array_values($con);
			$data=array_merge($con,$voc);
			while(count($data)<3)
				{														# se l'intero nome è più corto di 3 caratteri aggiungiamo X
					$data=array_push($data,"X");
				}
			$data=array($data[0],$data[1],$data[2]);
			$data=implode("",$data);
			return $data;
		}





private function elab_name($data)
		{
			$temp=str_split($data,1);
			$voc=$con=array();
			for ($x=0; $x<=strlen($data)-1;$x++)
			{
				if ($temp[$x]=='A' or $temp[$x]=='E' or $temp[$x]=='I' or $temp[$x]=='O' or $temp[$x]=='U')
				{
					$voc[$x]=$temp[$x];
				}
				else
				{
					$con[$x]=$temp[$x];
		 		}
			}
			$voc=array_values($voc);
			$con=array_values($con);
			if (count($con)>3)
			{ 														# se abbiamo più di 3 consonanti le prendiamo la prima terza e quarta
				$temp=$con;												# altrimenti l'ordine rimane quello ottenuto da input
				$con=array($temp[0],$temp[2],$temp[3]);
			}

			$data=array_merge($con,$voc);
			while(count($data)<3)
				{														# se l'intero nome è più corto di 3 caratteri aggiungiamo X
					$data=array_push($data,"X");
				}
			$data=array($data[0],$data[1],$data[2]);
			$data=implode("",$data);
			return $data;
		}



private function control_char($cf_partial,$tabpari,$tabdisp,$tabfinal)
 		{
 				$temp=str_split($cf_partial,1);
				$pari=array($temp[1],$temp[3],$temp[5],$temp[7],$temp[9],$temp[11],$temp[13]);
				$disp=array($temp[0],$temp[2],$temp[4],$temp[6],$temp[8],$temp[10],$temp[12],$temp[14]);
				$ris1=0;
				for ($x=0; $x<=count($pari)-1; $x++)
				{
					$key=$pari[$x];
					$ris1=$ris1+$tabpari[$key];
				}
				$ris2=0;
				for ($x=0; $x<=count($disp)-1; $x++)
				{
					$key=$disp[$x];
					$ris2=$ris2+$tabdisp[$key];
				}
				$key=($ris1+$ris2)%26;
				$temp=array_pad($temp,16,$tabfinal[$key]);
				$cf_partial=implode("",$temp);
				return $cf_partial;
 		}




 }

 ?>
