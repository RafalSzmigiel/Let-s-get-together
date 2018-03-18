<?php

session_start();

if(isset($_SESSION['zalogowany'])&&($_SESSION['zalogowany'] == true))
   {
       header('Location: main.php');
       exit(); // linia opuszczajaca plik tak aby nie czytac calego dokumentu
   }

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
   
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Let's Get Together</title>
    <link rel="stylesheet" href="style_v2.css" type="text/css">
    
    
</head>
<body>
    
     <header class="header">
     
     <h1>
        <a href="index.php">Let's Get Together</a>
     </h1>
     
     <nav>
         <ul>
             <li><a href="index.php">Strona główna</a>
             </li>
             <li><a href="o_aplikacji.php">O aplikacji</a></li>
             <li>
                <a href="o_autorze.php">O autorze</a>
             </li>
         </ul>
     </nav>
     
     </header>
     
      <div class="slogan-bg">
    <div id="container">
          
          <div class="square">
              
              
              <div class="slogan">
                  <h1>Let's Get Together</h1>
                  <h2>Spotkajmy się razem !</h2>
                  
              </div>
              
              
          </div>
       
    
          <div class="square">
           <div class="box_up">
           
            <form action="zaloguj.php" method="post">

            <input type = "text" name = "login" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" /> 

            <input type = "password" name = "haslo" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'"/>

            <input type = "submit" value="Zaloguj się" />
           
            
             <?php
    
            if(isset($_SESSION['blad'])) // sprawdzanie czy istnieje juz ustawiona sesja blad dla niepoprawnego logowania
            {
                echo $_SESSION['blad'];
            }
            ?>

            </form>
            
            </div>
           
            <div class="box_down">
           <br/><br>
           
           
          <a href="rejestracja.php" style="text-decoration: none"><input type="submit" value="Zarejestruj się!"/></a>
          
            
            </div>
            
        </div>
            
    </div>
    
   </div>
        <footer>
            <div class="contener_floatfix">
                <div class="footer">
                    <span>Let's Get Together 2017 &copy; All rights reserved</span>
                </div>
            </div>
        </footer>
        
</body>
</html>