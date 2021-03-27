<?php
class ConcatArray
{
	private $first_array;
	private $second_array;
	private $result_array;

	public function __construct(){
		$this->first_array = $this->set_random_item_to_array();
		$this->second_array = $this->set_random_item_to_array();
		$this->result_array = $this->concat_array();
	}

	public function __toString()
	{
		$result = '';
		foreach ($this as $key => $value) {
			$result .= 'Массив '.$key.'<b>'.implode(', ', $value).'</b><br>';
		}
		return $result;
	}

	private function concat_array(){
		$result_array = [];
		array_map(function($a, $b) use(&$result_array) { array_push($result_array, $a, $b);}, $this->first_array, $this->second_array);
		return $result_array;
	}

	private function set_random_item_to_array(int $length = 20){
		return str_split(substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length));
	}
}
?>
<pre>
class ConcatArray
{
  private $first_array;
  private $second_array;
  private $result_array;

  public function __construct(){
    $this->first_array = $this->set_random_item_to_array();
    $this->second_array = $this->set_random_item_to_array();
    $this->result_array = $this->concat_array();
  }

  public function __toString()
  {
    $result = '';
    foreach ($this as $key => $value) {
      $result .= 'Массив '.$key.' - '.implode(', ', $value);
    }
    return $result;
  }

  private function concat_array(){
    $result_array = [];
    array_map(function($a, $b) use(&$result_array) { array_push($result_array, $a, $b);}, $this->first_array, $this->second_array);
    return $result_array;
  }

  private function set_random_item_to_array($length = 20){
    return str_split(substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length));
  }
}
</pre>
