 <?php
	if (isset($_POST['question']) && !empty($_POST['question'])) {
		$str = $_POST['question'];

		echo "lovely";
		// $resp = getData($str);
	}

	function getData($str)
	{
		$str = rawurlencode($str);

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://51.68.206.144:8002/" . $str."?start=1&end=24",
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
			
			if (empty($dt[0]['address'])) {
				echo "Match does not found on keyword &ldquo;".$str."&rdquo;";
			} else {
				
				$sData = '<div class="row" id="resDivs">';
						
				foreach ($dt as $key => $response2) 
				{
					$sData.=
					'<div class="col-xl-3 col-6 p-2">
						<a href="nftpage.php?slug='.$response2["slug"].'" class="anchorRes" id="gnayboy-love-kiss">
							<div class="card resDiv h-100">
								<div class="row card-body">
									<div class="col-12">
										<h4>'.$response2["name"].'</h4>
										<p>'.$response2["address"].'</p>
									</div>
									<div class="col-12">
										<img src="'.$response2["image_url"].'" class="resImg img-fluid">
									</div>
								</div>
							</div>
						</a>
					</div>';
				}
				$sData .= '</div>';
				echo $sData;
				}

			}
		}
?>