<?php

namespace App\telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{

    public function handleUnknownCommand(Stringable $text): void
    {
//        if ($text->value() === '/start') {
//            $this->reply('Hello!👋  Welcome to Telegram bot!');
//        } else {
//            $this->reply('Unknown command');
//        }
    }



    public function start(): void
    {
        $this->chat->message("Hello!👋 Send your phone number for authorization!")->replyKeyboard(ReplyKeyboard::make()->oneTime()->buttons([
            ReplyButton::make('Send your phone number')->requestContact()
        ]))->send();
//        $this->chat->message("Hello!👋 Send your phone number for authorization!")->replyKeyboard(ReplyKeyboard::make()->row([
//            ReplyButton::make('Send your phone number')->requestContact()
//        ]))->send();
    }

    public function handleChatMessage(Stringable $text): void
    {
    $phone = $this->message->contact()->phoneNumber();
    $userId = $this->message->contact()->userId();
    $verifyUserId = $this->message->from()->id();

    $isVerifyPhone = intval($userId ==$verifyUserId);

//    $this->chat->html("Received: $phone, $userId, $verifyUserId, total: $isVerifyPhone")->send();
    $this->chat->message("Welcome to Telegram bot!")->send();
    }

public function about()
{
    Telegraph::message("Our telegram bot will teach you laravel")->send();
//    $this->reply('Our telegram bot will teach you laravel ');
//    $this->chat->message('Our telegram bot will teach you laravel');
}

    public function help(): void
    {
//            /** @var TelegraphChat $chat */
//            $chat->html("<h5>Laravel Bot Support Center.</h5>\n How can I help you?")->send();
        Telegraph::message("Laravel Bot Support Center. How can I help you?")->send();
    }
    public function actions(): void
    {
//        dd('kop');
        Telegraph::message('Choose what action')
            ->keyboard(Keyboard::make()->buttons([
                Button::make('go to website')->url('https://defstudio.github.io/telegraph/'),
                Button::make('layk qo\'yish')->action('like'),
                Button::make('Kanalga a\'zo bo\'sh')
                    ->action('subscribe')
                    ->param('group_name', 'LearningLaravel'),
                Button::make('switch')->switchInlineQuery('foo')->currentChat(),
            ]))->send();
    }

    public function like(): void
    {
//        $chat = TelegraphChat::find(1);
        //        $chat->message('hello')->send();


        $this->reply("Thank you for your like!");
//        Telegraph::message('Thank you for your like!')->send();
    }

    public function subscribe(): void
    {
//        $this->reply("Thanks for joining the group {$this->data->get('group_name')}!");
        Telegraph::message("Thanks for joining the group {$this->data->get('group_name')}!")->send(); //
    }


}
