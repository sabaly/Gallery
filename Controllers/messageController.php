<?php

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'tmssam47@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/emailForm.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new EmailForm($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
  $contact->ajax = true;
  
  $contact->_to = $receiving_email_address;

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */
  
  $contact->add_message();
  /*
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);
  */
  echo $contact->send();
?>
