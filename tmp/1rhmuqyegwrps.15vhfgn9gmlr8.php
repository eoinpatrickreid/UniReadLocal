<!DOCTYPE html>
<html>
   <head>
      <title><?= ($html_title) ?></title>
      <meta charset='utf8' />
      <?php echo $this->render('head.html',NULL,get_defined_vars(),0); ?>
   </head>
   <body>

      <?php echo $this->render($content,NULL,get_defined_vars(),0); ?>
   </body>
</html>
