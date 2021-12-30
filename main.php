<?php
if(isset ($_POST['kriteria']) && isset($_POST['kandidat']) && isset($_POST['q']) && isset($_POST['s'])){
    $kriteria = $_POST['kriteria'];
    $kandidat = $_POST['kandidat'];
    $q = $_POST['q'];
    $s = $_POST['s'];
}else{
    header("location:index.php");
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>


    <div class="wrapper">
        <section class="a">
            <div class="top-header">
                <header>Promethee Method</header>
                <h3>Level Function</h3>
            </div>
            <div id="1">
                <form action="result.php" method="post">
                    <div>
                        <h4>Mohon lengkapi data terlebih dahulu</h4>
                    </div>
                    <div class='lengkapi'>
                        <?php
                        $i = 0;
                        foreach ($kriteria as $value) {
                            echo "<div class='kriteria'>
                                <div class='field input '>
                                <label style='color:#F29727; margin-bottom: 10px;'>$kriteria[$i]</label>";
                            foreach ($kandidat as $value) {
                                echo " <label>$value</label><input type='number' name='kriteria[$i][]' class='kriteria' min='0' step='any' required>";
                            }
                            echo "</div></div>";
                            $i++;
                        }
                        ?>
                        <input type="hidden" id="q" name="q" value=<?php echo $q ?>>
                        <input type="hidden" id="s" name="s" value=<?php echo $s ?>>
                        <?php
                        foreach ($kandidat as $value) {
                            echo '<input type="hidden" id="kandidat" name="kandidat[]" value="' . $value . '">';
                        }
                        ?>
                    </div>
                    <div class='field button'>
                        <button type="submit" id="hitung" name="hitung">Calculate</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>

</html>