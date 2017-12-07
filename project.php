<?php 
require_once 'core/init.php';
require_once 'includes/header.php';


$user = new User();


$db = DB::getInstance();


$db->get('users', array('deleted', '=', '0'));
$users = $db->results();


if (Input::exists()) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'title' => array(
                'name' => 'title',
                'required' => true,
                'min' => 2,
                'max' => 50,
            ),
        ));

        if ($validate->passed()) {


            try {
                $db->insert('project', array(
                    'owner_id' => $user->data()->id,
                    'title' => Input::get('title'),
                    'assoc_id' => implode(',', Input::get('assoc_id')),
                ));

                
/*

                $to      = implode(',', $users->email);
                $subject = Input::get('title');
                $message = Input::get('message');
                $headers = 'From: aviteller2@gmail.com' . "\r\n" .
                    'Reply-To: aviteller2@gmail.com.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);

*/


                Redirect::to('project.php');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
        } else {
            foreach ($validate->errors() as $error) {
                echo $error . "<br>";
            }
        }
    
}

$db->get('project', array('deleted', '=', '0'));
$projects = $db->results();



 ?>


 <div class="container" style="padding-top: 30px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="border:1px black solid;">
			<form action="" method="post">
			<div class="form-group">
		            <label for="title">project title</label>
		            <input type="text" class="form-control" id="title" name="title" placeholder="name">
		          </div>
		          <?php foreach ($users as $key): ?>
		          	
		          <input type="checkbox" name="assoc_id[]" value="<?php echo $key->id; ?>"><?php echo $key->username; ?>
		          <?php endforeach ?>
		          <button type="submit" class="btn btn-default">Submit</button>

			</form>

                <?php foreach ($projects as $d): ?>
                	<div>
					<a href="message.php?project_id=<?php echo $d->id; ?>"><?php echo $d->title; ?></a>
					<hr>
					</div>
                <?php endforeach ?>
            </div>
</div>
</div>
</div>
