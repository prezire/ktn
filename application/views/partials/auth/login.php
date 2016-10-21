<div id="auth" class="login">
    <h3>Login</h3>
    <?php echo form_open('Auth/login'); ?>
        <div class="form-group">
            <div>
                Email: <input type="email" name="email" class="form-control" />
            </div>
            <div>
                Password: <input type="password" name="password" class="form-control" />
            </div>
            <div>
                <button class="btn btn-primary btn-login">Login</button>
                <a href="<?php echo site_url('Auth/register'); ?>">Register</a>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>