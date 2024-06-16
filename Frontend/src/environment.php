<?php
    $schema = $_ENV["schema"];
    $domain = $_ENV["domain"];
    $api_port = $_ENV["api_port"];
    $api_path = $_ENV["api_path"];

    $api_point = $schema.$domain.":".$api_port.$api_path;
?>