<?php

$target = __DIR__.'/storage/app/public';
$link = __DIR__.'/public/storage';

symlink($target, $link);

echo 'Storage link created successfully';
