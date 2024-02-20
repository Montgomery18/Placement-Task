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
        <input type="text" name="IDMin" value="0">
        <input type="text" name="IDMax" value="0">
        <input type="text" name="DogID" value="CANINE001">
        <input type="text" name="HourMode" value="true">
        <input type="text" name="DayMode" value="false">
        <button type="submit">test</button>
    </form>
    <div>
        @if (isset($data))
            @foreach ($data as $d)
                <br>
                <p>"{{ $d->CanineID }}"</p>
                <p>"{{ $d->Hour }}"</p>
                <p>"{{ $d->Weight }}"</p>
                <p>"{{ $d->Behaviour }}"</p>
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