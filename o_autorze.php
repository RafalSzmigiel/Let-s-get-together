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
          
          <div class="square2">
              
              
              <div class="slogan1">
                  <h3>
                        Student: Rafał Szmigiel<br/>
                        nr indeksu: 014210265
                  </h3>
                  
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