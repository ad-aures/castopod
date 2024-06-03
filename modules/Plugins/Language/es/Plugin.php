<?php

declare(strict_types=1);

// get locale from path
$locale = basename(__DIR__);

return load_plugins_translations($locale);
