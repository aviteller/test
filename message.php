<?php

require_once 'core/init.php';
include('includes/header.php');

$user = new User();


$db = DB::getInstance();




$project_id = $_GET['project_id'];

$db->get('project', array('id', '=', $project_id));
$assoc = $db->first();

$hi = explode(',', $assoc->assoc_id);


$users = array();
foreach ($hi as $d){
    $db->query("SELECT * FROM users WHERE id = '". $d ."'");
    $users[] = $db->first();
}


/*print_r($users);
die();
*/

if (Input::exists()) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'title' => array(
                'name' => 'title',
                'required' => true,
                'min' => 2,
                'max' => 50,
            ),
            'message' => array(
                'name' => 'message',
                'required' => true,
                'min' => 2,
                'max' => 200,
            ),
        ));

        if ($validate->passed()) {


            try {
                $db->insert('message', array(
                    'user_id' => $user->data()->id,
                    'author' => $user->data()->username,
                    'title' => Input::get('title'),
                    'message' => Input::get('message'),
                    'project_id' => $project_id,
                ));


                foreach ($users as $d) {
   
                   $to      =   $d->email;
                    $subject = Input::get('title'). ' project id is -x-'.$project_id.'-x-';
                    $message = Input::get('message'). 'this is the project number xx('.$project_id.')xx the user posting is is'. $user->data()->username;
                    $headers = 'mailbox@devps.exceedit.co.uk' . "\r\n" .
                        'Reply-To: mailbox@devps.exceedit.co.uk' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject, $message, $headers);
                }





                Redirect::to('message.php?project_id='.$project_id);
            } catch(Exception $e) {
                echo $error, '<br>';
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . "<br>";
            }
        }
    
}


get_email('mailbox@devps.exceedit.co.uk', 'nlKy43%1', '{mail.premium2.uk.plesk-server.com:993/imap/ssl}');




$db->get('message', array('project_id', '=', $project_id));
$messages = $db->results();
?>

<a href="project.php"> back to projects</a>

<div class="container" style="padding-top: 30px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="border:1px black solid;">
<form action="" method="post">
<div class="form-group">
            <label for="title">author</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="name">
          </div>
          <div class="form-group">
            <label for="message">message</label>
            <textarea class="form-control" name="message" id="message" cols="30" rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-default">Submit</button>

</form>

                <?php foreach ($messages as $d): ?>
                    <h3><?php echo $d->author; ?></h3>
                    <em><?php echo $d->title; ?></em>
                    <br>
                    <span><?php echo $d->message; ?></span>
                    <hr>
                <?php endforeach ?>
            </div>
</div>
</div>
</div>

