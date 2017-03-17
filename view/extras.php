		<!-- Modals -->
		<!-- LogIn Modal -->
		<div id="loginModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $lang['FORM_LOGIN'];?></h4>
					</div>
					<div class="modal-body">
						<form method="POST" action="index.php" class="clearfix">
						<input type="hidden" name="action" value="login" />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control" name="username" placeholder=<?php echo $lang['FORM_USER'];?>>
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="password" placeholder=<?php echo $lang['FORM_PASS'];?>>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="auth" placeholder=<?php echo $lang['FORM_2FA'];?>>
									</div>
								</div>
							</div>
							<button type="button" class="btn btn-default" href="" onclick="document.forms[0].submit();return false;"><?php echo $lang['FORM_LOGIN'];?> <span class="glyphicon glyphicon-log-in"></button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- LogOut Modal -->
		<div id="logoutModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $lang['WALLET_LOGOUT'];?>?</h4>
					</div>
					<!--<div class="modal-body">
						<p>Are you sure?</p>
					</div>-->
					<div class="modal-footer">
						<input type="hidden" name="action" value="logout" />
						<button type="button" class="btn btn-default" href="" onclick="document.forms[0].submit();return false;"><?php echo $lang['WALLET_LOGOUT'];?> <span class="glyphicon glyphicon-log-out"></button>
					</div>
				</div>
			</div>
		</div>

		<!-- Register Modal -->
		<div id="registerModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $lang['FORM_SIGNUP'];?></h4>
					</div>
					<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="text" class="form-control" name="username" placeholder=<?php echo $lang['FORM_USER'];?>>
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="password" placeholder=<?php echo $lang['FORM_PASS'];?>>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="confirmPassword" placeholder=<?php echo $lang['FORM_PASSCONF'];?>>
									</div>
								</div>
							</div>
						<form method="POST" action="index.php" class="clearfix">
						<input type="hidden" name="action" value="register" />
							<button type="button" class="btn btn-default" id="submit"><?php echo $lang['FORM_SIGNUP'];?> <span class="glyphicon glyphicon-check"></button>
						</form>
					</div>
				</div>
			</div>
		</div>

				<!-- LogOut Modal -->
		<div id="successModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Worked</h4>
					</div>
					<!--<div class="modal-body">
						<p>Are you sure?</p>
					</div>-->
					<div class="modal-footer">
						<input type="hidden" name="action" value="logout" />
						<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-log-out"></button>
					</div>
				</div>
			</div>
		</div>