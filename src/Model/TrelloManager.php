<?php

namespace App\Model;

class TrelloManager
{
    public function reset()
    {
        // Réinitialisation du tableau de session
        // On le vide intégralement
        $_SESSION = array();
        // Destruction de la session
        session_destroy();
        // Destruction du tableau de session
        unset($_SESSION);
    }

    public function addColumn()
    {
        if (isset($_POST['columnAdd'])) {
            $_SESSION['columns'][] = [];
        }
    }

    public function addTask()
    {
        foreach (array_keys($_POST) as $key) {
            if (str_starts_with($key, 'add')) {
                $index = substr($key, strlen('add'));
                $_SESSION['columns'][$index][] = $_POST['task'];
            }
        }
    }
    public function supprTask()
    {
        foreach (array_keys($_POST) as $key) {
            if (str_starts_with($key, 'suppr')) {
                $index = substr($key, strlen('suppr'));
                $ind = 0;
                $taskIndex = '';
                while (is_numeric($index[$ind])) {
                    $taskIndex .= $index[$ind];
                    $ind += 1;
                }
                $columnIndex = substr($key, strrpos($key, 'n') + 1);
                unset($_SESSION['columns'][$columnIndex][$taskIndex]);
            }
        }
    }
}
