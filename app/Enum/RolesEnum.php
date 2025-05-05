<?php

namespace App\Enum;

enum RolesEnum:string
{
   case Admin = 'Admin';

   case Commenter = 'Commentor';

   case User = 'User';

   public static function labels(): array
   {
    return [
        self::Admin->value => 'Admin',
        self::Commenter->value => 'Commentor',
        self::User->value => 'User'
    ];
   }

   public function label()
   {
    return match($this)
    {
        self::Admin => 'Admin',
        self::User => 'User',
        self::Commenter => 'Commentor'

    };
   }
}
