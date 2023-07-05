<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400">

<style>
/* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
body {
    font-family: 'Montserrat', sans-serif;
}

@keyframes spinner {
    0% {
        transform: rotateZ(0deg);
    }

    100% {
        transform: rotateZ(359deg);
    }
}

* {
    box-sizing: border-box;
}

.wrapper {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    min-height: 100%;
    padding: 20px;
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.jumbotron {
    background-image: url('<?php echo base_url("assets/images/bg-manajer-blur.JPEG");?>');
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: center;
    min-height: 75vh;
    padding: 20px;
    position: relative;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    font-family: 'Playfair Display', serif;
}

.btn {
    font-family: 'Montserrat', sans-serif;
    border-radius: 15px
}
</style>
<html>

<body>
    <br><br><br>
    <!-- <div class="wrapper" style="background-image: url('<?php echo base_url("assets/images/bg-manajer.JPG"); ?>');"> -->
    <div class="container text-center" style="margin: 2em auto;">
        <div class="jumbotron">
            <h1 class="display-3" style="color: #fff">Hallo Owner!</h1>
            <h2 class="display" style="color: #fff">Welcome to Andini Salon</h2>
            <div style="display: flex; justify-content: center; margin-top: 10px;">
                <a href="<?=base_url('user/tabel_barangmasuk');?>" type="button" class="btn btn-sm"
                    style="margin-right: 5px; background: #bba086; color: #fff; font-weight: bold">
                    <i class="fa fa-files-o" aria-hidden="true" style="color: #fff"></i> Report Pembelian Barang</a>
                <a href="<?=base_url('user/tabel_barangkeluar');?>" type="button" class="btn btn-sm"
                    style="margin-left: 5px; background: #bba086; color: #fff; font-weight: bold">
                    <i class="fa fa-files-o" aria-hidden="true" style="color: #fff"></i> Report Penggunaan Barang</a>
            </div>
        </div>
        <!-- </div> -->
    </div>
</body>






</html>