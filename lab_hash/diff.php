<?php

  $f1 = "1hmac.txt";
  $f2 = "2hmac.txt";

  $f1_source = file($f1); 
  $f2_source = file($f2);

  $total = count($f1_source);

  $certo = 0;
  $errado = 0;

  for($i = 0; $i < $total; $i += 1) {
    if($f1_source[$i] == $f2_source[$i])
      $certo += 1;
    else
      $errado += 1;
  }

  $proport = $certo / $errado;

  echo "TOTAL: {$total}" . PHP_EOL;
  echo "CERTOS: {$certo}" . PHP_EOL;
  echo "ERRADO: {$errado}" . PHP_EOL;
  echo "PROPORT: {$proport}" . PHP_EOL;
