<?php
class connection
{
  private $host = "localhost";
  private $user = "root";
  private $password = "";
  private $connection="";

  public function __construct()
  {
    $this->connect();
    $this->send_query();
    $this->disconnect();
  }

  public function connect()
  {
      $this->connection = mysql_connect($this->host, $this->user, $this->password)or die("Connession non riuscita: " . mysql_error());
  }

  public function disconnect()
  {
    mysql_close($this->connection);
  }

  public function send_query()
  {
    mysql_select_db("codicefiscale");
    $res = mysql_query("SELECT * FROM mesi ") or die("Query non valida: " . mysql_error());

    while ($riga = mysql_fetch_array($res, MYSQL_NUM))
    {
      echo "\n".$riga[0]." ".$riga[1]."\n";
    }

    mysql_free_result($res);
  }


}

new connection;
?>
