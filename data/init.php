<?php 
// блок инициализации
try {
	$pdoSet = new PDO('mysql:host=localhost', 'root', '');
	$pdoSet->query('SET NAMES utf8;');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// код для "неубиваемой" базы данных
$sqlTM = "CREATE DATABASE IF NOT EXISTS test;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "USE test;";
$stmt = $pdoSet->query($sqlTM);

$sqlTM = "CREATE TABLE IF NOT EXISTS myArtTable (id int(11) NOT NULL auto_increment, text text NOT NULL, description text NOT NULL, keywords text NOT NULL, PRIMARY KEY (id)) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "CREATE TABLE IF NOT EXISTS files (id_file int(11) NOT NULL auto_increment, id_my int(11) NOT NULL, description text NOT NULL, name_origin text NOT NULL, path text NOT NULL, date_upload text NOT NULL, PRIMARY KEY (id_file), FOREIGN KEY (id_my) REFERENCES myarttable(id)) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=cp1251;";
$stmt = $pdoSet->query($sqlTM);
// конец кода для "неубиваемой" базы данных

if (isset($_GET['bt1'])) {
	$sqlTM = "INSERT INTO myarttable (text, description, keywords) values ('" . $_GET["text"] . "', '" . $_GET["description"] . "', '" . $_GET["keywords"] . "')";
	$stmt = $pdoSet->query($sqlTM);
}

// начало вставки для UPDATE
if (isset($_GET['textId'])) {
	$sqlTM = "UPDATE myarttable SET text='".$_GET["textEd1"]."', description='".$_GET["textEd2"]."', keywords='".$_GET["textEd3"]."' WHERE id = " . $_GET["textId"];
	$stmt = $pdoSet->query($sqlTM);	
}
// конец вставки для UPDATE


// начало вставки для DELETE
if (isset($_GET['delid'])) {
	$sqlTM = "DELETE FROM files WHERE id_my = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
	$sqlTM = "DELETE FROM myarttable WHERE id = " . $_GET["delid"];
	$stmt = $pdoSet->query($sqlTM);
}
// конец вставки для DELETE


	$sqlTM="SELECT * FROM myarttable WHERE id>14 ORDER BY id DESC";  // ASC - по возрастанию; DESC - по убыванию.
//echo $sqlTM;
	$stmt = $pdoSet->query($sqlTM);
	$resultMF = $stmt->fetchAll();
	
//var_dump($resultMF);

?>
