/**
 * Class managing OOP API to lists (zero based int indexed arrays)
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

class ListClass implements \Countable, \ArrayAccess, \Iterator
{
    protected cont; // content of current instance

    protected pos = 0;  // current position of list element

    public function __construct(array cont = [])
    {
        if(array_is_list(cont)) {
            let this->cont = cont;
        } else {
            let this->cont = array_values(cont);
        }
    }

    public function raw() -> array
    {
        return this->cont;
    }

    // Implementing \Countable
    public function count() -> int
    {
        return count(this->cont);
    }

    // Implementing \ArrayAccess 

    public function offsetSet(offs, value) -> void 
    {
        if (is_null(offs)) {
            let this->cont[] = value;
        } else {
            let this->cont[offs] = value;
        }
    }

    public function offsetExists(offs) -> bool 
    {
        return isset(this->cont[offs]);
    }

    public function offsetUnset(offs) -> void 
    {
        unset(this->cont[offs]);
    }

    public function offsetGet(offs) -> mixed 
    {
        return isset(this->cont[offs]) ? this->cont[offs]  : null;
    }

    // Stack operations

    public function push(mixed value) -> <ZepLab\ZType\ListClass>
    {
        array_push(this->cont, value);
        return this;
    }

    public function pop() -> mixed
    {
        return array_pop(this->cont);
    }

    public function unshift(mixed value) -> <ZepLab\ZType\ListClass>
    {
        array_unshift(this->cont, value);
        return this;
    }

    public function shift() -> mixed
    {
        return array_shift(this->cont);
        
    }

    /**
     * Gets the first key|index of an array
     *
     * @return string|integer|null
     */
    public function firstKey() -> string|int|null
    {
        return array_key_first($this->cont);
    }

    /**
     * Gets the last key|index of an array
     *
     * @return string|integer|null
     */
    public function lastKey() -> string|int|null
    {
        return array_key_last($this->cont);
    }

    // Implementing \Iterator

    public function rewind() -> void 
    {
        let this->pos = 0;
    }

    public function current() -> mixed
    {
        return this->cont[this->pos];
    }

    public function key() -> mixed
    {
        return this->pos;
    }

    public function next() -> void 
    {
        let this->pos ++;
    }

    public function valid() -> bool 
    {
        return isset(this->cont[this->pos]);
    }
    

    // other custom functions
    public function join(string glue) ->string
    {
        return implode(glue, this->cont);
    }

    // m&r stuff
    public function reduce(callable callback, mixed initial = null) -> mixed
    {
        return array_reduce(this->cont, callback, initial);
    }

    public function map(callable callback, mixed initial = null) -> mixed
    {
        let tmp = array_map(callback, this->cont);
        return new self(tmp);
    }

    public function walk(callable $callback, mixed $arg = null) -> <ZepLab\ZType\ListClass>
    {
        array_walk(this->cont, callback, arg );
        return this;
    }
}



