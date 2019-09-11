<?php

namespace PontosDeVida;
/**
 * Criação de Tabelas no Banco de Dados
 */
class PontosDeVidaFuncoes {

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * init the object with a \PDO object
     * @param type $pdo
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //Utilizar apenas quando a solicitacao de amizade for aceita
    public function criarAmizade($usuario2) {

        $usuario1=$_SESSION['username'];
        if($usuario1==$usuario2){
            return "Erro voce nao pode ser seu amigo :-(";
        }
        $sql = 'INSERT INTO amigo(usuario1, usuario2) VALUES(:usuario1, :usuario2)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario1', $usuario1);
        $stmt->bindValue(':usuario2', $usuario2);

        $stmt->execute();

        return "Registrado";
    }
    public function excluirAmizade($usuario2) {

        $usuario1=$_SESSION['username'];
        $sql = 'DELETE FROM  amigo WHERE usuario1=:usuario1 AND usuario2=:usuario2';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario1', $usuario1);
        $stmt->bindValue(':usuario2', $usuario2);

        $stmt->execute();

        $sql = 'DELETE FROM  amigo WHERE usuario1=:usuario1 AND usuario2=:usuario2';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario1', $usuario2);
        $stmt->bindValue(':usuario2', $usuario1);

        $stmt->execute();

        return "Deletado";
    }
    // Mostrar Amigos do usuario logado
    public function mostrarAmigos() {
        $usuario=$_SESSION['username'];
        $stmt = $this->pdo->prepare('SELECT usuario1 '
                . 'FROM amigo '
                . 'WHERE usuario2=:usuario');
        $stmt->bindValue(':usuario', $usuario);

		$stmt->execute();
        $dadosUsuarios = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['usuario1']);
        }
        $stmt = $this->pdo->prepare('SELECT usuario2 '
                . 'FROM amigo '
                . 'WHERE usuario1=:usuario');
        $stmt->bindValue(':usuario', $usuario);

		$stmt->execute();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['usuario2']);
        }
        return $dadosUsuarios;
    }
    //DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #DOACAO #
    public function quantidadeDoacoes(){
        $sql = 'SELECT count(id_doacao) FROM doacao';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $dados=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['count']);
        }
        return $dados[0];
    }
    public function criarDoacao($id_local) {

        $usuario=$_SESSION['username'];
        $diasEntreDoacoes=90;
        $stmt = $this->pdo->prepare('SELECT data '
                . 'FROM doacao '
                . 'WHERE doador = :usuario '
                . 'ORDER BY data DESC',);

			$stmt->bindValue(':usuario', $usuario);

			$stmt->execute();

        $doavel=FALSE;
        if($stmt->rowCount() > 0 ){
                $row = $stmt->fetchObject();
                $datapassada = $row -> data;
                date_default_timezone_set('America/Recife');
                if((strtotime(date('Y-m-d'))-strtotime($datapassada))/86400 > $diasEntreDoacoes){
                    $doavel=TRUE;//se faz mais que 90 dias
                }
        }
        else{
            $doavel=TRUE;//se nunca doou 
        }
        if($doavel){
            date_default_timezone_set('America/Recife');
            $sql = 'INSERT INTO doacao(doador, id_local,data) VALUES(:usuario, :id_local,:data)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':id_local', $id_local);
            
            $stmt->bindValue(':data', date('Y-m-d'));

            $stmt->execute();
            return "Doacao registrada";
        }
        else{
            return "Doacao nao registrada";
        }
    }
    //TEMPLATE
    public function criarTemplate($nome,$descricao,$imagem,$tipo) {
        $sql = 'INSERT INTO template(nome,descricao,imagem,tipo) VALUES(:nome, :descricao,:imagem,:tipo)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':tipo', $tipo);

        $stmt->execute();
        return "Template registrada";
    }
    public function alterarTemplate($nome,$descricao,$imagem,$tipo) {
        $sql = 'UPDATE template 
            SET descricao=:descricao,imagem=:imagem,tipo=:tipo
            WHERE nome=:nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':tipo', $tipo);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function deletarTemplate($nome) {
        $sql = 'DELETE FROM figurinha WHERE template=:nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();

        $sql = 'DELETE FROM template WHERE nome=:nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);

        $stmt->execute();
        return "Excluido";
    }
    //FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #FIGURINHA #
    public function mostrarFigurinhasTemplate(){
        $stmt = $this->pdo->prepare('SELECT template,COUNT(template) FROM figurinha GROUP BY template');
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, [
                'template' => $row['template'],
                'count' => $row['count']
            ]);
            // $dados = [
            //     'template' => $row['template'],
            //     'count' => $row['count']
            // ];
        }
        return $dados;
    }
    public function criarFigurinha($posicao,$tabuleiro,$fixa,$dono,$template) {
        $sql = 'INSERT INTO figurinha(posicao,tabuleiro,fixa,dono,template) 
                VALUES(:posicao,:tabuleiro,:fixa,:dono,:template)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':posicao', $posicao);
        $stmt->bindValue(':tabuleiro', $tabuleiro);
        $stmt->bindValue(':fixa', $fixa);
        $stmt->bindValue(':dono', $dono);
        $stmt->bindValue(':template', $template);
        $stmt->execute();

        $stmt = $this->pdo->prepare('SELECT id_figurinha 
        FROM figurinha WHERE posicao=:posicao AND tabuleiro=:tabuleiro AND fixa=:fixa AND dono=:dono AND template=:template');
        $stmt->bindValue(':posicao', $posicao);
        $stmt->bindValue(':tabuleiro', $tabuleiro);
        $stmt->bindValue(':fixa', $fixa);
        $stmt->bindValue(':dono', $dono);
        $stmt->bindValue(':template', $template);
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['id_figurinha']);
        }
        return $dados[0];
    }

    public function isFixed($id_figurinha){
        $stmt = $this->pdo->prepare('SELECT fixa 
        FROM figurinha WHERE id_figurinha=:id_figurinha');
        $stmt->bindValue(':id_figurinha', $id_figurinha);
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['fixa']);
        }
        return $dados[0];
    }
    public function alterarFigurinha($id_figurinha,$posicao,$tabuleiro) {
        $usuario=$_SESSION['username'];
        $stmt = $this->pdo->prepare('SELECT fixa 
        FROM figurinha WHERE id_figurinha=:id_figurinha');
        $stmt->bindValue(':id_figurinha', $id_figurinha);
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['fixa']);
        }
        $fixa=$dados[0];
        if(!$fixa){
            $sql = 'UPDATE figurinha 
            SET posicao=:posicao,tabuleiro=:tabuleiro
            WHERE id_figurinha=:id_figurinha';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':posicao', $posicao);
            $stmt->bindValue(':tabuleiro', $tabuleiro);
            $stmt->bindValue(':id_figurinha', $id_figurinha);

            $stmt->execute();
            return $stmt->rowCount();
        }
        else{
            return 0;
        }
        
    }
    public function deletarFigurinha($id_figurinha) {
        $usuario=$_SESSION['username'];
        $sql = 'DELETE FROM figurinha WHERE id_figurinha=:id_figurinha and dono=:dono';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_figurinha', $id_figurinha);
        $stmt->bindValue(':dono', $usuario);
        $stmt->execute();
        return "Excluido";
    }
    //LOCAL
    public function criarLocal($nome) {
        $sql = 'INSERT INTO local(nome) 
                VALUES(:nome)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();

        $stmt = $this->pdo->prepare('SELECT id 
        FROM local WHERE nome=:nome');
        $stmt->bindValue(':nome', $nome);
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['id']);
        }
        return $dados[0];
    }
    public function alterarLocal($id,$nome) {
        $sql = 'UPDATE local 
            SET nome=:nome
            WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function deletarLocal($id) {
        $sql = 'DELETE FROM local WHERE id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return "Excluido";
    }
    //CLA ###########################################
    public function participantesCla($id_cla){
        $sql = 'SELECT usuario FROM alocacao where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_cla', $id_cla);

        $stmt->execute();
        $dados=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['usuario']);
        }
        if(sizeof($dados)==0){
            return 0;
        }
        else{
            return $dados;
        }
    }
    public function meuCla(){
        $usuario=$_SESSION['username'];
        return $this->mostrarCla($usuario);
    }
    private function mostrarCla($usuario){
        $sql = 'SELECT id_cla FROM alocacao where usuario=:usuario';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario', $usuario);

        $stmt->execute();
        $dados=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['id_cla']);
        }
        if(sizeof($dados)==0){
            return 0;
        }
        else{
            return $dados[0];
        }
    }
    public function criarCla($nome,$descricao,$caminho_foto) {
        $usuario=$_SESSION['username'];
        $id_cla=$this->mostrarCla($usuario);
        if($id_cla>0){
            return 0;
        }
        $sql = 'INSERT INTO cla(nome,descricao,lider,caminho_foto) 
                VALUES(:nome,:descricao,:lider,:caminho_foto)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':lider', $usuario);
        $stmt->bindValue(':caminho_foto', $caminho_foto);
        $stmt->execute();
        
        $stmt = $this->pdo->prepare('SELECT id_cla 
        FROM cla WHERE lider=:lider');
        $stmt->bindValue(':lider', $usuario);
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['id_cla']);
        }
        $this->criarAlocacao($usuario,$dados[0]);
        return $dados[0];
    }
    public function alterarCla($id_cla,$nome,$descricao,$lider,$caminho_foto) {
        $sql = 'UPDATE cla 
            SET nome=:nome,descricao=:descricao,lider=:lider,caminho_foto=:caminho_foto
            WHERE id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);
       
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':lider', $lider);
        $stmt->bindValue(':caminho_foto', $caminho_foto);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function deletarCla($id_cla) {
        $sql = 'DELETE FROM alocacao WHERE id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->execute();

        $sql = 'DELETE FROM figurinha_cla where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->execute();

        $sql = 'DELETE FROM mensagem where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->execute();

        $sql = 'DELETE FROM cla_conquista where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->execute();

        $sql = 'DELETE FROM cla WHERE id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->execute();
        return "Excluido Cla";
    }
    //FIGURINHA CLA #################################################
    private function getTemplate($id_figurinha){
        $sql = 'SELECT template FROM figurinha where id_figurinha=:id_figurinha';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_figurinha', $id_figurinha);

        $stmt->execute();
        $dadosUsuarios=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['template']);
        }
        return $dadosUsuarios[0];
    }
    public function doarFigurinha($id_figurinha){
        $usuario=$_SESSION['username'];
        $id_cla=$this->mostrarCla($usuario);
        if($id_cla==0){
            return 0;
        }
        $template=$this->getTemplate($id_figurinha);
        $sql = 'INSERT INTO figurinha_cla(template,id_cla) 
                VALUES(:template,:id_cla)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':template', $template);
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->execute();
        $this->deletarFigurinha($id_figurinha);
        return "Figurinha Doada";
    }
    private function getClaFig($id_figcla){
        $sql = 'SELECT id_cla FROM figurinha_cla where id_figcla=:id_figcla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_figcla', $id_figcla);

        $stmt->execute();
        $dadosUsuarios=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['id_cla']);
        }
        return $dadosUsuarios[0];
    }
    private function getTemplateFig($id_figcla){
        $sql = 'SELECT template FROM figurinha_cla where id_figcla=:id_figcla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_figcla', $id_figcla);

        $stmt->execute();
        $dadosUsuarios=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['template']);
        }
        return $dadosUsuarios[0];
    }
    private function deleteFigCla($id_figcla){
        $sql = 'DELETE FROM figurinha_cla where id_figcla=:id_figcla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_figcla', $id_figcla);

        $stmt->execute();
        return "Deletado";
    }
    public function receberFigurinha($id_figcla){
        $usuario=$_SESSION['username'];
        $cla_user=$this->mostrarCla($usuario);
        $id_cla=$this->getClaFig($id_figcla);
        if($cla_user!=$id_cla){
            return "Clas diferentes ou idfig inexistente";
        }
        else{
            $template=$this->getTemplateFig($id_figcla);
            $this->criarFigurinha(0,0,"FALSE",$usuario,$template);
            $this->deleteFigCla($id_figcla);
            return "Sucesso";
        }
    }
    //ALOCACAO ###########################################
    private function liderCla($id_cla){
        $sql = 'SELECT lider FROM cla where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_cla', $id_cla);

        $stmt->execute();
        $dadosUsuarios=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['lider']);
        }
        return $dadosUsuarios[0];
    }
    private function alterarLider($id_cla,$lider) {
        $sql = 'UPDATE cla 
            SET lider=:lider 
            WHERE id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->bindValue(':lider', $lider);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function criarAlocacao($usuario,$id_cla) {
        $sql = 'INSERT INTO alocacao(usuario,id_cla) 
                VALUES(:usuario,:id_cla)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':id_cla', $id_cla);

        $stmt->execute();
        return "Alocacao registrada";
    }
    public function deletarAlocacao($usuario) {
        $id_cla=$this->mostrarCla($usuario);
        if($id_cla==0){
            return 0;
        }
        $lider=$this->liderCla($id_cla);
        if($usuario==$lider){
            $participantes=$this->participantesCla($id_cla);
            $alterado=0;
            foreach ($participantes as $participante){
                if($participante!=$usuario){
                    $this->alterarLider($id_cla,$participante);
                    $alterado=1;
                    break;
                }
            }
            if(!$alterado){
                echo "Deletou";
                $this->deletarCla($id_cla);
            }
            else{
                $sql = 'DELETE FROM alocacao WHERE usuario=:usuario';
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(':usuario', $usuario);
                $stmt->execute();
                return "Excluido";
            }
        }
        else{
            $sql = 'DELETE FROM alocacao WHERE usuario=:usuario';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':usuario', $usuario);
            $stmt->execute();
            return "Excluido";
        }
    }
    //CONQUISTA ###########################################
    public function criarConquista($nome,$icone,$descricao) {
        $sql = 'INSERT INTO conquista(nome,icone,descricao) 
                VALUES(:nome,:icone,:descricao)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':icone', $icone);
        $stmt->bindValue(':descricao', $descricao);

        $stmt->execute();
        return "conquista registrada";
    }
    public function alterarConquista($nome,$icone,$descricao) {
        $sql = 'UPDATE conquista 
            SET icone=:icone,descricao=:descricao
            WHERE nome=:nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':icone', $icone);
        $stmt->bindValue(':descricao', $descricao);

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function deletarConquista($nome) {
        $sql = 'DELETE FROM cla_conquista WHERE conquista=:nome ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        $sql = 'DELETE FROM conquista WHERE nome=:nome';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        return "Excluido";
    }
    //CLACONQUISTA ###########################################
    public function mostrarConquistasCla($id_cla){
        $sql = 'SELECT conquista FROM cla_conquista where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_cla', $id_cla);

        $stmt->execute();
        $dadosUsuarios=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dadosUsuarios, $row['conquista']);
        }
        return $dadosUsuarios;
    }
    public function criarClaConquista($id_cla,$conquista) {
        $sql = 'INSERT INTO cla_conquista(id_cla,conquista) 
                VALUES(:id_cla,:conquista)';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_cla', $id_cla);
        $stmt->bindValue(':conquista', $conquista);

        $stmt->execute();
        return "Cla_conquista registrada";
    }
    //MENSAGEM ###########################################
    public function verMensagens(){
        $id_cla=$this->meuCla();
        echo "AQUIIIII";
        echo $id_cla;
        if($id_cla==0){
            return 0;
        }
        $sql = 'SELECT data,texto,remetente FROM mensagem where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_cla', $id_cla);

        $stmt->execute();
        $dadosUsuarios=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $dadosUsuarios[] = [
                'data' => $row['data'],
                'texto' => $row['texto'],
                'remetente' => $row['remetente']
            ];
        }
        return $dadosUsuarios;
    }
    public function criarMensagem($texto) {
        $sql = 'INSERT INTO mensagem(data,texto,remetente,id_cla) 
                VALUES(:data,:texto,:remetente,:id_cla)';
        $stmt = $this->pdo->prepare($sql);
        date_default_timezone_set('America/Recife');
        $data = date('m/d/Y h:i:s a', time());
        echo $data;
        $remetente=$_SESSION['username'];
        $id_cla=$this->mostrarCla($remetente);


        $stmt->bindValue(':data', $data);
        $stmt->bindValue(':texto', $texto);
        $stmt->bindValue(':remetente', $remetente);
        $stmt->bindValue(':id_cla', $id_cla);

        $stmt->execute();
        return "Mensagem registrada";
    }
    //Notfica ###########################################
    
}

?>
