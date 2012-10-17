<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>Minoptimizr</title>
        <link rel="stylesheet" href="css/style.css" />
        <style>
        .center {
            margin: auto;
            display: block;
        }

        .imgcaption {
            margin: auto;
            text-align: center;
            padding: 5px;
            background-color: #1F1F1F;
        }
        </style>
    </head>

    <body>
        <div id="container">
            <div id="head">
                Minoptimizr
                <span class="sm"></span>
            </div>
            <div id="body">
                <a href="index.php">&lt;&lt; Go Back</a><br /><br />
                Using Google's <a href="http://code.google.com/speed/page-speed/" target="_blank">Page Speed</a> add-on for Firefox, it showed that the JS and CSS files for the site should be optimized and that my page score was 89.
                <img src="images/pagespeed_before.png" width="600" height="301" class="center" /><br />
                After running Minoptimizr on the files and uploading them, it showed that those files no longer needed to be optimized and the page score increased to 96.
                <img src="images/pagespeed_after.png" width="340" height="107" class="center" /><br />
                <div class="imgcaption" style="width:515px">
                    <img src="images/results.png" class="center" width="507" height="208" />
                    Size differences
                </div>
            </div>
        </div>
    </body>
</html>