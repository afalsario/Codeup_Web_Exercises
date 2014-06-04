<?
class AddressDataStore
{
    public $filename = '';

    public function __construct($filename = '')
    {
    	$this->filename = $filename;
    }

    public function read_address_book()
    {
        $handle = fopen($this->filename, 'r');
		$array = [];
		while(!feof($handle))
		{
			$row = fgetcsv($handle);
			if(is_array($row))
			{
				$array[] = $row;
			}
		}
		fclose($handle);
		return $array;
    }

    public function write_address_book($addresses_array)
    {
        if(is_writeable($this->filename))
		{
			$handle = fopen($this->filename, 'w');
			foreach ($addresses_array as $fields)
			{
				fputcsv($handle, $fields);
			}
			fclose($handle);
		}
    }
}
?>
