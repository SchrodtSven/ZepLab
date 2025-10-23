<?php


class CliColor
{
    public const FG_BLACK        = 1;
    public const FG_DARK_GRAY    = 2;
    public const FG_BLUE         = 3;
    public const FG_LIGHT_BLUE   = 4;
    public const FG_GREEN        = 5;
    public const FG_LIGHT_GREEN  = 6;
    public const FG_CYAN         = 7;
    public const FG_LIGHT_CYAN   = 8;
    public const FG_RED          = 9;
    public const FG_LIGHT_RED    = 10;
    public const FG_PURPLE       = 11;
    public const FG_LIGHT_PURPLE = 12;
    public const FG_BROWN        = 13;
    public const FG_YELLOW       = 14;
    public const FG_LIGHT_GRAY   = 15;
    public const FG_WHITE        = 16;

    public const BG_BLACK      = 1;
    public const BG_RED        = 2;
    public const BG_GREEN      = 3;
    public const BG_YELLOW     = 4;
    public const BG_BLUE       = 5;
    public const BG_MAGENTA    = 6;
    public const BG_CYAN       = 7;
    public const BG_LIGHT_GRAY = 8;

    public const AT_NORMAL    = 1;
    public const AT_BOLD      = 2;
    public const AT_ITALIC    = 3;
    public const AT_UNDERLINE = 4;
    public const AT_BLINK     = 5;
    public const AT_OUTLINE   = 6;
    public const AT_REVERSE   = 7;
    public const AT_NONDISP   = 8;
    public const AT_STRIKE    = 9;

    /**
     * Map of supported foreground colors
     */
    private static array $fg = [
        self::FG_BLACK        => '0;30',
        self::FG_DARK_GRAY    => '1;30',
        self::FG_RED          => '0;31',
        self::FG_LIGHT_RED    => '1;31',
        self::FG_GREEN        => '0;32',
        self::FG_LIGHT_GREEN  => '1;32',
        self::FG_BROWN        => '0;33',
        self::FG_YELLOW       => '1;33',
        self::FG_BLUE         => '0;34',
        self::FG_LIGHT_BLUE   => '1;34',
        self::FG_PURPLE       => '0;35',
        self::FG_LIGHT_PURPLE => '1;35',
        self::FG_CYAN         => '0;36',
        self::FG_LIGHT_CYAN   => '1;36',
        self::FG_LIGHT_GRAY   => '0;37',
        self::FG_WHITE        => '1;37',
    ];

    /**
     * Map of supported background colors
     */
    private static array $bg = [
        self::BG_BLACK      => '40',
        self::BG_RED        => '41',
        self::BG_GREEN      => '42',
        self::BG_YELLOW     => '43',
        self::BG_BLUE       => '44',
        self::BG_MAGENTA    => '45',
        self::BG_CYAN       => '46',
        self::BG_LIGHT_GRAY => '47',
    ];

    /**
     * Map of supported attributes
     */
    private static array $at = [
        self::AT_NORMAL    => '0',
        self::AT_BOLD      => '1',
        self::AT_ITALIC    => '3',
        self::AT_UNDERLINE => '4',
        self::AT_BLINK     => '5',
        self::AT_OUTLINE   => '6',
        self::AT_REVERSE   => '7',
        self::AT_NONDISP   => '8',
        self::AT_STRIKE    => '9',
    ];

    /**
     * Identify if console supports colors
     */
    public static function isSupportedShell(): bool
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI') || 'xterm' === getenv('TERM');
        }

        return defined('STDOUT') && function_exists('posix_isatty') && posix_isatty(STDOUT);
    }

    /**
     * Colorizes the string using provided colors.
     */
    public static function colorize(string $string, ?int $fg = null, ?int $at = null, ?int $bg = null): string
    {
        // Shell not supported, exit early
        if (!static::isSupportedShell()) {
            return $string;
        }

        $colored = '';

        // Check if given foreground color is supported
        if (isset(static::$fg[$fg])) {
            $colored .= "\033[" . static::$fg[$fg] . "m";
        }

        // Check if given background color is supported
        if (isset(static::$bg[$bg])) {
            $colored .= "\033[" . static::$bg[$bg] . "m";
        }

        // Check if given attribute is supported
        if (isset(static::$at[$at])) {
            $colored .= "\033[" . static::$at[$at] . "m";
        }

        // Add string and end coloring
        $colored .= $string . "\033[0m";

        return $colored;
    }

    public static function head(string $msg): string
    {
        return CliColor::colorize($msg, CliColor::FG_BROWN);
    }

    /**
     * Color style for error messages.
     */
    public static function error(string $msg, string $prefix = 'Error: '): string
    {
        $msg   = $prefix . $msg;
        $space = self::tabSpaces($msg);
        $out   = static::colorize(str_pad(' ', $space), CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_RED) . PHP_EOL;
        $out   .= static::colorize('  ' . $msg . '  ', CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_RED) . PHP_EOL;
        $out   .= static::colorize(str_pad(' ', $space), CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_RED) . PHP_EOL;

        return $out;
    }

    /**
     * Color style for fatal error messages.
     */
    public static function fatal(string $msg, string $prefix = 'Fatal Error: '): string
    {
        $msg   = $prefix . $msg;
        $space = self::tabSpaces($msg);
        $out   = static::colorize(str_pad(' ', $space), CliColor::FG_LIGHT_GRAY, CliColor::AT_BOLD, CliColor::BG_RED) . PHP_EOL;
        $out   .= static::colorize('  ' . $msg . '  ', CliColor::FG_LIGHT_GRAY, CliColor::AT_BOLD, CliColor::BG_RED) . PHP_EOL;
        $out   .= static::colorize(str_pad(' ', $space), CliColor::FG_LIGHT_GRAY, CliColor::AT_BOLD, CliColor::BG_RED) . PHP_EOL;

        return $out;
    }

    /**
     * Color style for success messages.
     */
    public static function success(string $msg): string
    {
        $msg   = 'Success: ' . $msg;
        $space = self::tabSpaces($msg);
        $out   = static::colorize(str_pad(' ', $space), CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_GREEN) . PHP_EOL;
        $out   .= static::colorize('  ' . $msg . '  ', CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_GREEN) . PHP_EOL;
        $out   .= static::colorize(str_pad(' ', $space), CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_GREEN) . PHP_EOL;

        return $out;
    }

    /**
     * Color style for info messages.
     */
    public static function info(string $msg): string
    {
        $msg   = 'Info: ' . $msg;
        $space = self::tabSpaces($msg);
        $out   = static::colorize(str_pad(' ', $space), CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_BLUE) . PHP_EOL;
        $out   .= static::colorize('  ' . $msg . '  ', CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_BLUE) . PHP_EOL;
        $out   .= static::colorize(str_pad(' ', $space), CliColor::FG_WHITE, CliColor::AT_BOLD, CliColor::BG_BLUE) . PHP_EOL;

        return $out;
    }

    /**
     * Output tab space
     *
     * Depending on length of string.
     */
    protected static function tabSpaces(string $string, int $tabSize = 4): int
    {
        return strlen($string) + $tabSize;
    }
}
