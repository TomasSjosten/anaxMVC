<?php
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
// Configure theme file
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// Add Navbar to the theme
$app->navbar->configure(ANAX_APP_PATH.'config/navbar_me.php');







$app->router->add('presentation', function() use ($app) {
    $app->theme->setVariable('title', "Presentation");

    $content = $app->fileContent->get('presentation.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown, nl2br');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
            'content' => $content,
            'byline' => $byline,
    ]);
});




$app->router->add('', function() use ($app) {
    $app->theme->setVariable('title', 'About');

    $content = $app->fileContent->get('about.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown, nl2br');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
            'content' => $content,
            'byline' => $byline,
    ]);
});





$app->router->add('source', function() use ($app) {

    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Source code");


    $source = new \Me\Source\CSource([
                                              'secure_dir' => '..',
                                              'base_dir' => '..',
                                              'add_ignore' => ['.htaccess'],
                                      ]);

    $app->views->add('me/source', [
            'content' => $source->View(),
    ]);

});






$app->router->add('dice', function() use ($app) {
    $app->theme->setTitle('Spela tärning');
    $app->theme->addStylesheet('css/dice.css');

    $die = new \Mos\Dice\CDice();

    $results = null;
    $total = null;
    $roll = null;

    if (isset($_GET['roll']) && $_GET['roll'] > 0 && $_GET['roll'] < 7) {
        $die->roll($_GET['roll']);
        $roll = filter_var($_GET['roll'], FILTER_SANITIZE_NUMBER_INT);
        $results = $die->getResults();
        $total = $die->getTotal();
    }

    $app->views->add('dice/index', [
        'roll' => $roll,
        'results' => $results,
        'total' => $total,
    ]);
});








$app->router->add('presentation/kmom01', function() use ($app) {
    $app->theme->setVariable('title', "Kmom01");

    $content = $app->fileContent->get('presentation/kmom01.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown, nl2br');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');

    $app->views->add('me/page', [
            'content' => $content,
            'byline' => $byline,
    ]);
});






// Render the response using theme engine.
$app->router->handle();
$app->theme->render();
