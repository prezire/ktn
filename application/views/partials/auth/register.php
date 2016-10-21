<div id="auth" class="register">
    <h3>Register</h3>
    <?php echo form_open('Auth/register'); ?>
        <div class="form-group">
            <div>
                Email: <input type="email" name="email" class="form-control" />
            </div>
            <div>
                Password: <input type="password" name="password" class="form-control" />
            </div>
            <div>
                <a href="<?php echo site_url('Auth/login'); ?>">Back</a>
                <button class="btn btn-primary btn-register">Register</button>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>