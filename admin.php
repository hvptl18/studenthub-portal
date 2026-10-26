<?php
require_once __DIR__.'/includes/functions.php'; require_admin(); require_once __DIR__.'/config/db.php';
$message='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $action=$_POST['action']??'';
 if($action==='add_event'){
  $title=trim($_POST['title']??'');$category=trim($_POST['category']??'General');$date=$_POST['event_date']??'';$location=trim($_POST['location']??'');$description=trim($_POST['description']??'');
  if($title && $date && $location && $description){$stmt=$conn->prepare('INSERT INTO events(title,category,event_date,location,description) VALUES(?,?,?,?,?)');$stmt->bind_param('sssss',$title,$category,$date,$location,$description);$stmt->execute();$message='Event added.';}else $message='Complete all event fields.';
 }
 if($action==='delete_event'){$id=(int)($_POST['id']??0);$stmt=$conn->prepare('DELETE FROM events WHERE id=?');$stmt->bind_param('i',$id);$stmt->execute();$message='Event deleted if it existed.';}
}
$users=(int)$conn->query('SELECT COUNT(*) n FROM users')->fetch_assoc()['n'];$students=(int)$conn->query("SELECT COUNT(*) n FROM users WHERE role='student'")->fetch_assoc()['n'];$events=(int)$conn->query('SELECT COUNT(*) n FROM events')->fetch_assoc()['n'];
$eventRows=$conn->query('SELECT id,title,category,event_date,location FROM events ORDER BY event_date ASC');
$pageTitle='Admin'; require __DIR__.'/includes/header.php';
?>
<section class="dashboard-hero"><div class="container dashboard-heading"><div><p class="eyebrow">PORTAL MANAGEMENT</p><h1>Admin <em>dashboard.</em></h1><p>Manage events and review the portal at a glance.</p></div><span class="admin-badge">ADMIN ACCESS</span></div></section>
<section class="section-pad"><div class="container"><?php if($message):?><div class="flash success"><?=e($message)?></div><?php endif;?>
<div class="dashboard-stat-grid"><article class="stat-card"><small>TOTAL ACCOUNTS</small><strong><?=$users?></strong><span class="stat-note">Registered users</span></article><article class="stat-card"><small>STUDENT ACCOUNTS</small><strong><?=$students?></strong><span class="stat-note">Student role</span></article><article class="stat-card"><small>EVENTS</small><strong><?=$events?></strong><span class="stat-note">In the database</span></article></div>
<div class="admin-layout"><section class="panel"><p class="eyebrow">CREATE EVENT</p><h2>Add a campus event</h2><form method="post" class="admin-form"><input type="hidden" name="action" value="add_event"><label class="field">Event title<input name="title" required maxlength="160"></label><label class="field">Category<select name="category"><option>Workshop</option><option>Seminar</option><option>Competition</option><option>Social</option><option>General</option></select></label><label class="field">Date<input type="date" name="event_date" required></label><label class="field">Location<input name="location" required maxlength="160"></label><label class="field">Description<textarea name="description" rows="3" required></textarea></label><button class="btn btn-primary" type="submit">Add event ↗</button></form></section>
<section class="panel"><p class="eyebrow">EVENT DIRECTORY</p><h2>Current events</h2><div class="table-wrap"><table><thead><tr><th>Event</th><th>Date</th><th>Action</th></tr></thead><tbody><?php while($row=$eventRows->fetch_assoc()):?><tr><td><strong><?=e($row['title'])?></strong><small><?=e($row['category'])?> · <?=e($row['location'])?></small></td><td><?=e($row['event_date'])?></td><td><form method="post" onsubmit="return confirm('Delete this event?')"><input type="hidden" name="action" value="delete_event"><input type="hidden" name="id" value="<?=$row['id']?>"><button class="btn btn-small btn-danger" type="submit">Delete</button></form></td></tr><?php endwhile;?></tbody></table></div></section></div></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
