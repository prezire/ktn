<div id="report" class="update">
    <h1>Update A Kitten Report</h1>
    <div>
        <?php
            echo form_open('Report/update');
            $r = (object)get_vars('record');
        ?>
            <input type="hidden" name="id" value="<?php echo $r->id; ?>" />

            <div>
                <!-- 
                    Do not change photo of how the kitten was originally found.
                    If there are plans to upload a photo, file a new Report instead.
                -->
                Photo: <img src="<?php echo base_url($r->photo); ?>" class="photo" />
            </div>

            <div>
                Address: <textarea name="address"><?php echo $r->address; ?></textarea>
            </div>

            <div>
                Description: <textarea name="description"><?php echo $r->description; ?></textarea>
            </div>

            <div>
                Date / Time Last Seen: 
                <?php 
                    use Carbon\Carbon;
                    $lastSeen = new Carbon($r->datetime_last_seen);
                    $now = Carbon::now();
                    $diff = $lastSeen->diff($now)->days < 1
                        ? 'today'
                        : $lastSeen->diffForHumans($now);
                    echo $diff;
                ?>
            </div>

            <div>
                Status: <?php echo view('partials/report_status', NULL, TRUE); ?>
            </div>
            <a href="<?php echo site_url('Report'); ?>" class="btn btn-default">Back</a>
            <button>Update</button>
        <?php echo form_close(); ?>
    </div>
</div>