<?php
class munkiextra_model extends Model {

	function __construct($serial='')
	{
		parent::__construct('id', 'munkireport'); //primary key, tablename
		$this->rs['id'] = '';
		$this->rs['serial_number'] = $serial; $this->rt['serial_number'] = 'VARCHAR(255) UNIQUE';
		$this->rs['catalogs'] = '';
		$this->rs['included_manifests'] = '';
		$this->rs['sus_server'] = '';

		// Schema version, increment when creating a db migration
		$this->schema_version = 2;
		
		// Create table if it does not exist
		$this->create_table();
		
		if ($serial)
			$this->retrieve_one('serial_number=?', $serial);
		
		$this->serial = $serial;
		  
	}
	
	// ------------------------------------------------------------------------

	/**
	 * Process data sent by postflight
	 *
	 * @param string data
	 * 
	 **/
	function process($data)
	{		
		// Translate network strings to db fields
        $translate = array(
        	'Catalogs = ' => 'catalogs',
        	'Included Manifests = ' => 'included_manifests',
        	'SUS-server = ' => 'sus_server');

//clear any previous data we had
		foreach($translate as $search => $field) {
			$this->$field = '';
		}
		// Parse data
		foreach(explode("\n", $data) as $line) {
		    // Translate standard entries
			foreach($translate as $search => $field) {
			    
			    if(strpos($line, $search) === 0) {
				    
				    $value = substr($line, strlen($search));
				    
				    $this->$field = $value;
				    break;
			    }
			} 
		    
		} //end foreach explode lines
		$this->save();
	}
}