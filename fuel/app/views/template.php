<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="Hatena Diary Keyword Bot">
        <meta name="author" content="Yasuyuki Sasaki">
        <meta name="viewport" content="width=device-width">
        <title><?php echo $title; ?></title>
        <?php echo Asset::js('jquery-1.8.2.min.js'); ?>
        <?php echo Asset::js('bootstrap.min.js'); ?>
        <?php echo Asset::js('modal.js'); ?>
        <?php echo Asset::js('transition.js'); ?>
        <?php echo Asset::js('modernizr-2.6.1.custom.js'); ?>
        <?php echo Asset::css('bootstrap-responsive.min.css'); ?>
        <?php echo Asset::css('bootstrap.min.css'); ?>
        <?php echo Asset::css('layout.css'); ?>
    </head>
    <body>
        <?php echo $content; ?> 
    </body>
</html>
