<?php
require_once __DIR__.'/includes/functions.php';
require_once __DIR__.'/config/db.php';
if (is_logged_in()) redirect('dashboard.php');
$errors=[];
$name=$email=$mobile=$course=$gender='';
$year_level='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $mobile=trim($_POST['mobile']??'');
  $password=$_POST['password']??''; $confirm=$_POST['confirm_password']??''; $course=trim($_POST['course']??'');
  $year_level=(string)($_POST['year_level']??''); $gender=trim($_POST['gender']??'');
  if (!preg_match("/^[\p{L}][\p{L} .'-]{1,98}$/u",$name)) $errors[]='Enter a valid name (at least 2 letters).';
  if (!filter_var($email,FILTER_VALIDATE_EMAIL)) $errors[]='Enter a valid email address.';
  if (!preg_match('/^[6-9][0-9]{9}$/',$mobile)) $errors[]='Enter a valid 10-digit Indian mobile number.';
  if (strlen($password)<8 || !preg_match('/[A-Za-z]/',$password) || !preg_match('/[0-9]/',$password)) $errors[]='Password must be at least 8 characters and include a letter and a number.';
  if ($password!==$confirm) $errors[]='Password and confirm password do not match.';
  if ($course==='') $errors[]='Select your course.';
  if (!in_array($year_level,['1','2','3','4'],true)) $errors[]='Select your year.';
  if (!in_array($gender,['Female','Male','Non-binary','Prefer not to say'],true)) $errors[]='Select a gender option.';
  if (empty($_POST['terms'])) $errors[]='You must accept the terms to continue.';
  if (!$errors) {
    $check=$conn->prepare('SELECT id FROM users WHERE email=?'); $check->bind_param('s',$email); $check->execute();
    if ($check->get_result()->num_rows) $errors[]='An account with this email already exists.';
    else {
      $hash=password_hash($password,PASSWORD_DEFAULT);
      $stmt=$conn->prepare('INSERT INTO users(name,email,mobile,password_hash,course,year_level,gender) VALUES(?,?,?,?,?,?,?)');
      $year=(int)$year_level; $stmt->bind_param('sssssis',$name,$email,$mobile,$hash,$course,$year,$gender); $stmt->execute();
      set_flash('Account created successfully. You can now sign in.'); redirect('login.php');
    }
  }
}
$pageTitle='Registration'; require __DIR__.'/includes/header.php';
?>
<section class="form-page"><div class="container form-layout"><div class="form-intro"><p class="eyebrow">WELCOME TO THE COMMUNITY</p><h1>Your next chapter starts <em>here.</em></h1><p>Create your StudentHub account to access your dashboard, keep your profile updated and discover campus events.</p><div class="form-benefit"><span>✓</span><div><strong>One student account</strong><small>Your details and campus activities in one place.</small></div></div><div class="form-benefit"><span>✳</span><div><strong>Built for your journey</strong><small>Helpful features with a clean, responsive interface.</small></div></div></div>
<div class="form-card"><div class="form-card-heading"><h2>Create account</h2><p>Fields marked * are required.</p></div>
<?php if ($errors): ?><div class="form-errors" role="alert"><strong>Please check the following:</strong><ul><?php foreach($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form id="registrationForm" method="post" action="register.php" novalidate>
<div class="form-grid"><label class="field field-full">Full name *<input name="name" id="name" type="text" autocomplete="name" value="<?=e($name)?>" required minlength="2" maxlength="100" placeholder="e.g. Aanya Patel"><small class="field-error" data-for="name"></small></label>
<label class="field">Email address *<input name="email" id="email" type="email" autocomplete="email" value="<?=e($email)?>" required placeholder="you@example.com"><small class="field-error" data-for="email"></small></label>
<label class="field">Mobile number *<input name="mobile" id="mobile" type="tel" inputmode="numeric" autocomplete="tel" value="<?=e($mobile)?>" required maxlength="10" placeholder="10-digit mobile"><small class="field-error" data-for="mobile"></small></label>
<label class="field">Password *<input name="password" id="password" type="password" autocomplete="new-password" required minlength="8" placeholder="At least 8 characters"><small class="field-hint">Use at least 8 characters, with letters and numbers.</small><small class="field-error" data-for="password"></small></label>
<label class="field">Confirm password *<input name="confirm_password" id="confirm_password" type="password" autocomplete="new-password" required placeholder="Enter password again"><small class="field-error" data-for="confirm_password"></small></label>
<label class="field">Course *<select name="course" id="course" required><option value="">Choose course</option><?php foreach(['B.Tech Computer Science','B.Tech Information Technology','BCA','MCA','Other'] as $c): ?><option <?= $course===$c?'selected':'' ?>><?=e($c)?></option><?php endforeach; ?></select><small class="field-error" data-for="course"></small></label>
<label class="field">Year of study *<select name="year_level" id="year_level" required><option value="">Choose year</option><?php for($i=1;$i<=4;$i++): ?><option value="<?=$i?>" <?= $year_level===(string)$i?'selected':'' ?>>Year <?=$i?></option><?php endfor; ?></select><small class="field-error" data-for="year_level"></small></label>
<fieldset class="field field-full gender-field"><legend>Gender *</legend><div class="radio-row"><?php foreach(['Female','Male','Non-binary','Prefer not to say'] as $g): ?><label><input type="radio" name="gender" value="<?=e($g)?>" <?= $gender===$g?'checked':'' ?>> <?=e($g)?></label><?php endforeach; ?></div><small class="field-error" data-for="gender"></small></fieldset>
<label class="terms-check field-full"><input type="checkbox" name="terms" id="terms" value="1" <?=isset($_POST['terms'])?'checked':''?>> <span>I agree to the portal terms and responsible use policy. *</span></label><small class="field-error field-full" data-for="terms"></small>
</div><button class="btn btn-primary btn-wide" type="submit">Create my account <span>↗</span></button><p class="form-switch">Already registered? <a href="login.php">Sign in</a></p>
</form></div></div></section>
<?php require __DIR__.'/includes/footer.php'; ?>
