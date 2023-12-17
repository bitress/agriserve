<?php

include_once 'init.php';

Session::destroySession();

header("Location: login.php");