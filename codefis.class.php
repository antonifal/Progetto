<?php

class codefis
{

private $name_char;
private $surname_char;
private $birthday_char;
private $birthmonth_char;
private $birthyear_char;
private $cf_partial;
private $cf;


public function __construct($name,$surname,$sex,$birthday,$birthmonth,$birthyear,$placecode)
		{
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
			$birthmonth_char=$this->elab_month($birthmonth);
			$birthyear_char=$this->elab_year($birthyear);
			$cf_partial=array($surname_char,$name_char,$birthyear_char,$birthmonth_char,$birthday_char,$placecode);
			$cf_partial=implode($cf_partial);
			$cf_partial=$this->control_char($cf_partial);
			$this->set_cf($cf_partial);
		}


private function set_cf($data)
		{
			$this->cf=$data;
		}



public function get_cf()
		{
			//echo $this->cf;
			return $this->cf;
		}

		

private function elab_year($data) 
		{
			$data=trim($data);
			$len=strlen($data);					# controlliamo la lunghezza dell'input anno
				if ($len==4){ 					# se risulta diverso da 2 (es.87) o 4 (es.1987)
				$temp=str_split($data,2);			# avvertiamo l'utente dell'errore commesso (es.987 o 11987)
				$data=$temp[1];					# inoltre se lunghezza=4 riduciamo ai caratteri necessari
				}
					elseif ($len==2) 
					{
					$temp=str_split($data,2);
					$data=$temp[0];
					}
			return $data;
		}




private function elab_month($data) 
		{
			$tab=array(	"01"=>"A",
						"02"=>"B",
						"03"=>"C",
						"04"=>"D",
						"05"=>"E",
						"06"=>"H",
						"07"=>"L",
						"08"=>"M",
						"09"=>"P",
						"10"=>"R",
						"11"=>"S",
						"12"=>"T");
  			$data=$tab[$data];
  			return $data;
		}




private function elab_surname($data) 
		{
			$temp=str_split($data,1);    	# trasformiamo la stringa di input cognome in un array
			$voc=$con=array();				# per poter elaborare il tutto
			for ($x=0; $x<=strlen($data)-1;$x++) 
			{
				if ($temp[$x]=='A' or $temp[$x]=='E' or $temp[$x]=='I' or $temp[$x]=='O' or $temp[$x]=='U') 
				{																									# estraiamo le vocali
					$voc[$x]=$temp[$x];
				}																									
				elseif ($temp[$x]=='B' or $temp[$x]=='C' or $temp[$x]=='D' or $temp[$x]=='F' or $temp[$x]=='G' or
						$temp[$x]=='H' or $temp[$x]=='L' or $temp[$x]=='M' or $temp[$x]=='N' or $temp[$x]=='P' or 
						$temp[$x]=='Q' or $temp[$x]=='R' or $temp[$x]=='S' or $temp[$x]=='T' or $temp[$x]=='V' or 
						$temp[$x]=='W' or $temp[$x]=='X' or $temp[$x]=='Z' or $temp[$x]=='K' or $temp[$x]=='Y' or 
						$temp[$x]=='J') 
				{																						# estraiamo le consonanti
							$con[$x]=$temp[$x];
		 		}
			}
			$voc=array_values($voc);									# compattiamo gli array ottenuti (eliminando i "buchi")
			$con=array_values($con);
			$data=array_merge($con,$voc);								# uniamo gli array con l'ordine giusto
			while(count($data)<3) 
			{														# aggiungiamo il carattere X nel caso in cui non abbiamo 
				$data=array_push($data,"X");							# il num sufficiente di caratteri
			}
			$data=array($data[0],$data[1],$data[2]);					# prendiamo i caratteri che ci interessano (i primi 3)
			$data=implode("",$data);							# riportiamo l'array a una stringa e restituiamo il risultato
			return $data;
		}





private function elab_name($data) 
		{															# stesso procedimento della funzione elab_cognome
			$temp=str_split($data,1);
			$voc=$con=array();
			for ($x=0; $x<=strlen($data)-1;$x++) 
			{
				if ($temp[$x]=='A' or $temp[$x]=='E' or $temp[$x]=='I' or $temp[$x]=='O' or $temp[$x]=='U') 
				{
					$voc[$x]=$temp[$x];
				}
				if ($temp[$x]=='B' or $temp[$x]=='C' or $temp[$x]=='D' or $temp[$x]=='F' or $temp[$x]=='G' or
						$temp[$x]=='H' or $temp[$x]=='L' or $temp[$x]=='M' or $temp[$x]=='N' or $temp[$x]=='P' or 
						$temp[$x]=='Q' or $temp[$x]=='R' or $temp[$x]=='S' or $temp[$x]=='T' or $temp[$x]=='V' or 
						$temp[$x]=='W' or $temp[$x]=='X' or $temp[$x]=='Z' or $temp[$x]=='K' or $temp[$x]=='Y' or 
						$temp[$x]=='J')
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
		

 		
private function control_char($data) 
 		{															# questa funzione ci restituisce il carattere di controllo del codice fiscale
 			$temp=str_split($data,1);
 			print_r($temp);									# il primo array associativo contiene i valori da sostituire ai caratteri in pos. pari
 			$valpari=array( "0"=>"0","1"=>"1",
 							"2"=>"2","3"=>"3",
 							"4"=>"4","5"=>"5",
 							"6"=>"6","7"=>"7",
 							"8"=>"8","9"=>"9",
							"A"=>"0","B"=>"1",
							"C"=>"2","D"=>"3",
							"E"=>"4","F"=>"5",
							"G"=>"6","H"=>"7",
							"I"=>"8","J"=>"9",
							"K"=>"10","L"=>"11",
							"M"=>"12","N"=>"13",
							"O"=>"14","P"=>"15",
							"Q"=>"16","R"=>"17",
							"S"=>"18","T"=>"19",
							"U"=>"20","V"=>"21",
							"W"=>"22","X"=>"23",
							"Y"=>"24","Z"=>"25");
 			print_r($valpari);
 																	# il secondo contiene i valori da sostituire ai caratteri in pos. dispari
			$valdisp=array(	"0"=>"0","1"=>"0",
							"2"=>"5","3"=>"7",
							"4"=>"9","5"=>"13",
							"6"=>"15","7"=>"17",
							"8"=>"19","9"=>"21",
							"A"=>"1","B"=>"0",
							"C"=>"5","D"=>"7",
							"E"=>"9","F"=>"13",
							"G"=>"15","H"=>"17",
							"I"=>"19","J"=>"21",
							"K"=>"2","L"=>"4",
							"M"=>"18","N"=>"20",
							"O"=>"11","P"=>"3",
							"Q"=>"6","R"=>"8",
							"S"=>"12","T"=>"14",
							"U"=>"16","V"=>"10",
							"W"=>"22","X"=>"25",
							"Y"=>"24","Z"=>"23");
			print_r($valdisp);
			$pari=array($temp[1],$temp[3],$temp[5],$temp[7],$temp[9],$temp[11],$temp[13]);				# creiamo l'array che contiene i caratteri in pos. pari
			$disp=array($temp[0],$temp[2],$temp[4],$temp[6],$temp[8],$temp[10],$temp[12],$temp[14]);	# creiamo l'array che contiene i caratteri in pos. dispari
			$ris=0;
			for ($x=0; $x<=count($pari)-1; $x++)
			{
				$key=$pari[$x];
				$ris=$ris+$valpari[$key];
			}																# mettiamo in $pari la somma dei valori sotituiti ai caratteri pari
			$pari=$ris;
			$ris=0;
			for ($x=0; $x<=count($disp)-1; $x++)
			{
				$key=$disp[$x];
				$ris=$ris+$valdisp[$key];
			}																# mettiamo in $disp la somma dei valori sotituiti ai caratteri dispari
			$disp=$ris;
			$key=($pari+$disp)%26;												#  mettiamo in $key il resto della somma totale dei valori /26
			$val=array("A","B","C","D","E","F","G","H","I","J","K","L","M",		# creiamo l'array contenete i caratteri di controllo
						"N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
			$temp=array_pad($temp,16,"$val[$key]");								# aggiungiamo il carattere di controllo opportuno ottenendo un codice fiscale completo
			$data=implode("",$temp);
			return $data;
 		} 




 }

 ?>