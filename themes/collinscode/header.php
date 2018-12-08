<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="">
    <link rel="apple-touch-icon" href=""/>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
      <div class="header">
        <div class="header-content">
          <a class="logo" href="<?=home_url(); ?>">
            <!-- <img src="" alt=""> -->
          </a>
        </div> <!-- Header Content & Logo -->
        <nav class="header-nav">
          <?php wp_nav_menu( array( 'menu' => 'Default Menu' ) ); ?>
        </nav> <!-- Header Navigation -->

        <!-- Button trigger modal -->
        <div class="mobile-button">
          <div class="button-container">
            <div class="dot1 dot"></div>
            <div class="dot2 dot"></div>
            <div class="dot3 dot"></div>
          </div>
        </div> <!-- Mobile Menu Button -->
      </div> <!-- Header Inner Container -->

      <!-- Mobile Menu -->
      <div class="mobile-menu" id="mobile-menu">
        <nav class="menu-container">
          <?php wp_nav_menu( array( 'menu' => 'Default Menu' ) ); ?>
        </nav>
      </div>

    </header>

    <div class="body-container">
