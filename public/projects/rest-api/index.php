<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Config/Database.php';
require_once __DIR__ . '/src/Controller/AuthorController.php';
require_once __DIR__ . '/src/Controller/ContentController.php';
require_once __DIR__ . '/src/Controller/AwardController.php';
require_once __DIR__ . '/src/Controller/DeveloperController.php';
require_once __DIR__ . '/src/Controller/ProductController.php';

use Config\Database;
use Controller\AuthorController;
use Controller\ContentController;
use Controller\AwardController;
use Controller\DeveloperController;
use Controller\ProductController;

define('API_KEY', '1234');
$headers = getallheaders();
if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer ' . API_KEY) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized. Invalid API key."]);
    exit;
}
header('Content-Type: application/json; charset=UTF-8');

$basePath = '/rest_api_project/';
$requestPath = str_replace($basePath, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

$dbInstance = new Database();
$db = $dbInstance->getConnection();

switch ($requestPath) {
    case 'developer':
        $developerController = new DeveloperController($db);
        echo json_encode($developerController->getDeveloperInfo());
        break;

    case 'author':
        $authorController = new AuthorController($db);
        $search = $_GET['search'] ?? null;
        $page = $_GET['page'] ?? 1;
        $authorId = $_GET['author_id'] ?? null;
        $contentId = $_GET['content_id'] ?? null;
        echo json_encode($authorController->getAllAuthors($search, $page, $authorId, $contentId));
        break;

    case 'content':
        $contentController = new ContentController($db);
        $search = $_GET['search'] ?? null;
        $page = $_GET['page'] ?? 1;
        $contentId = $_GET['content_id'] ?? null;
        $authorId = $_GET['author_id'] ?? null;
        echo json_encode($contentController->getAllContent($search, $page, $contentId, $authorId));
        break;

    case 'award':
        $awardController = new AwardController($db);
        if ($method === 'GET') {
            echo json_encode($awardController->getAllAwards());
        } elseif ($method === 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($awardController->createAward($data));
        } elseif ($method === 'PATCH') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($awardController->updateAward($data));
        } elseif ($method === 'DELETE') {
            $data = json_decode(file_get_contents("php://input"), true);
            echo json_encode($awardController->deleteAward($data));
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
        }
        break;

    case 'content-award':
        $awardController = new AwardController($db);
        $dataRaw = file_get_contents("php://input");
        $data = json_decode($dataRaw, true);

        if ($method === 'POST') {
            echo json_encode($awardController->assignAwardToContent($data));
        } elseif ($method === 'DELETE') {
            echo json_encode($awardController->removeAwardFromContent($data));
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["error" => "Endpoint not found"]);
        break;
}





