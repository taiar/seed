<?php
  
  $s = file_get_contents("d.txt");

  $vals = unpack('H*', $s);

  echo print_r($vals);
