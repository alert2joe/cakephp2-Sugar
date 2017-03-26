<?php


App::build(array(
    'Model/Validation' => array('%s' . 'Model/Validation' . DS)
), App::REGISTER);

App::build(array(
    'Domain/Repository' => array('%s' . 'Domain/Repository' . DS)
), App::REGISTER);

App::build(array(
    'Model/Query' => array('%s' . 'Model/Query' . DS)
), App::REGISTER);

App::build(array(
    'Domain/Service' => array('%s' . 'Domain/Service' . DS)
), App::REGISTER);

App::build(array(
    'Model/Format' => array('%s' . 'Model/Format' . DS)
), App::REGISTER);

App::uses('SugarLoad', 'Sugar.Vendor');


