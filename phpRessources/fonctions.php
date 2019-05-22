<?php

class Database
{
    static $instance = null;

    static function init()
    {
        if (self::$instance == null) {
            try {
                self::$instance = new PDO('mysql:host=localhost;dbname=Domolink;charset=utf8', 'root', 'alpine');
            } catch (Exception $e) {
                header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
                echo "<script>alert('Impossible de se connecter à la base de donnée !{$e->getMessage()}');</script>";
                echo "La base de donnée est inaccessible :(, reconnectez vous dans quelques temps.";
                self::$instance = null;
            }
        }
    }

    static function execute($command, $array = null)
    {
        if (gettype($command) != "string" || ($array != null && gettype($array) != "array")) {
            return null;
        } else {
            if (self::$instance == null) {
                Database::init();
                if (self::$instance == null)
                    return null;
            }
            try {
                if ($array == null)
                    $req = self::$instance->query($command);
                else {
                    $req = self::$instance->prepare($command);
                    //$array2 = str_split($command);
                    //$variable = "";
                    //$addChar =false;
                    /*foreach ($array2 as $char) {
                        if ($char == ':'){
                            $addChar = true;
                        } else if ($char == ' ' || $char == ')' || $char == ','){
                            $addChar = false;
                            if (!empty($variable)){
                                $value = $array[$variable];
                                $req->bindParam(':'.$variable,$value,PDO::PARAM_STR);
                                $variable = "";
                            }
                        } else if ($addChar){
                            $variable .= $char;
                        }
                    }
                    if (!empty($variable)){
                        $req->bindParam(':'.$variable,$array[$variable],PDO::PARAM_STR);
                    }*/

                }
                if ($req == null)
                    return null;
                $req->execute($array);
                return $req;
            } catch (Exception $e) {
                return null;
            }
        }
    }
}

function humanDateFormat($date)
{
    date_default_timezone_set('Europe/Paris');
    return date('d-m-Y', strtotime($date));
}

function humanDateFormatHour($date)
{
    date_default_timezone_set('Europe/Paris');
    return date('H:i d-m-Y', strtotime($date));
}

function SQLDateFormat($date)
{
    return date('Y-m-d', strtotime($date));
}
  