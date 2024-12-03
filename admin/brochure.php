<?php

include ('dashboard.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<script type="text/javascript">
     function preventBack(){window.history.forward()};
     setTimeout("preventBack()",0);
     window.onunload=function(){null;}
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RHU FORM PDF</title>
    <style>
        #myPDF{
            width: 100%;
            height: 975px;
            margin-top: 10px;
        }
        /* Card Styling */
        .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 99%;
        max-width: 100%;
        margin-bottom: 20px;
        }

        .card-header {
        background-color: #000080;
        color: white;
        padding: 15px;
        font-size: 18px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        }

        .card-header i {
        margin-right: 10px;
        }

        .card-body {
        padding: 10px;
        }
    </style>
</head>
<body>
    <main class="mt-2 pt-3">
    <div class="col-md-13 mb-3 ms-3">
            <div class="card">
                <div class="card-header">
                    <span><i class="bi bi-file-earmark-pdf-fill"></i> BROCHURE OF MEALS</span>
                </div>
                <div class="card-body">
                    <div class="container">
                        <iframe id="myPDF" src="files/FOOD_CALORIES BROCHURE.pdf" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>