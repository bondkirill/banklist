<?php

include 'config.php';

// get string all data
if(isset($_POST["klient"])){
    $klient = $_POST["klient"];
                            echo "<table id='personlist' border='1' >";
                            echo "<th>EXIST</th>";
                           echo "<th>UPLOADED</th>";
//count how much array getting
    if(strpos($klient, ':') == true){
        $regexp = '/[:]/';
        $part = preg_split($regexp, $klient, 0, PREG_SPLIT_NO_EMPTY);
        $cnt = count($part)-1;
    //    var_dump($cnt);
   //separated string at ;
        if($cnt == 0){
            if(strpos($klient, ';') == true) {
                $regexp = '/[;]/';
                $part = preg_split($regexp, $klient, 0, PREG_SPLIT_NO_EMPTY);
                $date = $part[0];
                $fullname = $part[1];
                $k_price = $part[2];
                $account = $part[3];
                $goal = $part[4];

                //convert date correct format
                $timestamp = strtotime($date);
                $new_date = date('Y-m-d', $timestamp);
                $today_date = date('Y-m-d');
                // convert price
                if(strpos($k_price, ',') == true) {
                    $regexp = '/[,]/';
                    $part_price = preg_split($regexp, $k_price, 0, PREG_SPLIT_NO_EMPTY);
                    $price = $part_price[0].".".$part_price[1];
                    // check price, is not negative
                    if($price < 0){
                      //  echo "<a style='color: red;'>This transaction is negative! $date $fullname $k_price $account</a>";
                            echo "<tr><td align='center' width='550px' >";
                            echo "NOT EXIST This transaction is negative! ".$k_price;
                            echo "</td><td align='center' width='550px' >";
                            echo $date." | ".$fullname." | ".$price." | ".$account;
                            echo "</td></tr>";
                    }else{
                            echo "<tr><td align='center' width='550px'>";
                            echo $date." | ".$fullname." | ".$price." | ".$account;
                            echo "</td><td align='center' width='550px'>";
                            echo $date." | ".$fullname." | ".$price." | ".$account;
                            echo "</td></tr>";
                        // if not exist insert to mysql 
            $query = "SELECT * FROM acc_date WHERE fullnames = '$fullname' AND accounts = '$account' AND dates = '$new_date' ";
            $res = mysqli_query($connection, $query);
             if(mysqli_num_rows($res) == 0){ 
                        $query = 'INSERT IGNORE INTO acc_date (dates, add_dates, prices, accounts, fullnames, goals)
                        VALUES ("'.addslashes($new_date).'",
                        "'.addslashes($today_date).'",
                        "'.addslashes($price).'",
                        "'.addslashes($account).'",
                        "'.addslashes($fullname).'",
                        "'.addslashes($goal).'")';
                        mysqli_query($connection,$query) or die(mysqli_error($connection));
                     
                    }

                    }
                }

            }
        }else{

            //if checkebox checked more 1
            if(strpos($klient, ':') == true) {
                $regexp = '/[:]+[,]/';
                $parts = preg_split($regexp, $klient, 0, PREG_SPLIT_NO_EMPTY);
                $i = 0;
                while ($i < count($parts)) {
                    $a = $parts[$i];
                    $i++;
                    //find person data
                    if(strpos($a, ';') == true) {
                        $regexp = '/[;]/';
                        $partsi = preg_split($regexp, $a, 0, PREG_SPLIT_NO_EMPTY);
                        $date = $partsi[0];
                        $fullname = $partsi[1];
                        $k_price = $partsi[2];
                        $account = $partsi[3];
                        $goal = $partsi[4];
                        $count = count($partsi);
                        }


                        //convert date correct format
                        $timestamp = strtotime($date);
                        $new_date = date('Y-m-d', $timestamp);
                        $today_date = date('Y-m-d');
                    if(strpos($k_price, ',') == true) {
                        $regexp = '/[,]/';
                        $part_price = preg_split($regexp, $k_price, 0, PREG_SPLIT_NO_EMPTY);
                        $price = $part_price[0] . "." . $part_price[1];
                    }
                            // check price, is not negative
                         if($price < 0 ){

                            echo "<tr><td align='center' width='550px' >";
                            echo "NOT EXIST This transaction is negative! ".$k_price;
                            echo "</td><td align='center' width='550px' >";
                            echo $date." | ".$fullname." | ".$price." | ".$account;
                            echo "</td></tr>";

                            }else {


                            echo "<tr><td align='center' width='550px'>";
                            echo $date." | ".$fullname." | ".$price." | ".$account;
                            echo "</td><td align='center' width='550px'>";
                            echo $date." | ".$fullname." | ".$price." | ".$account;
                            echo "</td></tr>";
                            

            $query = "SELECT * FROM acc_date WHERE fullnames = '$fullname' AND accounts = '$account' AND dates = '$new_date' ";
            $res = mysqli_query($connection, $query);
             if(mysqli_num_rows($res) == 0){ 
                        $query = 'INSERT IGNORE INTO acc_date (dates, add_dates, prices, accounts, fullnames, goals)
                        VALUES ("'.addslashes($new_date).'",
                        "'.addslashes($today_date).'",
                        "'.addslashes($price).'",
                        "'.addslashes($account).'",
                        "'.addslashes($fullname).'",
                        "'.addslashes($goal).'")';
                        mysqli_query($connection,$query) or die(mysqli_error($connection));
                    }

                        
                   



                }

                }
                
            }
        }

    }
    echo "</table>";
}