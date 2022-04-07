<?php

namespace App\Libs;

class ResponseStatus
{
  public static function info(bool $success, string $message = "Successful", int $status = 200)
  {
    if (!$success) {
      $message = "Failure";
      $status  = 400;
    }
    return response()->json([
      "success" => $success,
      "message" => $message,
      "status"  => $status
    ]);
  }
}
