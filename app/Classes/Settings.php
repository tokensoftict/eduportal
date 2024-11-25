<?php

namespace App\Classes;

use Spatie\Valuestore\Valuestore;

class Settings extends Valuestore
{

    public static function ApplicationStatus(string $status_id)
    {
        $status = [
            "0" => "Pending",
            "1" => "Submitted",
            "2" => "Admitted",
            "3" => "Rejected",
            "4" => "Acceptance Paid"
        ];
        return $status[$status_id];
    }

    public static function ApplicationStatusLabel(string $status_id)
    {
        $status = [
            "0" => "text-warning",
            "1" => "text-primary",
            "2" => "text-success",
            "3" => "text-danger",
            "4" => "text-success"
        ];

        return $status[$status_id];
    }


   public static function generatePassword($chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", $length = 6) {
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }


    public static function generationNumber($student_id)
    {
        $padStudentID = str_pad($student_id, 4, '0', STR_PAD_LEFT);
        return "JU/".date('Y') ."/". $padStudentID;
    }
}
