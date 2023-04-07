<h1>{{ $heading }}</h1>

<?php foreach($listings as $list): ?>

    <h2><?php echo $list['title']; ?></h2>
    <p><?php echo $list['description']; ?></p>

<?php endforeach; ?>