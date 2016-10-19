<div id="auth" class="login">
    <h3>Login</h3>
    <?php echo form_open('Auth/login'); ?>
        <div>
            Email: <input type="email" name="email" />
        </div>
        <div>
            Password: <input type="password" name="password" />
        </div>
        <div>
            <button class="btn btn-primary btn-login">Login</button>
            <a href="<?php echo site_url('Auth/register'); ?>">Register</a>
        </div>
    <?php echo form_close(); ?>
</div>