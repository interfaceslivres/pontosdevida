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
    //USUARIO #USUARIO #USUARIO #USUARIO #USUARIO #USUARIO #USUARIO #USUARIO #USUARIO #USUARIO #
    public function criarUsuario($nome, $login_usuario, $senha, $email, $biografia, $data_nascimento,$sexo, $tipo_sangue) {
        // prepare statement for insert
        $sql = 'INSERT INTO usuario(nome, login_usuario, senha, email, biografia, data_nascimento, tipo_sangue, nivel, oauth, smtoggle, privacidade,sexo, foto) VALUES(:nome, :login_usuario, :senha, :email, :biografia, :data_nascimento, :tipo_sangue, :nivel, :oauth, :smtoggle, :privacidade, :sexo , :foto)';
        $stmt = $this->pdo->prepare($sql);

        // pass values to the statement
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':login_usuario', $login_usuario);
        $stmt->bindValue(':senha', md5($senha));
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':biografia', $biografia);
        $stmt->bindValue(':data_nascimento', $data_nascimento);
        $stmt->bindValue(':tipo_sangue', $tipo_sangue);
        $stmt->bindValue(':nivel', '10');
        $stmt->bindValue(':oauth', '0');
        $stmt->bindValue(':smtoggle', '0');
        $stmt->bindValue(':privacidade', '0');
        $stmt->bindValue(':sexo', $sexo);
        $stmt->bindValue(':foto', 'img/cachorro.jpg');


        // execute the insert statement
        $stmt->execute();

        // return generated id
        return $login_usuario;
    }
    // public function alteraUsuario($login_usuario, $senha,$oauth,$smtoggle,
    //                                 $email,$nome,$biografia,$data_nascimento,
    //                                 $privacidade,$tipo_sangue,$nivel,$tempo_retorno,$sexo,$foto) {

    //     // sql statement to update a row in the stock table
    //     $sql = 'UPDATE usuario '
    //             . 'SET senha = :senha, '
    //             . 'oauth = :oauth, '
    //             . 'smtoggle = :smtoggle, '
    //             . 'email = :email, '
    //             . 'nome = :nome, '
    //             . 'biografia = :biografia ,'
    //             . 'data_nascimento = :data_nascimento, '
    //             . 'privacidade = :privacidade, '
    //             . 'tipo_sangue = :tipo_sangue, '
    //             . 'nivel = :nivel, '
    //             . 'tempo_retorno = :tempo_retorno, '
    //             . 'sexo = :sexo, '
    //             . 'foto = :foto '
    //             . 'WHERE login_usuario = :login_usuario';

    //     $stmt = $this->pdo->prepare($sql);

    //     // bind values to the statement
    //     $stmt->bindValue(':login_usuario', $login_usuario);
    //     $stmt->bindValue(':senha', $senha);
    //     $stmt->bindValue(':oauth', $oauth);
    //     $stmt->bindValue(':smtoggle', $smtoggle);
    //     $stmt->bindValue(':email', $email);
    //     $stmt->bindValue(':nome', $nome);
    //     $stmt->bindValue(':biografia', $biografia);
    //     $stmt->bindValue(':data_nascimento', $data_nascimento);
    //     $stmt->bindValue(':privacidade', $privacidade);
    //     $stmt->bindValue(':tipo_sangue', $tipo_sangue);
    //     $stmt->bindValue(':nivel', $nivel);
    //     $stmt->bindValue(':tempo_retorno', $tempo_retorno);
    //     // update data in the database
    //     $stmt->execute();

    //     // return the number of row affected
    //     return $stmt->rowCount();
    // }

    public function alteraSenha($login_usuario, $senha) {

        // sql statement to update a row in the stock table
        $sql = 'UPDATE usuario '
                . 'SET senha = :senha '
                . 'WHERE login_usuario = :login_usuario';

        $stmt = $this->pdo->prepare($sql);

        // bind values to the statement
        $stmt->bindValue(':login_usuario', $login_usuario);
        $stmt->bindValue(':senha', $senha);
        // update data in the database
        $stmt->execute();

        // return the number of row affected
        return $stmt->rowCount();
    }

    public function configUsuario($login_usuario,
                                    $email,$nome,$biografia,$data_nascimento,
                                    $privacidade,$tipo_sangue,$tempo_retorno,$sexo,$foto) {

        // sql statement to update a row in the stock table
        $sql = 'UPDATE usuario '
                . 'SET email = :email, '
                . 'nome = :nome, '
                . 'biografia = :biografia, '
                . 'data_nascimento = :data_nascimento, privacidade = :privacidade, tipo_sangue = :tipo_sangue, '
                . 'tempo_retorno = :tempo_retorno, '
                . 'sexo = :sexo, '
                . 'foto = :foto '
                . 'WHERE login_usuario = :login_usuario';

        $stmt = $this->pdo->prepare($sql);

        // bind values to the statement
        $stmt->bindValue(':login_usuario', $login_usuario);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':biografia', $biografia);
        $stmt->bindValue(':data_nascimento', $data_nascimento);
        $stmt->bindValue(':privacidade', $privacidade);
        $stmt->bindValue(':tipo_sangue', $tipo_sangue);

        $stmt->bindValue(':tempo_retorno', $tempo_retorno);
        $stmt->bindValue(':sexo', $sexo);
        $stmt->bindValue(':foto', $foto);
        // update data in the database
        $stmt->execute();

        // return the number of row affected
        return $stmt->rowCount();
    }

        public function alterarTempo($tempo_retorno) {
            $usuario=$_SESSION['username'];
            // sql statement to update a row in the stock table
            $sql = 'UPDATE usuario
                SET tempo_retorno=:tempo_retorno
                WHERE login_usuario=:login_usuario';

            $stmt = $this->pdo->prepare($sql);
            // bind values to the statement
            $stmt->bindValue(':login_usuario', $usuario);
            $stmt->bindValue(':tempo_retorno', $tempo_retorno);

            // update data in the database
            $stmt->execute();
            // return the number of row affected
            return $stmt->rowCount();
        }


        public function mostrarEmails(){
            $stmt = $this->pdo->prepare('SELECT email
            FROM usuario ');
    		    $stmt->execute();
            $dados = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                array_push($dados,$row['email']);
            }
            return $dados;
        }

    public function mostrarUsuario($login_usuario){
        $stmt = $this->pdo->prepare('SELECT oauth,smtoggle,email,nome,biografia,
        data_nascimento,privacidade,tipo_sangue,nivel,foto,tempo_retorno,sexo
        FROM usuario WHERE login_usuario=:login_usuario');
        $stmt->bindValue(':login_usuario', $login_usuario);
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, [
                'oauth' => $row['oauth'],
                'smtoggle' => $row['smtoggle'],
                'email' => $row['email'],
                'nome' => $row['nome'],
                'biografia' => $row['biografia'],
                'data_nascimento' => $row['data_nascimento'],
                'privacidade' => $row['privacidade'],
                'tipo_sangue' => $row['tipo_sangue'],
                'nivel' => $row['nivel'],
                'foto' => $row['foto'],
                'sexo' => $row['sexo'],
                'tempo_retorno' => $row['tempo_retorno']
            ]);
        }
        return $dados;
    }
    public function meusDados(){
        $login_usuario=$_SESSION['username'];
        return $this->mostrarUsuario($login_usuario)[0];
    }
    public function confirmaSenha($senhaInput){
        $login_usuario=$_SESSION['username'];
        $stmt = $this->pdo->prepare('SELECT senha FROM usuario WHERE login_usuario = :login_usuario');

        $stmt->bindValue(':login_usuario', $login_usuario);
        $stmt->execute();
        $row = $stmt->fetchObject();
        $senha = $row -> senha;
        if (md5($senhaInput) == $senha) {
            return true;
        }else {
            return false;
        }

    }



    public function deletarUsuario($usuario){
        $this->excluirAmizade($usuario);
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
        $stmt = $this->pdo->prepare('SELECT usuario1 FROM amigo WHERE usuario2=:usuario');
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
    public function saoAmigos($usuario,$amigo) {
        $stmt = $this->pdo->prepare('SELECT usuario1 FROM amigo WHERE usuario2=:usuario');
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
        if(in_array($amigo, $dadosUsuarios)){
            return 1;
        }
        else{
            return 0;
        }
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
    function diasDesdaDoacao(){
        $usuario=$_SESSION['username'];
        $stmt = $this->pdo->prepare('SELECT data FROM doacao WHERE doador = :usuario ORDER BY data DESC');
                $stmt->bindValue(':usuario', $usuario);
                $stmt->execute();
        if($stmt->rowCount() > 0 ){
                $row = $stmt->fetchObject();
                $datapassada = $row -> data;
                date_default_timezone_set('America/Recife');
                return (strtotime(date('Y-m-d'))-strtotime($datapassada))/86400 ;
        }
        else{
            return "-1";
        }
    }
    public function criarDoacao() {

        $usuario=$_SESSION['username'];
        $dados=$this->meusDados();
        if($dados['sexo']=='M'){
            $diasEntreDoacoes=60;
        }
        else{
            $diasEntreDoacoes=90;
        }

        $doavel=FALSE;
        if($this->diasDesdaDoacao()==-1 or $chamador->diasDesdaDoacao()>$diasEntreDoacoes){
            $doavel=TRUE;
        }

        if($doavel){
            date_default_timezone_set('America/Recife');

            $sql = 'INSERT INTO doacao(doador, id_local,data) VALUES(:usuario,1,:data)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':usuario', $usuario);
            $stmt->bindValue(':data', date('Y-m-d'));
            $stmt->execute();
            return "Doacao registrada";
        }
        else{
            return "Doacao nao registrada";
        }
    }

    //TEMPLATE
    public function mostrarTemplates() {
      $stmt = $this->pdo->prepare('SELECT * FROM template');
      $stmt->execute();
          $dados = [];
          while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
              array_push($dados, [
                  'nome' => $row['nome'],
                  'descricao' => $row['descricao'],
                  'imagem' => $row['imagem'],
                  'tipo' => $row['tipo']
              ]);
          }
          return $dados;
    }

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

    public function mostrarUltimaPosicao($login_usuario){
        $stmt = $this->pdo->prepare('Select  posicao from figurinha where dono=:login_usuario order by posicao DESC LIMIT 1');
        $stmt->bindValue(':login_usuario', $login_usuario);
		    $stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, [
                'posicao' => $row['posicao']
            ]);
        }
        return $dados[0]['posicao'];
    }
    public function mostrarFigurinha($login_usuario){
        $stmt = $this->pdo->prepare('SELECT * FROM figurinha JOIN template ON figurinha.template = template.nome WHERE dono=:login_usuario');
        $stmt->bindValue(':login_usuario', $login_usuario);
		    $stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, [
                'posicao' => $row['posicao'],
                'tabuleiro' => $row['tabuleiro'],
                'fixa' => $row['fixa'],
                'dono' => $row['dono'],
                'imagem' => $row['imagem'],
                'tipo' => $row['tipo'],
                'id' => $row['id_figurinha'],
                'template' => $row['template']
            ]);
        }
        return $dados;
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
        if($id_figurinha==0){
            return -1;
        }
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
        $sql = 'SELECT nome, tipo_sangue FROM usuario where id_cla=:id_cla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_cla', $id_cla);

        $stmt->execute();
        $dados=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, [
                'nome' => $row['nome'],
                'tipo_sangue' => $row['tipo_sangue']
            ]);
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
    public function mostrarCla($usuario){
        $sql = 'SELECT c.id_cla, c.codigo_cla, c.nome, c.descricao, c.caminho_foto FROM usuario u JOIN cla c ON u.id_cla=c.id_cla where u.login_usuario=:usuario';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':usuario', $usuario);

        $stmt->execute();
        $dados=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, [
                'id_cla' => $row['id_cla'],
                'codigo_cla' => $row['codigo_cla'],
                'nome' => $row['nome'],
                'descricao' => $row['descricao'],
                'caminho_foto' => $row['caminho_foto']
            ]);
        }
        if(sizeof($dados)==0){
            return NULL;
        }
        else{
            return $dados[0];
        }
    }
    public function mostrarIdClaByCodigo($codigo_cla){
        $sql = 'SELECT id_cla FROM cla WHERE codigo_cla=:codigo_cla';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':codigo_cla', $codigo_cla);

        $stmt->execute();
        $dados=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['id_cla']);
        }
        if(sizeof($dados)==0){
            return NULL;
        }
        else{
            return $dados[0];
        }
    }
    public function mostrarMeuClaByLider($lider){
        $sql = 'SELECT id_cla, codigo_cla FROM cla WHERE lider=:lider';
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':lider', $lider);

        $stmt->execute();
        $dados=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, [
                'id_cla' => $row['id_cla'],
                'codigo_cla' => $row['codigo_cla']
            ]);
        }
        if(sizeof($dados)==0){
            return NULL;
        }
        else{
            return $dados[0];
        }
    }
    public function criarCla($nome,$descricao,$caminho_foto) {
        $usuario=$_SESSION['username'];
        $meu_cla=$this->mostrarMeuClaByLider($usuario);
        if($meu_cla!=NULL){
            $this->criarAlocacao($usuario,$meu_cla["id_cla"]);
            return $meu_cla["codigo_cla"];
        }
        $codigo_cla = substr(md5($usuario),0,15);
        $sql = 'INSERT INTO cla(nome,codigo_cla,descricao,lider,caminho_foto)
                VALUES(:nome,:codigo_cla,:descricao,:lider,:caminho_foto)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':codigo_cla', $codigo_cla);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':lider', $usuario);
        $stmt->bindValue(':caminho_foto', $caminho_foto);
        $stmt->execute();

        $stmt = $this->pdo->prepare('SELECT id_cla, codigo_cla
        FROM cla WHERE lider=:lider');
        $stmt->bindValue(':lider', $usuario);
		$stmt->execute();
        $dados = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            array_push($dados, $row['id_cla']);
            array_push($dados, $row['codigo_cla']);
        }
        $this->criarAlocacao($usuario,$dados[0]);
        return $dados[1];
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
        $sql = 'UPDATE usuario SET id_cla=:id_cla WHERE login_usuario=:usuario';
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
        $data = date('Y-m-d H:i:s', time());
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
    public function verNotifica($login_usuario){
        $sql = 'SELECT * FROM template_not JOIN notifica ON notifica.id_template = template_not.id_not WHERE dono=:login_usuario';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login_usuario', $login_usuario);
        $stmt->execute();
        $notificas=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $notificas[] = [
                'id_notifica' => $row['id_notifica'],
                'id_template' => $row['id_template'],
                'dono' => $row['dono'],
                'remetente' => $row['remetente'],
                'texto' => $row['texto']
            ];
        }
        return $notificas;
    }


    public function solicitaAmizade($amigo) {
        $usuario=$_SESSION['username'];
        $usramigo=$this->mostrarUsuario($amigo);
        if($usramigo==[]){
            return "Usuario não existe.";
        }
        $sql = 'SELECT id_notifica FROM notifica WHERE dono=:login_usuario AND remetente=:remetente';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login_usuario', $usuario);
        $stmt->bindValue(':remetente', $amigo);
        $stmt->execute();
        $notificacao=[];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $notificas[] = [
                'id_notifica' => $row['id_notifica'],
                'id_template' => $row['id_template'],
                'dono' => $row['dono'],
                'remetente' => $row['remetente'],
                'texto' => $row['texto']
            ];
        }
        if(count($notificacao)!=0){
            return "A solicitação já foi enviada.";
        }
        $amigos=$this->mostrarAmigos();
        if(in_array($amigo,$amigos) or $amigo==$usuario){
            return "O usuário já é seu amigo.";
        }
        else{
            $sql = 'INSERT INTO notifica(id_template,dono,remetente)
                    VALUES(:id_template,:dono,:remetente)';
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':id_template', 1);
            $stmt->bindValue(':dono', $amigo);
            $stmt->bindValue(':remetente', $usuario);

            $stmt->execute();
            return "Solicitação enviada";
        }
    }


    public function deletaNotifica($id_notifica){
        $sql = 'DELETE FROM notifica WHERE id_notifica=:id_notifica ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_notifica', $id_notifica);
        $stmt->execute();
        return 1;

    }
    public function aceitaAmizade($amigo,$id_notifica){
        $this->criarAmizade($amigo);
        $this->deletaNotifica($id_notifica);
        return 1;
    }


    public function criarNotifica($dono,$id_template) {
        $sql = 'INSERT INTO notifica(dono,id_template)
                VALUES(:dono,:id_template)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':dono', $dono);
        $stmt->bindValue(':id_template', $id_template);
        $stmt->execute();
    }





}

?>
