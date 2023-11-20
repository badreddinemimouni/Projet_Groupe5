<?php

namespace Tp\Project\Controller;

// Inclure les classes nécessaires
use Tp\Project\App\Model;
use Tp\Project\Entity\Users;

class UsersController {

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    // Méthode pour inscrire un nouvel utilisateur
    public function registerUser($username, $email, $password)
    {
        // Vérifier si l'utilisateur existe déjà (par exemple, basé sur l'email)
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // L'utilisateur existe déjà
            return "Cet email est déjà utilisé.";
        } else {
            // Insérer un nouvel utilisateur dans la base de données
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashedPassword]);
            return "Inscription réussie ! Connectez-vous maintenant.";
        }
    }

    // Méthode pour connecter un utilisateur
    public function loginUser($email, $password)
    {
        // Récupérer les informations de l'utilisateur basées sur l'email
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Le mot de passe est correct, utilisateur connecté
            return "Connexion réussie ! Bienvenue, " . $user['username'] . "!";
        } else {
            // Mauvais email ou mot de passe
            return "Email ou mot de passe incorrect.";
        }
    }

    // Méthode pour récupérer les détails d'un utilisateur spécifique
    public function getUserDetails($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}