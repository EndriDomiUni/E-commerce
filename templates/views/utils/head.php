<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Take it - <?php echo $title; ?></title>
    <link rel="icon" href="<?php echo IMG; ?>/logo.svg" type="image/svg" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="<?php echo CSS; ?>/style.css">
    <?php
    if (array_key_exists($_SERVER['PHP_SELF'], $stylesheets)) {
        for ($i = 0; $i < count($stylesheets[$_SERVER['PHP_SELF']]); $i++) {
            echo "<link rel='stylesheet' type='text/css' href='" . $stylesheets[$_SERVER['PHP_SELF']][$i] . "'>";
        }
    }
    ?>
    <script src="<?php echo JS; ?>/base.js" defer></script>
    <script src="<?php echo JS; ?>/Session.js" defer></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function downloadSectionAsPdf() {
            fetch('dashboard.php')
                .then(response => response.text())
                .then(data => {
                    const htmlContent = document.createElement('div');
                    htmlContent.innerHTML = data;
                    const section = htmlContent.querySelector('#sectionToDownload'); // ID della sezione HTML da scaricare

                    const options = {
                        filename: 'report.pdf',
                        jsPDF: {
                            format: 'a4',
                            orientation: 'portrait',
                        },
                    };

                    html2pdf()
                        .set(options)
                        .from(section)
                        .save();
                })
                .catch(error => {
                    console.error('Errore durante il download della sezione HTML:', error);
                });
        }

    </script>
</head>