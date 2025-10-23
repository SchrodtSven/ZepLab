namespace ZepLab;

class Foo
{
    public function foo() -> void
    {
        echo "Foo";
    }

    public function mirror(string txt) -> string
    {
        return strrev(txt);
    } 
}
