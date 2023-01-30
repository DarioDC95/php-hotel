<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function ciao($hotels, $isParking) {
        $filterdHotels = [];
    
        if($isParking == 'NoPark') {
            $filterdHotels = [];
            foreach ($hotels as $value) {
                if($value['parking'] == false) {
                    $filterdHotels[] = $value;
                }
            };
            return $filterdHotels;
        }
        elseif ($isParking == 'Park') {
            $filterdHotels = [];
            foreach ($hotels as $value) {
                if($value['parking'] == true) {
                    $filterdHotels[] = $value;
                }
            };
            return $filterdHotels;
        }
        else {
            return $hotels;
        }
    }

    var_dump($_POST);

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    // echo '<pre>';
    // var_dump($hotels);
    // echo '</pre>';

    $isParking = null;

    echo '<br>';

    if(isset($_POST["parckingArea"])) {
        $isParking = $_POST["parckingArea"];
    };
    echo $isParking ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <table class="table table-striped mb-4">
                        <thead>
                            <tr>
                                <th scope="col">name</th>
                                <th scope="col">Descrizione</th>
                                <th scope="col">Parcheggio</th>
                                <th scope="col">Voto</th>
                                <th scope="col">Distance-Center</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (ciao($hotels, $isParking) as $value) { ?>
                                <tr>
                                    <?php foreach ($value as $key => $element) { ?>
                                        <td>
                                            <?php
                                                if($key == 'parking' && $element) {
                                                    $element = 'si';
                                                }
                                                else if ($key == 'parking' && !$element) {
                                                    $element = 'no';
                                                }
                                                echo $element
                                            ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <form action="#" method="post">
                        <div class="mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="parckingArea" id="parckingAreaTrue" value="Park">
                                <label class="form-check-label" for="parckingArea">
                                    CON Parcheggio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="parckingArea" id="parckingAreaFalse" value="NoPark">
                                <label class="form-check-label" for="parckingArea">
                                    SENZA Parcheggio
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>