<?php

/**
 *
 */
class AdminGateway
{
    /**
     * @var Connection
     */
    private $con;

    /**
     * @param Connection $con
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * @param $login
     * @return string
     */
    function getCredentials($login): string{
        $query = "SELECT mdp FROM admin WHERE login = :login";
        $this->con->executeQuery($query, array(':login' => array($login, PDO::PARAM_STR)));
        $result = $this->con->getResults()[0]['mdp'];
        return $result;
    }

}