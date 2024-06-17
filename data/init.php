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
$sqlTM = "CREATE DATABASE IF NOT EXISTS bank;";
$stmt = $pdoSet->query($sqlTM);
$sqlTM = "USE bank;";
$stmt = $pdoSet->query($sqlTM);

$sqlTM = "
CREATE TABLE IF NOT EXIST `individuals` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `patronymic_name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `passport` varchar(10) CHARACTER SET utf8 NOT NULL,
  `inn` varchar(12) CHARACTER SET utf8 NOT NULL,
  `driving_license` varchar(10) CHARACTER SET utf8 NOT NULL,
  `additional_documents` text CHARACTER SET utf8 NOT NULL,
  `comment` varchar (255) CHARACTER SET utf8 NOT NULL
  PRIMARY KEY (`id`)
);";
$stmt = $pdoSet->query($sqlTM);
// конец кода для "неубиваемой" базы данных

$table_name = 'individuals';

if (isset($_GET['bt1'])) {
    // работает независимо от кол-ва столбцов.
    $sql = "SHOW COLUMNS FROM {$table_name}";
    $stmt = $pdoSet->query($sql);
    $resultMF = $stmt->fetchAll();
    $sqlTM = "INSERT INTO {$table_name} (";
    for ($iR = 1; $iR < Count($resultMF); ++$iR) {
        $sqlTM .= $resultMF[$iR]["Field"];
        if ($iR < Count($resultMF) - 1) {
            $sqlTM .= ', ';
        } else {
            $sqlTM .= ") VALUES (";
        }
    }

    for ($iR = 1; $iR < Count($resultMF); ++$iR) {
        $sqlTM .= "'" . $_GET[$resultMF[$iR]["Field"]] . "'";
        if ($iR < Count($resultMF) - 1) {
            $sqlTM .= ', ';
        } else {
            $sqlTM .= ");";
        }
    }
    $stmt = $pdoSet->query($sqlTM);
}

// начало вставки для UPDATE
if (isset($_GET['textId'])) {
    // работает независимо от кол-ва столбцов.
    $sql = "SHOW COLUMNS FROM {$table_name}";
    $stmt = $pdoSet->query($sql);
    $resultMF = $stmt->fetchAll();
    $sqlTM = "UPDATE {$table_name} SET ";
    for ($iR = 1; isset($_GET["textEd" . $iR]); ++$iR) {
        $sqlTM .= $resultMF[$iR]["Field"] . "='" . $_GET["textEd" . $iR] . "'";
        if (isset($_GET["textEd" . ($iR + 1)])) {
            $sqlTM .= ', ';
        } else {
            $sqlTM .= " WHERE id = " . $_GET["textId"];
        }
    }

    $stmt = $pdoSet->query($sqlTM);
}
// конец вставки для UPDATE


// начало вставки для DELETE
if (isset($_GET['delid'])) {
    $sqlTM = "DELETE FROM {$table_name} WHERE id = " . $_GET["delid"];
    $stmt = $pdoSet->query($sqlTM);
}
// конец вставки для DELETE

// добавление столбца.
if (isset($_GET['addrow'])) {
    $sqlTM = "ALTER TABLE {$table_name} ADD " . $_GET['addrow'] . "1 TEXT NOT NULL AFTER " . $_GET['addrow'];
    $stmt = $pdoSet->query($sqlTM);
}
// удаление столбца.
if (isset($_GET['delrow'])) {
    $sqlTM = "ALTER TABLE {$table_name} DROP " . $_GET['delrow'];
    $stmt = $pdoSet->query($sqlTM);
}

// основной запрос для выгрузки массива данных из таблицы.
if (isset($_GET['order'])) {
    $sql = "SELECT * FROM {$table_name} ORDER BY " . $_GET['order'] . " DESC";
} else {
    $sql = "SELECT * FROM {$table_name} ORDER BY id DESC";  // ASC - по возрастанию; DESC - по убыванию.
}
$stmt = $pdoSet->query($sql);
$resultMF = $stmt->fetchAll(PDO::FETCH_NUM); // PDO::FETCH_NUM - только числовые индексы: [0][0]
?>
