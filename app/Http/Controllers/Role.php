<?php

namespace App\Http\Controllers;

class Role
{
  
  public static function redirectBasedOnRole($role)
  {
    switch ($role) {
      case 'Admin':
        return 'admin.contentManagement';
      case 'Pelapor':
        return 'pelapor.reportPelapor';
      case 'Pimpinan':
        return 'pimpinan.dashboard';
      case 'Superuser':
        return 'superuser';
        case 'Narahubung':
          return 'narahubung';
      default:
        return 'user.beranda';
    }
  }
}