<?php
include 'config.php';



if(isset($_POST['selector'])){
	$options = $_POST['selector'];


if(isset($_FILES['fileUpload'])){
	$file = $_FILES['fileUpload'];

	//file properties
	$file_name = $file['name'];
	$file_type = $file['type'];
	$file_tmp = $file['tmp_name'];
	$file_size = $file['size'];
	$file_error = $file['error'];


	//file format
	$file_ext = explode('.', $file_name);
	$file_ext = strtolower(end($file_ext));

	// select bank and file format is correct
	if($file_ext == $options){

		// check file, don't have error
		if($file_error === 0){

			// check file size, less 2MB
			if($file_size <= 2097152) {

                $db_data = get_alldata();

                $blankinfo = file($file_name); // get upload file
                $blankCnt = count($blankinfo) - 1; // count key on array



                echo "<table id='personlist' border='1' >";
                echo "<th>EXIST</th>";
                echo "<th>UPLOADED</th>";
                echo "<div id='result'></div>";

                for ($i = 0; $i <= $blankCnt; $i++) {
                    $firstname = $blankinfo[$i];

                    //change format to utf-8
                    $unfirstname = iconv('windows-1250', 'UTF-8', $firstname); //ISO-8859-7

                    //    var_dump($unfirstname);
                    // find all reference separated |
                    if (strpos($unfirstname, '|') == true) {
                        $regexp = '/[|]/u';
                        $parts = preg_split($regexp, $unfirstname, 0, PREG_SPLIT_NO_EMPTY);
                        $date = trim($parts[1]); //get date
                        $price = trim($parts[3]); //get price
                        $fulling = trim($parts[5]); //get also information where name, surname and account

                   //     var_dump($parts);

                        //	separated at ;
                        if (strpos($fulling, ';') == true) {
                            $regexp = '/[;]/u';
                            $parts_two = preg_split($regexp, $fulling, 0, PREG_SPLIT_NO_EMPTY);
                            $part_acc = trim($parts_two[1]); //get account part
                            $part_person = trim($parts_two[2]); // get preson data part
                            $part_goal = trim($parts_two[3]);


                            //get account
                            if (strpos($part_acc, ':') == true) {
                                $regexp = '/[:]/u';
                                $parts_acc = preg_split($regexp, $part_acc, 0, PREG_SPLIT_NO_EMPTY);
                                $account = trim($parts_acc[1]);
                            }

                            // get name and surname
                            if (strpos($part_person, ':') == true) {
                                $regexp = '/[ ]/';
                                $parts_pers = preg_split($regexp, $part_person, 0, PREG_SPLIT_NO_EMPTY);
                                $name = $parts_pers[1];
                                $surname = $parts_pers[2];
                                $fullname = $name . " " . $surname;
                            }
                            //get goal
                            if (strpos($part_goal, ':') == true) {
                                $regexp = '/[:]/u';
                                $parts_goal = preg_split($regexp, $part_goal, 0, PREG_SPLIT_NO_EMPTY);
                                $goal = trim($parts_goal[1]);
                                //  var_dump($goal);
                                //       preg_match('/\d+ \d+/', $goal, $goalff);  // \d{7} ///[0-9]+\s[0-9]+/
                            }

                        }


                        echo "<tr><td align='center' width='550px'>";
                        foreach ($db_data as $value) {
                        $fullnames = $value['fullnames'];
                        $accounts = $value['accounts'];
                        if($fullnames == $fullname){
                            echo $date." | ".$fullname." | ".$price." | ".$account;
                        }
                        
                        }

                        echo "</td><td align='center' >";
                        echo $date." | ".$fullname." | ".$price." | ".$account;

                         echo "</td><td>";
                         echo "<input type='checkbox' name='area[]' class='get_value' value='$date;$fullname;$price;$account;$goal:' >";
                        echo "</td></tr>";

                    }
                }
    echo "</table>";
	echo "<input id='chkall' type='checkbox' align='center' >Check/ Uncheck all";
    echo "<button type='button' name='submit' class='btn btn-info' id='submit' >submit</button>";
	}else{
		echo "WARNING - LARGE FILE SIZE!!!";
	}
	}else{
		echo "WARNING - FILE HAVE ERROR!!!";
	}
	}else{
		echo "NOT CORRECT FILE FORMAT '".$file_ext."' !!!";
	}

	}
}



?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/myscript.js"></script>
	<title></title>
</head>
<body>
</body>
</html>

