<?php
require_once '../inc/shortner.class.php';
// die(json_encode($_SERVER));
if (!empty($_SERVER['QUERY_STRING']) || isset($_SERVER['PATH_INFO'])) 
{

    $url_params = explode('/',$_SERVER['REQUEST_URI']);
    $shortner = new shortner();
    $result = $shortner->exists(end($url_params));
    if($result)
    {
        header("Location: $result");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script defer src="scripts.js"></script>
    <title>URL Shortener</title>
</head>

<body>
    <div class="container">
        <div class="dashboard">
            <div class="shorten_container">
                <h2>shorten URL</h2>
                <form name="shorten_url_form">
                    <input id="source_url" name="source_url" type="url" placeholder="e.g https://YOUR_URL.com">
                    <button class="shorten_button" type="submit">SHORTEN</button>
                </form>
                <div class="shorten_result">
                    <p class="title">ORIGINAL URL:</p>
                    <p class="origin"></p>
                    <p class="title">YOUR URL SHORTENING:</p>
                    <p class="new"></p>
                </div>
            </div>
        </div>
        <div class="main_display">
            <div class="url_list_header">
                <div class="source_url">ORIGINAL</div>
                <div class="short_url">SHORT URL</div>
                <div class="created_at">CREATED AT</div>
            </div>
            <ul class="url_list"></ul>
        </div>
    </div>
</body>

</html>