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
    <link href="assets/css/ekko-lightbox.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.6.0/moment.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/ekko-lightbox.js"></script>
    <!-- End Bootstrap include stuff-->
    <title>
      <?=$fullname?> Wallet</title>
    <link rel="shortcut icon" href="favicon.ico">
  </head>

  <body>
    <header>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <a class="navbar-brand" href="index.php">
              <?=$fullname?> Wallet</a>
            <?php
if (!empty($_SESSION['user_session']))
{?>
              <p class="navbar-text">
                <?php echo $lang['WALLET_HELLO'];?> <strong><?php echo $user_session;?></strong>!</p>
              <p class="navbar-text">
                <?php echo $lang['WALLET_BALANCE'];?><strong id="balance"><?php echo satoshitize($balance);?></strong>
                  <?php echo $short;?>
              </p>
              <?php }?>
          </div>
          <ul class="nav navbar-nav navbar-right">
            <?php
if(empty($_SESSION['user_session']))
{ ?>
              <li class="button">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?php echo $lang['FORM_LOGIN'];?>
                </a>
                <ul class="dropdown-menu">
                  <div class="row">
                    <div class="col-md-12">
                      <form action="index.php" method="post" class="clearfix">
                        <div class="form-group">
                          <input type="text" class="form-control" name="username" placeholder=<?php echo $lang[ 'FORM_USER'];?>>
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control" name="password" placeholder=<?php echo $lang[ 'FORM_PASS'];?>>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="auth" placeholder=<?php echo $lang[ 'FORM_2FA'];?>>
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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?php echo $lang['FORM_CREATE'];?>
                </a>
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
                          <input type="submit" class="btn btn-outline-primary" value="<?php echo $lang['FORM_LOGIN'];?>" />
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
                      <?php
    if ($admin)
    { ?>
                        <!--<p><strong>Admin Links:</strong></p>-->
                        <li role="separator" class="divider"></li>
                        <form action="index.php" method="POST">
                          <a href="?a=body" class="btn btn-default">Admin Dashboard</a>
                        </form>
                        <?php } ?>
                          <li role="separator" class="divider"></li>
                          <?php
    if($twoFAenabled)
    {?>
                            <form id="deauth" action="index.php" method="post">
                              <form>
                                <input type="hidden" name="action" value="disauth" />
                                <button type="submit" class="btn btn-default">
                                  <?php echo $lang['WALLET_2FAOFF']; ?>
                                </button>
                              </form>
                              <?php }
    else
    {?>
                                <form id="addauth" action="index.php" method="post">
                                  <form>
                                    <input type="hidden" name="action" value="authgen" />
                                    <button type="submit" class="btn btn-default">
                                      <?php echo $lang['WALLET_2FAON']; ?>
                                    </button>
                                  </form>
                                  <?php }?>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                      <button type="button" class="btn btn-default" id="updatePass" data-toggle="modal" data-target="#passwordModal">
                                        <?php echo $lang['WALLET_PASSUPDATE']; ?>
                                      </button>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                      Support Key:
                                      <?php echo $_SESSION['user_supportpin'];?>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                      <button type="button" class="open-sendDialog btn btn-default" id="donate" data-toggle="modal" data-target="#sendModal" data-address="<?=$donation_address?>">Donate</button>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                      <form action="index.php" method="post">
                                        <input type="hidden" name="action" value="logout" />
                                        <input type="submit" class="btn btn-outline-primary" value="<?php echo $lang['WALLET_LOGOUT'];?>" />
                                        <!--<a href="" type="button" class="btn btn-default" data-toggle="modal" data-target="#logoutModal"><?php echo $lang['WALLET_LOGOUT'];?> <span class="glyphicon glyphicon-log-out"></a>-->
                                      </form>
                                    </li>
                    </ul>
                  </li>
                  <?php } ?>
                    <li class="dropdown">
                      <a href "" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Language<span class="caret"></span></a>
                      <ul class="dropdown-menu">
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
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
    <?php
if (empty($_SESSION['user_session']))
{?>
      <div class="jumbotron">
        <div class="container">
          <img class="img-responsive" src="<?= $coin_banner ?>">
        </div>
      </div>
      <?php } ?>
        <?php
if(!empty($_SESSION['user_session']) && !$admin_action)
{?>
          <div id="walletControls">
            <button type="button" class="open-sendDialog btn btn-default" id="send" data-toggle="modal" data-target="#sendModal" data-address="">
              <?php echo $lang['WALLET_SEND']; ?>
            </button>
            <br>
            <br>
            <form action="index.php" method="POST" id="newaddressform">
              <input type="hidden" name="action" value="new_address" />
              <button type="submit" class="btn btn-default">
                <?php echo $lang['WALLET_NEWADDRESS']; ?>
              </button>
            </form>
            <p id="newaddressmsg"></p>
          </div>
          <?php
    if(!empty($addressList))
    { ?>
            <p><strong><?php echo $lang['WALLET_USERADDRESSES']; ?></strong></p>
            <table class="table table-bordered table-striped" id="alist">
              <thead>
                <tr>
                  <td>
                    <?php echo $lang['WALLET_ADDRESS']; ?>:</td>
                  <td>
                    <?php echo $lang['WALLET_QRCODE']; ?>:</td>
                </tr>
              </thead>
              <tbody>
                <?php
        foreach ($addressList as $address)
        {
            echo "<tr><td>".$address."</t>";?>
                  <td><a href="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $address?>" data-toggle="lightbox" data-type="image">
            <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl=<?php echo $address?>" alt="QR Code" style="width:42px;height:42px;border:0;"></td></tr>
            <?php
        } ?>
        </tbody>
        </table>
    <?php }?>
    
    <?php
    if(!empty($transactionList))
    {  ?>
        <p><?php echo $lang['WALLET_LAST10']; ?></p>
        <table class="table table-bordered table-striped" id="txlist">
        <thead>
        <tr>
        <td nowrap><?php echo $lang['WALLET_DATE']; ?></td>
        <td nowrap><?php echo $lang['WALLET_ADDRESS']; ?></td>
        <td nowrap><?php echo $lang['WALLET_TYPE']; ?></td>
        <td nowrap><?php echo $lang['WALLET_AMOUNT']; ?></td>
        <td nowrap><?php echo $lang['WALLET_FEE']; ?></td>
        <td nowrap><?php echo $lang['WALLET_CONFS']; ?></td>
        <td nowrap><?php echo $lang['WALLET_INFO']; ?></td>
        </tr>
        </thead>
        <tbody>
        <?php
        $bold_txxs = "";
        foreach($transactionList as $transaction) {
            if($transaction['category']=="send") { $tx_type = '<b style="color: #FF0000;">Sent</b>'; } else { $tx_type = '<b style="color: #01DF01;">Received</b>'; }
            echo '<tr>
            <td>'.date('n/j/Y h:i a',$transaction['time']).'</td>
            <td>'.$transaction['address'].'</td>
            <td>'.$tx_type.'</td>
            <td>'.abs($transaction['amount']).'</td>
            <td>'.$transaction['fee'].'</td>
            <td>'.$transaction['confirmations'].'</td>
            <td><a href="' . $blockchain_url,  $transaction['txid'] . '" target="_blank">Info</a></td>
                  </tr>'; } } ?>
              </tbody>
            </table>
            <?php } ?>
<<<<<<< HEAD
              <footer>
                <div class="psuedoFooter">
                  <b>
=======
<footer>
<div class="psuedoFooter">
	<b>
>>>>>>> c324cfae186a75893ca3a11e3e41f58a400022c1
    <center>
    <p>Powered by <a href="http://github.com/burninbones/piWallet">piWallet</a></p>
    </center>
    </b>
                </div>
                <?php if($gen) { ?>
                  <script type="text/javascript">
                    $('#genModal').modal('show');
                  </script>
                  <?php } ?>
              </footer>

              <!-- authGen Modal -->
              <div id="addauthModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">*Please write key down and keep in a secure area*</h4>
                    </div>
                    <div class="modal-body">
                      <p>
                        <?= $gen ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- deAuth Modal -->
              <div id="deauthModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Two Factor Disabled</h4>
                    </div>
                    <div class="modal-body">
                      <p>
                        <?= $deauth ?>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- SendCoins Modal -->
              <div id="sendModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><?php echo $lang['WALLET_SEND']; ?></h4>
                    </div>
                    <div class="modal-body">
                      <form action="index.php" method="POST" class="clearfix" id="withdrawform">
                        <input type="hidden" name="action" value="withdraw" />
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                        <div class="col-md-6">
                          <input type="text" class="form-control" name="address" id="address" placeholder="<?php echo $lang['WALLET_ADDRESS']; ?>">
                        </div>
                        <div class="col-md-4">
                          <input type="text" class="form-control" name="amount" id="amount" placeholder="<?php echo $lang['WALLET_AMOUNT']; ?>">
                        </div>
                        <div class="col-md-4">
                          <button type="submit" class="btn btn-default">
                            <?php echo $lang['WALLET_SENDCONF']; ?>
                          </button>
                        </div>
                      </form>
                      <p id="withdrawmsg"></p>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="action" value="logout" />
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- PasswordUpdate Modal -->
              <div id="passwordModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title"><?php echo $lang['WALLET_PASSUPDATE']; ?></h4>
                    </div>
                    <div class="modal-body">
                      <form action="index.php" method="POST" class="clearfix" id="pwdform">
                        <input type="hidden" name="action" value="password" />
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                        <div class="col-md-2">
                          <input type="password" class="form-control" name="oldpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATEOLD']; ?>">
                        </div>
                        <div class="col-md-2">
                          <input type="password" class="form-control" name="newpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEW']; ?>">
                        </div>
                        <div class="col-md-2">
                          <input type="password" class="form-control" name="confirmpassword" placeholder="<?php echo $lang['WALLET_PASSUPDATENEWCONF']; ?>">
                        </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-default">
                            <?php echo $lang['WALLET_PASSUPDATECONF']; ?>
                          </button>
                        </div>
                      </form>
                      <p id="pwdmsg"></p>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="action" value="logout" />
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
  </body>

<<<<<<< HEAD
  <script type="text/javascript">
    var blockchain_url = "<?=$blockchain_url?>";
    $("#withdrawform input[name='action']").first().attr("name", "jsaction");
    $("#newaddressform input[name='action']").first().attr("name", "jsaction");
    $("#pwdform input[name='action']").first().attr("name", "jsaction");
    $(document).on("click", ".open-sendDialog", function() {
      var sendAddress = $(this).data('address');
      $(".modal-body #address").val(sendAddress);
      $(".modal-body #amount").val("0.01");
    });

    $("#donate").click(function(e) {
      //$("#sendModal").modal('show');
      $(".modal-body #address").val("<?=$donation_address?>");
      $(e.currentTarget).find("input[name='amount']").val("0.01");
    });

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox();
    });

    <?php if($gen) { ?>
    $(document).ready(function() {
      $('#addauthModal').modal('show');
    });
    <?php } ?>

    <?php if($deauth) { ?>
    $(document).ready(function() {
      $('#deauthModal').modal('show');
    });
    <?php } ?>

    $("#withdrawform").submit(function(e) {
      var postData = $(this).serializeArray();
      var formURL = $(this).attr("action");
      $.ajax({
        url: formURL,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
          var json = $.parseJSON(data);
          if (json.success) {
            $("#withdrawform input.form-control").val("");
            $("#withdrawmsg").text(json.message);
            $("#withdrawmsg").css("color", "green");
            $("#withdrawmsg").show();
            updateTables(json);
          } else {
            $("#withdrawmsg").text(json.message);
            $("#withdrawmsg").css("color", "red");
            $("#withdrawmsg").show();
          }
          if (json.newtoken) {
            $('input[name="token"]').val(json.newtoken);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          //ugh, gtfo
        }
      });
      e.preventDefault();
    });
    $("#newaddressform").submit(function(e) {
      var postData = $(this).serializeArray();
      var formURL = $(this).attr("action");
      $.ajax({
        url: formURL,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
          var json = $.parseJSON(data);
          if (json.success) {
            $("#newaddressmsg").text(json.message);
            $("#newaddressmsg").css("color", "green");
            $("#newaddressmsg").show();
            location.reload();
            updateTables(json);
          } else {
            $("#newaddressmsg").text(json.message);
            $("#newaddressmsg").css("color", "red");
            $("#newaddressmsg").show();
          }
          if (json.newtoken) {
            $('input[name="token"]').val(json.newtoken);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          //ugh, gtfo
        }
      });
      e.preventDefault();
    });
    $("#pwdform").submit(function(e) {
      var postData = $(this).serializeArray();
      var formURL = $(this).attr("action");
      $.ajax({
        url: formURL,
        type: "POST",
        data: postData,
        success: function(data, textStatus, jqXHR) {
          var json = $.parseJSON(data);
          if (json.success) {
            $("#pwdform input.form-control").val("");
            $("#pwdmsg").text(json.message);
            $("#pwdmsg").css("color", "green");
            $("#pwdmsg").show();
          } else {
            $("#pwdmsg").text(json.message);
            $("#pwdmsg").css("color", "red");
            $("#pwdmsg").show();
          }
          if (json.newtoken) {
            $('input[name="token"]').val(json.newtoken);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          //ugh, gtfo
        }
      });
      e.preventDefault();
    });

    function updateTables(json) {
      $("#balance").text(json.balance.toFixed(8));
      $("#alist tbody tr").remove();
      for (var i = json.addressList.length - 1; i >= 0; i--) {
        $("#alist tbody").prepend("<tr><td>" + json.addressList[i] + "</td></tr>");
      }
      $("#txlist tbody tr").remove();
      for (var i = json.transactionList.length - 1; i >= 0; i--) {
        var tx_type = '<b style="color: #01DF01;">Received</b>';
        if (json.transactionList[i]['category'] == "send") {
          tx_type = '<b style="color: #FF0000;">Sent</b>';
        }
        $("#txlist tbody").prepend('<tr> \
            <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
            <td>' + json.transactionList[i]['address'] + '</td> \
            <td>' + tx_type + '</td> \
            <td>' + Math.abs(json.transactionList[i]['amount']) + '</td> \
            <td>' + json.transactionList[i]['fee'] + '</td> \
            <td>' + json.transactionList[i]['confirmations'] + '</td> \
            <td><a href="' + blockchain_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
            </tr>');
      }
    }
  </script>
=======
      <script type="text/javascript">
      var blockchain_url = "<?=$blockchain_url?>";
      $("#withdrawform input[name='action']").first().attr("name", "jsaction");
      $("#newaddressform input[name='action']").first().attr("name", "jsaction");
      $("#pwdform input[name='action']").first().attr("name", "jsaction");
      $(document).on("click", ".open-sendDialog", function () {
		var sendAddress = $(this).data('address');
		$(".modal-body #address").val( sendAddress );
		$(".modal-body #amount").val("0.01");
	  });
	  
	  $("#donate").click(function(e) {
        //$("#sendModal").modal('show');
        $(".modal-body #address").val("<?=$donation_address?>");
        $(e.currentTarget).find("input[name='amount']").val("0.01");
      });

      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
      });

      <?php if($gen) { ?>
      $(document).ready(function() {
        $('#addauthModal').modal('show');
      });
      <?php } ?>

      <?php if($deauth) { ?>
      $(document).ready(function() {
        $('#deauthModal').modal('show');
      });
      <?php } ?>

      $("#withdrawform").submit(function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
          url: formURL,
          type: "POST",
          data: postData,
          success: function(data, textStatus, jqXHR) {
            var json = $.parseJSON(data);
            if (json.success) {
              $("#withdrawform input.form-control").val("");
              $("#withdrawmsg").text(json.message);
              $("#withdrawmsg").css("color", "green");
              $("#withdrawmsg").show();
              updateTables(json);
            } else {
              $("#withdrawmsg").text(json.message);
              $("#withdrawmsg").css("color", "red");
              $("#withdrawmsg").show();
            }
            if (json.newtoken) {
              $('input[name="token"]').val(json.newtoken);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            //ugh, gtfo
          }
        });
        e.preventDefault();
      });
      $("#newaddressform").submit(function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
          url: formURL,
          type: "POST",
          data: postData,
          success: function(data, textStatus, jqXHR) {
            var json = $.parseJSON(data);
            if (json.success) {
              $("#newaddressmsg").text(json.message);
              $("#newaddressmsg").css("color", "green");
              $("#newaddressmsg").show();
              updateTables(json);
            } else {
              $("#newaddressmsg").text(json.message);
              $("#newaddressmsg").css("color", "red");
              $("#newaddressmsg").show();
            }
            if (json.newtoken) {
              $('input[name="token"]').val(json.newtoken);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            //ugh, gtfo
          }
        });
        e.preventDefault();
      });
      $("#pwdform").submit(function(e) {
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax({
          url: formURL,
          type: "POST",
          data: postData,
          success: function(data, textStatus, jqXHR) {
            var json = $.parseJSON(data);
            if (json.success) {
              $("#pwdform input.form-control").val("");
              $("#pwdmsg").text(json.message);
              $("#pwdmsg").css("color", "green");
              $("#pwdmsg").show();
            } else {
              $("#pwdmsg").text(json.message);
              $("#pwdmsg").css("color", "red");
              $("#pwdmsg").show();
            }
            if (json.newtoken) {
              $('input[name="token"]').val(json.newtoken);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            //ugh, gtfo
          }
        });
        e.preventDefault();
      });

      function updateTables(json) {
        $("#balance").text(json.balance.toFixed(8));
        $("#alist tbody tr").remove();
        for (var i = json.addressList.length - 1; i >= 0; i--) {
          $("#alist tbody").prepend("<tr><td>" + json.addressList[i] + "</td></tr>");
        }
        $("#txlist tbody tr").remove();
        for (var i = json.transactionList.length - 1; i >= 0; i--) {
          var tx_type = '<b style="color: #01DF01;">Received</b>';
          if (json.transactionList[i]['category'] == "send") {
            tx_type = '<b style="color: #FF0000;">Sent</b>';
          }
          $("#txlist tbody").prepend('<tr> \
        <td>' + moment(json.transactionList[i]['time'], "X").format('l hh:mm a') + '</td> \
        <td>' + json.transactionList[i]['address'] + '</td> \
        <td>' + tx_type + '</td> \
        <td>' + Math.abs(json.transactionList[i]['amount']) + '</td> \
        <td>' + json.transactionList[i]['fee'] + '</td> \
        <td>' + json.transactionList[i]['confirmations'] + '</td> \
        <td><a href="' + blockchain_url.replace("%s", json.transactionList[i]['txid']) + '" target="_blank">Info</a></td> \
        </tr>');
        }
      }
    </script>
>>>>>>> c324cfae186a75893ca3a11e3e41f58a400022c1

  </html>