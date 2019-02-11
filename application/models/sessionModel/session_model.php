<?php
class Session_model extends CI_Model{
    
    protected $table = 'log';
    
     
    /*
    * recuperation des comptes utilidateurs
    * 
    * @return array
    */
    function userLog($login){
        
        return $this->db->select('id,login,mdp')
                    ->from($this->table)
                    ->where('login', $login)
                    ->get()
                    ->result();
    }
    
     /*
    * verify le mot de passe
    * 
    * @return boolean
    */
    function verifyMdp($log,$mdp){
        
        foreach($log as $newlog) 
        {   
            if(password_verify($mdp, $newlog->mdp) == 1)
            {
                return true;
            }else
            { 
                return false;
            } 
        }  
    }
      
}
