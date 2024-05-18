
<?php
session_start();
include('config/conection.php');
include('models/functions.php');
include('views/fixed/head.php');
include('views/fixed/header.php');
include('views/fixed/menu.php');
if (isset($_GET['page'])) {

	switch ($_GET['page']) {
		case 'home':
			include('views/pages/home.php');
			break;
		case 'about':
			include('views/pages/about.php');
			break;
		case 'contact':
			include('views/pages/contact.php');
			break;
		case 'single':
			include('views/pages/single_post.php');
			break;
		case 'registration':
			include('views/pages/registrations_view.php');
			break;
		case 'adminPanel':
			include('views/pages/adminPanel.php');
			break;
		case 'userPanel':
			include('views/pages/userPanel.php');
			break;
		case 'edit':
			include('views/pages/edit.php');
			break;
	}
} else {
	include('views/pages/home.php');
}



include('views/fixed/footer.php');

include('views/fixed/scripts.php');
?>

