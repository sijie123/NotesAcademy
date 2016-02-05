<?php
$str = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta name='viewport' content='width=device-width' />
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
<title>Actionable emails e.g. reset password</title>
<link href='styles.css' media='all' rel='stylesheet' type='text/css' />
</head>

<body itemscope itemtype='http://schema.org/EmailMessage'>

<table class='body-wrap'>
	<tr>
		<td></td>
		<td class='container' width='600'>
			<div class='content'>
				<table class='main' width='100%' cellpadding='0' cellspacing='0' itemprop='action' itemscope itemtype='http://schema.org/ConfirmAction'>
					<tr>
						<td class='content-wrap'>
							<meta itemprop='name' content='Confirm Email'/>
							<table width='100%' cellpadding='0' cellspacing='0'>
								<tr>
									<td class='content-block'>
										Dear ".$name.",<br>We're excited that you're on board!
									</td>
								</tr>
								<tr>
									<td class='content-block'>
										However, before you can start using NotesAcademy, we need you to confirm your email address by clicking the link below.

									</td>
								</tr>
								<tr>
									<td class='content-block' itemprop='handler' itemscope itemtype='http://schema.org/HttpActionHandler'>
										<a href='http://notesacademy.org/verify.php?code=".$code."' class='btn-primary' itemprop='url'>Confirm email address</a>
									</td>
								</tr>
								<tr>
									<td class='content-block'>
										&mdash; NotesAcademy
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class='footer'>
					<table width='100%'>
						<tr>
							<td class='aligncenter content-block'>Follow <a href='http://twitter.com/NotesAcademy'>@NotesAcademy</a> on Twitter.</td>
						</tr>
					</table>
				</div></div>
		</td>
		<td></td>
	</tr>
</table>

</body>
</html>";
?>