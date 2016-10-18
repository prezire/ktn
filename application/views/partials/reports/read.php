<div id="report" class="read">
    <h3>Filed Report</h3>
    <div>
        <hr />
        <?php $r = (object)get_vars('record'); ?>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $r->id; ?>" />
                    <img src="<?php echo base_url($r->photo); ?>" class="photo" />
                </div>

                <div>
                    <label for="">Address:</label>
                    <?php echo $r->address; ?>
                </div>

                <div>
                    <label for="">Description:</label>
                    <?php echo $r->description; ?>
                </div>

                <div>
                    <label for="">Date / Time Last Seen:</label>
                    <?php
                        use Carbon\Carbon;
                        $lastSeen = new Carbon($r->datetime_last_seen);
                        $now = Carbon::now();
                        $diff = $lastSeen->diff($now)->days < 1
                            ? 'today'
                            : $lastSeen->diffForHumans($now);
                        echo ucfirst($diff);
                    ?>
                </div>

                <div>
                    <label for="">Status:</label>
                    <?php echo $r->status; ?>
                </div>

                <div>
                    <a href="<?php echo site_url('Report'); ?>" class="btn btn-danger btn-sm">Back</a>
                    <a href="<?php echo site_url('Report/update/' . $r->id); ?>" class="btn btn-primary btn-sm">Update</a>
                </div>

                <!-- TODO: Link to Map. -->

            </div>
    </div>
</div>