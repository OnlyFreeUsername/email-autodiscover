<!doctype html>
<html lang="en">

<?php $config = json_decode(implode('', file('settings.json')), true); ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha256-DF7Zhf293AJxJNTmh5zhoYYIMs2oXitRfBjY+9L//AY=" crossorigin="anonymous">

    <title><?= $config["info"]["name"] ?></title>
</head>

<body>
    <div class="container">
        <div class="py-5 text-center">
            <h1><?= $config["info"]["name"] ?></h1>
            <h2>E-Mail Autoconfiguration</h2>
        </div>

        <label for="emailAddress">Your email address:</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="username" aria-label="Mailaccount username" onchange="mailchanged(this.value)" aria-describedby="emailAddress">
            <div class="input-group-append">
                <span class="input-group-text" id="emailAddress">@<?= $config["info"]["domain"] ?></span>
            </div>
        </div>

        <a class="btn btn-primary btn-lg btn-block" href="/generate.xml" role="button" id="generate">Generate</a>
    </div>

    <script>
        let generateButton = document.getElementById("generate") || console.error("Generate button not found!");

        function mailchanged(username) {
            let email = username + "@<?= $config["info"]["domain"] ?>";
            generateButton.href = `/mail/config-v1.1.xml?emailaddress=${encodeURIComponent(email)}`;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha256-SyTu6CwrfOhaznYZPoolVw2rxoY7lKYKQvqbtqN93HI=" crossorigin="anonymous"></script>
</body>

</html>