<?php

/**
 * APP Configuration
 */
const PRODUCTION = false;

const APP_URL = PRODUCTION ? 'https://agrisudipen.net/agriserve_test': 'http://localhost/agriserve';
const DB_HOST = PRODUCTION ? '23.111.150.178' : 'localhost';
const DB_NAME = PRODUCTION ? 'agrisudi_agri' : 'agriserve';
const DB_USER = PRODUCTION ? 'agrisudi_agriserve' : 'root';
const DB_PASS = PRODUCTION ? 'uXD3-bXc}{m#' : '';

error_reporting(PRODUCTION ? 0 : E_ALL);
ini_set('display_errors', PRODUCTION ? 'Off' : 'On');


ini_set('display_errors', 'On');





