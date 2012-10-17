<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <meta name="description" content="Web site optimization/compression tool" />
        <meta name="keywords" content="website, optimization, compression, javascript, css, minification, minify, gzip" />
        <title>Minoptimizr</title>
        <link rel="stylesheet" href="css/style.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="js/jquery.uploadify-3.2.min.js"></script>
        <script src="js/index.js"></script>
    </head>

    <body>
        <div id="container">
            <div id="head">
                Minoptimizr
                <span class="sm">A website optimization tool by <a href="http://pendarenstudios.com/" target="_blank">Jason Kaczmarsky</a></span>
            </div>
            <div id="info">
                <h1>What is Minoptimizr?</h1>
                Minoptimizr is an application which takes any JS or CSS files, minifies them, then compresses them using <a href="http://en.wikipedia.org/wiki/Gzip" target="_blank">GZIP</a> which greatly reduces the amount
                of bandwidth a site may use. All you have to do is upload the compressed files and add <a href="javascript:void(0)" id="htaccess_code">this</a> to your htaccess file in the root of your site. See the results <a href="results.php">here</a>.
            </div>
            <div id="local">
                <h1>Want Minoptimizr for your site?</h1>
                MinoptimizrLocal is available to download and upload to your own site for quick and easy use. Download the application <a href="MinoptimizrLocal.zip" id="downloadme">here</a>!
            </div>
            <div id="body">
                <div id="choose_files">
                    <h1>1. Choose the files</h1>
                    <div id="upload"></div>
                    <input type="button" id="upload_button" value="Minoptimize!" />
                </div>
                <div id="download" class="hidden">
                    <a href="javascript:void(0)" id="go_back">&lt;&lt; Go Back</a>
                    <h1>2. Download your files</h1>
                    <table id="files">
                        <thead><tr><th>File</th><th>Before</th><th>After</th><th>% Compressed</th></tr></thead>
                    </table>
                </div>
            </div>
        </div>
        <div id="popup" class="hidden">
            <h2>HTACCESS CODE</h2>
            <a href="javascript:void(0)" id="close">X</a>
            <textarea rows="9" cols="45">
RewriteEngine On
RewriteBase /

AddEncoding gzip .gz
RewriteCond %{HTTP_USER_AGENT} !Safari
RewriteCond %{HTTP:Accept-encoding} gzip
RewriteCond %{REQUEST_FILENAME} ^.*\.(css|js)$
RewriteCond %{REQUEST_FILENAME}.gz -f
RewriteRule ^(.*)$ $1.gz [QSA]
            </textarea>
        </div>
    </body>
</html>