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
                <h2>View Data</h2>
                <form id="Application" action="{{ route('selectData') }}" method="post">
                    @csrf
                    <input style="display:none;" type="text" id="newData" name="newData" value="true">
                    <label>Select Application</label>
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
                    if (session()->has("AppData")){
                        $AppData = session()->get("AppData");
                        echo "<h3>Application -" . session()->get("appName") . "</h3>";
                        echo "<h3>Resources -" . $AppData[4]->ServiceName . "</h3>";
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
                        if (isset($AppData)){
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
                            echo "<td>Awaiting User Choice</td>";
                            echo "<td>Awaiting User Choice</td>";
                            echo "<td>Awaiting User Choice</td>";
                            echo "<td>Awaiting User Choice</td>";
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
                    <input type="number" min="1" max="5" id="NextFive" name="NextFive" value="1">
                    <input type="submit" value="submit">
                </form>
            </section>
            <section>
                <h2>Data Tools</h2>
                <form id="Tools" action="{{ route('selectData') }}" method="post">
                    <label>Select Tool</label>
                    <select id="ApplicationSelect" name="ApplicationSelect" form="Tools">
                        <option value="HighestValue">Highest Cost</option>
                        <option value="LowestValue">Lowest Cost</option>
                        <option value="Average">Average Cost</option>
                        <option value="Range">Range</option>

                    </select>
                    <input type="submit" value="submit">
                </form>
            </section>
        </main>

        <footer>
            <a href="/">Go back</a>
        </footer>
    </div>
</body>
</html>