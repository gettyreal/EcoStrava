<?php

class ActivityController
{
    private ActivityRepository $activityRepo;
    private TransportRepository $transportRepo;

    public function __construct(ActivityRepository $activityRepo, TransportRepository $transportRepo) {
        $this->activityRepo = $activityRepo;
        $this->transportRepo = $transportRepo;
    }

    public function create()
    {
        requireAuth();

        $data = json_decode(file_get_contents("php://input"), true);
        $dto = new ActivityCreateDTO($data);

        $userId = $_SESSION['user_id'];

        $transport = $this->transportRepo->findById($dto->getTransportId());

        if (!$transport) {
            http_response_code(400);
            echo json_encode(["error" => "Trasporto non valido"]);
            return;
        }

        $activity = new Activity(
            100,
            new Distance($dto->getDistance()),
            new Date($dto->getDate()),
            $userId,
            $dto->getTransportId()
        );

        $id = $this->activityRepo->create($activity);

        echo json_encode(["message" => "Attività creata", "id" => $id]);
    }

    public function index()
    {
        requireAuth();

        $userId = $_SESSION['user_id'];
        $activities = $this->activityRepo->findByUserId($userId);

        echo json_encode($activities);
    }

    public function delete($id)
    {
        requireAuth();

        $userId = $_SESSION['user_id'];
        $this->activityRepo->deleteByIdAndUser($id, $userId);

        echo json_encode(["message" => "Attività eliminata"]);
    }
}
