<?php

namespace TechMateForm;

class QuestionChildren
{
    public static function getRelationships($conn, $parentQuestionId)
    {
        $sql = "SELECT * FROM QuestionChildren WHERE parentQuestion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $parentQuestionId);
        $stmt->execute();
        return array_map(function ($row) {
            return $row['childQuestion'];
        }, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));
    }

    public static function addRelationship($conn, $parentQuestionId, $childQuestionId)
    {
        $sql = "INSERT INTO QuestionChildren (parentQuestion, childQuestion) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $parentQuestionId, $childQuestionId);
        return $stmt->execute();
    }

    public static function checkIfRelationshipExists($conn, $parentQuestionId, $childQuestionId)
    {
        $sql = "SELECT * FROM QuestionChildren WHERE parentQuestion = ? AND childQuestion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $parentQuestionId, $childQuestionId);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public static function deleteRelationship($conn, $parentQuestionId, $childQuestionId)
    {
        $sql = "DELETE FROM QuestionChildren WHERE parentQuestion = ? AND childQuestion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $parentQuestionId, $childQuestionId);
        return $stmt->execute();
    }
}