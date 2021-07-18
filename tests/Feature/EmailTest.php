<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Tests\TestCase;

class EmailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function user_should_receive_order_shipped_email()
    {
        Mail::fake();

        $user = User::factory()->create();
        $deal = Order::factory()
            ->for($user)
            ->create();


        $recipient = $user->email;
        $subject = 'Order ' . $order->id . ' is shipped';

        Mail::shouldReceive('send')
            ->with(
                'emails.order-shipped',
                Mockery::type('array'),
                Mockery::on(function (\Closure $closure) use ($subject, $recipient) {
                    $mock = Mockery::mock(\Illuminate\Mail\Message::class);
                    $mock->shouldReceive('to')->once()->with($recipient)->andReturn($mock);
                    $mock->shouldReceive('subject')->once()->with($subject);

                    $closure($mock);

                    return true;
                }),
            )
            ->times(1)
        ;

        sendMailOrderShipped($order);
    }
}
