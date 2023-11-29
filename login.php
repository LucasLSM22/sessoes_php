<?php
//Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Recebe os dados do formulário
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Inicia a sessão
	session_start();

	// Armazena os dados do usuário na sessão
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $password;

	// Redireciona para a página de boas-vindas
	header('Location: telavotacao.php');
	exit;
} ?>