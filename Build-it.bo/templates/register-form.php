		<div class="wrapper register">
			<h1>Registrati</h1>
			<form action="register.php" method="POST">
                <?php if(isset($templateParams['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?=$templateParams['error']; ?>
                </div>
                <?php endif; ?>
				<?php if(isset($templateParams['success']) && !isset($templateParams['error'])): ?>
                <div class="alert alert-success" role="alert">
                    <?=$templateParams['success']; ?>
                </div>
                <?php endif; ?>
				<div class="div-box">
					<p class="register-p">USERNAME</p> <p class="required">*</p>
					<label for="username" style="font-size: 0;">Username<input type="text" name="username" placeholder="IlTuoUsername" id="username"></label>
				</div>
				<div class="div-box">
					<p class="register-p">EMAIL</p> <p class="required">*</p>
					<label for="email" style="font-size: 0;">Email<input type="text" name="email" placeholder="esempio@gmail.com" id="email"></label>
				</div>
				<div class="div-box">
					<p class="register-p">PASSWORD</p> <p class="required">*</p>
					<label for="password" style="font-size: 0;">Password<input type="password" name="password" placeholder="Password" id="password"></label>
				</div>
				<div class="div-box">
					<p class="register-p">VERIFICA PASSWORD</p> <p class="required">*</p>
					<label for="verify-password" style="font-size: 0;">Verifica password<input type="password" name="verify-password" placeholder="Conferma Password" id="verify-password"></label>
				</div>
				<label for="submit" style="font-size: 0;">Registrati<input type="submit" id="submit" name="submit" value="Registrati"></label>
				<div class="g-recaptcha" data-sitekey="6Lfq5r4dAAAAAEt8iYuflb4PiNmYbcLkyaRXPX4M"></div>
			</form>
            <div class="login-register">
                <p>Hai già un account?</p>
                <a href="login.php">Login</a>
            </div>
		</div>