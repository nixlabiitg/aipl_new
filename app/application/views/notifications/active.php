<div class="page-content bottom-content">
    <div class="container">
        <?php $this->load->view('messages'); ?>
        <div class="page-content">
            <div class="container profile-area pb-0">
                <?php
                    $i=0;
                    foreach ($NOTIFICATIONS as $notification) {
                ?>
                <div class="notification">
                    <div class="notification-content">
                        <small class="mb-1">Added on : <?= date('d M Y', strtotime($notification['ad'])) ?></small>
                        <div class="text-notify"><?=$notification['notification'] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>