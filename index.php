<?php
    require_once("inc/header.php");
?>
        <main class="container text-white">
            <div id="overlay" style="display: none;">
                <div id="loading"><img src="/assets/images/loading.gif" class="img-fluid"></div>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center mb-3">
                    <h1>NFT Search Engine</h1>
                </div>
                <div class="col-12">

                    <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> -->
                    <div class="form-group has-search">
							<button type="submit" class="form-control-feedback" id="srcBtn">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
								</svg>
							</button>
							<input type="text" class="form-control lead bg-light" placeholder="Search" id="question" name="question">
						</div>
                    <!-- </form> -->
                </div>
                <div class="col-12">
                    <div class="row" id="resDivs">
                        <?php
                            if(isset($_POST['question']) && "" != trim($_POST['question']))
                            {
                                $str = $_POST['question'];
                                
                                $str = rawurlencode($str);
                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => "http://51.68.206.144:8002/" . $str."?start=25&end=48",
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
                                    
                                    if (count($dt) < 1) {
                                        echo "Match does not found on keyword &ldquo;".$str."&rdquo;";
                                    } else {
                                        
                                       echo '<div class="row" id="resDivs">';
                                                
                                        foreach ($dt as $key => $response2):
                                            $bc = explode("-",$response2['network']);
                                            $lp = strtolower($bc[0]);
                                        ?>
                                            <div class="col-xl-3 col-6 p-2">
                                                <a href="/nftpage/<?php echo strtolower($response2['symbol']).'.php'; ?>" class="anchorRes" target="_blank">
                                                    <div class="card resDiv h-100">
                                                        <div class="row card-body">
                                                            <div class="col-12">
                                                                <div class="col-12">
                                                                    <img src="<?php 
                                                                        if(null != $response2['img_url'])
                                                                          echo $response2['img_url'];
                                                                        else echo '/costs/assets/images/no-image.png'; ?>" class="resImg img-fluid"
                                                                    />
                                                                </div>
                                                                <h4><br/><?php echo $response2['name']; ?></h4>
                                                                <p><strong>Marketplace :  </strong><?php echo $response2['marketplace']; ?><br>
                                                                <span><strong>Blockchain : </strong><?php echo ucwords($lp); ?></span><br>
                                                                <?php 
                                                                    if($response2['network'] == "etheruem-mainnet" || $response2['network'] == "polygon-mainnet")
                                                                    {
                                                                        if($response2['floor_price'] >0)
                                                                            echo "<span><strong>Floor Price :  </strong>".$response2['floor_price']." (ETH)</span>";
                                                                    }
                                                                ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        <?php 
                                        endforeach;
                                        echo '</div>';
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    

<script>
    $(function(){
        $('#question').on('keyup', function(e){
            e.keyCode == 13 ? $('#srcBtn').trigger('click') : null;
        });
        $('#srcBtn').on('click',function(){
            $.ajax({
                type:'POST',
                url:'api_anagrams.php',
                sync: true,
                data: question  = $('input[name=question]').val(),
                // dataType:'JSON',
                success:function(data){
                    alert(data);
                    //$('#resDivs').empty();
                    // $('#resDivs').append(data);
                },
                error:function(data){
                    alert("Failed");
                },
            });
        })
    });
  
    showForeign = () =>{
    
}
</script>

<?php
require_once("inc/footer.php");
?>