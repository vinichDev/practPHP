<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Отчёт для печати</title>
    <meta name="description" content="Отчёт для печати" />
    <meta name="Keywords" content="ОТЧЁТ, ПЕЧАТЬ" />
    <link rel="stylesheet" href="style/print.css" />
    <link rel="shortcut icon" href="image/favicon2.ico" type="image/x-icon" />
</head>
<body>
<header>
    <h3>&nbsp;</h3>
</header>
<content>
    <main>

        <form action="" method="get">
            <table class="c2">
                <tr>
                    <td class="c2">Печать таблицы
                        <br />
                        objects из MySQL
                        <br />
                    </td>
                </tr>
            </table>

            <table>

                <tr class="cH">
                    <?php
                    // блок инициализации
                    try {
                        $pdoSet = new PDO('mysql:dbname=space;host=localhost', 'root', '');
                        $pdoSet->query('SET NAMES utf8;');
                    } catch (PDOException $e) {
                        print "Error!: " . $e->getMessage() . "<br/>";
                        die();
                    }
                    // название столбцов.
                    $table_name = 'objects';
                    $sql = "SHOW COLUMNS FROM {$table_name}";
                    $stmt = $pdoSet->query($sql);
                    $resultMF = $stmt->fetchAll();

                    for ($iR = 0; $iR < Count($resultMF); ++$iR) {
                        ?>
                        <td><?php echo $resultMF[$iR]["Field"]; ?></td><?php
                    }
                    ?>
                </tr>

                <?php
                $sql = "SELECT * FROM {$table_name} ORDER BY id ASC";  // ASC - по возрастанию; DESC - по убыванию.
                $stmt = $pdoSet->query($sql);
                $resultMF = $stmt->fetchAll();

                for ($iC = 0; $iC < Count($resultMF); $iC++) {
                    ?>
                    <tr><?php
                    $iCountLine = floor(Count($resultMF[$iC]) / 2);
                    for ($iR = 0; $iR < $iCountLine; ++$iR) {
                        ?>
                        <td><?php echo $resultMF[$iC][$iR]; ?></td><?php
                    }
                    ?></tr><?php
                }

                ?>
            </table>
        </form>
    </main>
</content>
<footer>
    <div>&nbsp;</div>
</footer>
</body>
</html>