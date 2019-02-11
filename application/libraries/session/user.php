<?php
class User  {
  
    function __construct() {
        
    }

    
    /*
    * destruction de l'utilisateur
    *
    * @access    public
    * @return    void
    */

    public function logout() {
      $this->session->sess_destroy();
      redirect('');
    }
    
    
    /*
    * creation d'un utlisateur
    *
    * @access    public
    * @return    array
    */
    public function createUser($name){

        $newdata = array(
            'username'  => $name,
            'logged_in' => TRUE
        );
        
       return   $newdata;
    }
 }