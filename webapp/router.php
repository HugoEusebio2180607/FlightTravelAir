<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName/methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');


Router::get('login/login', 'LoginController/loginpassageiro');
Router::get('login/signup' , 'LoginController/registoform ');
Router::post('login/registo' , 'LoginController/registarPassageiro');
Router::Post('login/login' ,'LoginController/doLogin');
Router::get('login/logout',	    'LoginController/doLogout');

Router::get('admin/index',      'AdminController/index');


Router::resource('user', 'UserController');

Router::resource('aeroporto', 'AeroportoController');

Router::resource('voos', 'VooController');

Router::resource('escala' ,'EscalaController');

Router::resource('avioes' , 'AviaoController');

Router::resource('passageiro', 'PassageiroController');
Router::resource('detalhesvoo' , 'DetalhesVooController');

Router::get('gestor/index', 'GestorController/index');
Router::get('operador/index' ,'OperadorController/index');
Router::get('operador/checkin', 'BilhetesController/index');
Router::get('operador/store', 'BilhetesController/store');







/************** End of URLEncoder Routing Rules ************************************/