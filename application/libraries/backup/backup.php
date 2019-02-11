<?php

class backup {
    
    private $host = "localhost:8889";
    private $db = "compte";
    private $user = "root";
    private $pass = "pilou";   
    private $file = 'alert.sql';
    private $table = 'categorie';
     
    function save(){
        $cmd = '"C:\\Program Files (x86)\\Ampps/mysql\\bin\\mysqldump.exe" -h localhost -u root -ppilou -B compte > C:/Users/TOSHIBA/Downloads/test.sql';
       
        exec($cmd); 
    }
   
}
