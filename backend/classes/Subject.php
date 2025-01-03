<?php

namespace TechMateForm;

class Subject
{
    public static function getSubjects($conn)
    {
        $sql = "SELECT * FROM Subject";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function getSubjectById($conn, $id)
    {
        $sql = "SELECT * FROM Subject WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function createSubject($conn, $subjectName)
    {
        $sql = "INSERT INTO Subject (subjectName) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $subjectName);
        $stmt->execute();
        return $stmt->insert_id;
    }
}