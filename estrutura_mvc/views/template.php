<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meu Site</title>
</head>
<body>
    <h1>Este é o topo</h1>
    <a href="<?php echo BASE_URL;?>">Home</a>
    <a href="<?php echo BASE_URL;?>/galeria">Galeria</a>
    <hr/>
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
</body>
</html>