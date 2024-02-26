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
            <h1>Cost Data</h1>
        </header>
        <main>
            <section>
                <h2>View Data</h2>
                <form id="Application" action="{{ route('selectData') }}" method="post">
                    @csrf
                    <input style="display:none;" type="text" id="newData" name="newData" value="true">
                    <label for="ApplicationSelect">Select Application</label>
                    <select id="ApplicationSelect" name="ApplicationSelect" form="Application">
                    <?php
                        if (session()->has("ApplicationNames")){
                            if (session()->has("appName")){
                                echo "<option value='" . session()->get("appName") . "'>" . session()->get("appName") . "</option>";
                            }
                            foreach(session()->get("ApplicationNames") as $data){
                                if (session()->has("appName")){
                                    if ($data != session()->get("appName")){
                                        echo "<option value='" . $data . "'>" . $data . "</option>";
                                    }
                                }
                                else{
                                    echo "<option value='" .  $data . "'>" . $data . "</option>";
                                }
                            }
                        }
                    ?>
                    </select>
                    <input type="submit" value="Submit">
                </form>
                <?php
                    $AppData = [];
                    if (session()->has("AppData")){
                        $AppData = session()->get("AppData");
                        echo "<h3>Application - " . session()->get("appName") . "</h3>";
                        if (isset($AppData[4]->ServiceName)){
                            echo "<h3>Resources - " . $AppData[4]->ServiceName . "</h3>";
                        }
                        else{
                            echo "<h3>Resources - Null </h3>";
                        }
                    }
                    else{
                        echo "<h3>Application - Waiting for input</h3>";
                        echo "<h3>Resources - Waiting for input</h3>";
                    }
                ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Consumed Quantity</th>
                        <th>Cost</th>
                    </tr>
                    <?php
                        if (session()->has("AppData")){
                            $countLimit = session()->get("AppDataDisplay") + 6;
                            for ($i = session()->get("AppDataDisplay"); $i < $countLimit; $i++){
                                if (isset($AppData[$i])){
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $AppData[$i]->Date . "</td>";
                                    echo "<td>" . $AppData[$i]->ConsumedQuantity . "</td>";
                                    echo "<td>" . $AppData[$i]->Cost . "</td>";
                                    echo "</tr>";
                                }
                            }
                        }
                        else{
                            echo "<tr>";
                            echo "<td>Awaiting Choice</td>";
                            echo "<td>Awaiting Choice</td>";
                            echo "<td>Awaiting Choice</td>";
                            echo "<td>Awaiting Choice</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
                <form class="BottomForm" action="{{ route('selectData') }}" method="post">
                    @csrf
                    <div>
                        <label for="forward">Forward</label>
                        <input type="radio" id="forward" name="Nextwhere" value="forward">
                    </div>
                    <div>
                        <label for="backward">Backward</label>
                        <input type="radio" id="backward" name="Nextwhere" value="backward">
                    </div>
                    <input type="number" min="1" max="5" id="NextFive" name="NextFive" value="5">
                    <input type="submit" value="submit">
                </form>
            </section>
            <section>
                <h2>Data Tools</h2>
                <?php
                    if (session()->has("AppData")){
                        echo "<h3 style='margin-top:12px;'>Application - " . session()->get("appName") . "</h3>";
                        echo "<h3 style='margin-bottom:10px;'>Resources - " . $AppData[4]->ServiceName . "</h3>";
                    }
                ?>
                <form id="Tools" action="{{ route('selectData') }}" method="post">
                    @csrf
                    <label>Select Tool</label>
                    <select id="ToolSelect" name="ToolSelect" form="Tools">
                        <option value="HighestValue">Highest Cost</option>
                        <option value="LowestValue">Lowest Cost</option>
                        <option value="Average">Average Cost</option>
                        <option value="Range">Range</option>
                    </select>
                    <input type="submit" value="submit">
                </form>
                <?php
                    if (isset($toolUsed)){
                        echo "<table style='margin:auto;'>";
                        if (isset($highVal)){
                            echo "<tr>";
                            echo "<th>The Highest Cost</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>" . $highVal . "</td>";
                        }
                        else if (isset($lowVal)){
                            echo "<tr>";
                            echo "<th>The Lowest Cost</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>" . $lowVal . "</td>";
                        }
                        else if (isset($aveVal)){
                            echo "<tr>";
                            echo "<th>The Average Cost</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>" . $aveVal . "</td>";
                        }
                        else if (isset($range)){
                            echo "<tr>";
                            echo "<th>The Range Cost</th>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>" . $range . "</td>";
                        }
                        echo "</table>";
                    }
                ?>
            </section>
            <section>
                <h2>Select Specific Data</h2>
                <form id="Tools" action="{{ route('selectData') }}" method="post">
                    @csrf
                    <label>Select Specific Entry</label>
                    @if (session()->get('AppData') !== null)
                        <input type="number" min="0" max="@php count(session()->get('AppData')) @endphp" id="specific" name="specific" value="0">
                    @else
                        <input type="number" min="0" id="specific" name="specific" value="0">
                    @endif
                    <input type="submit" value="submit">
                </form>
                <?php
                    if (isset($specificData)){
                        echo "<h3>InstanceID: <br>" . $specificData->InstanceId . "</h3>";
                        echo "<table style='margin:auto;'>";
                        echo "<tr>";
                        echo "<th>Consumed Quantity</th>";
                        echo "<th>Cost</th>";
                        echo "<th>Date</th>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>" . $specificData->ConsumedQuantity . "</td>";
                        echo "<td>" . $specificData->Cost . "</td>";
                        echo "<td>" . $specificData->Date . "</td>";
                        echo "</tr>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>Meter Category</th>";
                        echo "<th>Resource Group</th>";
                        echo "<th>Resource Location</th>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>" . $specificData->MeterCategory . "</td>";
                        echo "<td>" . $specificData->ResourceGroup . "</td>";
                        echo "<td>" . $specificData->ResourceLocation . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>Unit Of Measure</th>";
                        echo "<th>Location</th>";
                        echo "<th>Service Name</th>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>" . $specificData->UnitOfMeasure . "</td>";
                        echo "<td>" . $specificData->Location . "</td>";
                        echo "<td>" . $specificData->ServiceName . "</td>";
                        echo "</tr>";
                        echo "</table>";
                    }
                ?>
            </section>
        </main>

        <footer>
            <a href="/">Go back</a>
        </footer>
    </div>
</body>
</html>