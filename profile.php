<?php
require_once __DIR__.'/includes/functions.php'; require_login(); require_once __DIR__.'/config/db.php';
$error=''; $success='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??''); $mobile=trim($_POST['mobile']??'');
 if(!preg_match("/^[\p{L}][\p{L} .'-]{1,98}$/u",$name)) $error='Enter a valid name.';
 elseif(!preg_match('/^[6-9][0-9]{9}$/',$mobile)) $error='Enter a valid 10-digit Indian mobile number.';
 else { $stmt=$conn->prepare('UPDATE users SET name=?,mobile=? WHERE id=?'); $stmt->bind_param('ssi',$name,$mobile,$_SESSION['user_id']); $stmt->execute(); $_SESSION['name']=$name; $success='Profile updated successfully.'; }
}
$stmt=$conn->prepare('SELECT name,email,mobile,course,year_level,gender,created_at FROM users WHERE id=?'); $stmt->bind_param('i',$_SESSION['user_id']); $stmt->execute(); $student=$stmt->get_result()->fetch_assoc();
$pageTitle='My Profile'; require __DIR__.'/includes/header.php';
?>
<section class="page-hero"><div class="container"><p class="eyebrow">YOUR ACCOUNT</p><h1>Your profile, <em>your space.</em></h1><p>Keep your contact information current.</p></div></section>
<section class="section-pad"><div class="container narrow-container"><div class="form-card"><div class="profile-avatar"><?=e(strtoupper(substr($student['name'],0,1)))?></div><h2><?=e($student['name'])?></h2><p class="muted"><?=e($student['email'])?></p>
<?php if($error):?><div class="form-errors"><?=e($error)?></div><?php endif;?><?php if($success):?><div class="flash success"><?=e($success)?></div><?php endif;?>
<form method="post"><label class="field">Full name<input name="name" required maxlength="100" value="<?=e($student['name'])?>"></label><label class="field">Email address<input value="<?=e($student['email'])?>" disabled><small class="field-hint">Email updates are not available in this version.</small></label><label class="field">Mobile number<input name="mobile" type="tel" inputmode="numeric" maxlength="10" required value="<?=e($student['mobile'])?>"></label><label class="field">Course<input value="<?=e($student['course'])?>" disabled></label><label class="field">Year<input value="Year <?=e((string)$student['year_level'])?>" disabled></label><button class="btn btn-primary" type="submit">Save changes ↗</button></form></div></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
