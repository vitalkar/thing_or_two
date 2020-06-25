<?php 
require_once 'database.class.php';
class shortner 
{
    private $conn = null;
    private $table = 'urls';

    public function __construct()
    {
        $this->conn = (new database())->get_connection();
    }
    /**
     * create a URL shortening
     * return the shorten URL
     */
    public function create($url) 
    {
        //validte
        $url = filter_var($url, FILTER_VALIDATE_URL);
        if (!$url)
        {
            return array('error' => 'invalid URL');
        }
        //check for duplicity

        //create shortening
        $short_url = substr(hash('md5', $url), 0, 8);
        //save to db
        $stmt = $this->conn->prepare("INSERT INTO $this->table (url, short_url) VALUES (?, ?)");
        $stmt->bind_param("ss", $url, $short_url);
        $result = $stmt->execute();
        if (!$result) 
        {
            $result = $stmt->error;
        }
        $stmt->close();
        $this->conn->close();

        return array('result' => $short_url, 'message' => $result);
    }
    /**
     * get all the URL shortenings
     */
    public function read_all()
    {
        $rv = $this->conn->query("SELECT DISTINCT * FROM $this->table");
        $result = $rv->fetch_all(MYSQLI_ASSOC);
        $rv->free_result();
        $this->conn->close();
        return $result;
    }

    public function exists($short_url)
    {
        $stmt = $this->conn->prepare("SELECT url FROM $this->table WHERE short_url = ?");

        $stmt->bind_param("s", $short_url);
        $stmt->execute();
        $stmt->bind_result($origin_url);
        $url_exists = $stmt->fetch();
        if($url_exists)
        {
            return $origin_url;
        }
        else
        {
            return false;
        }
    }
}