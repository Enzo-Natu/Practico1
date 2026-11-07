<?php
session_start();
session_destroy();
header("Location: front/dist/paginas/login.html");
exit();
