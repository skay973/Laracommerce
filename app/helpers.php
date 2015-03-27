<?php

Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('escape_quotes');

    return preg_replace($pattern, '$1<?php echo addslashes($2) ?>', $view);
});

Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('get_cents');

    return preg_replace($pattern, '$1<?php echo $2*100 ?>', $view);
});
