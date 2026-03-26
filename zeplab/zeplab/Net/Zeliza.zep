/**
 * Very simple Eliza chat emulation
 * 
 * 
 * @since 2026-03-27
 * @author Sven Schrodt
 */


namespace  ZepLab\Net;

class Zeliza extends TcpServer
{

    protected name = "Zeliza";
    protected version = "0.0.1";
    protected wlcMsg = "\nWelcome to %s version %s Test Server. \n To quit, type 'quit'.\n";
    protected sck;

    protected backlog = 5; // Maximum of queued requests
    protected address = "0.0.0.0";
    protected port = 9999;

    public function __construct(string address = "0.0.0.0", int port = 9999)
    {
        let this->address = address;
        let this->port = port;
        this->_init();
        this->run();
    }


    public function run()
    {
        var msgsock, buf, talkback, welcome;
        while (true) {
            let msgsock = socket_accept(this->sck);
            if msgsock == false {
                this->throwMsg("accept()", socket_strerror(socket_last_error(this->sck)));
                break;
            }
            /* Send instructions. */
            let welcome = sprintf(this->wlcMsg, this->name, this->version);
            socket_write(msgsock, welcome, mb_strlen(welcome));

            while (true) {
                let buf = socket_read(msgsock, 2048, PHP_NORMAL_READ);
                if buf == false {
                    this->throwMsg("read()", socket_strerror(socket_last_error(msgsock)));
                    break;
                }
                let buf = trim(buf);
                
                if (buf == "quit") {
                    break;
                }
                if (buf == "shutdown") {
                    socket_close(msgsock);
                    break;
                }
                if (buf == "date") {
                    let talkback = "The time is now: " . date("Y-m-d H:i:s") . PHP_EOL;
                    socket_write(msgsock, talkback, mb_strlen(talkback));
                }
                if(buf == "uname") {
                    let talkback = php_uname() . PHP_EOL;
                    socket_write(msgsock, talkback, mb_strlen(talkback));
                }
                let talkback = php_uname("n") . ": You said 'buf'\n";
                let talkback = talkback . "in rot13: ". str_rot13(buf) . "\n";
                socket_write(msgsock, talkback, mb_strlen(talkback));
                echo "buf\n";
            } 
            socket_close(msgsock);
        } 
    }
}
