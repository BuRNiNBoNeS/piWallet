<?php if (!defined("IN_WALLET")) { die("Auth Error!"); } ?>
<!DOCTYPE HTML>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content=""> 
        <!-- Bootstrap include stuff -->
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/wallet.css" rel="stylesheet">
		<link href="assets/css/languages.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- End Bootstrap include stuff-->
        <title><?=$fullname?> Wallet</title>
        <link rel="shortcut icon" href="favicon.ico">
    </head>
    
    
    <body>
        <nav class="navbar navbar-default">
			<div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php"><?=$fullname?> Wallet</a>
					<?php 
					if (!empty($_SESSION['user_session']))
					{
						echo "<p class=\"navbar-text\">".$lang['WALLET_HELLO']."<strong> ". $user_session."</strong>!</p>";
						echo "<p class=\"navbar-text\">".$lang['WALLET_BALANCE']."<strong id=\"balance\">".satoshitize($balance)."</strong>".$short."</p>";
					}
					?>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href"" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Language<span class="caret"></span></a>
						<ul class="dropdown-menu" >
							<li>
								<a href="index.php?lang=en">
									<span class="lang-sm lang-lbl" lang="en"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=grc">
									<span class="lang-sm lang-lbl" lang="el"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=zho">
									<span class="lang-sm lang-lbl" lang="zh"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=ita">
									<span class="lang-sm lang-lbl" lang="it"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=por">
									<span class="lang-sm lang-lbl" lang="pt"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=hin">
									<span class="lang-sm lang-lbl" lang="hi"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=spa">
									<span class="lang-sm lang-lbl" lang="es"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=tgl">
									<span class="lang-sm"></span>Tagalog
								</a>
							</li>
							<li>
								<a href="index.php?lang=rus">
									<span class="lang-sm lang-lbl" lang="ru"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=nld">
									<span class="lang-sm lang-lbl" lang="nl"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=fra">
									<span class="lang-sm lang-lbl" lang="fr"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=deu">
									<span class="lang-sm lang-lbl" lang="de"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=tur">
									<span class="lang-sm lang-lbl" lang="tr"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=vie">
									<span class="lang-sm lang-lbl" lang="vi"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=jpn">
									<span class="lang-sm lang-lbl" lang="ja"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=kor">
									<span class="lang-sm lang-lbl" lang="ko"></span>
								</a>
							</li>
							<li>
								<a href="index.php?lang=ara">
									<span class="lang-sm lang-lbl" lang="ar"></span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div><!-- /.container-fluid -->
        </nav>
<div class="jumbotron" style="background-image: #007f7f;">
    <div  class="container">
