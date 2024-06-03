<?php

require_once('../config.php');

class Contact
{
    public $Id;
    public $Email;
    public $Message;

    public function __construct(string $email, string $message)
    {
        $this->Email = $email;
        $this->Message = $message;
    }

    public function Create()
    {

        (!is_null($this->Email) ?: throw new Exception('Veuillez saisir un email'));
        (!is_null($this->Message) ?: throw new Exception('Veuillez saisir un message'));
        $link = connexion();
        $sql = 'INSERT INTO contact (`id`, `email`, `message`, `date_envoi`)VALUES(NULL, "' . mysqli_real_escape_string($link, $this->Email) . '", "' . mysqli_real_escape_string($link, $this->Message) . '", CURRENT_TIMESTAMP)';

        if (!mysqli_query($link, $sql)) {
            throw new Exception("Une erreur est survenue. " . mysqli_error($link));
        }
        if (mysqli_affected_rows($link) <= 0) {
            throw new Exception("Une erreur est survenue. 3");
        }

        $this->Id = mysqli_insert_id($link);
        return $this;
    }
}
