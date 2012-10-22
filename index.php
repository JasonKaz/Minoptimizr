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
            <div id="info" class="content">
                <h1>What is Minoptimizr?</h1>
                Minoptimizr is an application which takes any JS or CSS files, minifies them, then compresses them using <a href="http://en.wikipedia.org/wiki/Gzip" target="_blank">GZIP</a> which greatly reduces the amount
                of bandwidth a site may use. All you have to do is upload the compressed files and add <a href="javascript:void(0)" id="htaccess_code">this</a> to your htaccess file in the root of your site. See the results <a href="results.php">here</a>.
            </div>
            <div id="local" class="content">
                <h1>Want Minoptimizr for your site?</h1>
                MinoptimizrLocal is available to download and upload to your own site for quick and easy use. Download the application <a href="MinoptimizrLocal.zip" id="downloadme">here</a>!
            </div>
            <div id="body">
                <div id="choose_files" class="content step1">
                    <h1>1. Choose the files</h1>
                    <div id="upload"></div>
                </div>
                <div class="content step1">
                    <h1>2. Choose your options</h1>
                    <div style="overflow:auto">
                        <table style="float: left" id="css_options">
                            <thead>
                                <tr>
                                    <th colspan="2">CSS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><label for="css_gzip">GZIP</label></td>
                                    <td><input type="checkbox" id="css_gzip" class="css_option"  /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_comments">Remove Comments</label></td>
                                    <td><input type="checkbox" id="css_comments" class="css_option" checked /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_emptyrulesets">Remove Empty Rulesets</label></td>
                                    <td><input type="checkbox" id="css_emptyrulesets" class="css_option" checked /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_emptyats">Remove Empty @ Blocks</label></td>
                                    <td><input type="checkbox" id="css_emptyats" class="css_option" checked /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_font">Convert Font Weights</label></td>
                                    <td><input type="checkbox" id="css_font" class="css_option" checked /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_convertcolors">Convert Colors</label></td>
                                    <td><input type="checkbox" id="css_convertcolors" class="css_option" checked /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_compresscolors">Compress Colors</label></td>
                                    <td><input type="checkbox" id="css_compresscolors" class="css_option" checked /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_compressunits">Compress Units</label></td>
                                    <td><input type="checkbox" id="css_compressunits" class="css_option" checked /></td>
                                </tr>
                                <tr>
                                    <td><label for="css_browserconvert">Convert Browser Specifics</label></td>
                                    <td><input type="checkbox" id="css_browserconvert" class="css_option" /></td>
                                </tr>

                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">JS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><label for="js_comments">Remove Comments</label></td>
                                    <td><input type="checkbox" id="js_comments" class="css_option" /></td>
                                </tr>
                                <tr>
                                    <td><label for="js_emptyrulesets">Remove Empty Rulesets</label></td>
                                    <td><input type="checkbox" id="js_emptyrulesets" class="css_option" /></td>
                                </tr>
                                <tr>
                                    <td><label for="js_emptyats">Remove Empty At Blocks</label></td>
                                    <td><input type="checkbox" id="js_emptyats" class="css_option" /></td>
                                </tr>
                                <tr>
                                    <td><label for="js_browserconvert">Convert Browser Specifics</label></td>
                                    <td><input type="checkbox" id="js_browserconvert" class="css_option" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button id="upload_button">Minoptimize!</button>
                </div>
                <div id="download" class="hidden content">
                    <a href="javascript:void(0)" id="go_back">&lt;&lt; Go Back</a>
                    <h1>3. Download your files</h1>
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