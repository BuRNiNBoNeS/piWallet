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
		<header>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php"><?=$fullname?> Wallet</a>
						<?php
						if (!empty($_SESSION['user_session']))
						{?>
								<p class="navbar-text"><?php echo $lang['WALLET_HELLO'];?> <strong><?php echo $user_session;?></strong>!</p>
								<p class="navbar-text"><?php echo $lang['WALLET_BALANCE'];?><strong id="balance"><?php echo satoshitize($balance);?></strong><?php echo $short;?></p>
						<?php }?>
					</div>
					<ul class="nav navbar-nav navbar-right">
								<?php
								if(empty($_SESSION['user_session']))
								{ ?>
										<li class="button">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $lang['FORM_LOGIN'];?></a>
											<ul class="dropdown-menu">
													<div class="row">
														<div class="col-md-12">
															<form action="index.php" method="post" class="clearfix">
																<div class="form-group">
																	<input type="text" class="form-control" name="username" placeholder=<?php echo $lang['FORM_USER'];?>>
																</div>
																<div class="form-group">
																	<input type="password" class="form-control" name="password" placeholder=<?php echo $lang['FORM_PASS'];?>>
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" name="auth" placeholder=<?php echo $lang['FORM_2FA'];?>>
																</div>
																<li role="separator" class="divider"></li>
																<div class="form-group">
																	<input type="hidden" name="action" value="login" />
																	<input type="submit" class="btn btn-outline-primary" value="<?php echo $lang['FORM_LOGIN'];?>" />
																</div>
															</form>
														</div>
													</div>
												</li>
											</ul>
										</li>
										<li class="button">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $lang['FORM_CREATE'];?></a>
											<ul class="dropdown-menu">
													<div class="row">
														<div class="col-md-12">
															<form action="index.php" method="post" class="clearfix">
																<div class="form-group">
																	<input type="text" class="form-control" name="username" placeholder="<?php echo $lang['FORM_USER'];?>">
																</div>
																<div class="form-group">
																	<input type="password" class="form-control" name="password" placeholder="<?php echo $lang['FORM_PASS'];?>">
																</div>
																<div class="form-group">
																	<input type="text" class="form-control" name="confirmPassword" placeholder="<?php echo $lang['FORM_PASSCONF'];?>">
																</div>
																<li role="separator" class="divider"></li>
																<div class="form-group">
																	<input type="hidden" name="action" value="register" />
																	<input type="submit" class="btn btn-outline-primary" value="<?php echo $lang['FORM_LOGIN'];?>"/>
																</div>
															</form>
														</div>
													</div>
												</li>
											</ul>
										</li>
								<?php } ?>
								<?php							
								if(!empty($_SESSION['user_session']))
								{?>
									<li class="dropdown">
										<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-tasks"></a>
										<ul class="dropdown-menu">
											<li role="separator" class="divider"></li>
											<?php
											if($twoFAenabled) 
											{?>
												<form action="index.php" method="post">
												<form>
													<input type="hidden" name="action" value="disauth" />
													<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_2FAOFF']; ?></button>
												</form>
											<?php }
											else
											{?>
												<form action="index.php" method="post">
												<form>
													<input type="hidden" name="action" value="authgen" />
													<button type="submit" class="btn btn-default"><?php echo $lang['WALLET_2FAON']; ?></button>
												</form>
											<?php }?>
											<li role="separator" class="divider"></li>
											Support Key: <?php echo $_SESSION['user_supportpin'];?>
											<li role="separator" class="divider"></li>
											<li>
												<form action="index.php" method="post">
													<input type="hidden" name="action" value="logout" />
													<input type="submit" class="btn btn-outline-primary" value="<?php echo $lang['WALLET_LOGOUT'];?>"/>
													<!--<a href="" type="button" class="btn btn-default" data-toggle="modal" data-target="#logoutModal"><?php echo $lang['WALLET_LOGOUT'];?> <span class="glyphicon glyphicon-log-out"></a>-->
												</form>
											</li>
										</ul>
									</li>
								<?php } ?>
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
		</header>
		<?php
                if (!empty($error))
                {
                    echo "<p style='font-weight: bold; color: red;'>" . $error['message']; "</p>";
                }
        ?>
		<?php
		if (empty($_SESSION['user_session']))
		{?>
		<div class="jumbotron">
    		<div  class="container">
			<img class="img-responsive" src="<?= $coin_banner ?>">
            </div>
        </div>
		<?php } ?>	
		<footer>
			<div class="psuedoFooter">
				<b>
					<center>
						<p>Powered by <a href="http://github.com/burninbones/piWallet">piWallet</a></p>
					</center>
				</b>
			</div>
		</footer>
    </body>
</html>