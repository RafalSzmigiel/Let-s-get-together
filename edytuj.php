<?php

    session_start();

    if(!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }

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



 $id = $_GET['ideventx'];
   

$id_user = $_SESSION['id_user'];



$mysqli = new mysqli('localhost', 'root', '' ,'users');

   
$query = $mysqli->query("SELECT * FROM events WHERE id_event='$id' LIMIT 0,1");

$row = $query->fetch_assoc();

if(isset($_POST['update']))
{
    $id = $_POST['id_event'];
   $id_user = $_POST['id_user'];
    

    $name_event = $_POST['name_event'];
    $place = $_POST['place'];
    $date = $_POST['date'];
    $Time = $_POST['Time'];
    $desc_event = $_POST['desc_event'];
    
    $result = $mysqli->query("UPDATE events SET id_user='$id_user', name_event='$name_event', place='$place', date='$date', Time='$Time', desc_event='$desc_event' WHERE id_event='$id' ");
    
    header("location: main.php");
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
  						 <img src="resources/images/avatar.png" alt="">
          
           
           
           <?php

                echo "<p><br/>Witaj ".$_SESSION['user']."!</p>";

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
               Edytuj spotkanie 
           </div>
           
           <div class="dodaj">
               
               <form action = "edytuj.php" method="post" class="ui form">
                   <br/><label>Id użytkownika : </label><br/>
                <input type="text" name="id_user" value="<?php echo $row['id_user'] ?>" readonly/><br/><br/>  
                
                <label>Id spotkania : </label><br/>
                 <input type="text" name="id_event" value="<?php echo $row['id_event'] ?>" readonly/><br/><br/>      
                   
                   <label>Nazwa spotkania : </label><br/>
                   <input type="text" name="name_event" value="<?php echo $row['name_event'] ?>"/><br/><br/>
                   
                   
                 <label>Miejsce spotkania : </label><br/>
                   <input type="text" name="place" value="<?php echo $row['place'] ?>" /><br/><br/>
                   
                   <label>Godzina spotkania : </label><br/>
                   <input type="time" name="Time" value="<?php echo $row['Time'] ?>" /><br/><br/>
                   
                   <label>Data spotkania : </label><br/>
                   <input type="date" name="date" value="<?php echo $row['date'] ?>" /><br/><br/>
                   
                <label>Opis spotkania : </label><br/>
                   <input type="text" name="desc_event" value="<?php echo $row['desc_event'] ?>" style="width: 400px; height: 100px" /><br/><br/>
                   
                   <input type="submit" name="update" class="ui primary button" value="Aktualizuj spotkanie" /><br/>
                   
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