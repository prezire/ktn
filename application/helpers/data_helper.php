<?php defined('BASEPATH') OR exit('No direct script access allowed');

function errors(array $errors)
{
  vars(array('errors' => $errors));
}

/**
 * Generates random token for any use.
 * @param String $key Any simple or complicated
 * random string that can be added to generate a new key.
 * @return String A new generated key.
 */
function generateToken($key)
{
  return sha1($key . date('Ymd') . rand(0, 999) . time());
}