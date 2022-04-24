@php
    //set timezone to stockholm
    date_default_timezone_set('Europe/Stockholm');
    //Header
    $headers = array(
        'Authorization: Bearer GXifl1aqiT_2iIzzLPk9LgW4rfoa'
    );
    //Set parameters
    $auth_key = "91236f7a-0ef5-4753-bdff-d8f35153d588";
    $stop_id = "9021014003640000";
    $departureDate = date('Y-m-d');
    $departureTime = date('h:i');
    $api_url="https://api.vasttrafik.se/bin/rest.exe/v2";

    $cURL = curl_init();
    //Set the headers that we want our cURL client to use.
    curl_setopt($cURL, CURLOPT_HTTPHEADER, $headers);

    // set curl_setopt()
    curl_setopt($cURL, CURLOPT_URL, $api_url.'/departureBoard?authKey='.$auth_key.'&id='.$stop_id.'&date='.$departureDate.'&time='.$departureTime.'&format=json,&async=false');

    curl_setopt($cURL, CURLOPT_FAILONERROR, true);

    // return the transfer as a string, also with setopt()
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($cURL,CURLOPT_HTTPGET,1);

    // executes curl session
    $departureList = curl_exec($cURL);

    if (curl_errno($cURL)) {
        echo $error_msg = curl_error($cURL);
    }

    curl_close($cURL);

    $xml = simplexml_load_string($departureList);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    @endphp

    <section class="departTitle p-3">
    <div class="container">
        <div class="row">
            <h2>Departures from Järntorget</h2>
        </div>
    </div>
    </section>

    <section class="depart">
        <tr class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Number</th>
                    <th scope="col">Type</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Departs</th>
                </tr>
                </thead>
                <tbody>
                @foreach($array['Departure'] as $values)
                    <tr>
                        <th scope="row"> @php echo $values['@attributes']['sname']; @endphp</th>
                        <td> @php echo $values['@attributes']['type']; @endphp</td>
                        <td> @php echo $values['@attributes']['direction']; @endphp</td>
                        <td> @php echo $values['@attributes']['time']; @endphp</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>