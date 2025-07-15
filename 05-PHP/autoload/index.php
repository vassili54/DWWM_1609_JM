<?php

// require_once 'src/Blog/Article/Demo.php';
// require_once 'src/Demo.php';
require_once 'vendor/autoload.php'; // Autoload files using Composer autoload
use App\Demo;
use App\Blog\Article\Demo as ArticleDemo;
new Demo();
new ArticleDemo();
