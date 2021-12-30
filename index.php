<!DOCTYPE html>
<html lang="en">

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
                <div class="sejajar">
                    <div class="field input">
                        <label>Jumlah Kriteria</label>
                        <input type="number" id="jmlhkriteria" required>
                    </div>
                    <div class="field input">
                        <label>Jumlah Kandidat</label>
                        <input type="number" id="jmlhkandidat" required>
                    </div>
                </div>
                <div class="sejajar">
                    <div class="field input">
                        <label>q</label>
                        <input type="number" id="q" required autocomplete="off">
                    </div>
                    <div class="field input">
                        <label>s</label>
                        <input type="number" id="s" required autocomplete="off">
                    </div>
                </div>

            </div>
            <div class="field button">
                <button type="button" id="ok">Next</button>
            </div>

        </section>
    </div>

    <script>
        $('#ok').click(function() {
            var jmlhkriteria = $('#jmlhkriteria').val();
            var jmlhkandidat = $('#jmlhkandidat').val();
            var q = $("#q").val();
            var s = $("#s").val();


            var namaKriteria = "<div class='kriteria'><div class='field input'>";
            var angka = 1;
            for (let index = 0; index < jmlhkriteria; index++) {

                namaKriteria = namaKriteria + "<label>Kriteria " + angka + "</label><input type='text' name='kriteria[" + index + "]' placeholder='Nama Kriteria " + angka + "' required>";
                angka = angka + 1;
            }
            namaKriteria = namaKriteria + "</div></div>";

            angka = 1;
            var namaKandidat = " <div class='kandidat'><div class='field input'>";
            for (let index = 0; index < jmlhkandidat; index++) {
                namaKandidat = namaKandidat + "<label>Kandidat " + angka + "</label><input type='text' name='kandidat[" + index + "]' placeholder='Nama Kandidat " + angka + "' required>";
                angka = angka + 1;
            }
            namaKandidat = namaKandidat + "</div></div>";

            var finalPrint = "  <form action='main.php' method='POST' enctype='multipart/form-data' autocomplete='off'>";
            finalPrint = finalPrint + "<div><h4>Mohon lengkapi data terlebih dahulu</h4></div>";
            finalPrint = finalPrint + " <div class='lengkapi'>" + namaKriteria + namaKandidat + "</div>";
            finalPrint = finalPrint + "<div class='field button'><button type='submit' id='go'>Go</button></div>";
            finalPrint = finalPrint + "<input type='hidden' id='q' name='q' value=" + q + "><input type='hidden' id='s' name='s' value=" + s + "></form>";
            $("#1").html(finalPrint);

            $(this).remove();
        });

     
    </script>
</body>

</html>