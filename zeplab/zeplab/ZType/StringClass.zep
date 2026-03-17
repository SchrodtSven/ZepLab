/**
 * Class managing OOP API to string contents
 * - check
 * - manipulate
 * - split
 * - ...
 * 
 * 
 * @since 2026-03-17
 * @author Sven Schrodt
 */

namespace ZepLab\ZType;

class StringClass
{
    protected cont; // string content of current instance

    public function __construct(string cont = "")
    {
        let this->cont = cont;
    }

    public function __toString() -> string
    {
        return this->cont;
    }

    public function has(string needle)
    {
        return str_contains(this->cont, needle);
    }

    public function begins(string needle) -> bool
    {
        return str_starts_with(this->cont, needle);
    }

    public function ends(string needle) -> bool
    {
        return str_ends_with(this->cont, needle);
    }

    public function append(string txt) 
    {
        let this->cont = this->cont . txt;
        return this;
    }

    public function prepend(string txt) 
    {
        let this->cont = txt . this->cont;
        return this;
    }

    public function splitBy(string sep = " ") -> array
    {
        return explode(sep, this->cont);
    }


}



