<!DOCTYPE html>
<html lang="en">
    <head>
        <title>NFT Search Engine</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="A search engine for NFTs" name="description" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
        <!-- <link rel="stylesheet" type= "text/css" href= "{{ url_for('static', filename='styles.css') }}"> -->
        <link rel="stylesheet" type= "text/css" href= "static/styles.css">
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-FY49WMF33D"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-FY49WMF33D');
        </script>
    </head>
    <body>
        <main class="container-fluid text-white" style="padding: 0 !important;">
            <div id="overlay" style="display: none;">
                <div id="loading"><img src="static/loading.gif" class="img-fluid"></div>
            </div>
            <div class="row" id="nftInfo">
                
            <?php
                if (isset($_GET['slug']) && !empty($_GET['slug'])) {
                    $str = $_GET['slug'];
                    $resp = getData($str);
                }

                function getData($str)
                {
                    $str = rawurlencode($str);

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "http://51.68.206.144:8002/nftpage/" . $str,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 60,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                            "cache-control: no-cache",
                        ),
                    ));
                    $i = 0;
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    if ($err) {
                        echo "cURL Error #:" . $err;
                    } else {
                        $dt = json_decode($response, true);
                        
                        if (empty($dt['name'])) {
                            echo $dt['name'];
                        } else {
                            
                            $banner_image = $dt['banner_image_url'];
                            if (null == $banner_image) 
                                $banner_image = 'static/replacement_banner.png';
                
                            $sData = '<div class="row" id="resDivs">';
                            $sData.=
                                '
                                <div class="col-12">
                                <div class="banner-div">
                                <!-- Insert image banner here, if they don\'t have banner use a replacement banner -->
                                    <img class="banner-top" src='.$banner_image.'>
                                </div>
                                <div class="little-profile text-center">
                                    <div class="pro-img img-fluid"><img src="'.$dt["image_url"].'"></div>
                                    <div class="col-12 customDiv mb-3">
                                        <!-- insert collections name here -->
                                        <h3 class="m-b-0 text-uppercase">'.$dt["name"].'</h3>
                                        <!-- insert description here -->
                                        <p>'.$dt["description"].'</p>
                                        ${socmeds}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-dark customDiv" style="padding-bottom: 2vmax;">
                                <!-- insert other infos here -->
                                <div class="profile-info border w-100 p-3 text-center" style="background-color: rgb(219, 219, 219); border-radius: 10px;">
                                    <h4 class="text-uppercase pageInfo">Collection\'s Name:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["name"].'</p>
                                    <h4 class="text-uppercase pageInfo">Symbol:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["symbol"].'</p>
                                    <h4 class="text-uppercase pageInfo">Address:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["address"].'</p>
                                    <h4 class="text-uppercase pageInfo">Owner:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["owner"].'</p>
                                    <h4 class="text-uppercase pageInfo">Asset Contract Type:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["asset_contract_type"].'</p>
                                    <h4 class="text-uppercase pageInfo">Date Created:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["created_date"].'</p>
                                    <h4 class="text-uppercase pageInfo">NFT Version:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["nft_version"].'</p>
                                    <h4 class="text-uppercase pageInfo">Schema:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["schema_name"].'</p>
                                    <h4 class="text-uppercase pageInfo">Payout Address:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["payout_address"].'</p>
                                    <h4 class="text-uppercase pageInfo">External Link:</h4>
                                    <p style="padding-bottom: 1rem;">'.$dt["external_link"].'</p>
                                    <h4 class="text-uppercase pageInfo">Slug:</h4>
                                    <p>'.$dt["slug"].'</p>
                                </div>
                            </div>
                                
                                ';
                            // }
                            $sData .= '</div>';
                            }

                        }
                        echo $sData;
                    }
            ?>


            </div>
        </main>
    </body>
</html>