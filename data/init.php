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
	// работает независимо от кол-ва столбцов.
	$sql = "SHOW COLUMNS FROM myarttable";
	$stmt = $pdoSet->query($sql);
	$resultMF = $stmt->fetchAll();
	$sqlTM = "INSERT INTO myarttable (";
	for($iR=1; $iR < Count($resultMF); ++$iR) {
		$sqlTM .= $resultMF[$iR]["Field"];
		if ($iR < Count($resultMF)-1) { $sqlTM .= ', '; } else { $sqlTM .= ") VALUES ("; }
	}
	
	for($iR=1; $iR < Count($resultMF); ++$iR) {
		$sqlTM .= "'".$_GET[$resultMF[$iR]["Field"]]."'";
		if ($iR < Count($resultMF)-1) { $sqlTM .= ', '; } else { $sqlTM .= ")"; }
	}

	$stmt = $pdoSet->query($sqlTM);
}

// начало вставки для UPDATE
if (isset($_GET['textId'])) {
	// работает независимо от кол-ва столбцов.
	$sql = "SHOW COLUMNS FROM myarttable";
	$stmt = $pdoSet->query($sql);
	$resultMF = $stmt->fetchAll();
	$sqlTM = "UPDATE myarttable SET ";
	for($iR=1; isset($_GET["textEd".$iR]); ++$iR) {
		$sqlTM .= $resultMF[$iR]["Field"]."='".$_GET["textEd".$iR]."'";
		if (isset($_GET["textEd".($iR+1)])) { $sqlTM .= ', '; } else { $sqlTM .= " WHERE id = " . $_GET["textId"]; }
	}
	
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


// основной запрос для выгрузки массива данных из таблицы.
if (isset($_GET['order'])) {
	$sql = "SELECT * FROM myarttable WHERE id>14 ORDER BY ".$_GET['order']." DESC";
} else {
	$sql = "SELECT * FROM myarttable WHERE id>14 ORDER BY id DESC";  // ASC - по возрастанию; DESC - по убыванию.
}
	$stmt = $pdoSet->query($sql);
	$resultMF = $stmt->fetchAll();
?>
