<?php

$longUrl = getcwd();

$urlExplode = explode("htdocs", $longUrl);

$baseUrl = $urlExplode[1];

define("BASE_URL", $baseUrl);
