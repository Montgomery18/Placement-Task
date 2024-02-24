<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Page</title>
    <link href="{{ asset('css/data_page.css') }}" rel="stylesheet">
</head>
<body>
    <div id="container">
        <header>
            <h1>hi</h1>
        </header>
        <main>
            <section>
                <form id="Application" action="{{ route('selectData') }}" method="post">
                    @csrf
                    <label>Select Application</label>
                    <select id="ApplicationSelect" name="ApplicationSelect" form="Application">
                    @if (session()->has("ApplicationNames"))
                        @if (isset($appName))
                                <option value="{{ $appName }}">{{ $appName }}</option>
                        @endif
                        @foreach(session()->get("ApplicationNames") as $data)
                            @if (isset($appName)){
                                @if ($data != $appName)
                                    <option value="{{ $data }}">{{ $data }}</option>
                                @endif
                            }
                            @else
                                <option value="{{ $data }}">{{ $data }}</option>
                            @endif
                        @endforeach
                    @endif
                    </select>
                    <input type="submit" value="Submit">
                </form>
                    <table>
                        <tr>
                            @if (isset($appData))
                                <th>Application - {{ $appName }}</th>
                            @else
                                <th>Application</th>
                            @endif
                        </tr>
                        @if (isset($appData))
                            <tr>
                                <th>Resources - {{ $appData[4]->ServiceName }}</th>
                            </tr>
                        @endif
                        <tr>
                            <th>Date</th>
                            <th>Consumed Quantity</th>
                            <th>Cost</th>
                            @if (isset($appData))
                                @foreach($appData as $displayData)
                                    <tr>
                                        <td>{{ $displayData->Date}}</td>
                                        <td>{{ $displayData->ConsumedQuantity }}</td>
                                        <td>{{ $displayData->Cost }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>p</td>
                                    <td>p</td>
                                    <td>p</td>
                                </tr>
                            @endif
                    </table>
            </section>
            <section>
                <p>placeholder</p>
            </section>
            <section>
                <p>placeholder</p>
            </section>
        </main>

        <footer>
            <a href="/">Go back</a>
        </footer>
    </div>
</body>
</html>