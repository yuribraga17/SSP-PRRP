<?php
class Usuario
{
    private $id;
    private $nome;
    private $nome_personagem;
    private $sobrenome_personagem;
    private $sexo;
    private $faccao;
    private $faccao_nome;
    private $faccao_cargo;

    function set($prop, $valor)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->$prop = addslashes($valor);
    }

    function get($prop)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return $this->$prop;
    }

    function Logar($usuario, $senha_login)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        include $_SERVER['DOCUMENT_ROOT'] . "/system/config/mysql/connecdb.php";

        if ($usuario == "" or $senha_login == "") return false;

        $senha_hash = strtoupper(hash("whirlpool", $senha_login));

        $query = mysqli_query($con, "SELECT * FROM accounts WHERE Username = '" . mysqli_real_escape_string($con, $usuario) . "' AND Password = '" . mysqli_real_escape_string($con, $senha_hash) . "' AND Fac != 0 AND pBanido = 0");
        $dados = mysqli_fetch_assoc($query);
        if (mysqli_num_rows($query) == 0) {
            return false;
        }
        mysqli_close($con);
        $this->ConsultarUsuario($dados["ID"]);

        $_SESSION['usuario_id'] = $this->id;
        $_SESSION['usuario_nome'] = $this->nome;
        $_SESSION['personagem_nome'] = $this->nome_personagem . " " . $this->sobrenome_personagem;
        $_SESSION['faccao_id'] = $this->faccao;
        $_SESSION['faccao_nome'] = $this->faccao_nome;
        $_SESSION['faccao_cargo'] = $this->faccao_cargo;
        include_once $_SERVER['DOCUMENT_ROOT'] . "/system/config/logs/funcoes.php";
        return true;
    }

    function Deslogar()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION["usuario_id"])) {
            return false;
        }

        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['personagem_id']);
        unset($_SESSION['personagem_nome']);
        unset($_SESSION['faccao_id']);
        unset($_SESSION['faccao_nome']);
        unset($_SESSION['faccao_cargo']);
        session_destroy();
    }

    function ConsultarUsuario($idUser)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        include $_SERVER['DOCUMENT_ROOT'] . "/system/config/mysql/connecdb.php";

        $this->id = addslashes($idUser);

        $query = mysqli_query($con, "SELECT * FROM accounts WHERE ID = '" . $this->id . "'");
        if (mysqli_num_rows($query) == 0) {
            return false;
        } else {
            $dados = mysqli_fetch_assoc($query);
            $this->id = $dados["ID"];
            $this->nome = $dados["Username"];
            $this->personagem = $dados["pNomeP"];
            $nome_personagem_completo = explode("_", $dados["pNomeP"]);
            $this->nome_personagem = $nome_personagem_completo[0];
            $this->sobrenome_personagem = $nome_personagem_completo[1];
            $this->sexo = $dados["Gender"];
            $this->faccao = $dados["Fac"];
            $query_faccao = mysqli_query($con, "SELECT * FROM faccoes WHERE fID = '" . $this->faccao . "'");
            if (mysqli_num_rows($query_faccao)) {
                $dados_faccao = mysqli_fetch_assoc($query_faccao);
                $this->faccao_nome = $dados_faccao["fNome"];
                $this->faccao_cargo = $dados_faccao["fRank" . $dados["FacCargo"]];
            }
        }
        mysqli_close($con);
        return true;
    }
}