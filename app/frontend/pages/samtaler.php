<!-- Print messages -->
<div class="row">
    <div class="col-4">
        <div class="row mb-3">
            <h3 class="font-weight-bold col mb-0">Alle Samtaler</h3>
            <button class="btn btn-primary col-auto mr-3 rounded py-0">Start Samtale</button>
        </div>
        <!-- Search bar -->
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Søg samtale" aria-label="Søg samtale" aria-describedby="button-addon2">
            <button class="btn btn-primary type="button" id="button-addon2">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <?php foreach ($messages as $message) : ?>
            <div class="card mb-3 message-card" data-message-id="<?php echo $message->message_ID; ?>">
                <div class="card-title mb-0 rounded py-1 container" onclick="location.href='/samtaler?id=<?php echo $message->message_ID ?>'">
                    <div class="row">
                        <div class="col-auto d-flex align-items-center">
                            <!-- Round circle with either user image or initials -->
                            <div class="rounded-circle bg-primary" style="width: 40px; height: 40px;">
                                <img src="<?php echo FRONTEND_ASSET . "images/placeholder.png" ?>" class="w-100 h-100 rounded-circle">
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-truncate mb-1" style="width: 150px">
                                <a class="font-weight-bold"><?php echo $message->from->name ?></a><br>
                                <a class=""><?php echo $message->subject; ?></a>
                                <br>
                                <a class="font-italic"><?php echo $message->message; ?></a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="text-muted" style="font-size: 12px;">
                                <div class="mt-auto">
                                    <div><?php echo date('m. M', strtotime($message->date_created)); ?></div>
                                    <div><?php echo date('H:i', strtotime($message->date_created)); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-8">
        <div class="card container bg-white mb-3">
            <div class="row mt-2">
                <h3 class="col"><?php echo $selected_message->subject; ?></h3>
                <div class="col-auto">
                    <div class="text-muted" style="font-size: 15px;">
                        <div class="mt-auto">
                            <div><?php echo date('m. M Y - H:i', strtotime($message->date_created)); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <?php foreach ($selected_message->to as $to) : ?>
                    <a class="text-primary"><?php echo $to->name ?></a>
                <?php endforeach; ?>
            </div>
            <div>
                <p><?php echo $selected_message->message; ?></p>
            </div>
        </div>
        <div>
            <!-- Message bubbles as replies (like messenger) -->
            <?php foreach ($selected_message->replies as $reply) :
                if ($reply->from_uid == $user->data()->uid) : ?>
                    <div class="row justify-content-end my-2">
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <!-- Time -->
                                    <div class="text-muted" style="font-size: 15px;">
                                        <div class="mt-auto">
                                            <div><?php echo date('m. M Y - H:i', strtotime($reply->date_created)); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-muted">
                                        Dig
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-primary container">
                                <p class="card-text my-2"><?php echo $reply->message; ?></p>
                            </div>
                        </div>
                        <!-- user image -->
                        <div class="col-auto d-flex align-items-end px-0">
                            <div class="rounded-circle bg-primary" style="width: 40px; height: 40px;">
                                <img src="<?php echo FRONTEND_ASSET . "images/placeholder.png" ?>" class="w-100 h-100 rounded-circle">
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row my-2">
                        <div class="col-auto d-flex align-items-end pr-0">
                            <div class="rounded-circle bg-primary" style="width: 40px; height: 40px;">
                                <img src="<?php echo FRONTEND_ASSET . "images/placeholder.png" ?>" class="w-100 h-100 rounded-circle">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <!-- Time -->
                                    <div class="text-muted" style="font-size: 15px;">
                                        <div class="mt-auto">
                                            <div><?php echo date('m. M Y - H:i', strtotime($reply->date_created)); ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="text-muted">
                                        <?php echo $db->get('users', array('uid', '=', $reply->from_uid))->first()->name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-light container">
                                <p class="card-text my-2"><?php echo $reply->message; ?></p>
                            </div>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
    </div>
</div>

<script>
    //Make message card with same id as url selected
    let selected_message = "<?php echo $selected_message->message_ID; ?>";
    let message_cards = document.querySelectorAll('.message-card');
    message_cards.forEach(card => {
        if (card.getAttribute('data-message-id') == selected_message) {
            card.classList.add('bg-primary');
        }
    });
</script>