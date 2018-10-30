<?php

		session_start();
		$url = $_SESSION['defaulturl'];
		session_destroy();
		header("Location:$url");

?>