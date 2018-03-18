<?php

    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

 if(isset($_POST['name']))
    {
        // udana walidacja ? tak !
        $profil_ok = true;
        
        $id_user = $_SESSION['id_user'];
        
        
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $birth_date = $_POST['birth_date'];
        $nickname = $_POST['nickname'];
        $locality = $_POST['locality'];
        $street = $_POST['street'];
        $postcode = $_POST['postcode'];
        
        require_once "connect.php";
        
        mysqli_report(MYSQLI_REPORT_STRICT);
        
        try
        {
            $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
            
            if($polaczenie->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                /*
                // czy nazwa wydarzenie jest juz zarezerwowana
                $rezultat = $polaczenie->query("SELECT id_user FROM events WHERE name_event ='$name_event' ");
                
                if(!$rezultat) throw new Exception($polaczenie->error);
                
                $ile_takich_spotkan = $rezultat->num_rows;
                
                if($ile_takich_spotkan>0)
                {
                    $dodanie_ok=false;
                    $_SESSION['e_name_event'] = "istnieje juz taka nazwa spotkania przypisana do twojego profilu";
                }
                
                // -----------------
    
                */
        if($profil_ok==true)
        {  
            // wszystko okej teraz doddajmy do bazy
            
          if($polaczenie->query("INSERT INTO personal_data VALUES('$id_user', '$name', '$surname', '$birth_date', '$nickname', '$locality','$street','$postcode')"))
          {
              //$_SESSION['udane_dodanie']=true;
              header('Location: main.php');
          }
            else
            {
                throw new Exception($polaczenie->error);
            }
            
            
            
        }
                
                $polaczenie->close();
            }
            
            
        }
        catch(Exception $e)
        {
            echo '<span style="color:red;">bład serwera</span>';
                
                echo '<br/>Informacja deweloperska'.$e;
                
        }
        
        

            
        
    }


?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Let's Get Together</title>
    <link rel="stylesheet" href="style3_v7.css" type="text/css">
    <link rel="stylesheet" href="resources/semantic.min.css">
	<link rel="stylesheet" href="resources/custom7.css">
    <script src="resources/jquery.min.js"></script>
	<script src="resources/semantic.min.js"></script>
</head>
<body>
    
       <header class="header">
     
     <h1>
        <a href="index.php">Let's Get Together</a>
     </h1>
     
     <nav>
         <ul>
             <li><a href="dodaj.php">Dodaj wydarzenie</a>
             </li>

             <li>
                <a href="email.php">Wyślij zaproszenie</a>
             </li>
             
             <li><a href="logout.php">Wyloguj się!</a>
             </li>
             
         </ul>
     </nav>
     
     </header>
   <div class="slogan-bg">
   <div id="container">
       
       <div class ="profile">
          <div class="sk-popular-users">
  						<h3 class="sk-column-header">Profil Użytkownika</h3>
  						 <img src="resources/images/avatar.png" alt="">
           
           
           <?php

                echo "<p>Witaj ".$_SESSION['user']."!</p>";

                echo "<p><b>Id uzytkownika = </b>".$_SESSION['id_user'];

                echo "<p> Twoj email to : ".$_SESSION['email'];


            ?>
            
            
            <br/>
            <br/>
            
          <a href="modyfikuj.php" style="text-decoration: none">
           <div class="ui label"><i class="edit icon"></i>Modyfikuj profil</div>
           </a>

       </div>
       </div>
       
       <div class = "content">
           
           <div class="naglowek2">
               Profil Użytkownika ! 
           </div>
           
           <div class="dodaj">
               
               <form method = "post" class="ui form">
                   
                       
                  
                  <label>Imię: </label>
                   <input type="text" name="name" /><br/><br/>
                   
                 <label>Nazwisko: </label>
                   <input type="text" name="surname" /><br/><br/>
                   
                   <label>Data urodzenia: </label>
                   <input type="date" name="birth_date" /><br/><br/>
                   
                 <label>Ksywka: </label>
                   <input type="text" name="nickname" /><br/><br/>
                   
                  <label>Miasto: </label>
                   <input type="text" name="locality" /><br/><br/>
                   
                    <label>Ulica: </label>
                   <input type="text" name="street" /><br/><br/>
                   
                    <label>Kod pocztowy: </label>
                   <input type="text" name="postcode" /><br/><br/>
                   
                   <input type="submit" class="ui primary button" id="dodaj" name="dodaj"  value="Aktualizauj profil" /><br/>
                   
               </form>
               
               
               
               
               
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