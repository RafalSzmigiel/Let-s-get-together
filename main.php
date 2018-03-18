<?php

    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
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
    <br/>
       <div class="sk-popular-users">
  						<h3 class="sk-column-header">Profil Użytkownika</h3>
           <img src="resources/images/avatar.png" alt=""><br/>
        
         
          <?php
                 
           
                echo "<br/><p>Witaj <b>".$_SESSION['user']." !</b></p>";

                echo "<p><b>Id uzytkownika = </b>".$_SESSION['id_user'];

                echo "<p> Twoj email: ".$_SESSION['email'];

                
            ?>
            
           
            <br/>
            <br/>
           <a href="modyfikuj.php" style="text-decoration: none">
           <div class="ui label"><i class="edit icon"></i>Modyfikuj profil</div>
           </a>
           
       </div>
       </div>
       <div class = "content">
        <div class="wyswietlanie">
            
           <div class="title1">
               Twoja tablica spotkań ! 
           </div>
           
            <?php
           
                
                
                require_once 'login.php';
                $conn = new mysqli($hn, $un, $pw, $db);
                if($conn->connect_error)
                {
                    die($conn->connect_error);
                }
                
           
                $user=$_SESSION['id_user'];
                  
                
           
          
                
                $query = "SELECT * FROM events WHERE id_user='$user' ";
                $result = $conn->query($query);
                if(!$result)
                {
                    die($conn->error);
                }
                    
                $rows = $result->num_rows;
                echo '<br/>';
                for($j=0 ; $j< $rows ; ++$j)
                {
                    $result->data_seek($j);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                 
                    echo "<article class='single-article$j'>";
                    echo '<br/>';
                    echo '<h3>'.$row['name_event'].'</h3><br><br/>';
                    echo 'Miejsce spotkania : '.$row['place'].'<br>';
                    echo 'Godzina : '.$row['Time'].'<br>';
                    echo 'Data : '.$row['date'].'<br><br/>';
                    echo 'Opis spotkania : '.$row['desc_event'].'<br><br/>';
                    echo '<a href="usun.php?id_event='.$row['id_event'].'">
                            <div class="ui label"><i class="remove icon"></i>Usun spotkanie</div>
                            </a><br/>';
                    echo '<a href="edytuj.php?ideventx='.$row['id_event'].'">
                            <div class="ui label"><i class="edit icon"></i>Edytuj spotkanie</div>
                            </a><br/>';
                   echo '</article>';
                
                    
                    
                }
           
                $result->close();
                $conn->close();
           ?>
           
          
           </div>
           
           <div class="wyslij_zaproszenie">
               
               <div class="title1">
              Lista zaproszonych osób
           </div>
              
              
               <?php
           
                
                
                require_once 'login.php';
                $conn = new mysqli($hn, $un, $pw, $db);
                if($conn->connect_error)
                {
                    die($conn->connect_error);
                }
                
           
                $user=$_SESSION['id_user'];
                  
                
           
          
                
                $query = "SELECT * FROM participants WHERE id_user='$user' ";
                $result = $conn->query($query);
                if(!$result)
                {
                    die($conn->error);
                }
                    
                $rows = $result->num_rows;
                echo '<br/>';
                for($j=0 ; $j< $rows ; ++$j)
                {
                    $result->data_seek($j);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                 
                    echo "<article class='single-article$j'>";
                 
                    echo '<br/>';
                    echo '<h3>'.$row['name_event'].'</h3><br>';
                    echo $row['name'].'<br>';
                   echo '</article>';
                
                    
                    
                }
           
                $result->close();
                $conn->close();
           ?>
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