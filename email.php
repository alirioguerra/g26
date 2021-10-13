<?php
// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$headers = "MIME-Version: 1.1\n";
$headers .= "Reply-To: $_POST['email']\n"
$headers .= "Content-type: text/plain; charset=UTF-8\n";
$headers .= "From: atendimento@ag26.com.br\n"; // remetente
$headers .= "Return-Path: atendimento@ag26.com.br\n"; // return-path
$envio = mail("atendimento@ag26.com.br", $_POST['name'], $_POST['message'], $_POST['email'], $headers);
 
if($envio)
 echo "Mensagem enviada com sucesso";
else
 echo "A mensagem não pode ser enviada";
?>