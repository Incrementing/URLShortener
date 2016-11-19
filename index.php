<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */


$response = null;
if (isset($_POST["url"])) {
    if (empty($_POST["url"]) || !filter_var($_POST["url"], FILTER_VALIDATE_URL)) {
        $response = '<br><p style="display:inline-block;">'.$_POST["url"].' isn\'t a valid url</p>';
    } else {
        session_start();
        $_SESSION["url"] = $_POST["url"];

        include_once "_using/php/shortener.php";
        $shortener = new URLShortener();
        $short = $shortener->get_short_url();
        $response = '<br><p style="display:inline-block;">'.$_POST["url"].' was shortened to <a href="'.$short.'" target="_blank">'.$short.'</a></p>';
    }
}

include_once "_using/php/config.php";
$config = new Config();
?>

<head>
    <title>Homepage &bull; <?php echo $config->get("website_name"); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta name="description" content="<?php echo $config->get("meta_description"); ?>">
    <meta name="keywords" content="<?php echo $config->get("meta_keywords"); ?>">
    <meta name="author" content="Incrementing // Incrementing.PW // github.com/incrementing/URLShortener">

    <link rel="icon" type="image/png" href="http://example.com/favicon.png">
    <link rel="stylesheet" type="text/css" href="_using/styles/style.css">
    <link rel="stylesheet" type="text/css"
          href="_using/bootstrap-material-design-master/dist/css/bootstrap-material-design.css">
    <link rel="stylesheet" type="text/css" href="_using/bootstrap-material-design-master/dist/css/ripples.min.css">
    <style>
        html, body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
<div style="background: white center; position: relative;">
    <nav class="navbar navbar-info navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"
                   href="<?php echo $config->get("protocol") . "://" . $config->get("domain") . $config->get("path") ?>"><span
                        class="fa fa-code"></span>&nbsp;&nbsp;<?php echo $config->get("website_name"); ?></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a target="_blank" href="https://twitter.com/Incrementing" class="fa fa-twitter"></a></li>
                    <li><a target="_blank" href="https://github.com/Incrementing/URLShortener" class="fa fa-github"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center p-y-3">
        <h1 id="title" style="padding-top: 3%; display:inline-block;">Shorten URL</h1>
        <?php if ($response != null) {
            echo $response;
        } ?>
        <div class="row m-b-1">
            <div class="col-lg-8 col-lg-offset-2 push-lg-4">
                <form id="form" action="" method="POST" class="form-group label-floating is-empty"
                      style="text-align: left; white-space: nowrap;">
                    <label for="url" class="control-label">URL:</label>
                    <input type="text" autocomplete="off" spellcheck="false" onfocus="this.select();"
                           class="form-control" id="url" name="url" required>
                    <center>
                        <div onclick='$("#form").submit();' class="btn btn-success">Shorten!
                            <div class="ripple-container"></div>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<!-- Put your own introduction/content here to fill the blank space -->
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <center><p>Put your own content here to fill the blank space</p></center>
    </div>
</div>

<footer class="site-footer">
    <hr style="background: grey; width: 45%;">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 text-center"><a href="#">Terms of Service</a></div>
            <div class="col-sm-3 text-center"><a href="#">Privacy Policy</a></div>
            <div class="col-sm-3 text-center"><a href="#">Contact Us</a></div>
            <div class="col-sm-3 text-center"><span>Created by <a href="https://github.com/Incrementing">James</a> and licenced under the GNU General Public License</span></div>
        </div>
        <br>
    </div>
</footer>
<script src="_using/scripts/jquery-2.2.4.min.js"></script>
<script src="_using/scripts/bootstrap-3.3.7.min.js"></script>
<script src="_using/bootstrap-material-design-master/dist/js/material.min.js"></script>
<script src="_using/bootstrap-material-design-master/dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
</body>
