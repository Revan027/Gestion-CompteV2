<?php
defined('BASEPATH') OR exit('No direct script access allowed'); header("Content-Type: text/html;charset=utf-8"); 
?><!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Gestion Compte</title>
        <link rel="icon" href=" <?php echo img_url('favicon.ico'); ?>" type="image/x-icon">
        
        <link rel="stylesheet" href="<?PHP  echo css_url('css/font-awesome.min'); ?>"/>
        <link rel="stylesheet" href="<?PHP  echo css_url('css/font-awesome.min'); ?>"/>
        <link rel="stylesheet"  href="<?PHP  echo css_url('feuille'); ?>"/>
        
        <script src="<?PHP  echo js_url('lib/jquery-3.2.1'); ?>" ></script> 
        <script src="<?PHP  echo js_url('lib/Chart'); ?>"></script> 
        <script type="text/javascript" src="<?PHP  echo js_url('main_function'); ?>" > </script>   
        <script type="text/javascript" src="<?PHP  echo js_url('operation_resume_ajax'); ?>" > </script>   
        <script type="text/javascript" src="<?PHP  echo js_url('verification'); ?>"> </script>
        <script type="text/javascript" > 
            var chargement =" <?php echo img_url('chargement.gif'); ?>" ;
            var date = getDate();
            var deroulement = 0 ;
            var base_url =" <?php echo base_url(); ?>";
        </script> 
        <script type="text/javascript" src="<?PHP  echo js_url('view_ajax'); ?>" > </script>  
        <script type="text/javascript" src="<?PHP  echo js_url('operation_compte_ajax'); ?>" > </script>   
        <script type="text/javascript" src="<?PHP  echo js_url('verification'); ?>"> </script>
        <script type="text/javascript" src="<?PHP  echo js_url('slider'); ?>" > </script>  
        <script type="text/javascript" src="<?PHP  echo js_url('operation_mainDepense_ajax'); ?>" > </script>  
        <script type="text/javascript" src="<?PHP  echo js_url('operation_categorie_ajax'); ?>" > </script>  
        <script type="text/javascript"> 
            
            $(document).ready(function() {  // deroulement pour l'affichage des comptes

                $('#titre1').click( function () {
                    
                    if( $('#titre1').hasClass("active")){
                        
                        $('#accordeon').slideUp("normal"); 
                        $('#titre1').removeClass( "active" );
                        
                    }else{
                        
                        $('#accordeon').slideDown("normal");  
                        $('#titre1').addClass( "active" );
                        
                    }
                });   

            }); 
            
            $(document).ready(function() {  //select
                
                $('.dropdown').click(function () {

                    $(this).attr('tabindex', 1).focus();
                    $(this).toggleClass('active');
                    $(this).find('.dropdown-menu').slideToggle(300);

                });
                    
                $('.dropdown').focusout(function () {

                    $(this).removeClass('active');
                    $(this).find('.dropdown-menu').slideUp(300);

                });

                $('.dropdown .dropdown-menu li').click(function () {

                    $(this).parents('.dropdown').find('span').text();
                    $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));   
                    $(this).parents('.dropdown').find('div').empty();   //trouve et vide le input
                    $(this).parents('.dropdown').find('div').append($(this).attr('id'));    //ajoute la valeur
                });

               /* $('.dropdown-menu li').click(function () {

                    var input = '<strong>' + $(this).parents('.dropdown').find('input').val() + '</strong>', msg = '<span class="msg">Hidden input value: ';
                    $('.msg').html(msg + input + '</span>');

                });*/
            });
               
               
           /* $(function(){
             
                $(window).scroll(function () {//Au scroll dans la fenetre on déclenche la fonction
                   
                   if ($(this).scrollTop() > 160) { //si on a défilé de plus de 160px du haut vers le bas
                       
                       $('footer').addClass("fixe"); //on ajoute la classe "fixe" au header
                   } else {
                       
                   $('footer').removeClass("fixe");//sinon on retire la classe "fixe" (c'est pour laisser le header à son endroit de départ lors de la remontée
                   }
                   
                });
            });   */
               
               
            /* $(document).ready(function() {
                    $(document).off('click');
           $(document).on('click',function (event){
        
             
            });*/

               /* $(document).click(function(event) {   
              $(this).unbind("click");
                    if($('#containChart').hasClass("active")){
                        
                         if(!$(event.target).closest('#containChart').length) {
                  
                            alert('sd');
                        } 
                    }
                });   });*/

        </script> 
</head>