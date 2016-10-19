<div id="report" class="update">
    <h3>Update a report</h3>
    <div>
        <?php
            echo form_open('Report/update');
            $r = (object)get_vars('record');
        ?>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $r->id; ?>" />

                <div>
                    <!--
                        Do not change photo of how the kitten was originally found.
                        If there are plans to upload a photo, file a new Report instead.
                    -->
                    <?php
                        $photo = $r->photo;
                        if(!empty($photo))
                        {
                            echo '<img src="' . base_url($r->photo) . '" class="photo" />';
                        }
                        else
                        {
                            echo '<strong>No photo</strong>';
                        }
                    ?>
                </div>

                <div>
                    <label for="">Address:</label>
                    <textarea class="form-control input-sm" name="address"><?php echo $r->address; ?></textarea>
                </div>

                <div>
                    <label for="">Description:</label>
                    <textarea class="form-control input-sm" name="description"><?php echo $r->description; ?></textarea>
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
                    <?php echo view('partials/reports/status', NULL, TRUE); ?>
                </div>

                <div>
                    <a href="<?php echo site_url('Report/read/' . $r->id); ?>" class="btn btn-danger btn-sm">Back</a>
                    <button class="btn btn-primary btn-sm">Update</button>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>