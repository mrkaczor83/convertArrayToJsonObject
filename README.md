# convertArrayToJsonObject
PHP function to convert PHP array to JOSN object that you can inject to Mariadb SQL query

returns string with JSON_ARRAY and JSON_OBJECT that MariaDB cna digest to post parts of json with JSON_PUT etc. functions

usage:


$array = array("1"=>"string", "2" => array(3 , "aaa"=>array(67)), 5 => "XXX");

echo convertToJsonObject($array);

resut:

JSON_OBJECT(1,"string", 2, JSON_OBJECT(0, 3, "aaa",JSON_ARRAY(67)), 5, "XXX")

then you can create mariadb query:

UPDATE test SET `attr` = JSON_SET(`attr`, '$.json.node'".convertToJsonObject($array).") WHERE id = 1;
