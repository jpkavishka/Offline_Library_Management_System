<?php

//profile.php

include 'database_connection.php';
include 'link.php';
include 'function.php';

if(!is_user_login())
{
	header('location:user_login.php');
}

$message = '';

$success = '';

if(isset($_POST['save_button']))
{
	$formdata = array();

	if(empty($_POST['user_email_address']))
	{
		$message .= '<li>Email Address is required</li>';
	}
	else
	{
		if(!filter_var($_POST["user_email_address"], FILTER_VALIDATE_EMAIL))
		{
			$message .= '<li>Invalid Email Address</li>';
		}
		else
		{
			$formdata['user_email_address'] = trim($_POST['user_email_address']);
		}
	}

	if(empty($_POST['user_password']))
	{
		$message .= '<li>Password is required</li>';
	}
	else
	{
		$formdata['user_password'] = trim($_POST['user_password']);
	}

	if(empty($_POST['user_name']))
	{
		$message .= '<li>User Name is required</li>';
	}
	else
	{
		$formdata['user_name'] = trim($_POST['user_name']);
	}

	if(empty($_POST['user_address']))
	{
		$message .= '<li>User Address Detail is required</li>';
	}
	else
	{
		$formdata['user_address'] = trim($_POST['user_address']);
	}

	if(empty($_POST['user_contact_no']))
	{
		$message .= '<li>User Address Detail is required</li>';
	}
	else
	{
		$formdata['user_contact_no'] = $_POST['user_contact_no'];
	}

	$formdata['user_profile'] = $_POST['hidden_user_profile'];

	if(!empty($_FILES['user_profile']['name']))
	{
		$img_name = $_FILES['user_profile']['name'];
		$img_type = $_FILES['user_profile']['type'];
		$tmp_name = $_FILES['user_profile']['tmp_name'];
		$fileinfo = @getimagesize($tmp_name);
		$width = $fileinfo[0];
		$height = $fileinfo[1];
		$image_size = $_FILES['user_profile']['size'];
		$img_explode = explode(".", $img_name);
		$img_ext = strtolower(end($img_explode));
		$extensions = ["jpeg", "png", "jpg"];
		if(in_array($img_ext, $extensions))
		{
			if($image_size <= 2000000)
			{
				if($width == 225 && $height == 225)
				{
					$new_img_name = time() . '-' . rand() . '.'  . $img_ext;

					if(move_uploaded_file($tmp_name, "upload/" . $new_img_name))
					{
						$formdata['user_profile'] = $new_img_name;
					}
				}
				else
				{
					$message .= '<li>Image dimension should be within 225 X 225</li>';
				}
			}
			else
			{
				$message .= '<li>Image size exceeds 2MB</li>';
			}
		}
		else
		{
			$message .= '<li>Invalid Image File</li>';
		}
	}

	if($message == '')
	{
		$data = array(
			':user_name'			=>	$formdata['user_name'],
			':user_address'			=>	$formdata['user_address'],
			':user_contact_no'		=>	$formdata['user_contact_no'],
			':user_profile'			=>	$formdata['user_profile'],
			':user_email_address'	=>	$formdata['user_email_address'],
			':user_password'		=>	$formdata['user_password'],
			':user_updated_on'		=>	get_date_time($connect),
			':user_unique_id'		=>	$_SESSION['user_id']
		);

		$query = "
		UPDATE lms_user 
            SET user_name = :user_name, 
            user_address = :user_address, 
            user_contact_no = :user_contact_no, 
            user_profile = :user_profile, 
            user_email_address = :user_email_address, 
            user_password = :user_password, 
            user_updated_on = :user_updated_on 
            WHERE user_unique_id = :user_unique_id
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		$success = 'Data Change Successfully';
	}
}


$query = "
	SELECT * FROM lms_user 
	WHERE user_unique_id = '".$_SESSION['user_id']."'
";

$result = $connect->query($query);

include 'header.php';

?>

<style>
		body {
		background-image: url('https://t3.ftcdn.net/jpg/05/68/43/60/360_F_568436096_0xNtFx8C7290cH9Al6m3sjH8eQpoKHGC.jpg');
		background-repeat: no-repeat;
		background-size: cover;
	}

	.card {
		background-color: rgba(255, 255, 255, 0.8); /* Transparent background */
	}

	.form-label {
		font-weight: bold;
		color: black;
	}

	.form-control {
		border-radius: 5px;
	}

	.btn-primary {
		background-color: black;
		border: none;
		color: white;
	}

	.btn-primary:hover {
		background-color: #333;
	}
	.name_row{
		display: flex;
		justify-content: space-between;
		flex-direction: row;
	}

</style>

<div class="d-flex align-items-center justify-content-center mt-5 mb-5" style="max-height: 700px;">
    <div class="col-md-6">
        <?php 
        if ($message != '') {
            echo '<div class="alert alert-danger"><ul>'.$message.'</ul></div>';
        }

        if ($success != '') {
            echo '<div class="alert alert-success">'.$success.'</div>';
        }
        ?>
        <div class="card">
            <div class="card-header">PROFILE</div>
            <div class="card-body">
                <?php foreach ($result as $row) { ?>
					<form method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="mb-3">
				<label class="form-label">EMAIL ADDRESS</label>
				<input type="text" name="user_email_address" id="user_email_address" class="form-control" value="<?php echo $row['user_email_address']; ?>" />
			</div>
		</div>
		<div class="col-md-6">
			<div class="mb-3">
				<label class="form-label">PASSWORD</label>
				<input type="password" name="user_password" id="user_password" class="form-control" value="<?php echo $row['user_password']; ?>" />
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="mb-3">
				<label class="form-label">USER NAME</label>
				<input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo $row['user_name']; ?>" />
			</div>
		</div>
		<div class="col-md-6">
			<div class="mb-3">
				<label class="form-label">USER CONTACT NUMBER</label>
				<input type="text" name="user_contact_no" id="user_contact_no" class="form-control" value="<?php echo $row['user_contact_no']; ?>" />
			</div>
		</div>
	</div>
	<div class="row">
			<div class="col-md-6">
				<div class="mb-3">
					<label class="form-label">USER ADDRESS</label>
					<textarea name="user_address" id="user_address" class="form-control"><?php echo $row['user_address']; ?></textarea>
				</div>
			</div>
			<div class="col-md-6">
				<div class="mb-3">
					<label class="form-label">USER PHOTO</label><br />
					<input type="file" name="user_profile" id="user_profile" />
					<br />
					<span class="text-muted">Only .jpg & .png images allowed. Image size must be 225 x 225</span>
					<br />
					<input type="hidden" name="hidden_user_profile" value="<?php echo $row['user_profile']; ?>" />
					<img src="upload/<?php echo $row['user_profile']; ?>" width="100" class="img-thumbnail" />
				</div>
			</div>
		</div>
	<div class="text-center mt-4 mb-1">
		<input type="submit" name="save_button" class="btn btn-primary" value="Save" />
	</div>
</form>

                <?php } ?>
            </div>
        </div>
    </div>
</div>

