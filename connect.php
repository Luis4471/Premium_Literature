<?php
class MyDB extends SQLite3 {
function __construct() {
$this->open('premium_literature.db');
}
}
$db = new MyDB();

if(!$db) {
echo "erro de ligação";
echo $db->lastErrorMsg();
}
?>