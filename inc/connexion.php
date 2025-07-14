<?php 
function dbconnect(){
    static $connect = null ; 
    if ( $connect === null){
        $connect = mysqli_connect('localhost' , 'ETU003960' , 'u78R7nwy' , 'db_s2_ETU003960');
        if (!$connect){
            die('Erreur' . mysqli_connect_error());
        }
        mysqli_set_charset($connect , 'utf8mb4');
    }
    return $connect;
}
?>
