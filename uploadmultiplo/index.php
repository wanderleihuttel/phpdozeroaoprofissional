<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exemplo de Upload Múltiplo</title>
</head>
<body>
    <div><h2>Exemplo de upload de arquivos</h2></div>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="arquivo[]" multiple><br/>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>