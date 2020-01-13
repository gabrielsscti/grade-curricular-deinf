<?php
class DAOCadeiraCadeira{
    public static $table_name = "cadeiracadeira";

    public function __construct(){}

    private function getWhereStatement($statement){
        return ($statement) ? " WHERE {$statement}" : null;
    }

    private function getTableName($table){
        $prefix = DB_PREFIX;
        if(isset($prefix))
            return $prefix . '_' . $table;
        return $table;
    }

    private function execute($query){
        $link = DBConnect();
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        DBClose($link);
        return $result;
    }

    private function read($params = null, $fields="*"){
        $table = $this->getTableName(DAOCadeiraCadeira::$table_name);
        $params = ($params) ? " {$params}":null;
        $query = "SELECT {$fields} FROM {$table}{$params}";
        $result = $this->execute($query);
        $data = null;
        if(!mysqli_num_rows($result))
            return false;
        else
            while($res=mysqli_fetch_assoc($result))
                $data[]=$res;
        return $data;
    }

    private function getCadeiraCadeiraFromArray($cc){
        return new CadeiraCadeira(
            $cc["idCadeira"],
            $cc["idPreRequisito"]
        );
    }

    public function getCadeiraCadeiraFromFatherId($id){
        $data = $this->read("WHERE idCadeira = " .  $id);
        if(!$data)
            return array();
        $r = array();
        foreach($data as $i)
            array_push($r, $this->getCadeiraCadeiraFromArray($i));
        
        return $r;
    }
}
?>