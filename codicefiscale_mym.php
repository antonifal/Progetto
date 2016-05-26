<?php

class GenerateCodiceFiscale {
	
	public $cognome;
	public $nome;
	public $sesso;
	public $dataNascita;
	public $luogoNascita;
	public $codiceControlo;
	
	
	
	
	
	
	$months = array( 
        01  => 'A',  02 => 'B',  03 => 'C',  04 => 'D',  05 => 'E',  
        06  => 'H',  07 => 'L',  08 => 'M',  09 => 'P', 10 => 'R', 
        11 => 'S', 12 => 'T'
    );
	
	$consonant = array(
        'B', 'C', 'D', 'F', 'G', 'H', 'J', 'K',
        'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T',
        'V', 'W', 'X', 'Y', 'Z'
    );	
	
	$vowel = array(
        'A', 'E', 'I', 'O', 'U'
    );
	
	$even = array(
        '0' =>  0, '1' =>  1, '2' =>  2, '3' =>  3, '4' =>  4, 
        '5' =>  5, '6' =>  6, '7' =>  7, '8' =>  8, '9' =>  9,
        'A' =>  0, 'B' =>  1, 'C' =>  2, 'D' =>  3, 'E' =>  4, 
        'F' =>  5, 'G' =>  6, 'H' =>  7, 'I' =>  8, 'J' =>  9,
        'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13, 'O' => 14, 
        'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18, 'T' => 19,
        'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 
        'Z' => 25
    );
	
	$odd = array(  
        '0' =>  1, '1' =>  0, '2' =>  5, '3' =>  7, '4' =>  9,
        '5' => 13, '6' => 15, '7' => 17, '8' => 19, '9' => 21,
        'A' =>  1, 'B' =>  0, 'C' =>  5, 'D' =>  7, 'E' =>  9, 
        'F' => 13, 'G' => 15, 'H' => 17, 'I' => 19, 'J' => 21,
        'K' =>  2, 'L' =>  4, 'M' => 18, 'N' => 20, 'O' => 11, 
        'P' =>  3, 'Q' =>  6, 'R' =>  8, 'S' => 12, 'T' => 14,
        'U' => 16, 'V' => 10, 'W' => 22, 'X' => 25, 'Y' => 24, 
        'Z' => 23
    );
	
	
	$controllo = array( 
        '0'  => 'A', '1'  => 'B', '2'  => 'C', '3'  => 'D', 
        '4'  => 'E', '5'  => 'F', '6'  => 'G', '7'  => 'H', 
        '8'  => 'I', '9'  => 'J', '10' => 'K', '11' => 'L', 
        '12' => 'M', '13' => 'N', '14' => 'O', '15' => 'P', 
        '16' => 'Q', '17' => 'R', '18' => 'S', '19' => 'T',
        '20' => 'U', '21' => 'V', '22' => 'W', '23' => 'X', 
        '24' => 'Y', '25' => 'Z'
    ); 


 public __construct () 
 
{
	$this->set_cognome();
	$this->set_nome();
	$this->set_dataNascita();
	$this->set_luogoNascita();
	$this->set_codiceControlo();
	
	$this->cal_cognome() ;
	$this->cal_nome() ;
	$this->cal_DataNascita() ;
	$this->cal_LuogoNascita() ;
	$this->cal_CodiceControlo();
	
}


public function set_cognome () 
	{
	echo "insert cognome"; 
	$this->cognome=fgets(STDIN);
	}

public function set_nome()
	{
	echo "insert nome";
	$this->nome=fgets(STDIN);
	}

public function set_sesso()
	{
	echo "insert data di nascita"; 
	$this->sesso=fgets(STDIN);
	}

public function set_dataNascita()
	{
	echo "insert data di nascita"; 
	$this->dataNascita=fgets(STDIN);
	}
	
public function set_luogoNascita () 
	{
	echo "insert Luogo di Nascita"; 
	$this->luogoNascita=fgets(STDIN);
	}

/*public function set_CodiceControlo()
	{
	echo "insert provincia";$this->provincia=fgets(STDIN);
	}
	
*/	
	
	
	//here calculate cognome
public function cal_cognome($string)
	{
//to remove space
    $cognome = preg_replace('/\s+/', '', $string);

//convert into capital
	$cognome=strtoupper($cognome);

//store the consonant	
	for ($i = 0; $i < strlen($cognome); $i++) {
	if (in_array ($cognome[$i], $consonant))
	$constantlastname=$cognome[$i];

//store the vowel
	for ($i = 0; $i < strlen($cognome); $i++) {
	if(in_array ($cognome[$i], $vowel)){
		$vowelastname=$cognome[$i];

// merg consonant and vowel
	$result=array_merg ($constantlastname,$vowelastname);

// add the lettere 'X'	
	$n=count($result);
	while($n<3) {array_push($result,'X');}

//convert array to string
	$result=implode('',$result);
	$result=substr($result,0,3)
	return $result;
	}



	
	
	

	//here calculate nome
public function cal_nome($string) {
//to remove space
    $nome = preg_replace('/\s+/', '', $string);

//convert into capital
	$cognome=strtoupper($nome);

//get the consonant part in orden
	for ($i =0; $i < strlen($nome); $i++) 
	{
	if (in_array ($nome[$i], $consonant))
		$constantname=$nome[$i];
	}
	
// if we already have 4 consonant we get the 0th, 2th and 3th element of array
	if (count($constantname) >= 3) 
	{
	 unset($constantname[1]);   
     $constantname = implode('', $constantname);
    } 
		//break;?

// if no we add the vowel or lettere 'X'		
	elseif (in_array ($nome[$i],$vowel))
	{
		$vowelname=$nome[$i];
	}
				
	$result= array_merg($constantname,$vowelname);
	$n=count($result);
	while($n<3) 
	{
		array_push($result,'X');
	}
	
	$result=implode('',$result);
	$result=substr($result,0,3)	
	return $result;	
                       
            }



	//here calculate dataNascita
public function cal_dataNascita($dataNascita, $sesso) 
{  
// remove slash of insert date, put it in array
		$data = explode('/', $data);

        

        // last two year num
        $AA = substr($anno, -2);     
     
        $MM = $this->months[$mese];

       if (($sesso) == 'F'){
		  $GG=$giorno + 40 
		   
	   }
	  
              return $AA . $MM . $GG;        
    }


	
	
	
	 function Province($comune, $provincia) {
        $handle = fopen ("codici_comuni_italiani.txt", "r");

  // inserire controlli sul file: esiste, è leggibile, ....
 
	while ( !feof( $handle ) ) {

      $buffer = fgets($handle); 
  // legge una riga intera da file
     
	$buffer = rtrim($buffer); 
  // rimuove carattere di return a fine riga
 
     
	list($codice, $comune, $provincia) = explode (";", $buffer); 
 // divide la stringa in tre rispetto al separatore ; usato nel file

        
    }
	
	 function Controllo($codice) {
        $code = str_split($codice);
        $sum  = 0;

        for($i=1; $i <=15); $i+=2) {
		$odd= $code [$i];	
           }
		
		for ($i=o; $i <=15); $i+=2) {
		$even= $code [$i];}
		
		$sum= $odd + $even;
        $sum %= 26;

        return $this->controllo[$sum];
    }
}

?>
