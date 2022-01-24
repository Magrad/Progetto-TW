		<div class="wrapper login">
			<h1>Login</h1>
			<form action="login.php" method="POST">
                <?php if(isset($templateParams['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?=$templateParams['error']; ?>
                </div>
                <?php endif ?>
				<label for="username" class="user-label" style="font-size: 0;"> Username
					<span class="user"></span>
				</label>
				<input type="text" name="username" placeholder="Email" id="username">
				<label for="password"  class="lock-label" style="font-size: 0;"> Username
					<span class="lock"></span>
				</label>
				<input type="password" name="password" placeholder="Password" id="password">
				<input type="submit" name="submit" value="Login">
			</form>
            <div class="login-register">
                <p>Bisogno di un account?</p>
                <a href="register.php">Registrati</a>
            </div>
		</div>