<?php
include "cron/cron.php";
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Ezan Vakitleri</title>
    <?php
    $ulkeler = ulkeCek();
    ?>
</head>

<body class="d-flex flex-column h-100">
    <div class="content">
        <main class="flex-shrink-0">
            <div class="container">
            <h1>Vakit Saat İşlemleri</h1> 
           
            <div class="row">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Ülke</label>
                    </div>
                    <select class="custom-select" id="Ulkeler">
                        <option>Lütfen Seçim Yapınız...</option>
                        <?php foreach ($ulkeler as $ulke) : ?>
                        <option value="<?php echo $ulke->UlkeID; ?>"><?php echo $ulke->UlkeAdi; ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Şehir</label>
                    </div>
                    <select class="custom-select" id="Sehirler">
                        <option>Lütfen Seçim Yapınız...</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">İlçe</label>
                    </div>
                    <select class="custom-select" id="ilceler">
                        <option>Lütfen Seçim Yapınız...</option>

                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <table id="vakitler" class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-nowrap text-center font-weight-bold" >Tarih</td>
                            <td class="text-nowrap text-center font-weight-bold">AyinSekli</td>
                            <td class="text-nowrap text-center font-weight-bold">Gunes</td>
                            <td class="text-nowrap text-center font-weight-bold">Ogle</td>
                            <td class="text-nowrap text-center font-weight-bold">Akşam</td>
                            <td class="text-nowrap text-center font-weight-bold">İkindi</td>
                            <td class="text-nowrap text-center font-weight-bold">Yatsı</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
        </div>
        </main>
        <footer class="footer mt-auto py-3">
  <div class="container text-muted pull-center text-center">
    <span class="text-muted pull-center text-center"><!--OnlineZiyaretci.com kodu baslangici-->
 <script language="JavaScript" type="text/javascript" src="http://www.onlineziyaretci.com/sayac.php?userid=107551"></script><!--OnlineZiyaretci.com kodu sonu--></span>
    

    
  </div>
</footer>
        
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

                    $("#Ulkeler").change(function() {
                        let UlkeID = document.getElementById("Ulkeler").value;
                        $.ajax({
                                method: "GET",
                                url: "cron/cron.php",
                                data: {
                                    statu: "ulke",
                                    code: UlkeID
                                }
                            })
                            .done(function(sehirler) {
                                sehirler = JSON.parse(sehirler);
                                $('#Sehirler option').remove();
                                sehirler.forEach(function(sehirBilgileri) {

                                    $("#Sehirler").append('<option value=' + sehirBilgileri.SehirID + '>' + sehirBilgileri.SehirAdi + '</option>');

                                });

                            });
                    });


                    $("#Sehirler").change(function() {
                        let SehirID = document.getElementById("Sehirler").value;
                        $.ajax({
                                method: "GET",
                                url: "cron/cron.php",
                                data: {
                                    statu: "sehir",
                                    code: SehirID
                                }
                            })
                            .done(function(ilceler) {

                                ilceler = JSON.parse(ilceler);
                                $('#ilceler option').remove();
                                ilceler.forEach(function(ilceBilgileri) {

                                    $("#ilceler").append('<option value=' + ilceBilgileri.IlceID + '>' + ilceBilgileri.IlceAdi + '</option>');

                                });

                            });
                    });

                    $("#ilceler").change(function() {
                            let IlceID = document.getElementById("ilceler").value;
                            $.ajax({
                                    method: "GET",
                                    url: "cron/cron.php",
                                    data: {
                                        statu: "ilce",
                                        code: IlceID
                                    }
                                })
                                .done(function(vakitler) {
                                        vakitler = JSON.parse(vakitler);
                                        vakitler.forEach(function(vakitBilgileri) {
                                                var x = document.getElementById('vakitler').insertRow(1);
                                                var a = x.insertCell(0);
                                                var b = x.insertCell(1);
                                                var c = x.insertCell(2);
                                                var d = x.insertCell(3);
                                                var e = x.insertCell(4);
                                                var f = x.insertCell(5);
                                                var g = x.insertCell(6);
                                                a.innerHTML = vakitBilgileri.MiladiTarihKisaIso8601;
                                                b.innerHTML = "<img src='" + vakitBilgileri.AyinSekliURL + "'>";
                                                c.innerHTML = vakitBilgileri.Gunes;
                                                d.innerHTML = vakitBilgileri.Ogle;
                                                e.innerHTML = vakitBilgileri.Aksam;
                                                f.innerHTML = vakitBilgileri.Ikindi;
                                                g.innerHTML = vakitBilgileri.Yatsi;



                                                });

                                        });
                                });


                    });
    </script>
</body>

</html>