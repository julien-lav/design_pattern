<?php


spl_autoload_register(function($classe){
    include 'classes/' . $classe . '.class.php';
});




