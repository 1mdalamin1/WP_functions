<?php
declare(strict_types=1);

$recipientEmail = '01mdalamin1@gmail.com';
$siteName = 'service24.vir-za.com';
$fromEmail = 'no-reply@service24.vir-za.com';
$smtpHost = 'service24.vir-za.com';
$smtpPort = 465;
$smtpUsername = 'no-reply@service24.vir-za.com';
$smtpPassword = 'PUT_EMAIL_ACCOUNT_PASSWORD_HERE';

function clean_text(string $value, int $maxLength = 255): string
{
    $value = trim(str_replace(["\r\n", "\r"], "\n", $value));
    $value = strip_tags($value);
    $value = preg_replace('/[ \t]+/', ' ', $value) ?? $value;

    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, $maxLength);
    }

    return substr($value, 0, $maxLength);
}

function clean_multiline(string $value, int $maxLength = 5000): string
{
    $value = trim(str_replace(["\r\n", "\r"], "\n", $value));
    $value = strip_tags($value);
    $value = preg_replace("/\n{3,}/", "\n\n", $value) ?? $value;

    if (function_exists('mb_substr')) {
        return mb_substr($value, 0, $maxLength);
    }

    return substr($value, 0, $maxLength);
}

function has_header_injection(string $value): bool
{
    return (bool) preg_match('/[\r\n]|%0a|%0d/i', $value);
}

function html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function smtp_read($socket): string
{
    $response = '';

    while (($line = fgets($socket, 515)) !== false) {
        $response .= $line;

        if (isset($line[3]) && $line[3] === ' ') {
            break;
        }
    }

    return $response;
}

function smtp_command($socket, string $command, array $expectedCodes): string
{
    fwrite($socket, $command . "\r\n");
    $response = smtp_read($socket);
    $code = (int) substr($response, 0, 3);

    if (!in_array($code, $expectedCodes, true)) {
        throw new RuntimeException(trim($response));
    }

    return $response;
}

function smtp_prepare_message(string $message): string
{
    $message = str_replace(["\r\n", "\r"], "\n", $message);
    $lines = explode("\n", $message);

    foreach ($lines as &$line) {
        if (isset($line[0]) && $line[0] === '.') {
            $line = '.' . $line;
        }
    }
    unset($line);

    return implode("\r\n", $lines);
}

function smtp_send_mail(
    string $host,
    int $port,
    string $username,
    string $password,
    string $fromEmail,
    string $fromName,
    string $toEmail,
    string $replyToEmail,
    string $replyToName,
    string $subject,
    string $body
): bool {
    if ($password === '' || $password === 'PUT_EMAIL_ACCOUNT_PASSWORD_HERE') {
        throw new RuntimeException('SMTP password is missing.');
    }

    $errno = 0;
    $errstr = '';
    $socket = stream_socket_client(
        'ssl://' . $host . ':' . $port,
        $errno,
        $errstr,
        20,
        STREAM_CLIENT_CONNECT
    );

    if ($socket === false) {
        throw new RuntimeException('SMTP connection failed: ' . $errstr);
    }

    stream_set_timeout($socket, 20);

    try {
        $response = smtp_read($socket);
        if ((int) substr($response, 0, 3) !== 220) {
            throw new RuntimeException(trim($response));
        }

        smtp_command($socket, 'EHLO ' . $host, [250]);
        smtp_command($socket, 'AUTH LOGIN', [334]);
        smtp_command($socket, base64_encode($username), [334]);
        smtp_command($socket, base64_encode($password), [235]);
        smtp_command($socket, 'MAIL FROM:<' . $fromEmail . '>', [250]);
        smtp_command($socket, 'RCPT TO:<' . $toEmail . '>', [250, 251]);
        smtp_command($socket, 'DATA', [354]);

        $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $headers = [
            'From: ' . $fromName . ' <' . $fromEmail . '>',
            'To: ' . $toEmail,
            'Reply-To: ' . $replyToName . ' <' . $replyToEmail . '>',
            'Subject: ' . $encodedSubject,
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'Content-Transfer-Encoding: 8bit',
        ];

        $message = implode("\r\n", $headers) . "\r\n\r\n" . smtp_prepare_message($body);
        smtp_command($socket, $message . "\r\n.", [250]);
        smtp_command($socket, 'QUIT', [221]);
    } finally {
        fclose($socket);
    }

    return true;
}

function render_response(bool $success, string $title, string $message, array $errors = []): void
{
    http_response_code($success ? 200 : 422);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo html($title); ?></title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>
<body>
  <main class="section light-background min-vh-100 d-flex align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <div class="info-wrap">
            <div class="info-item d-flex">
              <i class="bi <?php echo $success ? 'bi-check-circle' : 'bi-exclamation-triangle'; ?> flex-shrink-0" aria-hidden="true"></i>
              <div>
                <h1 class="h3"><?php echo html($title); ?></h1>
                <p><?php echo html($message); ?></p>
                <?php if (!$success && $errors !== []) : ?>
                  <ul>
                    <?php foreach ($errors as $error) : ?>
                      <li><?php echo html($error); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <p class="mb-0">
                  <a class="btn btn-primary" href="index.html#contact">
                    <i class="bi bi-arrow-left"></i> Back to contact form
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
    <?php
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html#contact', true, 303);
    exit;
}

$name = clean_text($_POST['name'] ?? '', 100);
$email = clean_text($_POST['email'] ?? '', 254);
$subject = clean_text($_POST['subject'] ?? '', 150);
$phone = clean_text($_POST['phone'] ?? '', 40);
$message = clean_multiline($_POST['message'] ?? '', 5000);

$errors = [];

if ($name === '') {
    $errors[] = 'Please enter your name.';
}

if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors[] = 'Please enter a valid email address.';
}

if ($subject === '') {
    $errors[] = 'Please enter a subject.';
}

if ($message === '') {
    $errors[] = 'Please enter your message.';
}

foreach ([$name, $email, $subject, $phone] as $headerValue) {
    if (has_header_injection($headerValue)) {
        $errors[] = 'Invalid characters were detected in the form.';
        break;
    }
}

if ($errors !== []) {
    render_response(false, 'Message not sent', 'Please fix the following issue and submit the form again.', $errors);
    exit;
}

$safeSubject = sprintf('[%s] %s', $siteName, $subject);
$emailBody = <<<BODY
You received a new contact form submission from {$siteName}.

Name: {$name}
Email: {$email}
Phone: {$phone}
Subject: {$subject}

Message:
{$message}

--
Submitted from: {$siteName}
IP Address: {$_SERVER['REMOTE_ADDR']}
BODY;

try {
    smtp_send_mail(
        $smtpHost,
        $smtpPort,
        $smtpUsername,
        $smtpPassword,
        $fromEmail,
        $siteName,
        $recipientEmail,
        $email,
        $name,
        $safeSubject,
        $emailBody
    );

    render_response(true, 'Message sent', 'Thank you. Your message has been sent successfully.');
    exit;
} catch (Throwable $exception) {
    error_log('Contact form SMTP error: ' . $exception->getMessage());
}

render_response(false, 'Message not sent', 'The server could not send the email right now. Please check the SMTP password and try again, or email 01mdalamin1@gmail.com directly.');
