<?php
    $baseURL = "https://psgc.gitlab.io/api";

    $endpoint = "/regions/";

    // CURL HERE 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseURL . $endpoint);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($result);

    $regions = [];

    foreach($data as $row) {
        $temp = [];
        $temp['code'] = $row->code;
        $temp['name'] = $row->regionName;
        $regions[] = $temp;
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Philippines Barangay Selector</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid text-bg-dark">
            <div class="container">
                <section class="p-3 text-center">
                    <h1 class="text-uppercase">Philippines Barangay Selector</h1>
                </section>
            </div>
        </div>
        <div class="container">
            <section class="d-flex justify-content-center p-3">
                <form style="width: 50%;">
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold" for="region">Region</label>
                        <select class="form-control">
                            <option value="" selected disabled>Choose region...</option>
                            <?php
                                foreach($regions as $region) {
                                    echo '<option value="' . $region['code'] . '">' . $region['name'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold" for="province">Province</label>
                        <select class="form-control" disabled>
                            <option value="" selected disabled>Choose province...</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold" for="city">City/Municipality</label>
                        <select class="form-control" disabled>
                            <option value="" selected disabled>Choose city/municipality...</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold" for="barangay">Barangay</label>
                        <select class="form-control" disabled>
                            <option value="" selected disabled>Choose barangay...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn w-100 btn-primary" data-select="submit">Submit</button>
                    </div>
                </form>
            </section>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
<script>
    const submitBtn = document.querySelector('[data-select="submit"]');

    submitBtn.addEventListener('click', (e) => {
        e.preventDefault();
        Swal.fire({
            title: "Saved!",
            text: "Successfully saved!",
            icon: "success"
        });
    });
</script>