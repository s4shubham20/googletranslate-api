<?php
include('token.php');
if(isset($_POST['submitBtn'])){
$city = $_POST['search'];
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "$url",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "q=$city&target=hi&source=en",
	CURLOPT_HTTPHEADER => [
		"Accept-Encoding: application/gzip",
		"X-RapidAPI-Host: google-translate1.p.rapidapi.com",
		"X-RapidAPI-Key: b1bbd5105cmsh46cde6aea22c432p10f54fjsndb1a42345e37",
		"content-type: application/x-www-form-urlencoded"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
}
if(isset($response)){
    $data = json_decode($response, true);
}

// if ($err) {
// 	echo "cURL Error #:" . $err;
// } else {
// 	echo $response;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="container-fluid my-4">
        <div class="row mt-4">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col col-lg-6 col-md-6">
                <form class="d-flex" role="search" method="post">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" name="submitBtn" type="submit">Search</button>
                </form>
            </div>
            <?php if (isset($data)) {?>
                <div class="row my-3">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 px-3">
                    <div class="card">
                            <div class="card-header">
                            Translate Text
                            </div>
                            <div class="card-body">
                                <h2><?=$data['data']['translations'][0]['translatedText'];?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>