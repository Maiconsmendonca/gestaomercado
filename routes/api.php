<?php

use App\config\router;
use App\Http\Controllers\TesteController;

router::add('get', '/', 'TesteController@teste2');
router::add('get', '/teste', 'TesteController@teste');
router::add('get', '/teste', 'TesteController@teste');
