<div id="report" class="update">
    <h1>Update A Report</h1>
    <div>
        <?php
            echo form_open('Report/update');
            $r = (object)get_vars('record');
        ?>
            <input type="hidden" name="id" value="<?php echo $r->id; ?>" />

            <div>
                Photo: <img src="<?php echo $r->photo; ?>" />
            </div>

            <div>
                Address: <textarea name="address"><?php echo $r->address; ?></textarea>
            </div>

            <div>
                Description: <textarea name="description"><?php echo $r->description; ?></textarea>
            </div>

            <div>
                Date / Time Last Seen: <?php echo $r->datetime_last_seen; ?>
            </div>

            <div>
                Status: <?php echo view('partials/report_status', NULL, TRUE); ?>
            </div>
            <a href="<?php echo site_url('Report'); ?>" class="btn btn-default">Back</a>
            <button>Update</button>
        <?php echo form_close(); ?>
    </div>
</div>