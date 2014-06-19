<?

// TODO: require Filestore class
require('classes/filestore.php');

class AddressDataStore extends Filestore
{

	function __construct($filename = '')
	{
		parent:: __construct($filename);
		$this->filename = strtolower($filename);
	}

    function read_address_book()
    {
        // TODO: refactor to use new $this->read_csv() method
    }

    function write_address_book($addresses_array)
    {
        // TODO: refactor to use new write_csv() method
    }

}
?>
