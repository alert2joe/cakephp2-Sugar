<?php


App::build(array(
    'Model/Validation' => array('%s' . 'Model/Validation' . DS)
), App::REGISTER);

App::build(array(
    'Model/Repository' => array('%s' . 'Model/Repository' . DS)
), App::REGISTER);

App::build(array(
    'Model/Query' => array('%s' . 'Model/Query' . DS)
), App::REGISTER);

App::build(array(
    'Controller/Service' => array('%s' . 'Controller/Service' . DS)
), App::REGISTER);

App::build(array(
    'Model/Format' => array('%s' . 'Model/Format' . DS)
), App::REGISTER);

