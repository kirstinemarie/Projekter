<?php
//forbindelse til mySQl serveren ved brug af mySQLi metode 

//1.variabler (konstanter) til forbindelsen 
//konstante navne altid med storebogstaver 

const HOSTNAME = 'localhost'; //server
const MYSQLUSER = 'root';  //bruger
const MYSQLPASS = 'root';  //password
const MYSQLDB = 'mul_a';  //database navn 

//2. forbindelsen via mySQLi 

$con = new mysqli(HOSTNAME, MYSQLUSER, MYSQLPASS, MYSQLDB);

//for at sikre sig alle utf 8 tegn kan blive brugt i forbindelsen 
$con->set_charset ('utf8');

//3. tjek forbindelsen 
//hvis der er fejl i forbindelsen 
if($con->connect_error){
	die($con->connect_error);
	// hvis der er hul igennem 
} else{
	echo '';
}
// php slut tag kan undlades, hvis filen indeholder rent php 