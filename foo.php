<?php

declare(strict_types=1);
/**
 * Testing $foo
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/ZepLab
 * @package ZepLab
 * @version 0.1
 * @since 2026-03-27
 */



//$tokens = token_get_all(file_get_contents('src/test.php'));

$tokens = PhpToken::tokenize(file_get_contents('src/test.php'));



//var_dump($tokens);

foreach ($tokens as $token) {
    printf(
        "Token %s [%s] (ln:%s pos:%s) %s %s",
        $token->getTokenName(),
        $token->id,
        $token->line,
        $token->pos,
        $token->text,
        PHP_EOL
    );
}
