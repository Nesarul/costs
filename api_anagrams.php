 <?php
	if (isset($_POST['q']) && !empty($_POST['q'])) {
		$str = $_POST['q'];

		$resp = getData($str);
	}

	function getData($str)
	{
		$str = rawurlencode($str);
		$retVal['err'] = "";
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://51.68.206.144:8002/" . $str."?start=".$_POST['s']."&end=".$_POST['e'],
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
			
			if (null === $dt) {
				$retVal['records'] = "Match does not found on keyword &ldquo;".$str."&rdquo;";
				$retVal['err'] = "NR";
				echo json_encode($retVal);

			} else {
				$sData['records'] = "";
				$price = "";	
								
				foreach ($dt['results'] as $key => $response2) 
				{
					$bc = explode("-",$response2['network']);
					$lp = strtolower($bc[0]) == "etheruem" ? "ethereum" : strtolower($bc[0]);
					if($response2['network'] == "etheruem-mainnet" || $response2['network'] == "polygon-mainnet")
						if($response2['floor_price'] > 0)
							$price = $response2['floor_price'].' (ETH)';

					$im = $response2["img_url"] == null ? "/assets/images/no-image.png": $response2["img_url"];

					// $kk = getNetworks($response2);

					$sData['records'].=
					'<div class="col-xl-3 col-6 p-2">
						<a href="'.$response2['link'].'" class="anchorRes" id="gnayboy-love-kiss">
							<div class="card resDiv h-100">
								<div class="row card-body">
									<div class="col-12">
										<img src="'.$im.'" class="resImg img-fluid">
									</div>
									<div class="col-12">
										<h4>'.$response2["name"].'</h4>
										<p><strong>Marketplace :  </strong> '.$response2['marketplace'].'<br>
										<span><strong>Blockchain : </strong> '.ucwords($lp).'</span><br>
										<span><strong>Floor Price : </strong> '.$price.'</p>
										
									</div>
								</div>
							</div>
						</a>
					</div>';
				}
				$sData['total'] = $dt['total_count'];
				echo json_encode($sData);
				}

		}
	}

	// function getNetworks($ar){
	// 	$val=[
	// 		"ethereum-mainnet"=>
	// 		[
	// 			'name'=>"Ethereum",
	// 			'web'=>"https://opensea.io/assets?search[query]=".$ar['name']
	// 		],
	// 		"etheruem-mainnet"=>
	// 		[
	// 			'name'=>"Ethereum",
	// 			'web'=>"https://opensea.io/assets?search[query]=".$ar['name']
	// 		],
	// 		"solana-mainnet"=>
	// 		[
	// 			'name'=>"Salona",
	// 			'web'=>"https://magiceden.io/marketplace/".$ar['symbol']
	// 		],
	// 		"arbitrum-mainnet"=>
	// 		[
	// 			'name'=>"Arbitrum",
	// 			'web'=>"https://stratosnft.io/search?query=".$ar['name']
	// 		],
	// 		"avalanche-mainnet"=>
	// 		[
	// 			'name'=>"Avalanche",
	// 			'web'=>"https://joepegs.com"
	// 		],
	// 		"bsc-mainnet"=>
	// 		[
	// 			'name'=>"BSC",
	// 			'web'=>"https://www.binance.com/en/nft/search-result?keyword=".$ar['name']
	// 		],
	// 		"celo-mainnet"=>
	// 		[
	// 			'name'=>"Celo",
	// 			'web'=>"https://cyberbox.art"
	// 		],
	// 		"fantom-mainnet"=>
	// 		[
	// 			'name'=>"Fantom",
	// 			'web'=>"https://paintswap.finance"
	// 		],
	// 		"harmony-mainnet"=>
	// 		[
	// 			'name'=>"Harmony",
	// 			'web'=>"https://madnfts.io"
	// 		],
	// 		"optimism-mainnet"=>
	// 		[
	// 			'name'=>"Optimism",
	// 			'web'=>"https://qx.app/"
	// 		],
	// 		"polygon-mainnet"=>
	// 		[
	// 			'name'=>"Polygon",
	// 			'web'=>"https://opensea.io/assets?search[query]=".$ar['name']
	// 		],
	// 	];

	// 	if(array_key_exists($ar['network'],$val))
	// 		return $val[$ar['network']];
	// 	else
	// 		return "invalid";
	// }
?>