<?php


class EUtente
{
    private $nome;
    private $cognome;
    private $id;
    private $email;
    private $password;
    private $nickname;
    private $data_iscrizione;
    private $ban;

    private $_ricette = array();
    private $_post = array();

    public function aggiungiRicetta(ERicetta $ricetta){
        array_push($this->_ricette, $ricetta);
    }

    public function aggiungiPost(EPost $post){
        array_push($this->_post, $post);
    }

    public function cancellaRicetta(ERicetta $ricetta){
        unset($this->_ricette[key($ricetta)]);
        array_values($this->_ricette);
    }

    public function cancellaPost(EPost $post){
        unset($this->_post[key($post)]);
        array_values($this->_post);
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * @param mixed $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getDataIscrizione()
    {
        return $this->data_iscrizione;
    }

    /**
     * @param mixed $data_iscrizione
     */
    public function setDataIscrizione($data_iscrizione)
    {
        $this->data_iscrizione = $data_iscrizione;
    }

    /**
     * @return mixed
     */
    public function getBan()
    {
        return $this->ban;
    }

    /**
     * @param mixed $ban
     */
    public function setBan($ban)
    {
        $this->ban = $ban;
    }

    /**
     * @return array
     */
    public function getRicette(): array
    {
        return $this->_ricette;
    }

    /**
     * @param array $ricette
     */
    public function setRicette(array $ricette)
    {
        $this->_ricette = $ricette;
    }

    /**
     * @return array
     */
    public function getPost(): array
    {
        return $this->_post;
    }

    /**
     * @param array $post
     */
    public function setPost(array $post)
    {
        $this->_post = $post;
    }


}