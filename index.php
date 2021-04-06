<form method="POST" action="">
    <table>
        <tr>
            <td>Combien de place voulez vous acheter</td>
            <td><input type="number" min="1" max="9" name="siege" required></td>
        </tr>
        <tr>
            <td>A quelle rangée voulez vous allez</td>
            <td><input type="number" min="0" max="7" name="rangee" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="verifer" name="submit"></td>
        </tr>
    </table>

</form>

===============================================================================<br>
<?php

session_start();

if (isset($_POST['recommancer'])) {
    unset($_SESSION);
    session_destroy();
}

if (isset($_POST['submit'])) {

    if (!isset($_SESSION['cinema'])) {
        $_SESSION['cinema'] = [
            '0' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
            '1' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
            '2' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
            '3' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
            '4' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
            '5' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
            '6' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
            '7' => [0, 0, 0, 0, 0, 0, 0, 0, 0],
        ];
    }


    $rangee = $_POST['rangee'];
    $siege = $_POST['siege'];
    $nombre_siege_vide = 0;

    foreach ($_SESSION['cinema'][$rangee] as $siege_rangee) {
        if ($siege_rangee == 0) {
            $nombre_siege_vide++;
        }
    }


    if ($nombre_siege_vide >= $siege) {
        for ($i = 0; $i <= ((8 - $nombre_siege_vide) + $siege); $i++) {
            if ($_SESSION['cinema'][$rangee][$i] == 0) {
                $_SESSION['cinema'][$rangee][$i] = 1;
            }
        }


        echo "place(s) reservée(s) <br><br>";
        ?>
        <table>
            <?php
            for ($i = 0; $i <= 8; $i++) {
                echo "<tr>";

                if ($i == 8) {
                    echo "<td>&emsp;<td>";
                } else {
                    echo "<td>" . $i . ' | ' . "<td>";
                }

                for ($j = 0; $j <= 8; $j++) {

                    if ($i == 8) {
                        echo "<td>&nbsp;" . $j . " </td>";
                    } else {
                        if ($_SESSION['cinema'][$i][$j] == 0) {
                            echo "<td>[_]</td>";
                        } else {
                            echo "<td>[x]</td>";
                        }

                    }

                }
                echo "</tr>";
            }
            ?>
        </table>
        <?php
    } else {

        echo "il n y a plus de place dans cette rangée<br><br>";
        ?>
        <table>
            <?php
            for ($i = 0; $i <= 8; $i++) {
                echo "<tr>";

                if ($i == 8) {
                    echo "<td>&emsp;<td>";
                } else {
                    echo "<td>" . $i . ' | ' . "<td>";
                }

                for ($j = 0; $j <= 8; $j++) {

                    if ($i == 8) {

                        echo "<td>&nbsp;" . $j . " </td>";
                    } else {
                        if ($_SESSION['cinema'][$i][$j] == 0) {
                            echo "<td>[_]</td>";
                        } else {
                            echo "<td>[x]</td>";
                        }
                    }

                }
                echo "</tr>";
            }
            ?>
        </table>
        <?php
    }
    ?>

    ===============================================================================<br>

    <form method="POST" action="">
        <input type="submit" name="recommancer" value="tout vider et recommancer ">
    </form>


    <?php
}
?>
