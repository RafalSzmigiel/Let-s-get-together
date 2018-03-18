<?php

session_start();

if(!isset($_SESSION['udanarejestracja']))
   {
       header('Location: index.php');
       exit(); // linia opuszczajaca plik tak aby nie czytac calego dokumentu
   }
else
{
    unset($_SESSION['udanarejstracja']);
}

// usuwamy ustawione zmienne wpisane do formularza
if(isset($_SESSION['fr_nick']))
    unset($_SESSION['fr_nick']);

if(isset($_SESSION['fr_email']))
    unset($_SESSION['fr_email']);

if(isset($_SESSION['fr_regulamin']))
    unset($_SESSION['fr_regulamin']);

// usuwanie bledow rejestracji
if(isset($_SESSION['e_nick']))
    unset($_SESSION['e_nick']);
if(isset($_SESSION['e_email']))
    unset($_SESSION['e_email']);
if(isset($_SESSION['e_haslo']))
    unset($_SESSION['e_haslo']);
if(isset($_SESSION['e_regulamin']))
    unset($_SESSION['e_regulamin']);
if(isset($_SESSION['e_bot']))
    unset($_SESSION['e_bot']);

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
       <div class="slogan-bg">
    <div id="container">
          
          <div class="square2">
              
              
              <div class="slogan1">
                  <h3>
                      Dziękujemy za rejestrację w serwisie! <br/>
                       Możesz już zalogować się na swoję konto!
                        
                  </h3>
                  
                  <br/><br/>
                   <a href ="index.php">Zaloguj się na swoje konto!</a>
                   <br/><br/>
                  
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