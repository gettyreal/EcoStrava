<?php
class AuthController
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        try {
            $dto = new RegisterRequestDTO($data);
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
            return;
        }

        // check if email already exists
        $existing = $this->userRepo->findByEmail(strtolower($dto->getEmail()));
        if ($existing !== null) {
            http_response_code(409);
            echo json_encode(["error" => "Email già registrata"]);
            return;
        }

        $hash = password_hash($dto->getPassword(), PASSWORD_DEFAULT);
     
        $user = new User(
            null,
            $dto->getUsername(),
            new Email($dto->getEmail()),
            $hash,
            null
        );

        try {
            $id = $this->userRepo->create($user);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Errore durante la creazione dell'utente"]);
            return;
        }

        echo json_encode(["message" => "Utente creato", "id" => $id]);
    }
    
    public function login()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $dto = new LoginRequestDTO($data);

        // normalize email to lowercase as stored during registration
        $user = $this->userRepo->findByEmail(strtolower($dto->getEmail()));

        if (!$user || !password_verify($dto->getPassword(), $user->getPassword())) {
            http_response_code(401);
            echo json_encode(["error" => "Credenziali errate"]);
            return;
        }

        $_SESSION['user_id'] = $user->getId();

        echo json_encode(["message" => "Login effettuato", "user_id" => $user->getId()]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        echo json_encode(["message" => "Logout effettuato"]);
    }

    public function session()
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(["logged" => false]);
            return;
        }

        try {
            $user = $this->userRepo->findById((int)$_SESSION['user_id']);
        } catch (Exception $e) {
            echo json_encode(["logged" => false]);
            return;
        }

        echo json_encode([
            "logged" => true,
            "user" => [
                "id" => $user->getId(),
                "username" => $user->getUsername(),
                "email" => $user->getEmail()->value()
            ]
        ]);
    }
}
