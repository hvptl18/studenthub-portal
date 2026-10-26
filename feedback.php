<?php
require_once __DIR__.'/includes/functions.php'; require_once __DIR__.'/config/db.php';
$error='';$sent=false;
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??'');$email=strtolower(trim($_POST['email']??''));$message=trim($_POST['message']??'');
 if(mb_strlen($name)<2||mb_strlen($name)>100)$error='Enter a name between 2 and 100 characters.';
 elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))$error='Enter a valid email.';
 elseif(mb_strlen($message)<10||mb_strlen($message)>3000)$error='Message must be between 10 and 3000 characters.';
 else {$uid=is_logged_in()?(int)$_SESSION['user_id']:null;$stmt=$conn->prepare('INSERT INTO feedback(user_id,name,email,message) VALUES(?,?,?,?)');$stmt->bind_param('isss',$uid,$name,$email,$message);$stmt->execute();$sent=true;}
}
$pageTitle='Feedback';require __DIR__.'/includes/header.php';
?>
<section class="page-hero"><div class="container"><p class="eyebrow">MAKE IT BETTER</p><h1>Your feedback <em>matters.</em></h1><p>Tell us what works and what could be improved.</p></div></section>
<section class="section-pad"><div class="container narrow-container"><div class="form-card"><?php if($sent):?><div class="success-illustration">✓</div><h2>Thanks for sharing.</h2><p>Your feedback has been saved.</p><a class="btn btn-primary" href="index.php">Back home</a><?php else:?>
<?php if($error):?><div class="form-errors" role="alert"><?=e($error)?></div><?php endif;?>
<form method="post"><label class="field">Your name<input name="name" required maxlength="100" value="<?=e($_SESSION['name']??'')?>"></label><label class="field">Email address<input type="email" name="email" required value="<?=e($_SESSION['email']??'')?>"></label><label class="field">Your message<textarea name="message" rows="6" required minlength="10" maxlength="3000" placeholder="Tell us a little more..."><?=e($_POST['message']??'')?></textarea></label><button class="btn btn-primary" type="submit">Send feedback ↗</button></form><?php endif;?></div></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
