<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <input style="display=hide" type="text" name="page" value="dumpdata">
        <input type="text" name="From" value="CANINE001">
        <input type="text" name="Hour" value="true">
        <input type="text" name="Day" value="false">
        <button type="submit">test</button>
    </form>
    <?php
    if (isset($data)){
        var_dump($data);
    }
    ?>
</body>
</html>