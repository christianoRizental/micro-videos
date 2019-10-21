<?php

namespace Tests\Unit\Models;

use App\Models\Genre;
use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreTest extends TestCase
{
    private $genre;

    /* Executa logo que começa o teste apenas uma vez */
    //public static function setUpBeforeClass()
    //{
        //parent::setUpBeforeClass();
    //}

    /* Executa antes do teste */
    protected function setUp(): void
    {
        parent::setUp();
        $this->genre = new Genre();
    }

    /* Executa depois do teste */
    //protected function tearDown(): void
    //{
    //    parent::TearDown();
    //}

    //public static function tearDownAfterClass()
    //{
        //parent::tearDownAfterClass();
    //}

    public function testIfUseTraits()
    {
        $traits = [
            SoftDeletes::class,
            Uuid::class
        ];
        $genreTraits = array_keys(class_uses(Genre::class));
        $this->assertEquals($traits, $genreTraits);
    }

    public function testFillableAttribute()
    {
        $fillable = ['name','is_active'];
        $this->assertEquals($fillable, $this->genre->getFillable());
    }

    public function testDatesAttribute()
    {
        $dates = ['deleted_at','created_at','updated_at'];
        foreach($dates as $date){
            $this->assertContains($date, $this->genre->getDates());
        }
        $this->assertCount(count($dates), $this->genre->getDates());
    }

    public function testCastsAttibute()
    {
        $casts = ['id' => 'string', 'is_active' => 'boolean'];
        $this->assertEquals($casts, $this->genre->getCasts());
    }

    public function testIncrementing()
    {
        $this->assertFalse($this->genre->incrementing);
    }
}
