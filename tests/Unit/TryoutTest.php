<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TryoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test  **/
    public function it_can_be_open_for_registration()
    {
        $this->withExceptionHandling();

        $tryout = factory('App\Tryout')->create([
            'class_size' => 1,
            'registration_open' => Carbon::now()->subDays(2),
            'event_time' => Carbon::now()->addDays(2),
        ]);

        $this->assertEquals(1, $tryout->registrationOpen()->count());

        $tryout->event_time = Carbon::now()->subDays(1);
        $tryout->save();
        $tryout->fresh();

        $this->assertEquals(0, $tryout->registrationOpen()->count());
    }

    /** @test  **/
    public function it_can_be_full()
    {
        $tryout = factory('App\Tryout')->create([
            'class_size' => 1,
        ]);

        $this->assertFalse($tryout->isFull());

        $tryout->class_size = 0;
        $tryout->save();
        $tryout->fresh();

        $this->assertTrue($tryout->isFull());
    }
}
