<?php

$valuesExist = false;
$isOn = false;
$motor1 = $_POST["motor1"]."";
$motor2 = $_POST["motor2"]."";
$motor3 = $_POST["motor3"]."";
$motor4 = $_POST["motor4"]."";
$motor5 = $_POST["motor5"]."";
$motor6 = $_POST["motor6"]."";

echo $motor1 . "<br>";

$wasOn = false;



$link = mysqli_connect("localhost","root","","");

if ($link == false) {
    die("Connection failed: " );
  }
  echo "Connected successfully";


  $sql = "CREATE DATABASE myDB";
  

	if(mysqli_query($link,$sql)){
		echo "myDB database created !!!";
	}
	else{
        echo "Error in creating new datavase" . mysqli_error($link) ;
    }
    
    $link = mysqli_connect("localhost","root","","myDB");

    $sql = "CREATE TABLE robotValues (

		m1 VARCHAR(30) NOT NULL,
		m2 VARCHAR(30) NOT NULL,
        m3 VARCHAR(30) NOT NULL,
		m4 VARCHAR(30) NOT NULL,
        m5 VARCHAR(30) NOT NULL,
        m6 VARCHAR(30) NOT NULL)";


		if (mysqli_query($link,$sql)) {
            echo "table craeted";
            $valuesExist = false;
		}
		else
		{ 
            $valuesExist = true;
			echo mysqli_error($link);
        }
        
        if ($valuesExist === false){

            $sql = "INSERT INTO robotValues (m1, m2, m3, m4, m5, m6)
                VALUES ($motor1,$motor2,$motor3,$motor4,$motor5,$motor6)";

            if (mysqli_query($link,$sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . mysqli_error($link);
            }
        }

        else{
            $sql = "UPDATE robotValues SET m1=$motor1 ,m1=$motor1 ,m2=$motor2 ,
            m3=$motor3 ,m4=$motor4 ,m5=$motor5 ,m6=$motor6  ";

            if (mysqli_query($link,$sql)) {
                echo "Updated record  successfully";
            } else {
                echo "Error: " . mysqli_error($link);
            }     
         }


         
         $link = mysqli_connect("localhost","root","","myDB");

    $sql = "CREATE TABLE operate (
        isOn VARCHAR(10) NOT NULL)";


		if (mysqli_query($link,$sql)) {
            echo "table craeted";
            $valuesExist = false;
		}
		else
		{ 
            $valuesExist = true;
            
			echo mysqli_error($link);
        }


        if ($valuesExist === false){

            $sql = "INSERT INTO operate (isOn)
                VALUES ('ON')";

            if (mysqli_query($link,$sql)) {
                echo "New record created successfully";
                
            } else {
                echo "Error: " . mysqli_error($link);
            }
        }

        else{
           
            $sql = "SELECT isOn FROM operate";
           
            if($result = mysqli_query($link,$sql)){

		            if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                       if(strcmp($row["isOn"],'OFF')){
                           $isOn = true;
                       }
                       else{
                        $isOn = false;
                       }
                    }
                }

            if($isOn){
            $sql = "UPDATE operate SET isOn ='OFF' ";
             }
             else{
                $sql = "UPDATE operate SET isOn ='ON' ";
             }

            if (mysqli_query($link,$sql)) {
                echo "Updated record  successfully";
                
            } else {
                echo "Error: " . mysqli_error($link);
            }     
         }
  




	 header('Location: ./index.html');
?>
