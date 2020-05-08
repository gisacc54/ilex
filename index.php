<?php
/**
 * ile - A PHP Framework For Web
 *
 * @package  ilex
 * @author   Gift Isacc <giftisacc54@gmail.com>
 */
 /*
 |_______________________________________________________
 |  __________________________________________________   |
 | |  ilex Framework                                  |  |
 | |            Developed                             |  |
 | |                        By                        |  |
 | |                            GOSSystems            |  |
 | |__________________________________________________|  |
 |_______________________________________________________|
 |
 */
require_once 'vendor/autoload.php';


require_once 'routes/web.php';

$action = $_SERVER['REQUEST_URI'];

Config\Routes\Route::dispatch($action);
