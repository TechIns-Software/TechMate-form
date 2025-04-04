<?php
date_default_timezone_set('Europe/Athens');
header("Content-Type: application/json; charset=UTF-8");
require_once 'backend/init.php';
const ERROR_NO_ACTION = "No action provided";
const ERROR_NO_GOOD_ARGUMENTS = "No good arguments provided";
const ERROR_ACTION_NOT_FOUND = "Action not found";
$defaultErrorAnswer = array(
    'success' => 0,
    'message' => 'No answer returned'
);
if (!isset($_POST['action'])) {
    $defaultErrorAnswer['message'] = ERROR_NO_ACTION;
    sendRestApiAnswer($defaultErrorAnswer);
}

$conn = TechMateForm\Connection::getConnection();

$actionName = $_POST['action'];

if ($actionName == 'createSubject') {
    if (!isset(
        $_POST['subjectName'],
    )) {
        $defaultErrorAnswer['message'] = ERROR_NO_GOOD_ARGUMENTS;
        sendRestApiAnswer($defaultErrorAnswer);
    }
    $subjectName = $_POST['subjectName'];
    $idSubject = \TechMateForm\Subject::createSubject($conn, $subjectName);
    if ($idSubject < 1) {
        $defaultErrorAnswer['message'] = 'Error creating subject';
        sendRestApiAnswer($defaultErrorAnswer);
    }
    sendRestApiAnswer(array(
        'success' => 1,
        'idSubject' => $idSubject
    ));
} else if ($actionName == "createQuestion") {
    if (!isset(
        $_POST['subjectId'],
        $_POST['questionName'],
        $_POST['answer'],
    )) {
        $defaultErrorAnswer['message'] = ERROR_NO_GOOD_ARGUMENTS;
        sendRestApiAnswer($defaultErrorAnswer);
    }
    $subjectId = $_POST['subjectId'];
    $questionName = $_POST['questionName'];
    $answer = $_POST['answer'];

    $idQuestion = \TechMateForm\Question::createQuestion($conn, $questionName, $answer, $subjectId);
    if ($idQuestion < 1) {
        $defaultErrorAnswer['message'] = 'Error creating question';
        sendRestApiAnswer($defaultErrorAnswer);
    }
    sendRestApiAnswer(array(
        'success' => 1,
        'idQuestion' => $idQuestion
    ));
} else if ($actionName == "editQuestion") {
    if (!isset(
        $_POST['questionId'],
        $_POST['questionName'],
        $_POST['answer'],
    )) {
        $defaultErrorAnswer['message'] = ERROR_NO_GOOD_ARGUMENTS;
        sendRestApiAnswer($defaultErrorAnswer);
    }
    $questionId = $_POST['questionId'];
    $questionName = $_POST['questionName'];
    $answer = $_POST['answer'];

    $isUpdated = \TechMateForm\Question::editQuestion($conn, $questionId, $questionName, $answer);
    if (!$isUpdated) {
        $defaultErrorAnswer['message'] = 'Error updating question';
        sendRestApiAnswer($defaultErrorAnswer);
    }
    sendRestApiAnswer(array(
        'success' => 1,
        'idQuestion' => $questionId
    ));
} else if ($actionName == "relateQuestion") {
    if (!isset(
        $_POST['parentId'],
        $_POST['childId'],
    )) {
        $defaultErrorAnswer['message'] = ERROR_NO_GOOD_ARGUMENTS;
        sendRestApiAnswer($defaultErrorAnswer);
    }
    $parentId = $_POST['parentId'];
    $childId = $_POST['childId'];

    $isRelated = \TechMateForm\QuestionChildren::checkIfRelationshipExists($conn, $parentId, $childId);
    if ($isRelated) {
        $isDeleted = \TechMateForm\QuestionChildren::deleteRelationship($conn, $parentId, $childId);
        if (!$isDeleted) {
            $defaultErrorAnswer['message'] = 'Αδυναμία διαγραφής σχέσης';
            sendRestApiAnswer($defaultErrorAnswer);
        }
        $newStatus = false;
    } else {
        $isAdded = \TechMateForm\QuestionChildren::addRelationship($conn, $parentId, $childId);
        if (!$isAdded) {
            $defaultErrorAnswer['message'] = 'Αδυναμία προσθήκης σχέσης';
            sendRestApiAnswer($defaultErrorAnswer);
        }
        $newStatus = true;
    }
    sendRestApiAnswer(array(
        'success' => 1,
        'related' => $newStatus
    ));
}


$defaultErrorAnswer['message'] = ERROR_ACTION_NOT_FOUND;
sendRestApiAnswer($defaultErrorAnswer);