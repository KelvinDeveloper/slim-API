<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Hashing\BcryptHasher as Hash;

class User extends Model
{

    protected $fillable = ['name', 'lastname', 'email', 'password'];

    public function StoreData ( $Post )
    {

        $Hash = new Hash;

        $Post['password'] = $Hash->make( $Post['password'] );

        return $Post;
    }

    public function UpdateData ( $Post )
    {

        if ( isset( $Post['password'] ) ) return $this->StoreData($Post);

        return $Post;
    }

}