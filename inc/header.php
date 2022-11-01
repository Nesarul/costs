<?php 
    require_once $_SERVER['DOCUMENT_ROOT']."/costs/admin/functions.php";
    $tk = explode('/',$_SERVER['REQUEST_URI']);
    if(in_array('slug',$tk))
    {
        $isSlug = true;
        require_once SITE_ROOT.DS."costs/admin/getSlug.php";
        $sl = new getSlug();
        $response = $sl->getResults();
        $dt = json_decode($response, true);
    }else
    {
        $dt['contractMetadata']['name'] = 'NFT Search Engine';
        $dt['description'] = 'NFT Search Engine';
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- <title>NFT Search Engine</title> -->
        <title><?php echo $dt['contractMetadata']['name']; ?></title>
        <link rel="icon" type="image/x-icon" href="/costs/images/favicon.ico">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta content="A search engine for NFTs" name="description" /> -->

        <meta name="description" content="<?php echo $dt['description']; ?>" />
        <meta name="keywords" content="<?php echo $dt['name']; ?>" />

        <!-- jQuery -->
        <script src="/costs/assets/js/jquery-3.6.1.min.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="/costs/assets/bootstrap/css/bootstrap.css">
        <script src="/costs/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
        <link rel="stylesheet" type= "text/css" href= "/costs/assets/css/styles.css">
        
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