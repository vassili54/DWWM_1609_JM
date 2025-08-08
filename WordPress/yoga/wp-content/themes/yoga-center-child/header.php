<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<link href="https://fonts.googleapis.com/css2?family=Karma&display=swap" rel="stylesheet">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header style="padding: 20px; background-color: #fce5b5;">
        <div class="site-header" style="text-align: center; max-width: 1000px; margin: auto;">


            <div class="site-logo-name">
                <?php if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                } ?>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div>

            <nav class="main-nav">
                <?php
                wp_nav_menu(array(

                    'container' => false,
                    'menu_class' => 'nav-menu',
                ));
                ?>
            </nav>

        </div>
    </header>