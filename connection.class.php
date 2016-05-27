<?php
class connection
{
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $connection="";
  private $result="";


  public function connect()
  {
      $this->connection = mysql_connect($this->host, $this->user, $this->password)or die("Connession non riuscita: " . mysql_error());
  }

  public function disconnect()
  {
    mysql_free_result($this->result);
    mysql_close($this->connection);
  }

  public function send_query($q,$db)
  {
    mysql_select_db($db);
    $this->result = mysql_query($q) or die("Query non valida: " . mysql_error());
  }

  public function get_resource_assoc_array()
  {

    while ($riga = mysql_fetch_array($this->result))
    {
      $res_array[$riga[1]]=$riga[0];
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
