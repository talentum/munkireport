<?php
class Asus_model extends Model {

 function process($data)
    {
        echo "$data\n";
    }

}
// 
//     function __construct($serial='')
//     {
//         parent::__construct('id', 'asus'); //primary key, tablename
//         $this->rs['id'] = 0;
//         $this->rs['serial_number'] = $serial; $this->rt['serial_number'] = 'VARCHAR(255) UNIQUE';
//         $this->rs['CatalogURL'] = '';
//            
// 
//         // Create table if it does not exist
//         $this->create_table();
// 
//         if ($serial)
//         {
//             $this->retrieve_one('serial_number=?', $serial);
//         }
// 
//         $this->serial = $serial;
// 
//     }


//     function process($data)
//     {
//         require_once(APP_PATH . 'lib/CFPropertyList/CFPropertyList.php');
//         $parser = new CFPropertyList();
//         $parser->parse($data);
// 
//         print_r($parser->toArray());
//         
//         foreach(array('CatalogURL') AS $item)
//         {
//             if (isset($plist[$item]))
//             {
//                 $this->$item = $plist[$item];
//             }
//             else
//             {
//                 $this->$item = '';
//             }
//         }
// 
//         $this->save();
//     }
// }
