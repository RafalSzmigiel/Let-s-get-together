<?php

    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

    if(isset($_POST['name_event']))
    {
        // udana walidacja ? tak !
        $dodanie_ok = true;
        
        $id_user = $_SESSION['id_user'];
        
        
        $name_event = $_POST['name_event'];
            if((strlen($name_event)<3) || (strlen($name_event)>30))
            {
            $dodanie_ok = false;
            $_SESSION['e_name_event'] = "Nazwa wydarzenia musi posiadać od 3 do 30 znaków";
                
            }
            
            
        $place = $_POST['place'];
        $Time = $_POST['Time'];
        $date = $_POST['date'];
        $desc_event = $_POST['desc_event'];
        
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
        
                
        if($dodanie_ok==true)
        {  
            // wszystko okej teraz doddajmy do bazy
            
          if($polaczenie->query("INSERT INTO events VALUES(NULL,'$id_user', '$name_event', '$place', '$date', '$Time', '$desc_event')"))
          {
              $_SESSION['udane_dodanie']=true;
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
    <title>Let's Get Together - dodaj nowe spotkanie</title>
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
         <br/>
          <div class="sk-popular-users">
  						<h3 class="sk-column-header">Profil Użytkownika</h3>
  						<img src="resources/images/avatar.png" alt=""><br/>
  						
           </div>
           <br/>
           
           <?php

                echo "<p>Witaj <b>".$_SESSION['user']." !</b></p>";

                echo "<p><b>Id uzytkownika = </b>".$_SESSION['id_user'];

                echo "<p> Twoj email: ".$_SESSION['email'];


            ?>
            
            <br/>
            <br/>
        
           <a href="modyfikuj.php" style="text-decoration: none">
           <div class="ui label"><i class="edit icon"></i>Modyfikuj profil</div>
           </a>
         
           
       </div>
       
       <div class = "content">
           
           <div class="naglowek2">
               Dodaj spotkanie !
           </div>
           
           <div class="dodaj">
               
               <form method = "post" class="ui form">
                   
                       
                  <div class="required field">
                  <label> Nazwa spotkania: </label>
                  
                    <?php
                 
                   if(isset($_SESSION['e_name_event']))
                      {
                       echo '<br/>';
                       echo '<span class="ui red label">';
                          echo $_SESSION['e_name_event'];
                              unset($_SESSION['e_name_event']);
                       echo '</span>';
                      }
                
                   ?>
                     </div>
                   <input type="text" name="name_event" /><br/><br/>
                   
               
                   Miejsce spotkania: <br/>
                   <input type="text" name="place" /><br/><br/>
                   
                   Godzina spotkania: <br/>
                   <input type="time" name="Time" /><br/><br/>
                   
                   Data spotkania: <br/>
                   <input type="date" name="date" /><br/><br/>
                   
                    Opis spotkania: <br/>
                   <textarea name="desc_event" rows="4" cols="50"  ></textarea><br/><br/>
                   
                   <input type="submit" class="ui primary button" id="dodaj" name="dodaj"  value="Dodaj !" /><br/>
                   
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