<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('channel-name', function (User $user) {
    return true;
});

Broadcast::channel('public-channel.{ticketGroup}', function ($ticketgroup) {
    return true;
});
