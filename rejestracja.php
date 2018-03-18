<?php

    session_start();

if(isset($_POST['email']))
{
    
    //udana walidacja? zalozmy ze tak
    $wszystko_ok = true; // ustawiamy flage
    
    // sprawdz poprawnosc nickname
    $nick = $_POST['nick'];
    // nasz nick musi miec od 3 do 20 znakow
    // pobieranie długosci łańcucha
    // strlen($napis);
    // str = string (łańcuch,napis)
    // len = length (długosć)
    
    if((strlen($nick)<3) || (strlen($nick)>20))
    {
        $wszystko_ok = false; // zmieniamy stan flagi na blad
        
        $_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków";
    }
    
    
    if(ctype_alnum($nick)==false)
    {
        $wszystko_ok = false;
        $_SESSION['e_nick'] = " Nick moze skladac sie tylko z liter i cyfr (bez polskich znakow)";
    }
    
    // sprawdzenie poprawnosci email
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if((filter_var($emailB, FILTER_VALIDATE_EMAIL) == false) || ($emailB!=$email))
    {
    $wszystko_ok = false;
    $_SESSION['e_email'] = "podaj poprawny adres e-mail!";
    }
    
    
    // sprawdz poprawnosc hasla
    
    $haslo1 = $_POST['haslo1'];
    $haslo2 = $_POST['haslo2'];
    
    if((strlen($haslo1)<8)||(strlen($haslo1)>20))
    {
        $wszystko_ok = false ;
        $_SESSION['e_haslo'] = "haslo musis posiadac od 8 do 20 znakow";
    }
    
    if($haslo1 != $haslo2)
    {
        $wszystko_ok = false ;
        $_SESSION['e_haslo'] = "podane hasla nie sa identyczne";
    }
    
    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
   // echo $haslo_hash;
   // exit();
    
    // czy zaakceptowano regulamin
    if(!isset($_POST['regulamin']))
    {
        $wszystko_ok = false;
        $_SESSION['e_regulamin'] = "Regulamin nie został zaakceptowany";
    }
    
    
    //czy jestes botem ?
    $sekret = "6Lc4ADcUAAAAADkpq2I4hZUjoSMXB_-kU8kfmDCq";
    
    $sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
    
    $odpowiedz = json_decode($sprawdz);
    
    if($odpowiedz->success == false)
    {
        $wszystko_ok = false ;
        $_SESSION['e_bot'] = "Potwierdz, ze nie jestes botem!";
    }
    
    //zapamietywanie wprowadzanych danych podczas rejestracji
    $_SESSION['fr_nick'] = $nick;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_haslo1'] = $haslo1;
    $_SESSION['fr_haslo2'] = $haslo2;
    //zapamietanie akcepacji regulaminu
    if(isset($_POST['regulamin']))
        $_SESSION['fr_regulamin'] = true;
    
    //przeszukiwanie bazy danych pod katem czy nie ma takich juz uzytkownikow
    require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id_user FROM users WHERE email='$email'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_maili = $rezultat->num_rows;
				if($ile_takich_maili>0)
				{
					$wszystko_ok=false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
				}		

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id_user FROM users WHERE login='$nick'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_ok=false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny.";
				}
				
				if ($wszystko_ok==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
                    // zapytanie wkladajace dane do bazy 
					if ($polaczenie->query("INSERT INTO users VALUES (NULL, '$nick', '$haslo_hash', '$email' )"))
					{
						$_SESSION['udanarejestracja']=true;
						header('Location: witamy.php');
					}
					else
					{
                        // rzucamy wyjatek w razie nie dodania uzytkownika do bazy
						throw new Exception($polaczenie->error);
					}
					
				}
				
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
    
   


?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Let's Get Together - załóż darmowe konto</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="style_v2.css" type="text/css">
    
    <style>
        
        .error
            {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
            }
    
    </style>
    
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
             <li><a href="#">O aplikacji</a></li>
             <li>
                <a href="#">O autorze</a>
             </li>
         </ul>
     </nav>
     
     </header>
     <div class ="slogan-bg">
     <div id="container">
     <div class="register_form">
     
     <form method="post" >
       
        

        
     <br/> <input type = "text" value = "<?php
    
        if(isset($_SESSION['fr_nick']))
            {
                echo $_SESSION['fr_nick'];
                unset($_SESSION['fr_nick']);
            }
        
        ?>"
         
         name = "nick" placeholder="Podaj login" onfocus="this.placeholder=''" onblur="this.placeholder='Podaj login'"/> <br/>
          
        <?php
         
         if(isset($_SESSION['e_nick']))
         {
             echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
             unset($_SESSION['e_nick']);
         }
         ?>
          
           
       <br/> <input type = "text"  value = "<?php
    
            //pamietanie email
        if(isset($_SESSION['fr_email']))
            {
                echo  $_SESSION['fr_email'];
                unset($_SESSION['fr_email']);
            }
        
        ?>"
        name = "email" placeholder="Podaj E-mail" onfocus="this.placeholder=''" onblur="this.placeholder='Podaj E-mail'"/> <br/>
        
        <?php
         
         if(isset($_SESSION['e_email']))
         {
             echo '<div class="error">'.$_SESSION['e_email'].'</div>';
             unset($_SESSION['e_email']);
         }
         ?>
        
        <br/> <input type = "password" name = "haslo1" placeholder="Podaj hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Podaj hasło'" /> <br/>
        
        <?php
         
         if(isset($_SESSION['e_haslo']))
         {
             echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
             unset($_SESSION['e_haslo']);
         }
         ?>
         
        <br/> <input type = "password" name = "haslo2" placeholder="Powtórz hasło" onfocus="this.placeholder=''" onblur="this.placeholder='Powtórz hasło'" /> <br/><br/>
        
        <label>
        <input type = "checkbox" name = "regulamin" <?php
               if(isset($_SESSION['fr_regulamin']))
               {
                   echo "checked";
                   unset($_SESSION['fr_regulamin']);
               }
               ?>
        
               /> Akceptuję <a href="regulamin.php" target="_blank" ><font color="black;">regulamin </font></a>
        </label> 
        
        <?php
         
         if(isset($_SESSION['e_regulamin']))
         {
             echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
             unset($_SESSION['e_regulamin']);
         }
         ?>
        
        <br />
        
        <br /><div class="g-recaptcha"  data-sitekey="6Lc4ADcUAAAAABQI0bNrbNgy19YQ8Y3rAUTrl-fp"></div>
        
        <?php
         
         if(isset($_SESSION['e_bot']))
         {
             echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
             unset($_SESSION['e_bot']);
         }
         ?>
        <br />
        
        <input type="submit" value="Zarejestruj się !" />
        
        
     </form>
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