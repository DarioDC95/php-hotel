<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    function ciao($hotels, $isParking, $chosenVote) {
        $filterdHotels = [];
        $refilteredHotels = [];
    
        if($isParking == 'NoPark') {
            foreach ($hotels as $value) {
                if($value['parking'] == false) {
                    $filterdHotels[] = $value;
                }
            };
        }
        elseif ($isParking == 'Park') {
            foreach ($hotels as $value) {
                if($value['parking'] == true) {
                    $filterdHotels[] = $value;
                }
            };
        }
        else {
            $filterdHotels = $hotels;
        };

        if($chosenVote != null) {
            foreach ($filterdHotels as $key => $value) {
                if($value['vote'] >= $chosenVote) {
                    $refilteredHotels[] = $value;
                }
            };
        }
        else {
            $refilteredHotels = $hotels;
        }

        return $refilteredHotels;
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
    $chosenVote = null;

    echo '<br>';

    if(isset($_POST["parckingArea"])) {
        $isParking = $_POST["parckingArea"];
    };
    echo $isParking;

    if(isset($_POST["numberVote"])) {
        if($_POST["numberVote"] >= 0 && $_POST["numberVote"] <= 5) {
            $chosenVote = $_POST["numberVote"];
        }
        else {
            $chosenVote = null;
        }
    };
    echo $chosenVote;
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
                    <div class="card-header text-center">
                        <h1>Hotels</h1>
                    </div>
                    <div class="card-body">
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
                                <?php foreach (ciao($hotels, $isParking, $chosenVote) as $value) { ?>
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
                    </div>
                    <div class="card-footer">
                        <form action="#" method="post">
                            <div class="mb-2 d-flex">
                                <div class="me-5">
                                    <div class="form-check mb-2">
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
                                <div class="ms-5">
                                    <label for="numberVote" class="form-label">seleziona un voto da 0 a 5 per l'hotel che vuoi cercare</label>
                                    <input type="number" class="form-control" name="numberVote" id="numberVoteOK" placeholder="Inserisci un voto da 0 a 5">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>