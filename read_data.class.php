<?php
class read_data
{
  private $resource;

  public function __construct($path)
  {
    $this->read($path);
  }

  private function read($path)
  {
    $this->resource=file($path);
  }
  public function get_resource()
  {
    return $this->resource;
  }

}

//$a=new read_data;


?>
