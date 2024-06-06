<?php
class Cidadao
{
   public function listarCidadaos()
   {
      $db = DB::connect();
      $rs = $db->prepare("SELECT * FROM cidadao ORDER BY nome");
      $rs->execute();
      $obj = $rs->fetchAll(PDO::FETCH_ASSOC);

      if ($obj) {
         echo json_encode(["dados" => $obj]);
      } else {
         echo json_encode(["dados" => 'Nenhum cidadão cadastrado']);
      }
   }

   public function listarCidadaoPorNis($param)
   {
      $db = DB::connect();
      $stmt = $db->prepare("SELECT * FROM cidadao WHERE nis = :nis");
      $stmt->bindParam(':nis', $param, PDO::PARAM_STR);
      $stmt->execute();
      $obj = $stmt->fetchObject();

      if ($obj) {
         echo json_encode(["dados" => $obj]);
      } else {
         echo json_encode(["dados" => 'Cidadão não encontrado']);
      }
   }
   public function adicionaCidadaos()
   {
      $nis = $this->gerarNis();
      $sql = "INSERT INTO cidadao (nome, nis) VALUES (:nome, :nis)";
   
      $db = DB::connect();
      $stmt = $db->prepare($sql);
   
       // Ligar os valores das variáveis aos placeholders
       $stmt->bindParam(':nome', $_POST['nome'], PDO::PARAM_STR);
       $stmt->bindParam(':nis', $nis, PDO::PARAM_STR);
   
       $exec = $stmt->execute();
       if ($exec) {
           echo json_encode(["dados" => 'NIS: '. $nis .' - GERADO COM SUCESSO']);
       } else {
           echo json_encode(["dados" => 'Houve algum erro ao gerar o NIS']);
       }
   }
   
   private function gerarNis() {
       $db = DB::connect();
   
       do {
           // Gera um número de 11 dígitos
           $numero = mt_rand(10000000000, 99999999999);
           // Verifica se o número já existe no banco de dados
           $stmt = $db->prepare("SELECT COUNT(*) FROM cidadao WHERE nis = :numero");
           $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
           $stmt->execute();
           $count = $stmt->fetchColumn();
   
       } while ($count > 0);
   
       return $numero;
   }

  
}

