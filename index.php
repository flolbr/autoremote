<?php
$urlAutoRm = "http://autoremotejoaomgcd.appspot.com/sendmessage";
$key = ""; // Insert some default autoremote public key here (DO NOT insert one if this page is public on your server)

if (!empty($_GET['msg'])) {
    $url = $urlAutoRm."?key=".$_GET['key']."&message=".$_GET['msg'];
    echo json_encode( array( "url"=>$url,"answer"=> file_get_contents($url)) ); 
    die();
}

?>


<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Send to AutoRemote</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form class="form-signin" role="form" id="searchform">
            <h2 class="form-signin-heading">Envoyez vos commandes à AutoRemote</h2>
            <input type="text" name="key" id="key" class="form-control" placeholder="Public Key..." value="<?php echo $key ?>" required>
            <input type="text" name="message" id="message" class="form-control" placeholder="Mesage à envoyer" required autofocus>
            <input type="submit" name="btn_send" id="btn_send" class="btn btn-lg btn-primary btn-block" value="Envoyer" onclick="SendRequest();">
            <!-- <input type="button" name="btn_send" id="btn_send" class="btn btn-lg btn-primary btn-block" value="Envoyer" onclick="SendRequest();"> -->
        </form>
          <div class="form-signin">
              <hr>
              <p id="url"></p>
              <p id="answer"></p>
          </div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
    <script type="text/javascript">
        //function SendRequest() {
        $('#searchform').submit(function(event) {
            event.preventDefault();
            $('#url').empty();
            $('#answer').empty();
            var msg = $('#message').val();
            $.get( "./", {
                            key : $('#key').val(),
                            msg : encodeURIComponent(msg)
                        }) 
                .done(function( data ) {
                    var dataJSON = JSON.parse(data);
                    console.log(data);
                    $('#url').append("URL: <a href=\"" + dataJSON.url + "\">" + dataJSON.url + "</a>");
                    $('#answer').append("Answer: " + dataJSON.answer);
            });
        });
        // }
    </script>
</body>
</html>
