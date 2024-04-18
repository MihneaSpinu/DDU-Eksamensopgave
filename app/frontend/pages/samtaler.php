<!-- Print messages -->
<div class="row">
    <div class="col-12 col-lg-4 col-md-4">
        <div class="row mb-3">
            <h3 class="font-weight-bold col mb-0">Alle Samtaler</h3>
            <div class="col-auto mt-auto">
            <button class="btn btn-primary rounded py-0" onclick="clickOverlay('create_message')">Start samtale</button>
            </div>
        </div>
        <!-- Search bar -->
        <?php if ($message_id) : ?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Søg samtale" aria-label="Søg samtale" aria-describedby="button-addon2">
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
                        <!-- CREATE A WAY TO SEE UNREAD MESSAGE -->
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            Ingen Samtaler
        <?php endif; ?>
    </div>
    <?php if ($selected_message) : ?>
        <div class="col-12 col-md-8 d-flex flex-column">
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
                        <a class="text-primary"><?php echo $to->name ?>, </a>
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
                                <div class="card bg-secondary container">
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
                                    <div class="col-6">
                                        <!-- Time -->
                                        <div class="text-muted" style="font-size: 15px;">
                                            <div class="mt-auto">
                                                <div><?php echo date('m. M Y - H:i', strtotime($reply->date_created)); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted text-truncate">
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
            <div class="row mt-auto">
                <div class="col">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Skriv besked" name="reply">
                            <input type="hidden" name="csrf_token" value="<?php echo $token = Token::generate('reply_form'); ?>">
                            <input class="btn btn-primary px-3" type="submit" value="Svar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="create_message" class="overlay">
    <div class="overlay-content">
        <div class="close" onclick="clickOverlay('create_message')">X</div>
        <h3>Start samtale</h3>
        <form action="" method="post">
            <select class="form-select w-100 rounded mb-2" name="select_users[]" multiple>
                <?php foreach ($users as $user) : ?>
                    <!-- Option with border left. Border color primary if user_type_id == 1, else red -->
                    <option value="<?php echo $user->uid; ?>" class="ml-1" style="border-left: 3px solid <?php echo $user->user_type_ID == 1 ? 'blue' : 'red'; ?>"><?php echo $user->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" class="form-control w-100 rounded mb-2" placeholder="Emne" name="subject">
            <textarea class="form-control w-100 rounded mb-2" placeholder="Besked" style="height: 150px;" name="message"></textarea>
            <input type="hidden" name="csrf_token" value="<?php echo $token = Token::generate('send_message_form'); ?>">
            <input class="btn btn-primary rounded-pill px-3" type="submit" value="Send">
        </form>
    </div>
</div>

<script>
    //Make message card with same id as url selected
    let selected_message = "<?php echo $selected_message->message_ID; ?>";
    let message_cards = document.querySelectorAll('.message-card');
    message_cards.forEach(card => {
        if (card.getAttribute('data-message-id') == selected_message) {
            card.classList.add('bg-secondary');
        }
    });
</script>