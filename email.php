<?php

    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

$e_mail = '';
$adresat = '';

$nazwa_spotkania = '';
$email_nadawcy = $_SESSION['email'];

 // print_r($_POST); - komunikat

$errorEmail = '';
$errorAdresat = '';

$errorNazwa = '';
$zaproszenie_ok='';

$id_user = $_SESSION['id_user'];

if(isset($_POST['send']))
{
    $e_mail = $_POST['e_mail'];
    $adresat = $_POST['adresat'];
    $nazwa_spotkania = $_POST['nazwa_spotkania'];
    
    if( ! $e_mail)
    {
        $errorEmail = 'Uzupelnij adres email';
    }
    if( ! $adresat)
    {
        $errorAdresat = 'Nie podales adresata';
    }
    
    if( ! $nazwa_spotkania)
    {
        $errorNazwa = 'Nie podales nazwy spotkania';
    }
    
    $tresc2 = '';
    

//----------------------------------------------------------------
           
          
                
                require_once 'login.php';
                $conn = new mysqli($hn, $un, $pw, $db);
                if($conn->connect_error)
                {
                    die($conn->connect_error);
                }
            
                
                $query = "SELECT * FROM events WHERE name_event = '$nazwa_spotkania' ";
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
                   
                   
        
                   
                   $tresc2 = 'Zaproszenie ! 
                   
                   Czesc '.$adresat.' zapraszam Cie na spotkanie "'.$row['name_event'].'"
                   Miejsce naszego spotkania to '.$row['place'].'
                   Godzina: '.$row['Time'].'
                   Data: '.$row['date'].'
                   Dodatkowy Opis spotkania: '.$row['desc_event'].'
                   
                   Pamietaj nie moze Cie zabraknac.';
                   
                    
                    
                }
                
        
             //   echo $tresc2;
    
                $result->close();
                $conn->close();


//------------------------------------------------------------------------------

    
    // wysyłamy email
    
    if(! $errorEmail && ! $errorAdresat  )
    {
     $to = 'admin@localhost';
 
       
        $emailSent = mail($e_mail, $nazwa_spotkania, $tresc2, "From: $email_nadawcy ");
        
        $zaproszenie_ok = 'Zaproszenie zostało wysłane';
        
    }
        
}

if(isset($_POST['e_mail']))
{

    $wyslanie_ok = true;
    
    $e_mail = $_POST['e_mail'];
    $adresat = $_POST['adresat'];
    $nazwa_spotkania = $_POST['nazwa_spotkania'];
    
    $id_spotkania = '';
        
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
                          
       include('db_connect.php');

$dbserver = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'users';


$mysqli = new mysqli($dbserver,$dbuser,$dbpassword,$dbname);

$mysqli->set_charset('utf8');
if(mysqli_connect_errno() )
{
    echo 'błąd bazy danych';
}


$mysqli = new mysqli('localhost', 'root', '' ,'users');

   
$query = $mysqli->query("SELECT id_event FROM events WHERE name_event = '$nazwa_spotkania' ");

$row = $query->fetch_assoc();
            $id_event =  $row['id_event'];
          
        if($wyslanie_ok==true)
        {  
            // wszystko okej teraz doddajmy do bazy
            
          if($polaczenie->query("INSERT INTO participants VALUES(NULL,'$id_event','$id_user', '$nazwa_spotkania','$adresat', '$e_mail')"))
          {
              
          
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
            //echo '<span style="color:red;">bład serwera</span>';
                
             //   echo '<br/>Informacja deweloperska'.$e;
                
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
               Wyślij zaproszenie
           </div>
           
           <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="ui form">
              
               <div class="required field">
                  
                  
                  <br/><br/><label>Podaj adres e-mail : </label>
                  <?php if($errorEmail != null){ ?>
                  <span class="ui red label">
                      <?php echo $errorEmail; ?>
                  </span>
                  <?php } ?>
                   <input type="text" name="e_mail" id="e_mail" /><br/><br/>
                    
               </div>
               
               <div class="required field">
                   <label>Podaj imię adresata : </label>
                   <?php if($errorAdresat != null){ ?>
                  <span class="ui red label">
                      <?php echo $errorAdresat; ?>
                  </span>
                  <?php } ?>
                   <input type="text" name="adresat" id="adresat" /><br/><br/>
                    
               </div>
               
               
               
                <div class="required field">
                   <label>Wybierz spotkanie : </label>
                   <?php if($errorNazwa != null){ ?>
                  <span class="ui red label">
                      <?php echo $errorNazwa; ?>
                  </span>
                  <?php } ?>
               
               <?php
           
                
                
                require_once 'login.php';
                $conn = new mysqli($hn, $un, $pw, $db);
                if($conn->connect_error)
                {
                    die($conn->connect_error);
                }
                
           
                $user=$_SESSION['id_user'];
                
                
           echo "<select name='nazwa_spotkania' type='text' id='nazwa_spotkania'>\n";
          
                
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
                    
                 
                    
                    echo "<option value=".$row['name_event'].">".$row['name_event']."</option>\n";
                    
                }
           echo "</select>\n";
               
                $result->close();
                $conn->close();
           ?>
               </div>
               
               
             
               
               
               <input type="submit" class="ui primary button" id="send" name="send" value="Wyślij" /><br/>
               
               <?php if(($zaproszenie_ok != null)&&($errorEmail !=null) && ($errorAdresat !=null) &&($errorNazwa !=null)){ ?>
                  <span class="ui red label">
                      <?php echo $zaproszenie_ok; ?>
                  </span>
                  <?php } ?>
               
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