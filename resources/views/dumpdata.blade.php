<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('test') }}" method="post">
        @csrf
        <input style="display=hide" type="text" name="page" value="dumpdata">
        <input type="text" name="DateMin" value="2021-01-01">
        <input type="text" name="DateMax" value="2021-01-02">
        <input type="text" name="DogID" value="CANINE001">
        <input type="text" name="DisplayAll" value="false">
        <button type="submit">test</button>
    </form>
    <div>
        @if (isset($data))
            @dd($data)
            @foreach ($data as $d)
                <br>
                <p>"{{ $d->Hour }}"</p>
                <p>"{{ $d->Weight }}"</p>
                <p>"{{ $d->Activity_Level }}"</p>
                <p>"{{ $d->Temperature }}"</p>
            @endforeach
        @endif
    </div>
    <?php
    if (isset($data)){
        //var_dump($data);
    }
    ?>
</body>
</html>