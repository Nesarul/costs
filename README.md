4. In case you need it, the list of networks/blockchains from my API is:
"ethereum-mainnet",
"solana-mainnet",
"arbitrum-mainnet",
"avalanche-mainnet",
"bsc-mainnet",
"celo-mainnet",
"fantom-mainnet",
"harmony-mainnet",
"optimism-mainnet",
"polygon-mainnet"

6. Instead of linking each result to a subpage, link instead to the marketplace URL for each NFT collection. 
This marketplace URL is not in my API, you will need to create it.  It is based on the network/blockchain name.

For Ethereum and Polygon, it uses the the "name" field like if
name  "CondoMiniNeighborhood"  then the marketplace url would be
https://opensea.io/assets?search\[query]=CondoMiniNeighborhood

For Solana it uses the "symbol" field like
symbol  "okay_bears"   then the marketplace url would be
https://magiceden.io/marketplace/okay_bears

For these 2 networks/blockchains it uses the NFT collection name like:
Arbitrum:   https://stratosnft.io/search?query=collectionname
BSC: https://www.binance.com/en/nft/search-result?keyword=collectionname

For these, the marketplaces do not have a way for me to link to a specific search string, so instead just link to the main url of each marketplace:
Avalanche: https://joepegs.com
Celo: https://cyberbox.art
Fantom: https://paintswap.finance
Harmony:  https://madnfts.io
Optimism: https://qx.app/

======================================

Next, I want to add 3 more pages to BoredHumans.com, similar to text-to-speech. But instead of text, each of these involves use the user uploading a media file instead.
Also, none of these need a bad words filter, but they all do need the IP address limiting system.

Attached is speech-to-text.php which is to use to get started with the speech-to-text page. You will need to have a form to allow the user to upload a file instead of typing text. Once you finish it, use that as a template to create the other 2 sites, as those both have file uploads also. Use POST for the form to my API.

The biggest problem with these 3 new pages is you need to create a system for allowing users to upload the files. It is too complicated (and takes too long) to pass the actual media file to my remote API (which then would need to pass it again to the source API I use), so instead I want to upload all the photos to https://boredhumans.com/uploads/ 
You can then pass the url for it (like https://boredhumans.com/uploads/eric.jpg) to my API.
Also, after you get a result URL back from my API, automatically delete the source image from my server.

Like with text-to-image, I had my programmer create an API for each of these 3 sites.

The 3 sites are:

A) Speech-To-Text (creates a transcript of an audio file). It accepts FLAC, WAV, or MP3 files.
See demo at https://replicate.com/openai/whisper
My API is:
POST http://51.68.206.144:8010/whisper
Body should be like this :
{
 "file":"https://boredhumans.com/transcripts/audiofiles/videoplayback.mp3"
}

It will ouput a lot of info but all I want is the text, which is like this:  results.json['transcription']


B) StyleClip (you upload a photo and can change the hair color and other things)
See demo at https://replicate.com/orpatashnik/styleclip
My API is: 
POST http://51.68.206.144:8011/styleclip
{
 "file":"https://i0.wp.com/post.medicalnewstoday.com/wp-content/uploads/sites/3/2020/03/GettyImages-1092658864_hero-1024x575.jpg",
 "target": "a face with bald head"
}

The "target" is what you want to change the photo to. The ouptut will be an image url like with text-to-image.


C) Age Progression (you upload a photo and it shows what you look like younger or older) - https://replicate.com/yuval-alaluf/sam#run
See demo at https://replicate.com/yuval-alaluf/sam#run
My API is:
POST http://51.68.206.144:8012/age
{
 "file":"https://i0.wp.com/post.medicalnewstoday.com/wp-content/uploads/sites/3/2020/03/GettyImages-1092658864_hero-1024x575.jpg",
 "age": 80
}

The ouptut will be an image url like with text-to-image.

=============================

Next:

I want to add a version of Costs.ai and TopDatasets.com to BoredHumans.com, similar to what we did with text-to-image.php (and the 3 API pages you just added: TTS, Styleclip, and Age Progression). Both costs.ai and topdatasets.com are already set up to use an API from my remote server, so I am not sure you need to change that part any. I mainly need the main page for each of those to be changed to use my BoredHumans.com format. I don't want the page to be anything like what I have now at Costs.ai and TopDatasets.com, it will instead be like all these other Boredhumans.com page you have been doing for me.