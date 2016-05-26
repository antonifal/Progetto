<?php
class connection
{
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $connection="";
  private $result="";
  private $q="SELECT * FROM mesi";
//  public function __construct()
//  {
//    $this->connect();
//    $this->send_query($this->q);
  //  $this->get_resource_multid_array();
//    $this->get_resource_array();
//    $this->disconnect();
//  }
  public function connect()
  {
      $this->connection = mysql_connect($this->host, $this->user, $this->password)or die("Connession non riuscita: " . mysql_error());
  }
  public function disconnect()
  {
    mysql_close($this->connection);
  }
  public function send_query($q,$db)
  {
    mysql_select_db($db);
    $this->result = mysql_query($q) or die("Query non valida: " . mysql_error());
  //  mysql_free_result($this->res);
  }
  public function get_resource_multid_array()
  {
    $i=0;
    while ($riga = mysql_fetch_array($this->result, MYSQL_NUM))
    {
      //echo "\n".$riga[0]." ".$riga[1]."\n";
      $res_array[$i]=$riga;
      $i++;
    }
    return $res_array;
  }
  public function get_resource_array()
  {
    $i=0;
    while ($riga = mysql_fetch_array($this->result, MYSQL_NUM))
    {
      $res_array[$i]=implode(";", $riga);
      $i++;
    }
    return $res_array;
  }
}
//$a=new connection;
?>
