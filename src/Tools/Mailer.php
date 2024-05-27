<?php

	declare(strict_types=1);
	namespace EasyAI\Tools;

	class Mailer
	{
		/**
		 * send an email
		 */
		public function sendMail(string $subject, string $body, string $email): string
		{
			/* TODO:  Adding email sending functionality with SMTP */
			return 'The email has been sent to '.$email.' with the subject '.$subject.' and the body '.$body.'.';
		}
	}