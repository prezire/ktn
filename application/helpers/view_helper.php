<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function render($partial)
{
  view('layouts/header');
  view('partials/' . $partial);
  view('layouts/footer');
}

function toHumanizeDate($date)
{
  return str_replace('-', '/', $date);
}

function toFriendlyDate($carbonInst)
{
  //KLUDGE:
  $days = array
  (
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday'
  );
  $c = $carbonInst;
  return $days[$c->dayOfWeek]
    . ', '
    . toHumanizeDate($c->now());
}

function toDropdownArray(array $dbData, $keyIndex, $valueIndex)
{
  $data = array();
    foreach($dbData as $d)
    {
      $key        = $d[$keyIndex];
        $name       = $d[$valueIndex];
        $data[$key] = $name;
    }
    return $data;
}

/**
 * Converts an array to JSON format.
 * The header will be updated as well.
 *
 * @param array $data The data to convert.
 * @param int $httpStatusCode
 *
 * return NULL
 */
function showJsonView(array $data, $httpStatusCode = 200)
{
  $CI = &get_instance();
  $CI->output
    ->set_status_header($httpStatusCode)
    ->set_content_type('application/json', 'utf-8')
    ->set_output(json_encode(
        $data,
        JSON_PRETTY_PRINT
        | JSON_UNESCAPED_UNICODE
        | JSON_UNESCAPED_SLASHES
    ))->_display();
    exit;
}