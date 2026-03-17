/**
 * Class managing OOP API to string conts
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
    protected cont; // string cont of current instance

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

     public function trim(string characters = null, enc = null)
    {
         
        let this->cont = mb_trim(this->cont, characters, enc);
        return this;
    }

    public function toUpper()
    {
        let this->cont = strtoupper(this->cont);
        return this;
    }

    public function upperFirst()
    {
        let this->cont = ucfirst(this->cont);
        return this;
    }

    public function subString(int start, int length=0)
    {
        return new self(mb_substr(this->cont, start, length));
    }
    
    public function quote(string sign ="'")
    {
        this->prepend(sign)->append(sign);
        return this;
    }

    public function parseQuery(string query) -> array
    {
        // mb_parse_str(string $string, array &$result): bool

        array tmp = [];
        mb_parse_str(query, tmp);
        return tmp;
    }

}



