<?php

use Illuminate\Database\Eloquent\Model;

if (!function_exists('valida_cpf')) {
  function valida_cpf(string $cpf = null)
  {
    $cpf = preg_replace('/[^0-9]/is', '', $cpf);

    if (strlen($cpf) != 11) {
      return false;
    }

    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (preg_match('/(\d)\1{10}/', $cpf)) {
      return false;
    }

    for ($t = 9; $t < 11; $t++) {
      for ($d = 0, $c = 0; $c < $t; $c++) {
        $d += $cpf[$c] * (($t + 1) - $c);
      }
      $d = ((10 * $d) % 11) % 10;
      if ($cpf[$c] != $d) {
        return false;
      }
    }

    return true;
  }
}

if (!function_exists('sanitize')) {
  function sanitize(string $value): string
  {
    $value = strtolower($value);

    // ['.', ',', '-', '/', '\\', '#', '(', ')', ' ']
    $value = str_replace(' ', '', $value);

    return preg_replace('/[^A-Za-z0-9]/', '', trim(ltrim(rtrim($value))));
  }
}

if (!function_exists('generateUniqueId')) {
  function generateUniqueId(): string
  {
    return md5(uniqid(mt_rand(), true));
  }
}

//if (!function_exists('getResourceUrl')) {
//  function resource_url(Model $model, string $action): string
//  {
//    return request()->segment(1) . '.' . $model->getTable() . '.' . $action;
//  }
//}

if (!function_exists('getResourceUrl')) {
  function resource_url(Model $model, string $action): string
  {
    return $model->getTable() . '.' . $action;
  }
}

if (!function_exists('formatDate')) {
  function formatDate(DateTime $dateTime)
  {
    return $dateTime->format('d/m/Y H:i:s');
  }
}
