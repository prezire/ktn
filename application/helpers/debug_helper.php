<?php defined('BASEPATH') OR exit('No direct script access allowed');

function lm($level, $message)
{
  log_message($level, 'Begin ==========================');
  log_message($level, $message);
  log_message($level, 'End ----------------------------');
}

function ld($message)
{
  lm('debug', $message);
}

//CL = Custom Logger.
function cl($name = '', $values = '', $level = 'debug')
{
    $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];
    $c = $bt['class'];
    $m = $bt['function'];
    $t = print_r($values, TRUE);
    $s = "\r\n======= Start ======\r\n";
    $s .= "{$c}::{$m}() $name: $t";
    $s .= "\r\n------ End --------\r\n";
    log_message($level, $s);
}