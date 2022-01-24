        <?php
            if(isUserLoggedIn()) $permissions = $templateParams['permissions'][0]['permissions']; 
            if(isset($templateParams['admin-notifications'])) $notifications = $templateParams['admin-notifications'];
        ?>
        <div class="main-wrapper" id="result">
        </div>
        <?php if(isUserLoggedIn()): ?>
            <div id="toast">
            </div>
        <?php endif; ?>