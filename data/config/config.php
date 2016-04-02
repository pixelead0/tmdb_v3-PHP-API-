<?php

//------------------------------------------------------------------------------
// Configuration + Personal Preferences
//------------------------------------------------------------------------------

// Global Configuration
$cnf['apikey'] = '';
$cnf['lang'] = 'en';
$cnf['adult'] = false;
$cnf['debug'] = false;

// Data Return Configuration - Manipulate if you want to tune your results
$cnf['appender']['movie'] = array(
    'default' => array('trailers','images','credits','translations','reviews'),
    'all' => array('account_states','alternative_titles','credits','images','keywords','release_dates','videos','translations','similar','reviews','lists','changes','rating'));

$cnf['appender']['tvshow'] = array(
    'default' => array('trailers','images','credits','translations','keywords'),
    'all' => array('account_states','alternative_titles','changes','content_rating','credits','external_ids','images','keywords','rating','similar','translations','videos'));

$cnf['appender']['season'] = array(
    'default' => array('trailers','images','credits','translations'),
    'all' => array('changes','account_states','credits','external_ids','images','videos'));

$cnf['appender']['episode'] = array(
    'default' => array('trailers','images','credits','translations'),
    'all' => array('changes','account_states','credits','external_ids','images','rating','videos'));

$cnf['appender']['person'] = array(
    'default' => array('movie_credits','tv_credits','images'),
    'all' => array('movie_credits','tv_credits','combined_credits','external_ids','images','tagged_images','changes'));

$cnf['appender']['collection'] = array(
    'default' => array('images'),
    'all' => array('images'));

$cnf['appender']['company'] = array(
    'default' => array('movies'),
    'all' => array('movies'));

?>