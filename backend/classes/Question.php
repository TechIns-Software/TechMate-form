<?php

namespace TechMateForm;

class Question
{
    /**
     * Get all questions from the database.
     */
    public static function getQuestions($conn)
    {
        $sql = "SELECT * FROM Question";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return ["error" => "Database error: " . $conn->error];
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public static function getQuestionById($conn, $questionId)
    {
        $sql = "SELECT * FROM Question WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return ["error" => "Database error: " . $conn->error];
        }

        $stmt->bind_param('i', $questionId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result ? $result->fetch_assoc() : [];
    }
    /**
     * Get questions by idSubject.
     */
    public static function getQuestionByIdSubject($conn, $idSubject)
    {
        $sql = "SELECT * FROM Question WHERE idSubject = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $idSubject);
        $stmt->execute();
        $result = $stmt->get_result();

        return ($result && $result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    /**
     * Create a new question.
     */
    public static function createQuestion($conn, $questionName, $answer, $subjectId)
    {
        $sql = "INSERT INTO Question (questionName, answer, idSubject) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return ["error" => "Database error: " . $conn->error];
        }

        $stmt->bind_param('ssi', $questionName, $answer, $subjectId);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return 0;
        }
    }

    public static function editQuestion($conn, $questionId, $questionName, $answer)
    {
        $sql = "UPDATE Question SET questionName = ?, answer = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            return ["error" => "Database error: " . $conn->error];
        }

        $stmt->bind_param('ssi', $questionName, $answer, $questionId);
        return $stmt->execute() && $stmt->affected_rows > 0;
    }

}
