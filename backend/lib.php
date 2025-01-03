<?php
function sendRestApiAnswer(array $arr): void {
    echo json_encode($arr);
    exit();
}