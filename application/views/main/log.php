 <html>
   <head>
       <title>Identify page Gestion Compte </title>
        <link rel="stylesheet"  href="<?PHP  echo css_url('feuille'); ?>"/> 
        <link rel="icon" href=" <?php echo img_url('favicon.ico'); ?>" type="image/x-icon">
    </head>
    
    <body>
        <div id="top">
            <img class="titre" src="<?PHP  echo img_url('titre.png'); ?>" />
        </div>	
        
        <form action='<?php echo site_url('authentify/connection/controll'); ?>' method="post" autocomplete="off">
        
        <div id="containGrillAlone"> 
                        

            <div id="grill1">
                <div id="step"><b>Identification</b></div>
                <div id="champ">
                    Votre login <input type="text" name="login" />
                    <br /><br />
                    Votre mot de passe <input type="password" name="mdp"/><br /><br />
                    <input type="submit" class="bouton" value="Connexion">
                </div>
            </div>  

       </div>     

   
    </body>
</html>
 