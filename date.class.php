<?php
class date
{

 private $day;
 private $month;
 private $year;
 private $check_ok=false;
 private $msg_error=array();

 public function __construct()
 {
   $this->set_day();
   $this->set_month();
   $this->set_year();
   $this->check_date();
   if($this->check_ok==false)
   {
     $this->set_default();
   }
 }

 private function set_default()
 {
  echo "Data di default:\n\n";
  $this->day="01";
  $this->month="01";
  $this->year="1900";
 }
 private function set_day()
 {
  echo "Inserire giorno:"."\n\n";
  $this->day=trim(fgets(STDIN));
 }

 private function set_month()
 {
  echo "Inserire mese:"."\n\n";
  $this->month=trim(fgets(STDIN));
 }

 private function set_year()
 {
  echo "Inserire anno:"."\n\n";
  $this->year=trim(fgets(STDIN));
 }

 private function check_date()
 {
   $d=true;
   $m=true;
   $y=true;

   if($this->day>31 or $this->day<1)
   {
     $d=false;
     array_push($this->msg_error,'day');
   }
   if($this->year>2016 or $this->year<1900)
   {
     $y=false;
     array_push($this->msg_error,'year');
   }
   if($this->month>12 or $this->month<1)
   {
     $m=false;
     array_push($this->msg_error,'month');
   }

   if((($this->month==2 && $this->day>29) or (($this->month==4 or $this->month==6 or $this->month==9 or $this->month==11) && $this->day>30)))
   {
     array_push($this->msg_error,'day');
     array_push($this->msg_error,'month');
     $d=false;
     $m=false;
   }

   if($d and $m and $y)
   {
     $this->check_ok=true;
     //echo "data inserita corettamente \n\n";
   }

 }

 public function get_day()
 {
   //echo $this->day;
   return $this->day;
 }

 public function get_month()
 {
   //echo $this->month;
  return $this->month;
 }

 public function get_year()
 {
   //echo $this->year;
   return $this->year;
 }
 public function get_date($format)
 {
   if($format=="gg/mm/aaaa" or $format=="GG/MM/AAAA")
   {
     echo $this->day."/".$this->month."/".$this->year;
   }

 }
 public function get_msg_error()
 {
   return $this->msg_error;

 }
 
}

//$a=new date();

?>
