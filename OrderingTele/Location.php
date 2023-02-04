<?php

include '../functions.php';
include '../paymproc.php';

$received = json_decode(file_get_contents('php://input'));



if ($received->action == 'submitlocation') {


    echo json_encode(CommentLitsener($received->comment, $received->selectedDate, $received->UID));
}

if ($received->action == 'submitDatePicker') {


    echo json_encode(DatePickerSelecter($received->selectedDate, $received->UID));
}


if ($received->action == 'submitemail') {


    echo json_encode(emailSubmit($received->comment, $received->UID));
}

function emailSubmit($comment, $UID)
{
    emailUpdater($comment, $UID);
}

function CommentLitsener($comment, $selectedDate, $UID)
{
    setLocationComment($comment, $selectedDate, $UID);
}

function DatePickerSelecter($selectedDate, $UID)
{
    setDatePicker($selectedDate, $UID);
}
