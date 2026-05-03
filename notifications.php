<?php
include 'connection.php';
?>

<?php
include 'desk-navigation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Usage Notifications</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; padding: 20px; }
        .notification-card {
            background: white;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header { background: #3498db; color: white; padding: 15px; font-weight: bold; }
        .list-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }
        .list-item:hover { background: #f9f9f9; }
        .list-item.unread { border-left: 4px solid #3498db; }
        .item-title { font-weight: bold; display: block; }
        .meta { font-size: 0.85em; color: #777; margin-top: 5px; }
    </style>
</head>
<body>

<div class="notification-card">
    <div class="header">Item Usage Alerts</div>
    
    <?php if (empty($notifications)): ?>
        <div class="list-item">No recent activity.</div>
    <?php else: ?>
        <?php foreach ($notifications as $note): ?>
            <div class="list-item <?php echo $note['status']; ?>">
                <span class="item-title">
                    <strong><?php echo htmlspecialchars($note['item_name']); ?></strong> was used.
                </span>
                <div class="meta">
                    By <?php echo htmlspecialchars($note['user_name']); ?> • 
                    <?php echo date('M j, g:i a', strtotime($note['usage_time'])); ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>