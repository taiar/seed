<?php

  $arquivo = "samplefile.txt";
  $chave = "016E6472655F616E6472650A";

  if(is_file($arquivo)) {
    $mac = hash_hmac_file("sha256", $arquivo, $chave);
    echo "HMAC: '{$mac}'" . PHP_EOL;
  }
