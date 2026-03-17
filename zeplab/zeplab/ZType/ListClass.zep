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

class ListClass
{
    protected cont; // content of current instance

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

    
}



