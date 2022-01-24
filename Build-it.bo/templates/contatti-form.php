            <?php if(isUserLoggedIn()) $user_id = $_SESSION['user_id'];?>
            <div class="wrapper contacts-wrapper">
                <h1>Contatti</h1>
                <div class="admins">
                    <p>Admin:</p>
                    <p>Andrea Micheli</p>
                    <p>Email:</p>
                    <a href="mailto:andrea.micheli3@studio.unibo.it?subject=Richiesta_<?php echo isset($user_id) ? $user_id : "NaN"; ?>">andrea.micheli3@studio.unibo.it</a>
                    <p>Altri link:</p>
                    <a href="https://github.com/Magrad">GitHub</a>
                </div>
            </div>