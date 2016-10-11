<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Codeigniter 3 Alias Helper to shorten common
 * methods from different core classes.
 * Just put it in the helpers folder and load it via autoload.php.
 * Sample: view(), post(), method(), parse(), etc.
 * @author Amoin, Mark N. <prezire@gmail.com>
*/
function view($view, $vars = [], $return = FALSE)
{
  return get_instance()->load->view($view, $vars, $return);
}
function parse($template, $data, $return = FALSE)
{
  return get_instance()->parser->parse($template, $data, $return);
}
//
function vars($vars, $val = '')
{
  return get_instance()->load->vars($vars, $val);
}
function get_var($key)
{
  return get_instance()->load->get_var($key);
}
function get_vars()
{
  return get_instance()->load->get_vars();
}
function clear_vars()
{
  return get_instance()->load->clear_vars();
}
//
function dbforge($db = NULL, $return = FALSE)
{
  return get_instance()->load->dbforge($db, $return);
}
function database($params = '', $return = FALSE, $query_builder = NULL)
{
  return get_instance()->load->database($params, $return, $query_builder);
}
//
function get($index = NULL, $xss_clean = NULL)
{
  return get_instance()->input->get($index, $xss_clean);
}
function post($index = NULL, $xss_clean = NULL)
{
  return get_instance()->input->post($index, $xss_clean);
}
function server($index = NULL, $xss_clean = NULL)
{
  return get_instance()->input->server($index, $xss_clean);
}
function cookie($index = NULL, $xss_clean = NULL)
{
  return get_instance()->input->cookie($index, $xss_clean);
}
function method($upper = FALSE)
{
  return get_instance()->input->method($upper);
}
//
function helper($helpers)
{
  return get_instance()->load->helper($helpers);
}
function lib($library, $params = NULL, $object_name = NULL)
{
  return get_instance()->load->library($library, $params, $object_name);
}
function model($model, $name = '', $db_conn = FALSE)
{
  return get_instance()->load->model($model, $name, $db_conn);
}
//Returns instances only.
function fv()
{
  $i = &get_instance();
  return $i->form_validation;
}
function form_validation()
{
  $i = &get_instance();
  return $i->form_validation;
}
function sess()
{
  $i = &get_instance();
  return $i->session;
}
function migration()
{
  $i = &get_instance();
  return $i->migration;
}
function config()
{
  $i = &get_instance();
  return $i->config;
}
function output()
{
  $i = &get_instance();
  return $i->output;
}
function unit()
{
  $i = &get_instance();
  return $i->unit;
}
function pagination()
{
  $i = &get_instance();
  return $i->pagination;
}
function cache()
{
  $i = &get_instance();
  return $i->cache;
}
function cal()
{
  $i = &get_instance();
  return $i->calendar;
}
function uri()
{
  $i = &get_instance();
  return $i->uri;
}
function agent()
{
  $i = &get_instance();
  return $i->agent;
}
function table()
{
  $i = &get_instance();
  return $i->table;
}
function encryption()
{
  $i = &get_instance();
  return $i->encryption;
}
function upload()
{
  $i = &get_instance();
  return $i->upload;
}