<?php

    declare(strict_types=1);

    // Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
    function redireccionar(string $url)
    {
        header("Location: $url");
        exit;
    }

?>