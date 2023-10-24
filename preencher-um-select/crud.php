<?php

class Crud
{
    private $connect;

    private $tarefa;
   

    function __construct($conexao)
    {
        $this->connect = $conexao;
    }

    

    public function readInfo($id = null){
       if(isset($id)){
        $sql = $this->connect->prepare("SELECT * FROM tarefas WHERE id=?");

        $sql->bindValue(1,$id);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_OBJ);

        return $result;

    }else{
       $this->getAll(); 
  }
}

    public function getAll(){
        $sql = $this->connect->query("SELECT * FROM tarefas");
        return $sql->fetchAll();

        
    }


    

    public function update($id,$tarefa){
        $sql = $this->connect->prepare("UPDATE tarefas SET tarefa=?, status='Pendente' WHERE id=?");

        $sql->bindValue(1,$tarefa,PDO::PARAM_STR);
        $sql->bindValue(2,$id,PDO::PARAM_STR);

        if ($sql->execute()) {
            echo '<script language="javascript">alert("Tarefa finalizada com sucesso.")</script>';
		    echo '<script language="javascript">window.location="index.php"</script>';
        }else{
            echo '<script language="javascript">alert("Ocorreu um erro a finalizar com sucesso.")</script>';
            echo '<script language="javascript">window.location="index.php"</script>';        }

    }

    public function atualizar($id,$tarefa){
        $sql = $this->connect->prepare("UPDATE tarefas SET tarefa=?, status='Concluído' WHERE id=?");

        $sql->bindValue(1,$tarefa,PDO::PARAM_STR);
        $sql->bindValue(2,$id,PDO::PARAM_STR);

        if ($sql->execute()) {
            echo '<script language="javascript">alert("Tarefa finalizada com sucesso.")</script>';
		    echo '<script language="javascript">window.location="index.php"</script>';
        }else{
            echo '<script language="javascript">alert("Ocorreu um erro a finalizar com sucesso.")</script>';
            echo '<script language="javascript">window.location="index.php"</script>';        }

    }


}

?>