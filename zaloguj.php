<?php

session_start();

if( (!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php";
    // tutaj idzie sciezka do pliku z adresem i hasłami do polaczenia z baza danych
    // zyskujemy to ze dany z connect.php pojawia sie tutaj
    // dlaczego nie include ???
    // require wygeneruje blad krytyczny i zablokuje skrypt a include wygeneruje tylko ostrzezenie
    // include albo include once
    // require albo require once 
    // once - apobieganie regudancji
    
    $polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);  
    // podajemy namiary do polaczenie z baza danych tworzymy nowy obiekt polaczenie
// @ blokuje wyrzucanie bledow na wierzchu, nic nie pokaze

if($polaczenie->connect_errno!=0) // spelniony if odpowiada zajsciu wydarzenia
{
    echo "Error : ".$polaczenie->connect_errno ; // obsluga bledów
}
else
{
    $login = $_POST['login'];  // tutaj mamy pobieranie danych z login i haslo przesłanych metoda POST
    $haslo = $_POST['haslo'];
    
    // zapobieganie sql injection 
    // metoda ma zapobiegac wstrzykiwaniu zapytan sql
    
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    
    
     // echo "it works!";
    
    if($rezultat = @$polaczenie->query(sprintf("SELECT * FROM users WHERE login = '%s' ", mysqli_real_escape_string($polaczenie,$login))))
    {
        $ilu_userow = $rezultat->num_rows;
        if($ilu_userow>0) // przypadek kiedy uzytkownikowi uda sie zalogowac
        {
            
            
             $wiersz = $rezultat->fetch_assoc(); // fetch assoc - przynies dane i wloz je do tablicy asocjacyjnej
            
            if(password_verify($haslo,$wiersz['password']))
            {
                // kiedy wiemy ze logowanie sie udalo, tworzymy zmienna ktora ustawimy jako flake ze jestesmy zalogowani;
                // ustawiamy tez flage na id uzytkownika tak zeby w systemie bylo wiadomo jaki uzytkownik jest zalogowany 
                $_SESSION['zalogowany'] = true ;



                $_SESSION['user'] = $wiersz['login'];


                $_SESSION['id_user'] = $wiersz['id_user']; // ustawiamy tak aby wiedziec jaki uzytkownik jest zaloghowanyt
                $_SESSION['email'] = $wiersz['email']; 

                // wkladanie danych do sesji
              

                //echo $user; test

                unset($_SESSION['blad']); // wywala usuwa sesje blad w razie poprawnego zalogowania
                $rezultat->free_result(); // do pozbycia sie z pamieci

                header('Location: main.php');
            }
             else // przypadek kiedy podane zostane nie prawidłowe dany login lub haslo
                {
                    $_SESSION['blad'] = '<span style = "color:red"> Nieprawidłowy login lub hasło </span> ';

                        header('Location: index.php');
                }
            
        }
        else // przypadek kiedy podane zostane nie prawidłowe dany login lub haslo
        {
            $_SESSION['blad'] = '<span style = "color:red"> Nieprawidłowy login lub hasło </span> ';
                
                header('Location: index.php');
        }
    }
        
    $polaczenie->close(); // metoda zamykajaca polaczenie
}



// echo $login."<br/>";
// echo $haslo;
// echo wyswietli nam dane z zmiennych login i haslo



?>