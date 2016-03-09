--TEST--
Should validate NotOptional rule
--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Factory;
use Respect\Validation\Rules\NotOptional;
use Respect\Validation\Validator;

$factory = new Factory();
$validator = new Validator($factory);
$validator->addRule(new NotOptional());

$values = [null, '', [], ' ', 0, '0', 0.0, '0.0', false, [''], [' '], [0], ['0'], [false], [[''], [0]], -1];
foreach ($values as $value) {
    echo str_pad(json_encode($validator->validate($value)), 6).': '.json_encode($value).PHP_EOL;
}
?>
--EXPECTF--
false : null
false : ""
true  : []
true  : " "
true  : 0
true  : "0"
true  : 0
true  : "0.0"
true  : false
true  : [""]
true  : [" "]
true  : [0]
true  : ["0"]
true  : [false]
true  : [[""],[0]]
true  : -1
